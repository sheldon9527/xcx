<!DOCTYPE html>
<html >
@include('admin.common.head')
	<body class="hold-transition skin-green sidebar-mini">
		@include('admin.common.header')
		@include('admin.common.sidebar')
		<div class="content-wrapper">
		    <section class="content-header">
		        <h1>
		            @yield('title', '')
		        </h1>
		    </section>
		    <section class="content">
		        @yield('content')
		    </section>
		</div>

		@include('admin.common.footer')
	</body>
</html>
