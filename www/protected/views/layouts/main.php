<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/css/style.css">	
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/theme/js/global.js'); ?>
</head>
<body>
<div class="wrapper">
	<div class="header_cont">
		<div class="header">
			<div class="logo">
				<a href="<?php echo Yii::app()->homeUrl; ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/theme/images/logo.png" alt="" /></a>
			</div>
			<div class="options">
				<?php
				if (Yii::app()->user->isGuest) {
					echo CHtml::link(Yii::t('yii','Sign in'),array('user/login'));
					echo ' '.Yii::t('yii','or').' ';
					echo CHtml::link(Yii::t('yii','Register'),array('user/register'));
				} else {
					echo Yii::t('yii', 'Hello, {username}!', array('{username}' => Yii::app()->user->name)).' ';
					echo CHtml::link(Yii::t('yii','Log out'),array('user/logout'));
				}
				?>
			</div>
			<?php if (!Yii::app()->user->isGuest) { ?>
			<div class="tabs">
				<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'Feed', 'url'=>array('/user/feed')),
						array('label'=>'Courses', 'url'=>array('/user/courses')),
						array('label'=>'Settings', 'url'=>array('/user/settings')),
					),
				)); ?>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="cont_for_all">	
		<?php echo $content; ?>
	</div>
</div>
</body>
</html>