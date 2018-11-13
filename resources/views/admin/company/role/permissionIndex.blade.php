@extends('admin.common.layout')
@section('title')
	管理员及其权限--{{$role->display_name}}</span> 的权限列表
@endsection
@section('content')

<div class="row">
    <div class="col-md-2">
        @include('admin.company.nav')
    </div>
    <div class="col-md-10">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">角色 <span class="text-red">{{$role->display_name}}</span> 的权限列表</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route('admin.roles.permissions.update', $role->id)}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label class="checkbox-inline ng-scope">
                                    <input type="checkbox" class="check-all">
                                    <span class="ng-binding text-blue">全选</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            @foreach($permissions as $permission)
                            <div class="col-md-3">
                                <label class="checkbox-inline ng-scope">
                                    <input type="checkbox" name="permission_ids[]" class="permission" value="{{$permission->id}}" @if($role->hasPermission($permission->name)) checked="checked" @endif>
                                    <span class="ng-binding">{{$permission->display_name}}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">&nbsp;</div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit">保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    require(['jquery'], function($) {
        $('.check-all').change(function() {
            if ($(this).is(":checked")) {
                $('input.permission').prop('checked', true);
            } else {
                $('input.permission').prop('checked', false);
            }
        });
    });
</script>
@endsection
