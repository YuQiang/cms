<?php
	$riaPath = Yii::app()->baseUrl.'/ria';
	$tree1 = array(
		array('text'=>'栏目管理','isexpand'=>false,'children'=>array(
			array('text'=>'节点1','url'=>'/welcome')
		)),
	);
?>
    <script type="text/javascript">
	
	var EmployeeData = { Rows: [{ "__status": null, "ID": 1, "DepartmentID": 3, "RealName": "fewf", "DepartmentName": "销售部", "Sex": 1, "Age": 2433, "IncomeDay": new Date(1301356800000), "Phone": "159244332", "Address": "变为不为恶" }, { "__status": null, "ID": 2, "DepartmentID": 1, "RealName": "李三34", "DepartmentName": "主席", "Sex": 2, "Age": 23, "IncomeDay": new Date(1301299200000), "Phone": "2323232323", "Address": "3434" }, { "__status": null, "ID": 3, "DepartmentID": 3, "RealName": "吴彬3", "DepartmentName": "销售部", "Sex": 2, "Age": 26, "IncomeDay": new Date(1294128000000), "Phone": "159244332", "Address": "1311飞屋服务费3434343433434" }, { "__status": null, "ID": 5, "DepartmentID": 2, "RealName": "吴久", "DepartmentName": "研发中心", "Sex": 2, "Age": 29, "IncomeDay": new Date(1288569600000), "Phone": "159244332", "Address": "3444444" }, { "__status": null, "ID": 6, "DepartmentID": 3, "RealName": "黄乐", "DepartmentName": "销售部", "Sex": 2, "Age": 21, "IncomeDay": new Date(1297728000000), "Phone": null, "Address": "3435333" }, { "__status": null, "ID": 7, "DepartmentID": 3, "RealName": "陈留", "DepartmentName": "销售部", "Sex": 1, "Age": 32, "IncomeDay": new Date(1298851200000), "Phone": null, "Address": "3333444444444444" }, { "__status": null, "ID": 8, "DepartmentID": 1, "RealName": "谢银223", "DepartmentName": "主席", "Sex": 1, "Age": 13, "IncomeDay": new Date(1298880000000), "Phone": null, "Address": "34344555555555" }, { "__status": null, "ID": 10, "DepartmentID": 2, "RealName": "陈元为2", "DepartmentName": "研发中心", "Sex": 2, "Age": 16, "IncomeDay": new Date(1298851200000), "Phone": null, "Address": "34343434343434" }, { "__status": null, "ID": 11, "DepartmentID": 1, "RealName": "大为", "DepartmentName": "主席", "Sex": 1, "Age": 19, "IncomeDay": new Date(1301472000000), "Phone": null, "Address": "3434444444" }, { "__status": null, "ID": 21, "DepartmentID": 4, "RealName": "444", "DepartmentName": "市场部", "Sex": 2, "Age": 20, "IncomeDay": new Date(1298880000000), "Phone": null, "Address": "444" }, { "__status": null, "ID": 22, "DepartmentID": 1, "RealName": "22", "DepartmentName": "主席", "Sex": 1, "Age": 20, "IncomeDay": new Date(1301270400000), "Phone": null, "Address": "22" }, { "__status": null, "ID": 23, "DepartmentID": 2, "RealName": "22", "DepartmentName": "研发中心", "Sex": 1, "Age": 20, "IncomeDay": new Date(1301270400000), "Phone": null, "Address": "2224444444" }, { "__status": null, "ID": 26, "DepartmentID": 4, "RealName": "232323", "DepartmentName": "市场部", "Sex": 2, "Age": 0, "IncomeDay": new Date(1306108800000), "Phone": null, "Address": "222222222222222"}], Total: 13 };
	
        //var DepartmentList = DepartmentData.Rows;
        var sexData = [{ Sex: 1, text: '男' }, { Sex: 2, text: '女'}];
        $(f_initGrid);
        var manager, g;
        function f_initGrid()
        {
            g = manager = $("#grid").ligerGrid({
                columns: [
                { display: '类目ID', name: 'cid',  type: 'int', frozen: true },
                { display: '父类目ID', name: 'parent',type: 'int',editor: {type: 'int'}},
                { display: '路径',  name: 'tree', type: 'text', },
                { display: '标题', name: 'title',  type: 'text', editor: { type: 'text'}},
				{ display: '备注', name: 'notes',  type: 'text', editor: { type: 'text'}},
				{ display: '链接', name: 'url',  type: 'text', editor: { type: 'text'} },
                { display: '操作', isSort: false, render: function (rowdata, rowindex, value)
					{
						var h = "";
						if (!rowdata._editing)
						{
							h += "<a href='javascript:beginEdit(" + rowindex + ")'>修改</a> ";
							h += "<a href='javascript:deleteRow(" + rowindex + ")'>删除</a> "; 
						}
						else
						{
							if(rowdata.ID)
							{
								h += "<a href='javascript:endEdit(" + rowindex + ")'>提交</a> ";
							}
							else
							{
								h += "<a href='javascript:endAdd(" + rowindex + ")'>保存</a> ";
							}
							h += "<a href='javascript:cancelEdit(" + rowindex + ")'>取消</a> "; 
						}
						return h;
					}
                }
                ],
                onSelectRow: function (rowdata, rowindex)
                {
                    $("#txtrowindex").val(rowindex);
                },
                enabledEdit: true,clickToEdit:false, isScroll: false,url:'http://localhost/cms/admin/index.php?r=list',
                width: '100%',
				cssClass: 'l-grid-gray',
				heightDiff: -6
            });   
        }
        function beginEdit(rowid) { 
            manager.beginEdit(rowid);
        }
        function cancelEdit(rowid) { 
            manager.cancelEdit(rowid);
        }
        function endEdit(rowid)
        {
            manager.endEdit(rowid);
        }
		function endAdd(rowid)
        {
            manager.endEdit(rowid);
			data = manager.getRow(rowid);
			yiiFormPost('<?php echo Yii::app()->createUrl('category/list'); ?>',data)
			manager.loadData(); 
        }

        function deleteRow(rowid)
        {
            if (confirm('确定删除?'))
            {
                manager.deleteRow(rowid);
            }
        }

        var newrowid = 100;
        function addNewRow()
        {
            manager.addEditRow();
        } 

        function getSelected()
        { 
            var row = manager.getSelectedRow();
            if (!row) { alert('请选择行'); return; }
            alert(JSON.stringify(row));
        }

        function getData()
        { 
            var data = manager.getData();
            alert(JSON.stringify(data));
        } 
		
		function yiiFormPost(url,data,success,error)
		{
			yiiData = {};
			if(!arguments[2]) success = yiiFormSuccess;
			if(!arguments[3]) error = yiiFormError;
			for (key in data){
				yiiKey = 'liger['+key+']';
				yiiData[yiiKey] = data[key];
			}
			$.ajax({
				type: "POST",
				url: url,
				data: data,
				success:success,
				error:error,
				dataType:'json'
			});
		}
		function yiiFormError(XMLHttpRequest, textStatus, errorThrown)
		{
			$.ligerDialog.error(textStatus?textStatus:'unknow error');
		}
		function yiiFormSuccess(data, textStatus)
		{
		}
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
<div id="grid"></div>
