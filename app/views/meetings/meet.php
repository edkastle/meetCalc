{% extends 'templates/default.php' %}

{% block title %}{{ meeting.name }}{% endblock %}

{% block mainClass %}home{% endblock %}

{% block content %}
	<div id="clockSection">
		<h2>{{ meeting.name }}</h2>
		<div class="clockContent clearfix">
			<div class="clock">
				<div id="time" class="clearfix"><div id="timeH">{{ time.timerH }}</div>:<div id="timeM">{{ time.timerM }}</div>:<div id="timeS">{{ time.timerS }}</div></div>
				<input type="hidden" id="timerH" value="{{ time.timerH }}" >
				<input type="hidden" id="timerM" value="{{ time.timerM }}" >
				<input type="hidden" id="timerS" value="{{ time.timerS }}" >
				<input type="hidden" id="timerWasted" value="{{ time.timer }}" >
				<span id="timerTitle" class="title">{% if time.timer < 0 %}Starts in{% else %}Timer{% endif %}</span>
			</div>
			<div class="classbttn"><div></div></div>
			<div class="clock">
				<span class="counter">${{ wasted.waste }}</span>
				<span class="title">Money Wasted</span>
				<input type="hidden" id="allWasted" value="{{ wasted.waste }}" >
				<input type="hidden" id="hourlyWasted" value="{{ wasted.wage }}" >
			</div>
		</div>
		<a class="settings" href="{{ urlFor('meeting.edit', {meet: meeting.id}) }}"></a>
	</div>
	<div id="contentSection">
		<ul class="peopleList">
			{% for attendee in attendees %}
				<li>{{ attendee.last }}, {{ attendee.first }} <span class="wasted">${{ attendee.wage }}/hour</span></li>
			{% endfor %}
		</ul>
	</div>
{% endblock %}