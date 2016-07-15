$(".datatable").dataTable({
        "sPaginationType" : "full_numbers",
        "oLanguage" : {
		"sLengthMenu" : "每页显示 _MENU_ 条记录",
		"sZeroRecords" : "对不起，没有匹配的数据",
		"sInfo" : "第 _START_ - _END_ 条 / 共 _TOTAL_ 条数据",
		"sInfoEmpty" : "没有匹配的数据",
		"sInfoFiltered" : "(数据表中共 _MAX_ 条记录)",
		"sProcessing" : "正在加载中...",
		"sSearch" : "全文搜索：",
		"oPaginate" : {
			"sFirst" : "<i class='icon-step-backward' title='首页'></i>",
			"sPrevious" : "<i class='icon-play icon-rotate-180' title='上一页'></i> ",
			"sNext" : "<i class='icon-play' title='下一页'></i>",
			"sLast" : "<i class='icon-step-forward' title='末页'></i>",
                        //"sFirst" : " 首页 ",
			//"sPrevious" : " 上一页 ",
			//"sNext" : " 下一页 ",
			//"sLast" : " 末页 "
		}
	}
    });