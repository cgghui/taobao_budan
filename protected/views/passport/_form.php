<link rel="stylesheet" href="<?php echo ASSET_URL;?>default/css/form.css" type="text/css" media="all" />
<style>
.errorSummary{ border:1px solid #ccc; background:#f7dada;}
.errorSummary p{ width:98%; margin:0 auto;}
.errorSummary ul{ width:98%; margin:0 auto;}
.errorMessage{ display:inline; color:red;}
.required{ color:red;}
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm'); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Username'); ?>
		<?php echo $form->textField($model,'Username',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PassWord'); ?>
		<?php echo $form->passwordField($model,'PassWord',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'PassWord'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NickName'); ?>
		<?php echo $form->textField($model,'NickName',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'NickName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'QQToken'); ?>
		<?php echo $form->textField($model,'QQToken',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'QQToken'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VipLv'); ?>
		<?php echo $form->textField($model,'VipLv'); ?>
		<?php echo $form->error($model,'VipLv'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Phon'); ?>
		<?php echo $form->textField($model,'Phon'); ?>
		<?php echo $form->error($model,'Phon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PhonClock'); ?>
		<?php echo $form->textField($model,'PhonClock'); ?>
		<?php echo $form->error($model,'PhonClock'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Question'); ?>
		<?php echo $form->textField($model,'Question',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Question'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Anser'); ?>
		<?php echo $form->textField($model,'Anser',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Anser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TrueName'); ?>
		<?php echo $form->textField($model,'TrueName',array('size'=>18,'maxlength'=>18)); ?>
		<?php echo $form->error($model,'TrueName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IdNumber'); ?>
		<?php echo $form->textField($model,'IdNumber',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'IdNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RegIp'); ?>
		<?php echo $form->textField($model,'RegIp',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'RegIp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RegTime'); ?>
		<?php echo $form->textField($model,'RegTime'); ?>
		<?php echo $form->error($model,'RegTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LoginIp'); ?>
		<?php echo $form->textField($model,'LoginIp',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'LoginIp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LoginTime'); ?>
		<?php echo $form->textField($model,'LoginTime'); ?>
		<?php echo $form->error($model,'LoginTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IsDefult'); ?>
		<?php echo $form->textField($model,'IsDefult'); ?>
		<?php echo $form->error($model,'IsDefult'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Opend'); ?>
		<?php echo $form->textField($model,'Opend'); ?>
		<?php echo $form->error($model,'Opend'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '确定注册' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->