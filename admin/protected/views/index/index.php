<?php
	$tree1 = array(
		array('text'=>'栏目管理','isexpand'=>true,'children'=>array(
			array('text'=>'节点1','url'=>Yii::app()->createUrl('categorys/index'))
		)),
	);
?>

<script type="text/javascript">
var tab = null;
var accordion = null;
var tree = null;
$(function(){
	$("#pageloading").hide();
	$("#layout").ligerLayout({ leftWidth: 190, heightDiff:-34,space:4,  onHeightChanged: f_heightChanged });
	var height = $(".l-layout-center").height();
	$("#accordion").ligerAccordion({ height: height - 24, speed: null });
	accordion = $("#accordion1").ligerGetAccordionManager();
	$("#framecenter").ligerTab({ height: height});
	tab = $("#framecenter").ligerGetTabManager();
	$("#tree1").ligerTree({
		data : <?php echo json_encode($tree1) ?>,
		checkbox: false,
		slide: true,
		nodeWidth: 150,
		attribute: ['nodename', 'url'],
		btnClickToToggleOnly :false,
		onSelect: function (node)
		{
			if (!node.data.url) return;
			var tabid = $(node.target).attr("tabid");
			if (!tabid)
			{
				tabid = new Date().getTime();
				$(node.target).attr("tabid", tabid)
			} 
			tab.addTabItem({tabid:tabid,text:node.data.text,url:node.data.url});
		}
	});
	tree = $("#tree1").ligerGetTreeManager();
});

function f_heightChanged(options)
{
	if (tab)
		tab.addHeight(options.diff);
	if (accordion && options.middleHeight - 24 > 0)
		accordion.setHeight(options.middleHeight - 24);
}
</script>
<div id="pageloading"></div>  
<div id="header"></div>
<div id="layout">
	<div id="accordion" position="left"  title="主要菜单" >
        <div title="内容管理">
            <ul id="tree1"></ul>
        </div> 
        <div title="实验室">
            <div style=" height:7px;"></div>
            <a class="l-link" href="lab/generate/index.htm" target="_blank">表格表单设计器</a> 
        </div> 
    </div>
    <div id="framecenter" position="center"> 
        <div tabid="home" title="我的主页" style="height:300px" >
        	<iframe frameborder="0" name="home" id="home" src="<?php echo Yii::app()->createUrl('index/welcome') ?>"></iframe>
        </div> 
    </div> 
</div>
<div id="footer">
        Copyright © 2011-2012 www.ligerui.com
</div>
