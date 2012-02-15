<?php

/**
 * This is the model class for table "Mark".
 *
 * The followings are the available columns in table 'Mark':
 * @property integer $id
 * @property string $value
 * @property integer $attachmentId
 * @property string $createTime
 *
 * The followings are the available model relations:
 * @property Attachment $attachment
 */
class Mark extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mark the static model class
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
		return 'Mark';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, attachmentId', 'required'),
			array('id, attachmentId', 'numerical', 'integerOnly'=>true),
			array('value, createTime', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, value, attachmentId, createTime', 'safe', 'on'=>'search'),
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
			'attachment' => array(self::BELONGS_TO, 'Attachment', 'attachmentId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'value' => 'Value',
			'attachmentId' => 'Attachment',
			'createTime' => 'Create Time',
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
		$criteria->compare('value',$this->value,true);
		$criteria->compare('attachmentId',$this->attachmentId);
		$criteria->compare('createTime',$this->createTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}