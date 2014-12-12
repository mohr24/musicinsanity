<?php

class SearchController extends Controller
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

    public function accessRules()
    {
        return array(

            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('musictypes','users','concerts','artists'),
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

    public function actionMusictypes()
    {
        $allMusictypes = Musictype::model()->findAll();


        if(isset($_GET['type']))
        {
            $type = Musictype::model()->find('type_name=:type',array(':type'=>$_GET['type']));
            $concertinfo = Yii::app()->db->createCommand()
                // ->select('co.course_name, cl.section_id')
                ->select('c.*, a.aid ,a.aname,v.vname,v.city, ')
                ->from('concert c, artist a, venue v, concert_musictype m')
                ->where('m.type_name  = :type and m.cid = c.cid and c.aid = a.aid and c.vid = v.vid',
                    array(':type'=>$type->type_name ))
                ->queryAll();
            foreach($concertinfo as $i=>$concert){
                $userConcert = UserConcert::model()->find('uid=:uid and cid = :cid',array(':uid'=>Yii::app()->user->getId(),':cid'=>$concert['cid']));
                if($userConcert){
                    $concertinfo[$i]['attending']="Yes";
                }else{
                    $concertinfo[$i]['attending']="No";
                }
            }
            if(sizeof($concertinfo)>0){
                $dataProviderConcerts=new CArrayDataProvider($concertinfo, array(
                    'keyField'=>'cid',
                    //   'id'=>'cid',
                    'sort'=>array(
                        'attributes'=>array(
                            'cdate DESC',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>10,
                    ),
                ));
            }else{
                $dataProviderConcerts = null;
            }

            $artistinfo = $type->artists;
            if(sizeof($artistinfo)>0){
                $dataProviderArtists=new CArrayDataProvider($artistinfo, array(
                    'keyField'=>'aid',
                    //   'id'=>'cid',

                    'pagination'=>array(
                        'pageSize'=>10,
                    ),
                ));
            }else{
                $dataProviderArtists=null;
            }

            $this->render('musictypes',array(
                'dataProviderArtists'=>$dataProviderArtists,
                'dataProviderConcerts'=>$dataProviderConcerts,
                'allMusictypes'=>$allMusictypes,
                'musictype'=>$type,
            ));
        }
        else {
            $this->render('musictypes',array(
                                             'allMusictypes'=>$allMusictypes,
                                             ));
        }

    }

    public function actionUsers(){



        if(isset($_GET['name']))
        {
            $text = $_GET['name'];
            $users = User::model()->findAll('artist = 0 and (uname like :text or uusername like :text)', array(':text'=>'%'.$text.'%'));
            $dataProvider=new CArrayDataProvider($users, array(
                'keyField'=>'uid',

                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

            $this->render('users',array(
                'dataProvider'=>$dataProvider,
            ));
        }else{
            $this->render('users');
        }


    }
    public function actionArtists(){



        if(isset($_GET['name']))
        {
            $text = $_GET['name'];
            $users = Artist::model()->findAll('aname like :text', array(':text'=>'%'.$text.'%'));
            $dataProvider=new CArrayDataProvider($users, array(
                'keyField'=>'aid',

                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

            $this->render('artists',array(
                'dataProvider'=>$dataProvider,
            ));
        }
        else{
            $this->render('artists');
        }


    }

    public function actionConcerts(){

        if(isset($_GET['name']) || isset($_GET['artist']) || isset($_GET['city']) || isset($_GET['startdate']) || isset($_GET['enddate'])){
            $name = $_GET['name'];
            $artist = $_GET['artist'];
            $city = $_GET['city'];
            $startdate = $_GET['startdate'];
            $enddate = $_GET['enddate'];
            $where = 'c.aid = a.aid and c.vid = v.vid and c.cname like :cname and a.aname like :aname and v.city like :city';
            $params = array(':cname'=>'%'.$name.'%',':aname'=>'%'.$artist.'%',':city'=>'%'.$city.'%');
            if($startdate!=""){
                $where .= ' and c.cdate >= :sdate';
                $params[':sdate'] =$startdate;
            }

            if($enddate!=""){
                $where .= ' and c.cdate <= :edate';
                $params[':edate'] =$enddate;
            }
            $concertinfo = Yii::app()->db->createCommand()
                ->select('c.*, a.aid ,a.aname,v.vname,v.city')
                ->from('concert c, artist a, venue v')
                ->where($where,$params)
                ->queryAll();
            foreach($concertinfo as $i=>$concert){
                $userConcert = UserConcert::model()->find('uid=:uid and cid = :cid',array(':uid'=>Yii::app()->user->getId(),':cid'=>$concert['cid']));
                if($userConcert){
                    $concertinfo[$i]['attending']="Yes";
                }else{
                    $concertinfo[$i]['attending']="No";
                }
            }
            $dataProvider=new CArrayDataProvider($concertinfo, array(
                'keyField'=>'cid',
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

            $this->render('concerts',array(
                'dataProvider'=>$dataProvider,
                'artist'=>Yii::app()->user->artist,
            ));
        }
        else{
            $this->render('concerts');
        }


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
