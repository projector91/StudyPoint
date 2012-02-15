<?php

/**
 * This is the model class for table "Course".
 *
 * The followings are the available columns in table 'Course':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $startTime
 * @property string $endTime
 * @property integer $teacherId
 *
 * The followings are the available model relations:
 * @property User $teacher
 * @property Lesson[] $lessons
 * @property Registry[] $registries
 */
class Course extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Course the static model class
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
		return 'Course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, teacherId', 'required'),
			array('id, teacherId', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>60),
			array('description', 'length', 'max'=>200),
			array('startTime, endTime', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, startTime, endTime, teacherId', 'safe', 'on'=>'search'),
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
			'teacher' => array(self::BELONGS_TO, 'User', 'teacherId'),
			'lessons' => array(self::HAS_MANY, 'Lesson', 'courseId'),
			'registries' => array(self::HAS_MANY, 'Registry', 'courseId'),
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
			'description' => 'Description',
			'startTime' => 'Start Time',
			'endTime' => 'End Time',
			'teacherId' => 'Teacher',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('startTime',$this->startTime,true);
		$criteria->compare('endTime',$this->endTime,true);
		$criteria->compare('teacherId',$this->teacherId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}