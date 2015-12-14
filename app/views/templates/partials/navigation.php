<div id="mainMenu" class="">
	<ul class="mainMenu">
		<li class="logo">
			<a href="{{ urlFor('home') }}"><img src="{{ mainUrl }}/app/assets/style/logo.png"></a>
		</li>
		
		{% if auth %}
			<li><a class="link" href="{{ urlFor('logout') }}">Logout</a></li>
			<li class="first"><a class="link" href="{{ urlFor('meetings') }}">Meetings</a></li>
		{% else %}
			<li><a class="link" href="{{ urlFor('register') }}">Register</a></li>
			<li class="first"><a class="link" href="{{ urlFor('login') }}">Login</a></li>
		{% endif %}
	</ul>
</div>