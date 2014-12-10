<?php

/**
 * This is the model class for table "artist".
 *
 * The followings are the available columns in table 'artist':
 * @property integer $aid
 * @property string $aname
 * @property string $aemail
 * @property string $alink
 * @property string $abio
 * @property string $last_login_tp
 *
 * The followings are the available model relations:
 * @property ArtistArtist[] $artistArtists
 * @property ArtistArtist[] $artistArtists1
 * @property Musictype[] $musictypes
 * @property Concert[] $concerts
 * @property User[] $users
 */
class Artist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'artist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aname, aemail, last_login_tp', 'required'),
			array('aname', 'length', 'max'=>20),
			array('aemail, alink', 'length', 'max'=>40),
			array('abio', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('aid, aname, aemail, alink, abio, last_login_tp', 'safe', 'on'=>'search'),
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
			'artistArtists' => array(self::HAS_MANY, 'ArtistArtist', 'aid'),
			'artistArtists1' => array(self::HAS_MANY, 'ArtistArtist', 'faid'),
			'musictypes' => array(self::MANY_MANY, 'Musictype', 'artist_musictype(aid, type_name)'),
			'concerts' => array(self::HAS_MANY, 'Concert', 'aid'),
			'users' => array(self::MANY_MANY, 'User', 'user_artist(aid, uid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'aid' => 'Aid',
			'aname' => 'Aname',
			'aemail' => 'Aemail',
			'alink' => 'Alink',
			'abio' => 'Abio',
			'last_login_tp' => 'Last Login Tp',
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

		$criteria->compare('aid',$this->aid);
		$criteria->compare('aname',$this->aname,true);
		$criteria->compare('aemail',$this->aemail,true);
		$criteria->compare('alink',$this->alink,true);
		$criteria->compare('abio',$this->abio,true);
		$criteria->compare('last_login_tp',$this->last_login_tp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Artist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
