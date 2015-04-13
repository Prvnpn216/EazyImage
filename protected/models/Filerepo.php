<?php

/**
 * This is the model class for table "filerepo".
 *
 * The followings are the available columns in table 'filerepo':
 * @property integer $sno
 * @property string $name
 * @property integer $active
 * @property integer $s_size
 * @property string $type
 */
class Filerepo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Filerepo the static model class
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
		return 'filerepo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, active, s_size, type', 'required'),
			array('active, s_size', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>256),
			array('type', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sno, name, active, s_size, type', 'safe', 'on'=>'search'),
			array('name', 'file', 'types'=>'jpg, gif, png'),
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
			'sno' => 'Sno',
			'name' => 'Name',
			'active' => 'Active',
			's_size' => 'Select a Size',
			'type' => 'Type',
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

		$criteria->compare('sno',$this->sno);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('s_size',$this->s_size);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}