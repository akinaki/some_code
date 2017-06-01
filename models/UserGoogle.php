<?php

/**
 * This is the model class for table "user_google".
 *
 * The followings are the available columns in table 'user_google':
 * @property string $user_id
 * @property string $token
 * @property string $last_check
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserGoogle extends CActiveRecord
{
    public $refreshToken;
	const LC_DATE_FORMAT = "yyyy-MM-dd HH:mm:ss";
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_google';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, token', 'required'),
			array('user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, token', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'token' => 'Token',
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

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('token',$this->token,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserGoogle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave()
    {
        if ( parent::beforeSave() ) {

            $token = CJSON::decode($this->token);

            if(!isset($token['refresh_token'])){
                $token['refresh_token'] = $this->refreshToken;
            }
            $this->token =  CJSON::encode($token);

            return true;
        }
        return false;
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->refreshToken = CJSON::decode($this->token)['refresh_token'];
    }
}
