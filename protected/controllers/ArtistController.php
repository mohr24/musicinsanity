<?php

class ArtistController extends Controller
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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('create'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('follow','update','unfollow','index','view'),
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
        $user_id = Yii::app()->user->getId();
        $artistModel=$this->loadModel($id);
        $dataProviderMusicType =new CArrayDataProvider($artistModel->musictypes, array(
            'keyField'=>'type_name',
        ));
        $futureconcertinfo = Yii::app()->db->createCommand()
            // ->select('co.course_name, cl.section_id')
            ->select('c.*, v.vname, v.city, a.aid, a.aname')
            ->from('concert c, artist a, venue v')
            ->where('a.aid = :aid and c.aid = a.aid and c.vid = v.vid and (c.cdate between CURRENT_DATE() and (CURRENT_DATE() + interval 30 day))',
                array(':aid'=>$artistModel->aid ))
            ->queryAll();
        foreach($futureconcertinfo as $i=>$concert){
            $futureconcertinfo[$i]["artist"] = true;
        }
        $dataProviderUpcomingConcerts =new CArrayDataProvider($futureconcertinfo, array(
            'keyField'=>'cid',
        ));
        $reviews = Yii::app()->db->createCommand()
            // ->select('co.course_name, cl.section_id')
            ->select('u.uid, u.uname, a.aname, a.aid, uc.rate, uc.review, c.*, v.vname, v.city')
            ->from('concert c, artist a, venue v, user_concert uc, user u')
            ->where('a.aid = :aid and c.cid = uc.cid and c.aid = a.aid and c.vid = v.vid and u.uid = uc.uid and
            (c.cdate between (CURRENT_DATE() - interval 30 day) and CURRENT_DATE())',
                array(':aid'=>$artistModel->aid ))
            ->queryAll();
        foreach($reviews as $i=>$concert){
            $userConcert = UserConcert::model()->find('uid=:uid and cid = :cid',array(':uid'=>$user_id,':cid'=>$concert['cid']));
            if(isset($userConcert->review)|| isset($userConcert->rate)){
                $reviews[$i]['reviewed']="Yes";
            }else{
                $reviews[$i]['reviewed']="No";
            }
        }
        $dataProviderRecentReviews=new CArrayDataProvider($reviews, array(
            'keyField'=>'cid',
        ));
        $follows = UserArtist::model()->exists('uid = :uid and aid = :aid',array(':uid'=>Yii::app()->user->getId(),':aid'=>$artistModel->aid));

        $this->render('view',array(
			'model'=>$this->loadModel($id),
            'dataProviderMusicType'=>$dataProviderMusicType,
            'dataProviderUpcomingConcerts'=>$dataProviderUpcomingConcerts,
            'dataProviderRecentReviews'=>$dataProviderRecentReviews,
            'follows'=>$follows,
            'artist'=>Yii::app()->user->artist,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Artist;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Artist']))
		{
			$model->attributes=$_POST['Artist'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->aid));
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

		if(isset($_POST['Artist']))
		{
			$model->attributes=$_POST['Artist'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->aid));
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
		$dataProvider=new CActiveDataProvider('Artist');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Artist('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Artist']))
			$model->attributes=$_GET['Artist'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Artist the loaded model
	 * @throws CHttpException
	 */
    public function actionFollow($thisArtist){
        $currentUser=Yii::app()->user->getId();

        $userArtistRecord=new UserArtist();
        $userArtistRecord->uid=$currentUser;
        $userArtistRecord->aid=$thisArtist;
        $userArtistRecord->fan_tp= new CDbExpression('CURRENT_DATE()');
        if($userArtistRecord->save())
            $this->actionView($thisArtist);
        else{
            print_r($userArtistRecord->getErrors());
        }
    }
    public function actionUnfollow($thisArtist){
        $userArtistRecord = UserArtist::model()->find('uid = :uid and aid = :aid',array(':uid'=>Yii::app()->user->getId(),':aid'=>$thisArtist));
        if($userArtistRecord->delete())
            $this->actionView($thisArtist);
        else{
            print_r($userArtistRecord->getErrors());
        }
    }
	public function loadModel($id)
	{
		$model=Artist::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Artist $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='artist-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
