<?php

/**
 * This is the model class for table "{{categorys}}".
 *
 * The followings are the available columns in table '{{categorys}}':
 * @property integer $cid
 * @property integer $parent
 * @property string $tree
 * @property string $title
 * @property string $notes
 * @property string $url
 */
class Categorys extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Categorys the static model class
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
		return '{{categorys}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent', 'numerical', 'integerOnly'=>true),
			array('tree, title, notes', 'length', 'max'=>64),
			array('url', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cid, parent, tree, title, notes, url', 'safe', 'on'=>'search'),
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
			'parent' => 'Parent',
			'tree' => 'Tree',
			'title' => 'Title',
			'notes' => 'Notes',
			'url' => 'Url',
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

		$criteria->compare('cid',$this->cid);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('tree',$this->tree,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}