<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	//This method will be used to upload image

	public function actionUploadImage()
	{
	    $model=new Filerepo;

	   if(isset($_POST['Filerepo'])){

	        $tempSave=CUploadedFile::getInstance($model,'name');
	        if(!($tempSave=='')){
	    	$model->name = $tempSave->name;
	    	}
	       	$nameextention = explode('.',$model->name);
	   	if(sizeof($nameextention)>1){
	    	$extention = $nameextention[1];	 
	    	$model->type = $extention; 
	    }
	    $model->active = true;
	    	
	    if(!($_POST['Filerepo']['s_size'] == '')){
		$model->s_size = $_POST['Filerepo']['s_size'];	    	
		}
	        if($model->validate())
	        {
	           
	        	if(!$model->save()){
	        		die('File not uploaded');
		        	return;
	        	}
	        	else
	        	{
	        		$tempSave->saveAs(Yii::app()->basePath .
		                 '/../images/' . $model->sno.'.'.$model->type);
				$this->redirect(Yii::app()->baseUrl.'/index.php?r=site/resize');	        		
	        	}
	            return;
	        }
	    }
	    $this->render('UploadImage',array('model'=>$model));
	}


	public function actionResize()
	{	

		$model = new Filerepo;

		$lastRow = $model->find(array(
			'order' => 'sno DESC'
			));

		switch ($lastRow->s_size) {
			case 1:{
				Yii::import('application.extensions.image.Image');
				$image = new Image('images/'.$lastRow->sno.'.'.$lastRow->type);
				$image->resize(200, 50)->quality(100);
				$image->save('images/tempSave.'.$lastRow->type); 
			}
				
			break;
			case 2:{
				Yii::import('application.extensions.image.Image');
				$image = new Image('images/'.$lastRow->sno.'.'.$lastRow->type);
				$image->resize(500, 150)->quality(100);
				$image->save('images/tempSave.'.$lastRow->type); 
			}
			break;
			case 3:{
				Yii::import('application.extensions.image.Image');
				$image = new Image('images/'.$lastRow->sno.'.'.$lastRow->type);
				$image->resize(700, 250)->quality(100);
				$image->save('images/tempSave.'.$lastRow->type); 
			}
			break;
			
			default:
				die('No Size selected for ');
				break;
		}
		// Yii::import('application.extensions.image.Image');
		// $image = new Image('images/1.png');
		// $image->resize(200, 50)->quality(100);
		// $image->save('images/Thumbnail.png'); 
		// $image->resize(500, 150)->quality(100);
		// $image->save('images/large.png');
		// $image->resize(700, 200)->quality(100);
		// $image->save('images/XL.png');  
		 $this->render('resizeImage', array(
		 	'type' => $lastRow->type
		 	));
	}

	public function actionDownload(){

		$model = new Filerepo;

		$lastRow = $model->find(array(
			'order' => 'sno DESC'
			));

		if( file_exists(Yii::app()->basePath .
		                 '/../images/tempSave'.'.'.$lastRow->type)){
			Yii::app()->getRequest()->sendFile( 'Download' , 
			file_get_contents( Yii::app()->basePath .
		                 '/../images/tempSave'.'.'.$lastRow->type ) 
			);
		}
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}