<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $uid
 * @property string $uusername
 * @property string $upassword
 * @property string $uname
 * @property string $uemail
 * @property string $birthday
 * @property string $city_residence
 * @property integer $reputation
 * @property string $last_login_tp
 * @property integer $artist
 * @property string $gender
 *
 * The followings are the available model relations:
 * @property List[] $lists
 * @property Artist[] $artists
 * @property Concert[] $concerts
 * @property UserFollow[] $userFollows
 * @property UserFollow[] $userFollows1
 * @property Musictype[] $musictypes
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uusername, upassword, uname, uemail, reputation', 'required'),
			array('reputation, artist', 'numerical', 'integerOnly'=>true),
			array('uusername, uname, city_residence', 'length', 'max'=>20),
			array('upassword, gender', 'length', 'max'=>10),
			array('uemail', 'length', 'max'=>30),
			array('birthday, last_login_tp', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('uid, uusername, upassword, uname, uemail, birthday, city_residence, reputation, last_login_tp, artist, gender', 'safe', 'on'=>'search'),
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
			'lists' => array(self::HAS_MANY, 'ListModel', 'uid'),
			'artists' => array(self::MANY_MANY, 'Artist', 'user_artist(uid, aid)'),
			'concerts' => array(self::MANY_MANY, 'Concert', 'user_concert(uid, cid)'),
			'userFollows' => array(self::HAS_MANY, 'UserFollow', 'uid'),
			'userFollows1' => array(self::HAS_MANY, 'UserFollow', 'fuid'),
			'musictypes' => array(self::MANY_MANY, 'Musictype', 'user_musictype(uid, type_name)'),
            'usersFollowed' => array(self::MANY_MANY, 'User', 'user_follow(uid,fuid)'),
            'usersFollowing' => array(self::MANY_MANY, 'User', 'user_follow(fuid,uid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => 'Uid',
			'uusername' => 'Uusername',
			'upassword' => 'Upassword',
			'uname' => 'Uname',
			'uemail' => 'Uemail',
			'birthday' => 'Birthday',
			'city_residence' => 'City Residence',
			'reputation' => 'Reputation',
			'last_login_tp' => 'Last Login Tp',
			'artist' => 'Artist',
			'gender' => 'Gender',
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

		$criteria->compare('uid',$this->uid);
		$criteria->compare('uusername',$this->uusername,true);
		$criteria->compare('upassword',$this->upassword,true);
		$criteria->compare('uname',$this->uname,true);
		$criteria->compare('uemail',$this->uemail,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('city_residence',$this->city_residence,true);
		$criteria->compare('reputation',$this->reputation);
		$criteria->compare('last_login_tp',$this->last_login_tp,true);
		$criteria->compare('artist',$this->artist);
		$criteria->compare('gender',$this->gender,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
