<aside class="main-sidebar">
        <section class="sidebar" id="scrollspy">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{app('admin')->user()->avatar}}" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p></p>
                    <a href=""><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <ul class="sidebar-menu">
              <li class="{{
					\Route::is('admin.dashboard') ? 'active' : null
				}} treeview"><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>仪表盘</span> </a>
              </li>

			  <li class="{{\Route::is('admin.articles.*') ? 'active' : null }} treeview">
					 <a href="#">
						 <i class="fa fa-list-alt"></i><span>文章管理</span>
						 <i class="fa fa-angle-left pull-right"></i>
					 </a>
					 <ul class="treeview-menu">
						 <li class="{{\Route::is('admin.articles.index','admin.articles.edit') ? 'active' : null }} treeview">
							 <a href="{{route('admin.articles.index')}}">
								 <i class="fa fa-circle-o"></i>文章列表
							 </a>
						 </li>
						 <li class="{{\Route::is('admin.articles.create') ? 'active' : null }} treeview">
							<a href="{{route('admin.articles.create')}}">
								<i class="fa fa-circle-o"></i>创建文章
							</a>
						</li>
					 </ul>
			  </li>

			  <li class="{{\Route::is('admin.categories.*') ? 'active' : ''}}">
					<a href="{{route('admin.categories.index')}}">
						<i class="fa fa-sitemap"></i><span>导航分类</span>
					</a>
				</li>

				<li class="{{\Route::is('admin.admins.*','admin.roles.*','admin.permissions.*') ? 'active' : ''}}">
				   <a href="{{route('admin.admins.index')}}">
					   <i class="fa fa-user-secret"></i><span>管理员及权限</span>
				   </a>
			   </li>
            </ul>
        </section>
</aside>
<script type="text/javascript">
require(['jquery'], function($) {
	height();
	function height(e){
		var end=$(".content-wrapper").height();
		$("aside").css("height",end);
			// $("aside").css("height",end);
			var hh =$(".content-wrapper").css("height");
			// console.log(hei)
		window.onresize=function(){
			var hei=document.body.scrollHeight;
			var end=$(document).height();
			$("aside").css("height",end);
		}
	}
});
</script>
