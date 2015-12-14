{% extends 'templates/default.php' %}

{% block title %}Login{% endblock %}
{% block mainClass %}fullForm{% endblock %}

{% block content %}

	<div class="newMeeting vcenter">
		<h1>Login</h1>
		{% if flash.login %}
			<p>{{ flash.login }}</p>
		{% endif %}
		<form action="{{ urlFor('login.post') }}" method="post" autocomplete="off">
			<ul class="form">
				<li><input class="text{% if errors.has('Username') %} error{% endif %}" type="text" placeholder="Username" name="identifier" {% if login_request.post('identifier') %} value="{{ login_request.post('identifier') }}" {% endif %}></li>
				<li><input class="text{% if errors.has('Password') %} error{% endif %}" type="password" placeholder="Password" name="password" ></li>
				<li class="clearfix">
					<input class="button" type="submit" value="Login" >
					<a href="{{ urlFor('register') }}" class="link">Don't have an account yet?</a>
				</li>
			</ul>
			<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" >
		</form>
	</div>
{% endblock %}