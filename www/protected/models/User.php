<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $fullname
 * @property integer $roleId
 *
 * The followings are the available model relations:
 * @property Attachment[] $attachments
 * @property Comment[] $comments
 * @property Course[] $courses
 * @property Question[] $questions
 * @property Registry[] $registries
 * @property Role $role
 */
class User extends CActiveRecord
{
	//for captcha
	public $verifyCode;	
	//for passwords equality check
    public $secondPass;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, roleId', 'required'),
			array('id, roleId', 'numerical', 'integerOnly'=>true),
			array('username, password, salt, email', 'length', 'max'=>45),
			array('fullname', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, salt, email, fullname, roleId', 'safe', 'on'=>'search'),
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
			'attachments' => array(self::HAS_MANY, 'Attachment', 'userId'),
			'comments' => array(self::HAS_MANY, 'Comment', 'userId'),
			'courses' => array(self::HAS_MANY, 'Course', 'teacherId'),
			'questions' => array(self::HAS_MANY, 'Question', 'userId'),
			'registries' => array(self::HAS_MANY, 'Registry', 'userId'),
			'role' => array(self::BELONGS_TO, 'Role', 'roleId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'salt' => 'Salt',
			'email' => 'Email',
			'fullname' => 'Fullname',
			'roleId' => 'Role',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('roleId',$this->roleId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function validatePassword($password)
    {
        //return $this->hashPassword($password,$this->salt)===$this->password;
		return true;
    }
	
	public function hashPassword($password,$salt)
    {
        return md5($salt.$password);
    }
}