<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>This application will help you to resize your image in any resollution you wish.(Must Be a valid Resollution) </p>

<p>Please click on following button to start Image Resizing</p>

<div style="margin-top:30px;" id = "Resizer" >
      <a href = <?php echo Yii::app()->baseUrl."/index.php?r=site/UploadImage"?>>
      <center><input type="button" class="btn btn-primary" value = "Take Me to Resizer" ></center></a>
</div>
<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>
