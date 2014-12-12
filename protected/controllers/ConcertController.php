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
                'actions'=>array('attend','update','unattend', 'review','index','view','create','createUser'),
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
            $is_your_concert = (Yii::app()->user->getId() == $concertModel->aid);
            $is_artist = true;
        }
        else{
            $is_your_concert=false;
            $is_artist = false;
        }
        $past = Concert::model()->exists('cid = :cid and cdate < CURRENT_DATE()',array(':cid'=>$id));
        $reviews = Yii::app()->db->createCommand()
            // ->select('co.course_name, cl.section_id')
            ->select('c.*,a.aname, a.aid,v.vname, v.city, u.uid,u.uname, uc.review, uc.rate')
            ->from('concert c, artist a, venue v, user_concert uc, user u')
            ->where('c.cid = :cid and u.uid = uc.uid and uc.cid = c.cid and c.aid = a.aid and c.vid = v.vid and (uc.review is not NULL or uc.rate is not NULL)' ,
                array(':cid'=>$id,))
            ->queryAll();
        foreach($reviews as $i=>$concert){
            $userConcert = UserConcert::model()->find('uid=:uid and cid = :cid',array(':uid'=>Yii::app()->user->getId(),':cid'=>$concert['cid']));
            if(isset($userConcert->review)|| isset($userConcert->rate)){
                $reviews[$i]['reviewed']="Yes";
            }else{
                $reviews[$i]['reviewed']="No";
            }
        }
        $dataProviderReviews = new CArrayDataProvider($reviews, array(
            'keyField'=>'cid',
        ));
        $attending = UserConcert::model()->exists('uid = :uid and cid = :cid',array(':uid'=>Yii::app()->user->getId(),':cid'=>$concertModel->cid));

        $this->render('view',array(
			'model'=>$concertModel,
            'dataProviderReviews'=>$dataProviderReviews,
            'is_your_concert'=>$is_your_concert,
            'artist'=>$is_artist,
            'attending'=>$attending,
            'past' =>$past,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($aid)
	{
		$model=new Concert;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Concert']))
		{
			$model->attributes=$_POST['Concert'];
            $model->aid=$aid;
            $model->concert_tp = new CDbExpression('CURRENT_DATE()');
			if($model->save()){
                $artistMusictypes = Artist::model()->find('aid = :aid',array(':aid'=>$aid))->musictypes;
                foreach($artistMusictypes as $musictype){
                    $concertMusictype = new ConcertMusictype();
                    $concertMusictype->cid = $model->cid;
                    $concertMusictype->type_name= $musictype->type_name;
                    if(!$concertMusictype->save())
                        print_r($concertMusictype->getErrors());
                }
                $this->redirect(array('view','id'=>$model->cid));
            }

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
    
    public function actionCreateUser()
    {
        $model=new Concert;
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if(isset($_POST['Concert']))
        {
            $model->attributes=$_POST['Concert'];
            $model->submitted_by_uid = Yii::app()->user->id;
            $model->concert_tp = new CDbExpression('CURRENT_DATE()');
            if($model->save()){
                $currentuser = User::model()->findByPk(Yii::app()->user->getId());
                $currentuser->saveAttributes(array('reputation'=>$currentuser->reputation+1));
                Yii::app()->user->setState('reputation', $currentuser->reputation);

                $this->redirect(array('//list/add','cid'=>$model->cid, 'return'=>substr(Yii::app()->request->url, strlen(Yii::app()->baseUrl))));
            }

        }
        
        $this->render('create_user',array(
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
	public function actionIndex($future)
	{
        $user_id = Yii::app()->user->getId();
        if(isset($future) && $future=="false"){
            $pastConcerts = Yii::app()->db->createCommand()
                // ->select('co.course_name, cl.section_id')
                ->select('c.*,a.aname, a.aid,v.vname, v.city')
                ->from('concert c, artist a, venue v')
                ->where('c.aid = a.aid and c.vid = v.vid and
                    c.cdate < CURRENT_DATE()')
                ->order('c.cdate DESC')
                ->queryAll();
            //add attending column
            foreach($pastConcerts as $i=>$concert){
                $userConcert = UserConcert::model()->find('uid=:uid and cid = :cid',array(':uid'=>Yii::app()->user->getId(),':cid'=>$concert['cid']));
                if(isset($userConcert->review)|| isset($userConcert->rate)){
                    $pastConcerts[$i]['reviewed']="Yes";
                }else{
                    $pastConcerts[$i]['reviewed']="No";
                }
            }
            $dataProviderConcerts=new CArrayDataProvider($pastConcerts, array(
                'keyField'=>'cid',
                //   'id'=>'cid',
                /* 'sort'=>array(
                     'attributes'=>array(
                         'id', 'username', 'email',
                     ),
                 ),
                 'pagination'=>array(
                     'pageSize'=>10,
                 ),*/
            ));


        }else{
            $upcomingConcerts = Yii::app()->db->createCommand()
                // ->select('co.course_name, cl.section_id')
                ->select('c.*,a.aname, a.aid,v.vname, v.city')
                ->from('concert c, artist a, venue v')
                ->where('c.aid = a.aid and c.vid = v.vid and
              c.cdate>=CURRENT_DATE()')
                ->order('c.cdate ASC')
                ->queryAll();
            //add attending column
            foreach($upcomingConcerts as $i=>$concert){
                $userConcert = UserConcert::model()->find('uid=:uid and cid = :cid',array(':uid'=>$user_id,':cid'=>$concert['cid']));
                if($userConcert){
                    $upcomingConcerts[$i]['attending']="Yes";
                }else{
                    $upcomingConcerts[$i]['attending']="No";
                }
            }
            $dataProviderConcerts=new CArrayDataProvider($upcomingConcerts, array(
                'keyField'=>'cid',
                //   'id'=>'cid',
                /* 'sort'=>array(
                     'attributes'=>array(
                         'id', 'username', 'email',
                     ),
                 ),
                 'pagination'=>array(
                     'pageSize'=>10,
                 ),*/
            ));

        }
        $this->render('index',array(
            'dataProviderConcerts'=>$dataProviderConcerts,
            'artist'=>Yii::app()->user->artist,
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
            $this->redirect(Yii::app()->baseUrl.$return);
        }

        else{
            print_r($userConcert->getErrors());
        }

    }
    public function actionUnattend($id,$return){
        $userConcert = UserConcert::model()->find('uid = :uid and cid = :cid',array(':uid'=>Yii::app()->user->getId(),':cid'=>$id));
        if($userConcert->delete())
            $this->redirect(Yii::app()->baseUrl.$return);
        else{
            print_r($userConcert->getErrors());
        }
    }
    public function actionReview($id,$return){
        $concert = Concert::model()->find('cid = :cid and cdate <= CURRENT_DATE()',array(':cid'=>$id));
        if(!$concert){
            $this->actionView($id);
        }
        $userConcert = UserConcert::model()->find('uid = :uid and cid = :cid',array(':uid'=>Yii::app()->user->getId(),':cid'=>$id));
        if(!$userConcert){
            $userConcert=new UserConcert();
            $userConcert->uid= Yii::app()->user->getId();
            $userConcert->cid = $id;
        }

        if(isset($_POST['UserConcert']))
        {
            $userConcert->attributes=$_POST['UserConcert'];
            $userConcert->attend_tp = new CDbExpression('CURRENT_DATE()');
            if($userConcert->save()){
                $currentuser = User::model()->findByPk(Yii::app()->user->getId());
                $currentuser->saveAttributes(array('reputation'=>$currentuser->reputation+0.5));
                Yii::app()->user->setState('reputation', $currentuser->reputation);

                $this->redirect(Yii::app()->baseUrl.$return);
            }
            else{
                echo $userConcert->getErrors();
            }
        }

        $this->render('review',array(
            'cname'=>$concert->cname,
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
