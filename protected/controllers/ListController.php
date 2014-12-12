<?php

class ListController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view', 'add', 'remove'),
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
        $listModel = $this->loadModel($id);
        $concertinfo = Yii::app()->db->createCommand()
            ->select('c.*, a.aid ,a.aname,v.vname, v.city')
            ->from('concert c, artist a, venue v, concert_list cl')
            ->where('cl.lid = :lid and cl.cid = c.cid and c.aid = a.aid and c.vid = v.vid',
                array(':lid'=>$id ))
            ->queryAll();
        foreach($concertinfo as $i=>$concert){
            $concertinfo[$i]['lid'] = $id;
            $concertinfo[$i]['listing'] = "Yes";
            $concertinfo[$i]['uid'] = $listModel->uid;
            $userConcert = UserConcert::model()->find('uid=:uid and cid = :cid',array(':uid'=>Yii::app()->user->getId(),':cid'=>$concert['cid']));
            if($userConcert){
                $concertinfo[$i]['attending']="Yes";
            }else{
                $concertinfo[$i]['attending']="No";
            }
        }
        $dataProviderConcerts=new CArrayDataProvider($concertinfo, array(
            'keyField'=>'cid',
            //   'id'=>'cid',

            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
		$this->render('view',array(
			'model'=>$this->loadModel($id),
            'dataProviderConcerts'=>$dataProviderConcerts,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

	public function actionCreate($uid)
	{
		$model=new ListModel;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ListModel']))
		{
			$model->attributes=$_POST['ListModel'];
            $model->uid=$uid;
			if($model->save())
				$this->redirect(array('view','id'=>$model->lid));
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

		if(isset($_POST['ListModel']))
		{
			$model->attributes=$_POST['ListModel'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->lid));
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
        $listinfo = Yii::app()->db->createCommand()
        ->select('l.*')
        ->from('list l')
        ->where('l.uid= :uid',array(':uid'=>Yii::app()->user->getId()))
        ->queryAll();
		$dataProvider=new CArrayDataProvider($listinfo, array('keyField'=>'lid'));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ListModel('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ListModel']))
			$model->attributes=$_GET['ListModel'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ListModel the loaded model
	 * @throws CHttpException
	 */
    public function actionAdd($cid,$return){
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $concertList= new ConcertList();
        $lists = ListModel::model()->findAll('uid = :uid',array(':uid'=>Yii::app()->user->getId()));
        if(isset($_POST['ConcertList']))
        {
            $concertList->attributes=$_POST['ConcertList'];
            $concertList->cid=$cid;
            if(ConcertList::model()->exists('lid = :lid and cid = :cid',array(':lid'=>$concertList->lid,':cid'=>$concertList->cid))){
                $this->refresh();
            }else if($concertList->save()){
                $this->redirect(Yii::app()->baseUrl.'/index.php/list/'.$concertList->lid);
            }else{
                print_r($concertList->getErrors());
            }
        }

        $this->render('choose_list',array(
            'concertList'=>$concertList,
            'lists'=>$lists,
        ));
    }

    public function actionRemove($cid,$lid,$return){
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $listModel = $this->loadModel($lid);
        if($listModel->user->uid != Yii::app()->user->getId()){
            $this->refresh();
        }
        $concertList= ConcertList::model()->find('cid=:cid and lid=:lid',array(':cid'=>$cid,':lid'=>$lid));
        if($concertList->delete()){
            $this->redirect(Yii::app()->baseUrl.$return);
        }else{
            echo $concertList->getErrors();
        }
    }
	public function loadModel($id)
	{
		$model=ListModel::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ListModel $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='list-model-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
