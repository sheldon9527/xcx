<!DOCTYPE html>
<html>
<head>
<title>管理平台</title>
<!-- For-Mobile-Apps-and-Meta-Tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Sliding Forms Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //For-Mobile-Apps-and-Meta-Tags -->
<link href="/css/style.css" type="text/css" rel="stylesheet" media="all">
<link href="/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<!--web-fonts-->
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--//web-fonts-->
</head>

<body>
<h1>管理平台</h1>
<section>
  <div class="stage">
    <div class="cbImage active signin agileits">
		<form action="{{ route('admin.auth.login.post') }}" method="POST">
            @include('admin.common.errors', ['errors'=>$errors])
			<input type="text" name="username"  placeholder="登录账号" value="{{old('username')}}" required>
			<input type="password" name="password" placeholder="密码" required>
			<input type="submit" value="登录">
		</form>
	</div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
  <div class="footer">
  </div>
</section>
<script src="/js/jquery-2.1.4.min.js"></script>
<script src="/js/coverflow-slideshow.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
