@extends('admin.common.layout')
@section('title')
	管理员及其权限--管理员编辑
@endsection
@section('content')
<div class="row">
    <div class="col-md-2">
        @include('admin.company.nav')
    </div>
    <div class="col-lg-10">
		<div class="box">
        <div class="ibox float-e-margins">
            @include('admin.common.errors')
            <div class="ibox-content">
                <form method="post" action="{{route('admin.admins.update', [$admin->id])}}" id="form" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="text-red">*</span>登陆账号</label>
                        <div class="col-sm-3">
                            <input type="text" name="username" value="{{$admin->username}}" class="form-control" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">手机</label>
                        <div class="col-sm-3">
                            <input type="text" name="cellphone" value="{{$admin->cellphone}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-3">
                            <input type="text" name="email" value="{{$admin->email}}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">角色</label>
                        <div class="col-sm-3">
                            <select name="roles[]" class="selectpicker" multiple>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if($admin->hasRole($role->name)) selected="selected" @endif>{{$role->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">密码</label>
                        <div class="col-sm-3">
                            <input type="text" name="password" class="form-control">
                        </div>
                    </div>
								<div class="form-group">
									<label class="col-sm-2 control-label"><span class="text-red">*</span>状态</label>
									<div class="col-sm-3">
										<select name="status" id='editStatus' class="form-control" data-width="auto" required="">
											<option value="active" @if ($admin->status == 'active') selected="selected" @endif>激活</option>
											<option value="inactive" @if ($admin->status == 'inactive') selected="selected" @endif>禁用</option>
										</select>
									</div>
								</div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-success" type="submit">保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
