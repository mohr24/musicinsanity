<?php

/**
 * This is the model class for table "user_concert".
 *
 * The followings are the available columns in table 'user_concert':
 * @property integer $cid
 * @property integer $uid
 * @property integer $rate
 * @property string $review
 * @property string $attend_tp
 */
class UserConcert extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_concert';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cid, uid', 'required'),
			array('cid, uid, rate', 'numerical', 'integerOnly'=>true),
			array('review', 'length', 'max'=>40),
			array('attend_tp', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cid, uid, rate, review, attend_tp', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cid' => 'Cid',
			'uid' => 'Uid',
			'rate' => 'Rate (out of 10)',
			'review' => 'Review',
			'attend_tp' => 'Attend Tp',
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
		$criteria->compare('uid',$this->uid);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('review',$this->review,true);
		$criteria->compare('attend_tp',$this->attend_tp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserConcert the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
