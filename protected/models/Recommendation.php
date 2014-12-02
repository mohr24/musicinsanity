<?php

/**
 * This is the model class for table "recommendation".
 *
 * The followings are the available columns in table 'recommendation':
 * @property integer $rid
 * @property integer $lid
 * @property integer $aid
 * @property integer $cid
 * @property string $rdate
 * @property integer $vid
 * @property string $rlink
 * @property string $rdescription
 * @property string $recom_tp
 *
 * The followings are the available model relations:
 * @property Musictype[] $musictypes
 * @property List $l
 * @property Venue $v
 * @property Artist $a
 * @property User[] $users
 */
class Recommendation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'recommendation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lid, recom_tp', 'required'),
			array('lid, aid, cid, vid', 'numerical', 'integerOnly'=>true),
			array('rlink', 'length', 'max'=>20),
			array('rdescription', 'length', 'max'=>40),
			array('rdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rid, lid, aid, cid, rdate, vid, rlink, rdescription, recom_tp', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'musictypes' => array(self::MANY_MANY, 'Musictype', 'recom_musictype(rid, type_name)'),
			'l' => array(self::BELONGS_TO, 'List', 'lid'),
			'v' => array(self::BELONGS_TO, 'Venue', 'vid'),
			'a' => array(self::BELONGS_TO, 'Artist', 'aid'),
			'users' => array(self::MANY_MANY, 'User', 'sys_recom(rid, uid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rid' => 'Rid',
			'lid' => 'Lid',
			'aid' => 'Aid',
			'cid' => 'Cid',
			'rdate' => 'Rdate',
			'vid' => 'Vid',
			'rlink' => 'Rlink',
			'rdescription' => 'Rdescription',
			'recom_tp' => 'Recom Tp',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('rid',$this->rid);
		$criteria->compare('lid',$this->lid);
		$criteria->compare('aid',$this->aid);
		$criteria->compare('cid',$this->cid);
		$criteria->compare('rdate',$this->rdate,true);
		$criteria->compare('vid',$this->vid);
		$criteria->compare('rlink',$this->rlink,true);
		$criteria->compare('rdescription',$this->rdescription,true);
		$criteria->compare('recom_tp',$this->recom_tp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Recommendation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
