@extends('admin.common.layout')
@section('title')
	管理员及其权限--角色列表
@endsection
@section('content')

<div class="row">
    <div class="col-md-2">
        @include('admin.company.nav')
    </div>
    <div class="col-md-10">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">

                        <button type="button" class="pull-left btn btn-success" data-toggle="modal" data-target="#add-role"><i class="fa fa-plus"></i></button>
                    </div>
                </div>

                <div class="row">&nbsp;</div>
                @include('admin.common.errors')
                <div class="row">
                    <div class="col-sm-12">
                        <table id="infos" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr role="row">
                                    <td>ID</td>
                                    <td>角色名称</td>
                                    <td>角色说明</td>
                                    <td>操作</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr role="row">
                                    <td>{{$role->id}} </td>
                                    <td>{{$role->display_name}} </td>
                                    <td>{{$role->description}} </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">操作
                                                <span class="fa fa-caret-down"></span></button>
                                            <ul class="dropdown-menu slim-menu">
                                                <li><a href="{{route('admin.roles.permissions.edit', [$role->id])}}">权限设置</a></li>
                                                <li><a data-method="DELETE" data-confirm="你确定删除该角色吗？" href="{{route('admin.roles.destroy', [$role->id])}}">删除</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add-role" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <form action="{{route('admin.roles.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">添加角色</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><span class="text-red">*</span>角色名称</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" value="" class="form-control" required data-original-title="不可重复" data-trigger="hover"  data-toggle="tooltip">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">角色说明</label>
                                <div class="col-sm-8">
                                <textarea type="text" name="description" value="" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn btn-success">保存</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
