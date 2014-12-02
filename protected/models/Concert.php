<?php

/**
 * This is the model class for table "concert".
 *
 * The followings are the available columns in table 'concert':
 * @property integer $cid
 * @property integer $aid
 * @property string $cdate
 * @property integer $vid
 * @property integer $price
 * @property integer $availability
 * @property string $clink
 * @property string $cdescription
 * @property string $concert_tp
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
			array('aid, cdate, vid, concert_tp', 'required'),
			array('aid, vid, price, availability', 'numerical', 'integerOnly'=>true),
			array('clink', 'length', 'max'=>20),
			array('cdescription', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cid, aid, cdate, vid, price, availability, clink, cdescription, concert_tp', 'safe', 'on'=>'search'),
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
			'aid' => 'Aid',
			'cdate' => 'Cdate',
			'vid' => 'Vid',
			'price' => 'Price',
			'availability' => 'Availability',
			'clink' => 'Clink',
			'cdescription' => 'Cdescription',
			'concert_tp' => 'Concert Tp',
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
		$criteria->compare('aid',$this->aid);
		$criteria->compare('cdate',$this->cdate,true);
		$criteria->compare('vid',$this->vid);
		$criteria->compare('price',$this->price);
		$criteria->compare('availability',$this->availability);
		$criteria->compare('clink',$this->clink,true);
		$criteria->compare('cdescription',$this->cdescription,true);
		$criteria->compare('concert_tp',$this->concert_tp,true);

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
