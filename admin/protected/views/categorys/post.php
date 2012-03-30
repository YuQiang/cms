<script>
$(function ()
{
	$("#toptoolbar").ligerToolBar({ items: [
		{ text: '目录列表', click: function(){window.location.href="<?php echo Yii::app()->createUrl('categorys/index')?>";} , icon:'add'},
		{ line:true },
		{ text: '增加目录', click: function(){window.location.href="<?php echo Yii::app()->createUrl('categorys/post')?>";} , icon:'add'},
	]
	});
});
</script>
<div id="toptoolbar"></div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categorys-post-form',
	'htmlOptions'=>array('class'=>"pageForm required-validate",
	'onsubmit'=>"return validateCallback(this, navTabAjaxDone)"),
	'enableAjaxValidation'=>false,
)); ?>
<table cellpadding="0" cellspacing="0" class="l-table-edit" >
<tr>
    <td align="right" class="l-table-edit-td"><?php echo $form->labelEx($model,'parent'); ?></td>
    <td align="left" class="l-table-edit-td"><?php echo $form->textField($model,'parent'); ?></td>
    <td align="left"><?php echo $form->error($model,'parent'); ?></td>
</tr>
<tr>
    <td align="right" class="l-table-edit-td"><?php echo $form->labelEx($model,'tree'); ?></td>
    <td align="left" class="l-table-edit-td"><?php echo $form->textField($model,'tree'); ?></td>
    <td align="left"><?php echo $form->error($model,'tree'); ?></td>
</tr>
<tr>
    <td align="right" class="l-table-edit-td"><?php echo $form->labelEx($model,'title'); ?></td>
    <td align="left" class="l-table-edit-td"><?php echo $form->textField($model,'title'); ?></td>
    <td align="left"><?php echo $form->error($model,'title'); ?></td>
</tr>
<tr>
    <td align="right" class="l-table-edit-td"><?php echo $form->labelEx($model,'notes'); ?></td>
    <td align="left" class="l-table-edit-td"><?php echo $form->textField($model,'notes'); ?></td>
    <td align="left"><?php echo $form->error($model,'notes'); ?></td>
</tr>
<tr>
    <td align="right" class="l-table-edit-td"><?php echo $form->labelEx($model,'url'); ?></td>
    <td align="left" class="l-table-edit-td"><?php echo $form->textField($model,'url'); ?></td>
    <td align="left"><?php echo $form->error($model,'url'); ?></td>
</tr>
</table>
<div class="row">
<input type="submit" value="提交" id="Button1" class="l-button l-button-submit" /> 
<input type="reset" value="重置" class="l-button l-button-reset"/>
</div>
<?php $this->endWidget(); ?>
<script>
$(function ()
{
    $("form").ligerForm();
	$("tr").each(function(){
		error = $('.errorMessage',this).html();
		width = $('.errorMessage',this).width();
		if(error){
			$('td',this).eq(1).ligerTip({ content: error ,width:width+16});
			$('.errorMessage',this).hide();
		}
	});
}); 
</script>