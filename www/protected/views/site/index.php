<?php $this->pageTitle=Yii::app()->name; ?>
<div class="content home">
	<div class="home_img">
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/theme/images/home_img.jpg" alt="" />
	</div>
	<div class="text">		
		<?php echo Yii::t('yii','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'); ?>
	</div>
	<?php echo CHtml::link(Yii::t('yii','Get Started'),array('user/register'),array('class'=>'button')); ?>
</div>