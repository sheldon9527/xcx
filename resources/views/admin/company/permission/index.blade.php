@extends('admin.common.layout')
@section('title')
	管理员及其权限--权限列表
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
                    <div class="col-sm-12">
                        <table id="infos" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr role="row">
                                    <td>权限名称</td>
                                    <td>权限说明</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr role="row">

                                    <td>{{$permission->display_name}} </td>
                                    <td>{{$permission->description}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
