<?php

/**
 * This is the model class for table "musictype".
 *
 * The followings are the available columns in table 'musictype':
 * @property string $type_name
 * @property string $major
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Artist[] $artists
 * @property Concert[] $concerts
 * @property Musictype $major0
 * @property Musictype[] $musictypes
 * @property Recommendation[] $recommendations
 * @property User[] $users
 */
class Musictype extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'musictype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_name, major', 'length', 'max'=>20),
			array('description', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('type_name, major, description', 'safe', 'on'=>'search'),
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
			'artists' => array(self::MANY_MANY, 'Artist', 'artist_musictype(type_name, aid)'),
			'concerts' => array(self::MANY_MANY, 'Concert', 'concert_musictype(type_name, cid)'),
			'major0' => array(self::BELONGS_TO, 'Musictype', 'major'),
			'musictypes' => array(self::HAS_MANY, 'Musictype', 'major'),
			'recommendations' => array(self::MANY_MANY, 'Recommendation', 'recom_musictype(type_name, rid)'),
			'users' => array(self::MANY_MANY, 'User', 'user_musictype(type_name, uid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'type_name' => 'Type Name',
			'major' => 'Major',
			'description' => 'Description',
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

		$criteria->compare('type_name',$this->type_name,true);
		$criteria->compare('major',$this->major,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Musictype the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
