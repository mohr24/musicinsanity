<?php

class MusictypeController extends Controller
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
				'actions'=>array('index','view', 'chooseArtist', 'chooseUser', 'chooseConcert'),
				'users'=>array('@'),
			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update'),
//				'users'=>array('*'),
//			),
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
        $model = $this->loadModel($id);
        $concertinfo = Yii::app()->db->createCommand()
            // ->select('co.course_name, cl.section_id')
            ->select('c.cid,c.cdate, a.aid ,a.aname,v.vname')
            ->from('concert c, artist a, venue v, concert_musictype m')
            ->where('m.type_name  = :type and m.cid = c.cid and c.aid = a.aid and c.vid = v.vid and
            (c.cdate between (CURRENT_DATE() + interval 30 day) and CURRENT_DATE())',
                array(':type'=>$model->type_name ))
            ->queryAll();
        $dataProviderConcerts=new CArrayDataProvider($concertinfo, array(
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
        $artistinfo = $model->artists;
        $dataProviderArtists=new CArrayDataProvider($artistinfo, array(
            'keyField'=>'aid',
            //   'id'=>'cid',

            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
		$this->render('view',array(
			'model'=>$model,
            'dataProviderConcerts'=>$dataProviderConcerts,
            'dataProviderArtists'=>$dataProviderArtists,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
    public function actionChooseArtist($aid)
    {
        $artistModel = Artist::model()->findByPk($aid);
        $lists = $artistModel->musictypes;
        $types = Musictype::model()->findAll();
        if(isset($_POST['Musictype']))
        {
            $changedTypes = $_POST['Musictype'];
            ArtistMusictype::model()->deleteAll(array("condition"=>"aid='$aid'"));
            foreach ($changedTypes as $i => $value) {
                //echo $value['type_name'];
                $a = new ArtistMusictype();
                $a->type_name=$value['type_name'];
                $a->aid=$aid;
                if($a->type_name != "No"/*UserMusictype::model()->exists('uid=:uid and type_name=:type_name', array(':uid'=>$userMusic->uid, ':type_name'=>$userMusic->type_name))*/){
                    if(!$a->save()){
                        print_r($a->getErrors());
                    }
                    
                }
            }
            //when done
            $this->redirect(array('site/index'));
        }
        else {
            $this->render('choose_type', array(
                                               'types'=>$types,
                                               'lists'=>$lists));
        }
    }
    
    public function actionChooseUser($uid)
    {
        $userModel = User::model()->findByPk($uid);
        $lists = $userModel->musictypes;
        $types = Musictype::model()->findAll();
        if(isset($_POST['Musictype']))
        {
            $changedTypes = $_POST['Musictype'];
            UserMusictype::model()->deleteAll(array("condition"=>"uid='$uid'"));
            foreach ($changedTypes as $i => $value) {
                //echo $value['type_name'];
                $a = new UserMusictype();
                $a->type_name=$value['type_name'];
                $a->uid=$uid;
                if($a->type_name != "No"/*UserMusictype::model()->exists('uid=:uid and type_name=:type_name', array(':uid'=>$userMusic->uid, ':type_name'=>$userMusic->type_name))*/){
                    if(!$a->save()){
                        print_r($a->getErrors());
                    }
                    
                }
                
            }
            //when done
            $this->redirect(array('site/index'));
        }
        $this->render('choose_type', array(
                                     'types'=>$types,
                                           'lists'=>$lists));
    }
    
    public function actionChooseConcert($cid){
        $concertModel = Concert::model()->findByPk($cid);
        $lists = $concertModel->musictypes;
        $types = Musictype::model()->findAll();
        if(isset($_POST['Musictype']))
        {
            $changedTypes = $_POST['Musictype'];
            ConcertMusictype::model()->deleteAll(array("condition"=>"cid='$cid'"));
            foreach ($changedTypes as $i => $value) {
                //echo $value['type_name'];
                $a = new ConcertMusictype();
                $a->type_name=$value['type_name'];
                $a->cid=$cid;
                if($a->type_name != "No"/*UserMusictype::model()->exists('uid=:uid and type_name=:type_name', array(':uid'=>$userMusic->uid, ':type_name'=>$userMusic->type_name))*/){
                    if(!$a->save()){
                        print_r($a->getErrors());
                    }
                    
                }
                
            }
            //when done
            $this->redirect(array('concert/'.$cid));
        }
        $this->render('choose_type', array(
                                           'types'=>$types,
                                           'lists'=>$lists));
    }
    
    public function actionCreate()
	{
		$model=new Musictype;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Musictype']))
		{
			$model->attributes=$_POST['Musictype'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->type_name));
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

		if(isset($_POST['Musictype']))
		{
			$model->attributes=$_POST['Musictype'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->type_name));
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
		$dataProvider=new CActiveDataProvider('Musictype');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Musictype('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Musictype']))
			$model->attributes=$_GET['Musictype'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Musictype the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Musictype::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Musictype $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='musictype-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
