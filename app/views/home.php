{% extends 'templates/default.php' %}

{% block title %}Home{% endblock %}

{% block mainClass %}home{% endblock %}

{% block content %}
	<div id="clockSection">
		<!--
		<div class="clockMenu clearfix">
			<input class="button first active" type="button" value="Wasted Timer">
			<input class="button" type="button" value="Timer Information">
		</div>
		-->
		<h2>Name of the meeting</h2>
		<div class="clockContent clearfix">
			<div class="clock">
				4:33:29
				<span class="title">Timer</span>
			</div>
			<div class="classbttn">
				<div class="play">
					<span class="title">Start</span>
				</div>
			</div>
			<div class="clock">
				<span class="counter">$227.90</span>
				<span class="title">Money Wasted</span>
			</div>
		</div>
		<a class="settings" href="#"></a>
	</div>
	<div id="contentSection">
		<ul class="peopleList">
			<li>Eduardo Castillo<span class="wage">$25/hour</span> <span class="wasted">Wasted: $600</span></li>
			<li>Argenis Sanches<span class="wage">$25/hour</span> <span class="wasted">Wasted: $600</span></li>
			<li>Tania Rubio<span class="wage">$25/hour</span> <span class="wasted">Wasted: $600</span></li>
		</ul>
	</div>
{% endblock %}