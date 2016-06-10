<?php session_start() ?>
<!DOCTYPE html>
<html lang="zh-CN" class="ax-vertical-centered">
<head>
    <title>图书馆管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/library/plugins/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="/library/plugins/bootstrap-3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/library/plugins/bootstrap-3.3.5/css/bootstrap-admin-theme.css">
    <link rel="stylesheet" href="/library/plugins/datatables-1.10.8/css/dataTables.bootstrap.css">
    <script src="/library/plugins/jquery-1.11.3/jquery.min.js"></script>
    <script src="/library/plugins/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <script src="/library/plugins/bootstrap-3.3.5/js/bootstrap-dropdown.min.js"></script>
    <script src="/library/plugins/datatables-1.10.8/js/jquery.dataTables.zh_CN.js"></script>
    <script src="/library/plugins/datatables-1.10.8/js/dataTables.bootstrap.js"></script>
    <script src="/library/js/book-type.js"></script>
</head>
<body class="bootstrap-admin-with-small-navbar">
    <nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar bootstrap-admin-navbar-under-small" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="collapse navbar-collapse main-navbar-collapse">
                        <a class="navbar-brand" href="#"><strong>欢迎使用图书馆管理系统</strong></a>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> 欢迎您，<?php echo $_SESSION['rname']; ?> <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/library/logout">退出</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- left, vertical navbar & content -->
        <div class="row">
            <!-- left, vertical navbar -->
            <div class="col-md-2 bootstrap-admin-col-left">
                <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
                    <li>
                        <a href="/library/admin/book"><i class="glyphicon glyphicon-chevron-right"></i> 图书管理</a>
                    </li>
                    <li class="active">
                        <a href="/library/admin/bookType"><i class="glyphicon glyphicon-chevron-right"></i> 图书分类管理</a>
                    </li>
                    <li>
                        <a href="/library/admin/borrow"><i class="glyphicon glyphicon-chevron-right"></i> 图书借阅</a>
                    </li>
                    <li>
                        <a href="/library/admin/return"><i class="glyphicon glyphicon-chevron-right"></i> 图书归还</a>
                    </li>
                    <li>
                        <a href="/library/admin/borrowInfo"><i class="glyphicon glyphicon-chevron-right"></i> 借阅查询</a>
                    </li>
                    <li>
                        <a href="/library/admin/student"><i class="glyphicon glyphicon-chevron-right"></i> 帐户管理</a>
                    </li>
                    <li>
                        <a href="/library/admin/setting"><i class="glyphicon glyphicon-chevron-right"></i> 系统设置</a>
                    </li>
                </ul>
            </div>
            <!-- content -->
            <div class="col-md-10">  
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default bootstrap-admin-no-table-panel">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title">查询</div>
                            </div>
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal">
                                    <div class="col-lg-6 form-group">
                                        <label class="col-lg-4 control-label" for="query_tname">分类名称</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" id="query_tname" type="text" value="">
                                            <label class="control-label" for="query_tname" style="display: none;"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <button type="button" class="btn btn-primary" id="btn_query" onclick="query()">查询</button>
                                        <button type="button" class="btn btn-primary" id="btn_add" onclick="showAdd()">添加</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="data_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>分类名称</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addModalLabel">添加</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form class="form-horizontal" id="form_add">
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="add_tname"><label class="text-danger">*&nbsp;</label>分类名称</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="add_tname" type="text" value="">
                                        <label class="control-label" for="add_tname"></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn_add_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="btn_add_save" onclick="add()">保存</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="updateModalLabel">修改</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form class="form-horizontal" id="form_update">
                            <input type="hidden" id="update_id">
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <label class="col-lg-3 control-label" for="update_tname"><label class="text-danger">*&nbsp;</label>分类名称</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="update_tname" type="text" value="">
                                        <label class="control-label" for="update_tname"></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn_update_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="btn_update_save" onclick="update()">保存</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deleteModalLabel">删除</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            确认删除此数据？
                            <input type="hidden" id="delete_id"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn_delete_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="btn_delete" onclick="del()">删除</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_info" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="infoModalLabel">提示</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12" id="div_info"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn_info_close" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>