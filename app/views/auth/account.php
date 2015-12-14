{% extends 'templates/default.php' %}

{% block title %}New Meeting{% endblock %}

{% block content %}

	<div class="newMeeting">
		<h1>Login</h1>
		<form>
			<ul class="form">
				<li><input class="text" type="text" placeholder="Username" ></li>
				<li><input class="text" type="password" placeholder="Password" ></li>
				<li></li>
			</ul>
		</form>
	</div>
{% endblock %}