<?php
$this->pageTitle=Yii::app()->name;
?>
<div class="panel">
	<div class="panel-header">
		<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
	</div>
	<div class="panel-body">
		<p>This application will help you to resize your image in any resollution you wish.(Must Be a valid Resollution) </p>

		<p>Please click on following button to start Image Resizing</p>

		<div style="margin-top:30px;" id = "Resizer" >
		      <a href = <?php echo Yii::app()->baseUrl."/index.php?r=site/UploadImage"?>>
		      <center><input type="button" class="btn btn-primary" value = "Take Me to Resizer" ></center></a>
		</div>
	</div>
</div>