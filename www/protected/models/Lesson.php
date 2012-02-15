<?php

/**
 * This is the model class for table "Lesson".
 *
 * The followings are the available columns in table 'Lesson':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $createTime
 * @property string $updateTime
 * @property integer $courseId
 *
 * The followings are the available model relations:
 * @property Attachment[] $attachments
 * @property Course $course
 * @property Question[] $questions
 */
class Lesson extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Lesson the static model class
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
		return 'Lesson';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, courseId', 'required'),
			array('id, courseId', 'numerical', 'integerOnly'=>true),
			array('title, createTime, updateTime', 'length', 'max'=>45),
			array('content', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, content, createTime, updateTime, courseId', 'safe', 'on'=>'search'),
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
			'attachments' => array(self::HAS_MANY, 'Attachment', 'lessonId'),
			'course' => array(self::BELONGS_TO, 'Course', 'courseId'),
			'questions' => array(self::HAS_MANY, 'Question', 'lessonId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'createTime' => 'Create Time',
			'updateTime' => 'Update Time',
			'courseId' => 'Course',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('updateTime',$this->updateTime,true);
		$criteria->compare('courseId',$this->courseId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}