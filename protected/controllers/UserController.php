<?php

class UserController extends Controller
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
				'actions'=>array('create','createArtist'),
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
        $userModel = $this->loadModel($id);
        $dataProviderArtists=new CArrayDataProvider($userModel->artists, array(
            'keyField'=>'aid',
            /*'id'=>'user',
            'sort'=>array(
                'attributes'=>array(
                    'id', 'username', 'email',
                ),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),*/
        ));
        $dataProviderFollowing=new CArrayDataProvider($userModel->usersFollowed, array(
            'keyField'=>'uid',
            /*'id'=>'user',
            'sort'=>array(
                'attributes'=>array(
                    'id', 'username', 'email',
                ),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),*/
        ));

        $futureconcertinfo = Yii::app()->db->createCommand()
            // ->select('co.course_name, cl.section_id')
            ->select('c.*, a.aid ,a.aname,v.vname, v.city')
            ->from('concert c, artist a, venue v, user_concert uc')
            ->where('uc.uid = :uid and c.cid = uc.cid and c.aid = a.aid and c.vid = v.vid and c.cdate>CURRENT_DATE()',
                array(':uid'=>$userModel->uid ))
            ->queryAll();
        foreach($futureconcertinfo as $i=>$concert){
            $userConcert = UserConcert::model()->find('uid=:uid and cid = :cid',array(':uid'=>Yii::app()->user->getId(),':cid'=>$concert['cid']));
            if($userConcert){
                $futureconcertinfo[$i]['attending']="Yes";
            }else{
                $futureconcertinfo[$i]['attending']="No";
            }
        }
        $dataProviderFutureConcerts=new CArrayDataProvider($futureconcertinfo, array(
            'keyField'=>'cid',
            //   'id'=>'cid',
            'sort'=>array(
                'attributes'=>array(
                    'cdate',
                ),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
        $pastconcertinfo = Yii::app()->db->createCommand()
            // ->select('co.course_name, cl.section_id')
            ->select('c.*, a.aid ,a.aname,v.vname, v.city, uc.rate, uc.review')
            ->from('concert c, artist a, venue v, user_concert uc')
            ->where('uc.uid = :uid and c.cid = uc.cid and c.aid = a.aid and c.vid = v.vid and
            (c.cdate between (CURRENT_DATE() - interval 30 day) and CURRENT_DATE())',
                array(':uid'=>$userModel->uid ))
            ->queryAll();
        foreach($pastconcertinfo as $i=>$concert){
            $userConcert = UserConcert::model()->find('uid=:uid and cid = :cid',array(':uid'=>Yii::app()->user->getId(),':cid'=>$concert['cid']));
            if(isset($userConcert->review)|| isset($userConcert->rate)){
                $pastconcertinfo[$i]['reviewed']="Yes";
            }else{
                $pastconcertinfo[$i]['reviewed']="No";
            }
        }
        $dataProviderPastConcerts=new CArrayDataProvider($pastconcertinfo, array(
            'keyField'=>'cid',
            //   'id'=>'cid',
            'sort'=>array(
                'attributes'=>array(
                    'cdate',
                ),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
        $recommendations = Yii::app()->db->createCommand()
            // ->select('co.course_name, cl.section_id')
            ->select('c.*,a.aname, a.aid, v.vname')
            ->from('concert c, list l,concert_list cl, user_follow uf, artist a, venue v, user u2')
            ->where('uf.uid = :uid and uf.fuid = l.uid and l.uid = u2.uid and l.lid = cl.lid and cl.cid = c.cid and
                 c.aid = a.aid and c.vid = v.vid',
                array(':uid'=>$userModel->uid,))
            ->queryAll();
       /* $dataProviderRecommendations=new CArrayDataProvider($recommendations, array(
            'keyField'=>'rid',
            //   'id'=>'cid',
            /* 'sort'=>array(
                 'attributes'=>array(
                     'id', 'username', 'email',
                 ),
             ),
             'pagination'=>array(
                 'pageSize'=>10,
             ),
        ));*/
        $dataProviderLists=new CArrayDataProvider($userModel->lists, array(
            'keyField'=>'lid',

             'pagination'=>array(
                 'pageSize'=>10,
             ),
        ));
        $follows = UserFollow::model()->exists('uid = :uid and fuid = :fuid',array(':uid'=>Yii::app()->user->getId(),':fuid'=>$userModel->uid));
		$this->render('view',array(
			'model'=>$userModel,
            'recommendations'=>$recommendations,
            'dataProviderArtists'=>$dataProviderArtists,
            'dataProviderFollowing'=>$dataProviderFollowing,
            'dataProviderFutureConcerts'=>$dataProviderFutureConcerts,
            'dataProviderPastConcerts'=>$dataProviderPastConcerts,
           //'dataProviderRecommendations'=>$dataProviderRecommendations,
            'dataProviderLists'=>$dataProviderLists,
            'follows'=>$follows,
            'is_user'=>(Yii::app()->user->getId() == $userModel->uid),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

       // $musictypes = {'rock','jazz',}
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
            $model->reputation=0;
            $model->last_login_tp= new CDbExpression('CURRENT_DATE()');
			if($model->save()) {

                $this->redirect(array('//site/login'));
            }
            else{
                print_r($model->getErrors());
            }

		}

		$this->render('//user/create',array(
			'model'=>$model,
		));
	}

    public function actionCreateArtist()
    {
        $usermodel=new User;
        $artistmodel = new Artist;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        // $musictypes = {'rock','jazz',}
        if(isset($_POST['User']) && isset($_POST['Artist']) )
        {
            $usermodel->attributes=$_POST['User'];
            $artistmodel->attributes=$_POST['Artist'];
            $usermodel->reputation=10;
            $usermodel->last_login_tp= new CDbExpression('CURRENT_DATE()');
            $usermodel->uname = $artistmodel->aname;
            $usermodel->artist=1;
            if($usermodel->save()){
                $artistmodel->aid=$usermodel->uid;
                $artistmodel->aemail=$usermodel->uemail;
                $artistmodel->last_login_tp= new CDbExpression('CURRENT_DATE()');
                if($artistmodel->save()){
                    $userArtist = new UserArtist();
                    $userArtist->uid=$usermodel->uid;
                    $userArtist->aid=$artistmodel->aid;
                    $userArtist->fan_tp= new CDbExpression('CURRENT_DATE()');
                    if($userArtist->save()){
                        $this->redirect(array('//site/login'));
                    }
                    else{
                        print_r($userArtist->getErrors());
                    }
                }
                else{
                    print_r($artistmodel->getErrors());
                }
            }
            else{
                print_r($usermodel->getErrors());
            }

        }

        $this->render('create_artist',array(
            'usermodel'=>$usermodel,
            'artistmodel'=>$artistmodel,
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

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->uid));
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
    public function actionFollow($thisUser){
        $currentUser=Yii::app()->user->getId();

        $userFollowRecord=new UserFollow();
        $userFollowRecord->uid=$currentUser;
        $userFollowRecord->fuid=$thisUser;
        $userFollowRecord->follow_tp= new CDbExpression('CURRENT_DATE()');
        if($userFollowRecord->save())
            $this->actionView($thisUser);
        else{
            print_r($userFollowRecord->getErrors());
        }
    }
    public function actionUnfollow($thisUser){
        $userFollowRecord = UserFollow::model()->find('uid = :uid and fuid = :fuid',array(':uid'=>Yii::app()->user->getId(),':fuid'=>$thisUser));
        if($userFollowRecord->delete())
            $this->actionView($thisUser);
        else{
            print_r($userFollowRecord->getErrors());
        }
    }
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User', array(
            'criteria'=>array(
                'condition'=>'artist=0',

            ),

        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
