<?php
	$riaPath = Yii::app()->baseUrl.'/ria';
	$tree1 = array(
		array('text'=>'栏目管理','isexpand'=>false,'children'=>array(
			array('text'=>'节点1','url'=>'/welcome')
		)),
	);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo $riaPath ?>/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" /> 
<script src="<?php echo $riaPath ?>/jquery/jquery-1.3.2.min.js" type="text/javascript"></script>    
<script src="<?php echo $riaPath ?>/ligerUI/js/ligerui.min.js" type="text/javascript"></script> 
<style type="text/css"> 
body{ padding:0px; margin:0;   overflow:hidden;}  
	#pageloading{position:absolute; left:0px; top:0px; background:white url('loading.gif') no-repeat center; width:100%; height:100%;z-index:99999;}
	#header{ margin:0; padding:0; height:31px; line-height:31px; background:url('<?php echo $riaPath ?>/images/top.jpg') repeat-x bottom;  position:relative; border-top:1px solid #1D438B;  }
	#footer{height:32px; line-height:32px; text-align:center;}
	.l-link{ display:block; line-height:22px; height:22px; padding-left:16px;border:1px solid white; margin:4px;}
</style>
</head>
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
<body style="padding:0px;background:#EAEEF5;">
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
</body>
</html>
