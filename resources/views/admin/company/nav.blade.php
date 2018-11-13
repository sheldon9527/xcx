<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">导航</h3>
        <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body no-padding">
      <ul class="nav nav-pills nav-stacked">
        <li class="{{\Route::is('admin.admins.*') ? 'active' : null}}"><a href="{{ route('admin.admins.index') }}"><i class="fa fa-user-secret"></i> 管理员管理</a></li>
        <li class="{{\Route::is('admin.roles.*') ? 'active' : null}}"><a href="{{ route('admin.roles.index') }}"><i class="fa fa-users"></i> 角色管理</a></li>
        <li class="{{\Route::is('admin.permissions.*') ? 'active' : null}}"><a href="{{ route('admin.permissions.index') }}"><i class="fa fa-key"></i> 权限列表</a></li>
      </ul>
    </div>
</div>
<style type="text/css">
.active{
	background:none !important;
	border-left:none !important;

}
</style>
