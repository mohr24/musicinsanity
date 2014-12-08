<?php

class ConcertController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            /*array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('create'),
                'users'=>array('*'),
            ),*/
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('attend','update','unattend', 'review','index','view','create'),
                'users'=>array('@'),
            ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $concertModel = $this->loadModel($id);
        if(Yii::app()->user->artist){
            $is_artist = (Yii::app()->user->aid == $concertModel->aid);
        }
        else{
            $is_artist=false;
        }
        $attending = UserConcert::model()->exists('uid = :uid and cid = :cid',array(':uid'=>Yii::app()->user->getId(),':cid'=>$concertModel->cid));
		$this->render('view',array(
			'model'=>$concertModel,
            'is_artist'=>$is_artist,
            'attending'=>$attending,
            'past' =>(new CDbExpression('CURRENT_DATE()>:date',array(':date'=>$concertModel->cdate))),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Concert;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Concert']))
		{
			$model->attributes=$_POST['Concert'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->cid));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Concert']))
		{
			$model->attributes=$_POST['Concert'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->cid));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Concert');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Concert('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Concert']))
			$model->attributes=$_GET['Concert'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
    public function actionAttend($id,$return){
        $currentUser=Yii::app()->user->getId();

        $userConcert = new UserConcert();
        $userConcert->uid = $currentUser;
        $userConcert->cid = $id;
        if($userConcert->save()){
            if($return == "home") {
                $this->redirect(array('site/index'));
            }else if($return == "page"){
                $this->actionView($id);
            }

        }

        else{
            print_r($userConcert->getErrors());
        }

    }
    public function actionUnattend($id,$return){
        $userConcert = UserConcert::model()->find('uid = :uid and cid = :cid',array(':uid'=>Yii::app()->user->getId(),':cid'=>$id));
        if($userConcert->delete())
            if($return == "home") {
                $this->redirect(array('site/index'));
            }else if($return == "page"){
                $this->actionView($id);
            }
        else{
            print_r($userConcert->getErrors());
        }
    }
    public function actionReview($id,$return){
        $userConcert = UserConcert::model()->find('uid = :uid and cid = :cid',array(':uid'=>Yii::app()->user->getId(),':cid'=>$id));
        if(isset($_POST['UserConcert']))
        {
            $userConcert->attributes=$_POST['UserConcert'];
            $userConcert->attend_tp = new CDbExpression('CURRENT_DATE()');
            if($userConcert->save())
                if($return == "home") {
                    $this->redirect('//site/index');
                }else if($return == "page"){
                    $this->redirect('view/'.$id);
                }
        }

        $this->render('review',array(
            'model'=>$userConcert,
        ));
    }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Concert the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Concert::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Concert $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='concert-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
