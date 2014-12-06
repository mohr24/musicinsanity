<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $user_id = Yii::app()->user->getId();

        $upcomingConcerts = Yii::app()->db->createCommand()
            // ->select('co.course_name, cl.section_id')
            ->select('c.cid,c.cdate,a.aname,v.vname')
            ->from('concert c, artist a, venue v, user_artist ua')
            ->where('ua.uid = :uid and ua.aid = a.aid and c.aid = a.aid and c.vid = v.vid and
              (c.cdate between CURRENT_DATE() and (CURRENT_DATE() + interval 14 day)) ',
                array(':uid'=>$user_id,))
            ->queryAll();
        //add attending column
        foreach($upcomingConcerts as $i=>$concert){
            $userConcert = UserConcert::model()->find('uid=:uid and cid = :cid',array(':uid'=>$user_id,':cid'=>$concert['cid']));
            if($userConcert){
                $upcomingConcerts[$i]['attending']="yes";
            }else{
                $upcomingConcerts[$i]['attending']="no";
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
        $recentReviews = Yii::app()->db->createCommand()
            // ->select('co.course_name, cl.section_id')
            ->select('c.cid,c.cdate,a.aname,v.vname, u2.uname, uc.review, uc.rate')
            ->from('concert c, artist a, venue v, user_concert uc, user_follow uf, user u2')
            ->where('uf.uid = :uid and uf.fuid = u2.uid and u2.uid = uc.uid and uc.cid = c.cid and c.aid = a.aid and c.vid = v.vid and
              (c.cdate between (CURRENT_DATE() - interval 14 day) and CURRENT_DATE()) ',
                array(':uid'=>$user_id,))
            ->queryAll();
        $dataProviderReviews = new CArrayDataProvider($recentReviews, array(
            'keyField'=>'cid',

        ));
        $ArtistsYouMightLike = Artist::model()->findAllBySql('select a.*, count(u2.uid) from artist a, user u1, user u2, user_artist ua2
            where u1.uid = :uid and u2.uid in
            (select u22.uid from user_artist ua21, user_artist ua22, user u22
            where ua21.uid=u1.uid and ua21.aid=ua22.aid and ua22.uid = u22.uid and u22.uid != u1.uid
            group by u22.uid
            having count(ua22.aid)>1) and ua2.uid = u2.uid and ua2.aid = a.aid
            and a.aid not in (select ua31.aid from user_artist ua31 where ua31.uid = u1.uid)
            group by a.aid
            having count(u2.uid) > 1',array(':uid'=>$user_id));
        $dataProviderArtists = new CArrayDataProvider($ArtistsYouMightLike, array(
            'keyField'=>'aid',

        ));
		$this->render('index',array(
            'dataProviderConcerts'=>$dataProviderConcerts,
            'dataProviderReviews'=>$dataProviderReviews,
            'dataProviderArtists'=>$dataProviderArtists,
        ));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login', array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}