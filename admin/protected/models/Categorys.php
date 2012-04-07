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
 * @property string $update
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
			array('parent,update', 'numerical', 'integerOnly'=>true),
			array('tree, title, notes', 'length', 'max'=>64),
			array('url', 'length', 'max'=>255),
			array('parent', 'validateParent'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cid, parent, tree, title, notes, url ,update', 'safe', 'on'=>'search'),
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
			'cid' => '类目ID',
			'parent' => '父类目ID',
			'tree' => '路径',
			'title' => '标题	',
			'notes' => '备注',
			'url' => '链接',
			'update' => '更新时间',
		);
	}
	public function validateParent($attribute,$params)
	{
		if ($this->parent == 0) return true;
		$parent = Categorys::model()->findByPk($this->parent);
		if ($parent){
			$items = explode('|',$parent->tree);
			if($this->cid && in_array($this->cid, $items)){
				$this->addError('parent','非法父类目');
			}
		}else{
			$this->addError('parent','指定父类目不存在');
		}
	}
	public function beforeSave()
	{
		$this->update = time();
		return true;
	}
	public static  function updateTree($cid)
	{
		$model = Categorys::model()->findByPk($cid);
		if($model->parent !== 0 && $parent = Categorys::model()->findByPk($model->parent)){
			$tree = $parent->tree.$model->cid.'|';
		}else{
			$tree = $model->cid.'|';
		}
		$model->tree = $tree;
		$model->save();
		$children = Categorys::model()->findAllByAttributes(array('parent'=>$model->cid));
		foreach ($children as $child){
			Categorys::updateTree($child->cid);
		}
		
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