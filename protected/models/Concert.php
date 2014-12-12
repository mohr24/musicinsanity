<?php

/**
 * This is the model class for table "concert".
 *
 * The followings are the available columns in table 'concert':
 * @property integer $cid
 * @property string $cname
 * @property integer $aid
 * @property string $cdate
 * @property integer $vid
 * @property integer $price
 * @property integer $availability
 * @property string $clink
 * @property string $cdescription
 * @property string $concert_tp
 * @property integer $submitted_by_uid
 *
 * The followings are the available model relations:
 * @property Artist $a
 * @property Venue $v
 * @property Musictype[] $musictypes
 * @property User[] $users
 */
class Concert extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'concert';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cname, aid, cdate, vid, concert_tp', 'required'),
			array('aid, vid, price, availability, submitted_by_uid', 'numerical', 'integerOnly'=>true),
			array('cname, cdescription', 'length', 'max'=>40),
			array('clink', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cid, cname, aid, cdate, vid, price, availability, clink, cdescription, concert_tp, submitted_by_uid', 'safe', 'on'=>'search'),
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
			'a' => array(self::BELONGS_TO, 'Artist', 'aid'),
			'v' => array(self::BELONGS_TO, 'Venue', 'vid'),
			'musictypes' => array(self::MANY_MANY, 'Musictype', 'concert_musictype(cid, type_name)'),
			'users' => array(self::MANY_MANY, 'User', 'user_concert(cid, uid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cid' => 'Cid',
			'cname' => 'Cname',
			'aid' => 'Aid',
			'cdate' => 'Cdate',
			'vid' => 'Vid',
			'price' => 'Price',
			'availability' => 'Availability',
			'clink' => 'Clink',
			'cdescription' => 'Cdescription',
			'concert_tp' => 'Concert Tp',
			'submitted_by_uid' => 'Submitted By Uid',
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

		$criteria->compare('cid',$this->cid);
		$criteria->compare('cname',$this->cname,true);
		$criteria->compare('aid',$this->aid);
		$criteria->compare('cdate',$this->cdate,true);
		$criteria->compare('vid',$this->vid);
		$criteria->compare('price',$this->price);
		$criteria->compare('availability',$this->availability);
		$criteria->compare('clink',$this->clink,true);
		$criteria->compare('cdescription',$this->cdescription,true);
		$criteria->compare('concert_tp',$this->concert_tp,true);
		$criteria->compare('submitted_by_uid',$this->submitted_by_uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Concert the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
