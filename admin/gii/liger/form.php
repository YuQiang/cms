<?php
/**
 * This is the template for generating a form script file.
 * The following variables are available in this template:
 * - $this: the FormCode object
 */
?>
<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass).'-'.basename($this->viewName)."-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>
<table cellpadding="0" cellspacing="0" class="l-table-edit" >
<?php foreach($this->getModelAttributes() as $attribute): ?>
<tr>
    <td align="right" class="l-table-edit-td"><?php echo "<?php echo \$form->labelEx(\$model,'$attribute'); ?>"; ?></td>
    <td align="left" class="l-table-edit-td"><?php echo "<?php echo \$form->textField(\$model,'$attribute'); ?>"; ?></td>
    <td align="left"><?php echo "<?php echo \$form->error(\$model,'$attribute'); ?>"; ?></td>
</tr>
<?php endforeach; ?>
</table>
<div class="row">
<input type="submit" value="提交" id="Button1" class="l-button l-button-submit" /> 
<input type="reset" value="重置" class="l-button l-button-reset"/>
</div>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
<script>
$(function ()
{
    $("form").ligerForm();
	$(".errorMessage").each(function(){
		error = $(this).html();
		width = $(this).width();
		if(error){
			$(this).html('.');
			$(this).ligerTip({ content: error ,width:width+16});
			$(this).hide();
		}
	});
}); 
</script>