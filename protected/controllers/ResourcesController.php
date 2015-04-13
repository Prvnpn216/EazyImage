<?php

class ResourcesController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}


public function actionThumbs() {
 
        $request = str_replace(DIRECTORY_SEPARATOR . 'thumbs', '', Yii::app()->request->requestUri);
 
        $resourcesPath = Yii::getPathOfAlias('webroot') . $request;
        $targetPath = Yii::getPathOfAlias('webroot') . Yii::app()->request->requestUri;
 
 
        if (preg_match('/_(\d+)x(\d+).*\.(jpg|jpeg|png|gif)/i', $resourcesPath, $matches)) {
 
            if (!isset($matches[0]) || !isset($matches[1]) || !isset($matches[2]) || !isset($matches[3]))
                throw new CHttpException(400, 'Non valid params');
 
            if (!$matches[1] || !$matches[2]) {
                throw new CHttpException(400, 'Invalid dimensions');
            }
 
            $originalFile = str_replace($matches[0], '', $resourcesPath);
            if (!file_exists($originalFile))
                throw new CHttpException(404, 'File not found');
 
 
            $dirname = dirname($targetPath);
            if (!is_dir($dirname))
                mkdir($dirname, 0775, true);
 
 
            $image = Yii::app()->image->load($originalFile);
            $image->resize($matches[1], $matches[2]);
 
            if ($image->save($targetPath)) {
                if (Yii::app()->request->urlReferrer != Yii::app()->request->requestUri)
                    $this->refresh();
            }
 
            throw new CHttpException(500, 'Server error');
        } else {
            throw new CHttpException(400, 'Wrong params');
        }
    }
 
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