<?php
/* @var $this FilerepoController */
/* @var $model Filerepo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'filerepo-UploadImage-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class = "row">
		<?php echo '<h1>Select a Size</h1>'; ?>
		
	</div>
	<?php echo $form->errorSummary($model); ?>
	
	<div class = "row">
		<?php echo CHtml::image(Yii::app()->baseUrl.'/images/Thumbnail.png'); ?><span >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
		<?php echo CHtml::image(Yii::app()->baseUrl.'/images/large.png'); ?><span >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
		<?php echo CHtml::image(Yii::app()->baseUrl.'/images/XL.png'); ?>
	</div>
	<div class = "row"
		<?php echo '<div ><b><span style="margin-left:10px">Icon</span><span style="margin-left:120px">Thumbnail</span><span style="margin-left:300px">Gallery</span></b></div>'; ?>
		
	</div>

	<div class="row" style="margin-top:30px;">
		<div >Please Select an Image to be resized </div>
		<br />
		<?php echo $form->fileField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<br />
	<div class = "row style=margin-top:30px;">
		<?php echo $form->labelEx($model,'s_size'); ?>
		<?php echo $form->dropDownList($model,'s_size',array(''=>'Select','1'=>'Icon','2'=>'Thumbnail','3'=>'Gallery')); ?>
		<?php echo $form->error($model,'s_size'); ?>
	</div>

	
	<center><div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div></center>

<?php $this->endWidget(); ?>

</div><!-- form -->