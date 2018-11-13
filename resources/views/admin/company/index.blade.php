@extends('admin.common.layout')
@section('title')
	管理员及其权限--管理员列表
@endsection
@section('content')

<div class="row">
    <div class="col-md-2">
        @include('admin.company.nav')
    </div>
    <div class="col-md-10">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="pull-left btn btn-success" data-toggle="modal" data-target="#clientModel"><i class="fa fa-plus"></i></button>
                    </div>
                </div>

                <div class="row">&nbsp;</div>
                <div class="row">
                    @include('admin.common.errors')
                    <div class="col-sm-12">
                        <table id="infos" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr role="row">
                                    <td>ID</td>
                                    <td>登陆账号</td>
                                    <td>联系电话</td>
                                    <td>角色</td>
                                    <td>超级管理员</td>
                                    <td>状态</td>
                                    <td>操作</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                <tr role="row">
                                    <td>{{$admin->id}}</td>
                                    <td>{{$admin->username}}</td>
                                    <td>{{$admin->cellphone}}</td>
                                    <td>
                                        @foreach($admin->roles as $role)
                                            <span class="badge badge-info">{{$role->display_name}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($admin->isSuper)
                                            <span class="text-info"><i class="fa fa-check" aria-hidden="true"></i></span>
                                        @else
                                            <span class="text-danger"><i class="fa fa-close" aria-hidden="true"></i></span>
                                        @endif
                                    </td>
                                    <td>
										<span @if($admin->status == 'active') class="badge bg-green" @else class="badge bg-red"  @endif>
                                        {{$admin->statusLabel[$admin->status]}}
                                        </span>
									</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">操作
                                                <span class="fa fa-caret-down"></span></button>
                                            <ul class="dropdown-menu slim-menu">
                                                <li><a href="{{route('admin.admins.edit', [$admin->id])}}">编辑</a></li>
                                                <li><a href="{{route('admin.admins.show', [$admin->id])}}">详情</a></li>
                                                @if(!$admin->isSuper)
                                                <li><a data-method="DELETE" data-confirm="你确定删除该管理员吗" href="{{route('admin.admins.destroy', [$admin->id])}}">删除</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {!! $admins->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="clientModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <form action="{{route('admin.admins.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">添加管理员</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><span class="text-red">*</span>登陆账号</label>
                                <div class="col-sm-8">
                                    <input type="text" name="username" value="" class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">手机</label>
                                <div class="col-sm-8">
                                    <input type="text" name="cellphone" value="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">邮箱</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" value="" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label"><span class="text-red">*</span>密码</label>
                                <div class="col-sm-8">
                                    <input type="text" name="password" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><span class="text-red">*</span>确认密码</label>
                                <div class="col-sm-8">
                                    <input type="text" name="password_confirmation" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">角色</label>
                                <div class="col-sm-8">
                                    <select name="roles[]" class="selectpicker" multiple>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{$role->display_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label"><span class="text-red">*</span>状态</label>
                                <div class="col-sm-8">
                                    <select name="status" class="form-control" data-width="auto" required>
                                        <option value="active">激活</option>
                                        <option value="inactive">禁用</option>
                                    </select>
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
