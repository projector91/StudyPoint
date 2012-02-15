<?php $this->pageTitle=Yii::app()->name . ' - Register'; ?>
<div class="content register common">
	<div class="title"><?php echo Yii::t('yii','Register'); ?></div>
	<div class="form">
	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::activeTextField($model,'username',array('value' => 'Username')) ?>
	<?php echo CHtml::activeTextField($model,'fullname',array('value' => 'Full Name')) ?>
	<?php echo CHtml::activeTextField($model,'email',array('value' => 'Email')) ?>
	<?php echo CHtml::activePasswordField($model,'password') ?>
	<?php echo CHtml::activePasswordField($model,'secondPass') ?>
	<div class="captcha">
	<?php $this->widget('CCaptcha'); ?>
	<?php echo CHtml::activeTextField($model,'verifyCode',array('value'=>'5 symbols you see above')); ?>
	</div>
	<?php echo CHtml::submitButton('Register',array('class'=>'button')); ?>
	<?php echo CHtml::endForm(); ?>
	</div><!-- form -->
</div>


