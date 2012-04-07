<?php

class CategorysController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionList()
	{
		$page = isset($_POST['page'])?$_POST['page']:1;
		$pageSize = isset($_POST['pagesize'])?$_POST['pagesize']:10;
		$model = new Categorys;
		$criteria=new CDbCriteria;
		$total = $model->count($criteria);
		$criteria->offset = ($page-1)*$pageSize;
		$criteria->limit = $pageSize;
		if(isset($_POST['sortname']) && isset($_POST['sortorder'])){
			$criteria->order = $_POST['sortname']." ".$_POST['sortorder'];
		}
		$categorys = $model->findAll($criteria);
		$data = array();
		foreach ($categorys as $category){
			$item = $category->getAttributes();
			$item['__post'] = Yii::app()->createUrl('categorys/post',array('cid'=>$category->cid));
			$data[] = $item;
		}
		echo json_encode(array('Rows'=>$data,'Total'=>$total));
	}
	
	public function actionPost()
	{
		$model = false;
		isset($_GET['cid']) && $model=Categorys::model()->findByPk($_GET['cid']);
	    $model || $model=new Categorys;
	
	    // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='categorys-post-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */
	
	    if(isset($_POST['Categorys']))
	    {
	        $model->attributes=$_POST['Categorys'];
	        if($model->validate())
	        {
	            // form inputs are valid, do something here
	            $model->save();
	        	Categorys::updateTree($model->cid);
	            $this->redirect(array('categorys/index'));
	            return;
	        }
	    }
	    $categorys = Categorys::model()->findAll();
	    $parents = array('0'=>'[0]无');
	    foreach($categorys as $category){
	    	$parents[$category->cid]="[".$category->cid."]".$category->title;
	    }
	    $this->render('post',array('model'=>$model,'parents'=>$parents));
	}
	
	public function actionRemove()
	{
		$msg =array();
		if(isset($_POST['cid']) && Categorys::model()->deleteByPk($_POST['cid'])){
			$msg['error'] = false;
		}else{
			$msg['error']='不存在记录';
		}
		echo json_encode($msg);
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()	
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}