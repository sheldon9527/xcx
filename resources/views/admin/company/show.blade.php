@extends('admin.common.layout')
@section('title')
	管理员及其权限--管理员详情
@endsection
@section('content')
<div class="row">
    <div class="col-md-2">
        @include('admin.company.nav')
    </div>
    <div class="col-lg-10">
		<div class="box">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <table class="table table-hover table-striped">
                    <tbody>
                        <tr>
                            <td>id</td>
                            <td>{{$admin->id}}</td>
                        </tr>
                        <tr>
                            <td>登陆账号</td>
                            <td>{{$admin->username}}</td>
                        </tr>
                        <tr>
                            <td>手机</td>
                            <td>{{$admin->cellphone}}</td>
                        </tr>
                        <tr>
                            <td>邮箱</td>
                            <td>{{$admin->email}}</td>
                        </tr>
						<tr>
							<td>类型</td>
							<td>
								<span class="badge bg-yellow">{{$admin->typeLabel[$admin->type]}}</span>
							</td>
						</tr>
                        <tr>
                            <td>角色</td>
                            <td>
                                @foreach($admin->roles as $role)
                                    <span class="badge badge-info">{{$role->display_name}}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>状态</td>
                            <td>
								<span @if($admin->status == 'active') class="badge bg-green" @else class="badge bg-red"  @endif>
								{{$admin->statusLabel[$admin->status]}}
								</span>
							</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="{{route('admin.admins.edit',['id' => $admin->id])}}">
                                    <button class="btn btn-default" type="submit">编辑</button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
