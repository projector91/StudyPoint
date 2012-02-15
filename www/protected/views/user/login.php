<?php $this->pageTitle=Yii::app()->name . ' - Login'; ?>
<div class="content login common">
	<div class="title"><?php echo Yii::t('yii','Sign In'); ?></div>
	<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
	<div class="row">
		<?php echo $form->textField($model,'username',array('value' => Yii::t('yii','username'))); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	<div class="row">
		<?php echo $form->passwordField($model,'password',array('value' => '123456')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Sign In',array('class'=>'button')); ?>
	</div>
	<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>


