<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name='viewport' content='width=1200'>
	
	@yield('meta')
	
	<link rel="shortcut icon" href="{{ asset('img/markup/favicon.ico') }}">
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/font-awesome.min.css') }}
	{{ HTML::style('css/style.css') }}
	{{ HTML::style('css/flash_messages.css') }}
	{{ HTML::style('css/magnific-popup.css') }}
	{{ HTML::style('css/animate-popup.css') }}
	{{ HTML::style('css/pdf.css') }}
	{{ HTML::script('js/jquery.min.js') }}
	{{ HTML::script('js/jquery.magnific-popup.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	{{ HTML::script('js/betterContactForm.js') }}
	{{ HTML::script('http://www.skypeassets.com/i/scom/js/skype-uri.js') }}

	<!--[if IE]>
		{{ HTML::style('css/ie.css') }}
	<![endif]-->
	

	@yield('css')
	<script>
	      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	      ga('create', 'UA-60414778-1', 'auto');
	      ga('send', 'pageview');
	</script>
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
	      (function (d, w, c) {
	          (w[c] = w[c] || []).push(function() {
	              try {
	                  w.yaCounter28860550 = new Ya.Metrika({id:28860550,
	                          webvisor:true,
	                          clickmap:true,
	                          trackLinks:true,
	                          accurateTrackBounce:true});
	              } catch(e) { }
	          });

	          var n = d.getElementsByTagName("script")[0],
	              s = d.createElement("script"),
	              f = function () { n.parentNode.insertBefore(s, n); };
	          s.type = "text/javascript";
	          s.async = true;
	          s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

	          if (w.opera == "[object Opera]") {
	              d.addEventListener("DOMContentLoaded", f, false);
	          } else { f(); }
	      })(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="//mc.yandex.ru/watch/28860550" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
</head>
<body>
	@yield('header')
	<div class="container_main">
		@yield('left_sidebar')
		@yield('right_sidebar')
		@yield('body')
	</div>	
	@yield('footer')

	<script>
		$(window).on('load', function() {
			$('#bcf-trigger img').attr('src', "{{ asset('icons/online_apply.png') }}" );
		});
	</script>
	<script>
		$(window).on('load', function() {
			$('#SkypeButton_Call_thefantom2_1_paraElement img').attr('src', "{{ asset('icons/skype.png') }}" );
		});
	</script>

	<div id="scrollup">
		<i class="fa fa-arrow-circle-up to_top_button fa-4x"></i>
	</div>

	{{ HTML::script('js/cart.js') }}
	{{ HTML::script('js/script.js') }}
	{{ HTML::script('js/common.js') }}
	<script>
		@yield('js')
	</script>
</body>
</html>