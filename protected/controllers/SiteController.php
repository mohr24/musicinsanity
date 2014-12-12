<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
    //public $layout = '//layouts/index';
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

        if($user_id && !Yii::app()->user->artist){
            $userModel = User::model()->find('uid = :uid',array(':uid'=>$user_id));
            if(sizeof($userModel->musictypes)==0){
                $this->redirect(Yii::app()->baseUrl."/index.php/musictype/chooseUser?uid=".$user_id);
            }
            $this->layout = '//layouts/column2';
            $upcomingConcerts = Yii::app()->db->createCommand()
                // ->select('co.course_name, cl.section_id')
                ->select('distinct(c.cid), c.*,a.aname, a.aid,v.vname, v.city')
                ->from('concert c, artist a, venue v, user_artist ua, user_concert uc')
                ->where('((ua.uid = :uid and ua.aid = a.aid) or (uc.uid = :uid and uc.cid = c.cid))
                    and c.aid = a.aid and c.vid = v.vid and
                  (c.cdate between CURRENT_DATE() and (CURRENT_DATE() + interval 14 day)) ',
                    array(':uid'=>$user_id,))
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
                 ),*/
                 'pagination'=>array(
                     'pageSize'=>10,
                 ),
            ));
            $recentReviews = Yii::app()->db->createCommand()
                // ->select('co.course_name, cl.section_id')
                ->select('c.*,a.aname, a.aid,v.vname, v.city, u2.uid,u2.uname, uc.review, uc.rate')
                ->from('concert c, artist a, venue v, user_concert uc, user_follow uf, user u2')
                ->where('uf.uid = :uid and uf.fuid = u2.uid and u2.uid = uc.uid and uc.cid = c.cid and c.aid = a.aid and c.vid = v.vid and
              (c.cdate between (CURRENT_DATE() - interval 14 day) and CURRENT_DATE()) ',
                    array(':uid'=>$user_id,))
                ->queryAll();
            foreach($recentReviews as $i=>$concert){
                $userConcert = UserConcert::model()->find('uid=:uid and cid = :cid',array(':uid'=>$user_id,':cid'=>$concert['cid']));
                if(isset($userConcert->review)|| isset($userConcert->rate)){
                    $recentReviews[$i]['reviewed']="Yes";
                }else{
                    $recentReviews[$i]['reviewed']="No";
                }
            }
            $dataProviderReviews = new CArrayDataProvider($recentReviews, array(
                'keyField'=>'cid',

            ));
            $recommendedConcerts = Yii::app()->db->createCommand()
                ->select('distinct(c.cid),c.*,a.aname, a.aid,v.vname, v.city, u2.uid as recommender_id, u2.uname as recommender_name')
                ->from('concert c, artist a, venue v, user_follow uf, user u2, list l, concert_list cl')
                ->where('uf.uid = :uid and uf.fuid = u2.uid and u2.uid = l.uid and l.lid = cl.lid and c.cid = cl.cid and c.aid = a.aid
                    and c.vid = v.vid and c.cdate >= CURRENT_DATE()
                    and c.cid not in (select uc.cid from concert c, user_concert uc where uc.uid = :uid and uc.cid = c.cid)',
                    array(':uid'=>$user_id,))
                ->queryAll();
            foreach($recommendedConcerts as $i=>$concert){
                $userConcert = UserConcert::model()->find('uid=:uid and cid = :cid',array(':uid'=>$user_id,':cid'=>$concert['cid']));
                if($userConcert){
                    $recommendedConcerts[$i]['attending']="Yes";
                }else{
                    $recommendedConcerts[$i]['attending']="No";
                }
            }
            $ConcertsInMusictype = Yii::app()->db->createCommand()
                ->select('distinct(c.cid),c.*,a.aname, a.aid,v.vname, v.city')
                ->from('concert c, artist a, venue v, concert_musictype cm, user_musictype um, musictype m')
                ->where('um.uid = :uid and um.type_name = cm.type_name and cm.cid = c.cid and c.aid = a.aid
                    and c.vid = v.vid and c.cdate >= CURRENT_DATE()
                    and c.cid not in (select uc.cid from concert c, user_concert uc where uc.uid = :uid and uc.cid = c.cid)',
                    array(':uid'=>$user_id,))
                ->queryAll();
            foreach($ConcertsInMusictype as $i=>$concert){
                $userConcert = UserConcert::model()->find('uid=:uid and cid = :cid',array(':uid'=>$user_id,':cid'=>$concert['cid']));
                if($userConcert){
                    $ConcertsInMusictype[$i]['attending']="Yes";
                }else{
                    $ConcertsInMusictype[$i]['attending']="No";
                }
            }
            if(sizeof($recommendedConcerts)>0){
                $dataProviderRecommendedConcerts = new CArrayDataProvider($recommendedConcerts, array(
                    'keyField'=>'cid',
                    'pagination'=>array(
                        'pageSize'=>10,
                    ),
                ));
            }else{
                $dataProviderRecommendedConcerts = new CArrayDataProvider($ConcertsInMusictype, array(
                    'keyField'=>'cid',
                    'pagination'=>array(
                        'pageSize'=>10,
                    ),
                ));
            }

            $ArtistsInYourMusicType = Artist::model()->findAllBySql('select a.*
            from artist a,user u, musictype m, artist_musictype am, user_musictype um
            where  a.aid=am.aid and am.type_name=um.type_name and um.uid = :uid
            and a.aid not in (select ua31.aid from user_artist ua31 where ua31.uid = :uid)
            group by a.aid',array(':uid'=>$user_id));

            $ArtistsYouMightLike = Artist::model()->findAllBySql('select a.*, count(u2.uid) from artist a, user u1, user u2, user_artist ua2
            where u1.uid = :uid and u2.uid in
            (select u22.uid from user_artist ua21, user_artist ua22, user u22
            where ua21.uid=u1.uid and ua21.aid=ua22.aid and ua22.uid = u22.uid and u22.uid != u1.uid
            group by u22.uid
            having count(ua22.aid)>1) and ua2.uid = u2.uid and ua2.aid = a.aid
            and a.aid not in (select ua31.aid from user_artist ua31 where ua31.uid = u1.uid)
            group by a.aid
            having count(u2.uid) > 1',array(':uid'=>$user_id));
            if(sizeof($ArtistsYouMightLike)>0){
                $dataProviderArtists = new CArrayDataProvider($ArtistsYouMightLike, array(
                    'keyField'=>'aid',
                ));
            }else{
                $dataProviderArtists = new CArrayDataProvider($ArtistsInYourMusicType, array(
                    'keyField'=>'aid',
                ));
            }

            $this->render('indexMichael',array(
                'dataProviderConcerts'=>$dataProviderConcerts,
                'dataProviderRecommendedConcerts'=>$dataProviderRecommendedConcerts,
                'dataProviderReviews'=>$dataProviderReviews,
                'dataProviderArtists'=>$dataProviderArtists,
                'dataProviderArtistsMusicType'=>$dataProviderArtists,
            ));
        }else if($user_id && Yii::app()->user->artist){
            $artistModel = Artist::model()->find('aid = :aid',array(':aid'=>$user_id));
            if(sizeof($artistModel->musictypes)==0){
                $this->redirect(Yii::app()->baseUrl."/index.php/musictype/chooseArtist?aid=".$user_id);
            }
            $this->layout = '//layouts/column2';
            $upcomingConcerts = Yii::app()->db->createCommand()
                // ->select('co.course_name, cl.section_id')
                ->select('c.*,a.aname, a.aid,v.vname, v.city')
                ->from('concert c, artist a, venue v, user_artist ua')
                ->where('ua.uid = :uid and ua.aid = a.aid and c.aid = a.aid and c.vid = v.vid and
              (c.cdate between CURRENT_DATE() and (CURRENT_DATE() + interval 14 day)) ',
                    array(':uid'=>$user_id,))
                ->queryAll();
            $dataProviderConcerts=new CArrayDataProvider($upcomingConcerts, array(
                'keyField'=>'cid',
                //   'id'=>'cid',
                /* 'sort'=>array(
                     'attributes'=>array(
                         'id', 'username', 'email',
                     ),
                 ),*/
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));
            $reviews = Yii::app()->db->createCommand()
                // ->select('co.course_name, cl.section_id')
                ->select('u.uid, u.uname, uc.rate, uc.review, c.*, v.vname, v.city, a.aid, a.aname')
                ->from('concert c, artist a, venue v, user_concert uc, user u')
                ->where('a.aid = :aid and c.cid = uc.cid and c.aid = a.aid and c.vid = v.vid and u.uid = uc.uid and
            (c.cdate between (CURRENT_DATE() - interval 30 day) and CURRENT_DATE())',
                    array(':aid'=>Yii::app()->user->aid ))
                ->queryAll();

            $dataProviderRecentReviews=new CArrayDataProvider($reviews, array(
                'keyField'=>'cid',
            ));

            $artistsWithSimilarFans = Artist::model()->findAllBySql('select a.*, count(ua2.uid)
            from artist a, user_artist ua1, user_artist ua2
            where ua1.aid = :aid and ua1.uid = ua2.uid and ua2.aid = a.aid and ua1.aid != ua2.aid
            group by a.aid
            having count(ua2.uid) > 1',array(':aid'=>Yii::app()->user->aid));
            $dataProviderArtists = new CArrayDataProvider($artistsWithSimilarFans, array(
                'keyField'=>'aid',
            ));
            $this->render('indexArtist',array(
                'dataProviderConcerts'=>$dataProviderConcerts,
                'dataProviderReviews'=>$dataProviderRecentReviews,
                'dataProviderArtists'=>$dataProviderArtists,
            ));
        }
        else{

            $this->render('index',array(

            ));
        }

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