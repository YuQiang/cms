<?php

class CategorysController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionList()
	{
		//$models = Categorys::model()->findAll();
		$models = array('asd'=>'asd');
		echo json_encode($models);
	}
	
	public function actionPost()
	{
	    $model=new Categorys;
	
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
	            return;
	        }
	    }
	    $this->render('post',array('model'=>$model));
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