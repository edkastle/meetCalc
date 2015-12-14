{% extends 'templates/default.php' %}

{% block title %}Register{% endblock %}
{% block mainClass %}fullForm{% endblock %}

{% block content %}

	<div class="newMeeting vcenter reg">
		<h1>Register</h1>
		<form action="{{ urlFor('register.post') }}" method="post" autocomplete="off">
			<ul class="form">
					
				<li class="half clearfix">
					<input class="text{% if errors.has('First name') %} error{% endif %}" type="text" name="first_name" placeholder="First Name" {% if request.post('first_name') %} value="{{ request.post('first_name') }}" {% endif %}>
					<input class="text{% if errors.has('Last name') %} error{% endif %}" type="text" name="last_name" placeholder="Last Name" {% if request.post('last_name') %} value="{{ request.post('last_name') }}" {% endif %}>
				</li>
				
				<li><input class="text{% if errors.has('Wage') %} error{% endif %}" type="text" name="wage" placeholder="Wage per hour (ex: 12.34)" {% if request.post('wage') %} value="{{ request.post('wage') }}" {% endif %}></li>
				<li><input class="text{% if errors.has('Username') %} error{% endif %}" type="text" name="username" placeholder="Username" {% if request.post('username') %} value="{{ request.post('username') }}" {% endif %}></li>
				<li class="half clearfix">
					<input class="text{% if errors.has('Password') %} error{% endif %}" type="password" name="password" placeholder="Password" >
					<input class="text{% if errors.has('Password confirm') %} error{% endif %}" type="password" name="password_confirm" placeholder="Confirm Password" >
				</li>
				<li class="clearfix">
					<input class="button" type="submit" value="Register" >
					<a href="{{ urlFor('login') }}" class="link">Already have an account?</a>
				</li>
			</ul>
			<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" >
		</form>
	</div>
{% endblock %}