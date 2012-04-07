    <script type="text/javascript">
	
        //var DepartmentList = DepartmentData.Rows;
        $(f_initGrid);
        var manager, g;
        function f_initGrid()
        {
            g = manager = $("#grid").ligerGrid({
                columns: [
                { display: '类目ID', name: 'cid',  type: 'int'},
                { display: '父类目ID', name: 'parent',type: 'int',editor: {type: 'int'}},
                { display: '路径',  name: 'tree', type: 'text', },
                { display: '标题', name: 'title',  type: 'text', editor: { type: 'text'}},
				{ display: '备注', name: 'notes',  type: 'text', editor: { type: 'text'}},
				{ display: '链接', name: 'url',  type: 'text', editor: { type: 'text'} },
                { display: '操作', isSort: false, render: function (rowdata, rowindex, value)
					{
						var h = "";
						h += "<a href='" + rowdata.__post + "'>修改</a> ";
						h += "<a href='javascript:remove(" + rowdata.cid + ")'>删除</a> ";
						return h;
					}
                }
                ],
                enabledEdit: true,clickToEdit:false, isScroll: false,url:'<?php echo Yii::app()->createUrl('categorys/list') ?>',
                width: '99%',
				cssClass: 'l-grid-gray',
				heightDiff: -6,
            });   
        }
		
		function remove(cid){
			$.ligerDialog.confirm('是否删除', function (yes)
			{
				if(!yes) return;
				url = '<?php echo Yii::app()->createUrl('categorys/remove') ?>';
				$.ajax({
					type: "POST",
					url: url,
					data: 'cid='+cid,
					success:function(data){
						if(data.error){
							$.ligerDialog.error(data.error);
						}else{
							manager.loadData();
						}
					},
					error:function(){
						$.ligerDialog.error('删除失败');
					},
					dataType:'json'
				});
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
