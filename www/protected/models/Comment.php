<?php

/**
 * This is the model class for table "Comment".
 *
 * The followings are the available columns in table 'Comment':
 * @property integer $id
 * @property string $createTime
 * @property integer $questionId
 * @property integer $userId
 *
 * The followings are the available model relations:
 * @property Question $question
 * @property User $user
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'Comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, questionId, userId', 'required'),
			array('id, questionId, userId', 'numerical', 'integerOnly'=>true),
			array('createTime', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createTime, questionId, userId', 'safe', 'on'=>'search'),
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
			'question' => array(self::BELONGS_TO, 'Question', 'questionId'),
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'createTime' => 'Create Time',
			'questionId' => 'Question',
			'userId' => 'User',
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
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('questionId',$this->questionId);
		$criteria->compare('userId',$this->userId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}