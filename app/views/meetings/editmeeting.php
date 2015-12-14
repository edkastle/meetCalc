{% extends 'templates/default.php' %}

{% block title %}Edit{% endblock %}

{% block mainClass %}home{% endblock %}

{% block content %}
	<div id="clockSection">
		<input id="meetid" type="hidden" value="{{ meeting.id }}"  >
		<form action="{{ urlFor('meeting.edit.post', {meet: meeting.id}) }}" method="post">
			<div><input name="name" class="text" type="text" placeholder="Meeting name" value="{{ meeting.name }}" autocomplete="off" ></div>
			<div class="clockContent timelength clearfix">
				<div class="clock timelength">
					<input name="start_hour" class="text" type="text" maxlength="2" placeholder="--" {% if meeting.start_time is not null %} value="{{ meeting.start_time|date('h') }}" {% endif %} autocomplete="off">
					<span class="colon">:</span>
					<input name="start_minute" class="text" type="text" maxlength="2" placeholder="--" {% if meeting.start_time is not null %} value="{{ meeting.start_time|date('i') }}" {% endif %} autocomplete="off">
					<div class="selection timeSelect">
						<input class="timeSelected" type="button" value="{% if meeting.start_time is not null %}{{ meeting.start_time|date('A') }}{% else %}AM{% endif %}" >
						<input type="hidden" class="timeValue" name="start_time" value="{% if meeting.start_time is not null %}{{ meeting.start_time|date('A') }}{% else %}AM{% endif %}" >
					</div>
					<span class="title">Start Time (Today)</span>
				</div>
				<div class="classbttn">
					<div></div>
				</div>
				<div class="clock timelength">
					<input name="end_hour" class="text" type="text" maxlength="2" placeholder="--" {% if meeting.end_time is not null %} value="{{ meeting.end_time|date('h') }}" {% endif %} autocomplete="off">
					<span class="colon">:</span>
					<input name="end_minute" class="text" type="text" maxlength="2" placeholder="--" {% if meeting.end_time is not null %} value="{{ meeting.end_time|date('i') }}" {% endif %} autocomplete="off">
					<div class="selection timeSelect">
						<input class="timeSelected" type="button" value="{% if meeting.end_time is not null %}{{ meeting.end_time|date('A') }}{% else %}AM{% endif %}" >
						<input type="hidden" class="timeValue" name="end_time" value="{% if meeting.end_time is not null %}{{ meeting.end_time|date('A') }}{% else %}AM{% endif %}" >
					</div>
					<span class="title">End Time</span>
				</div>
			</div>
			<div class="clockButton clearfix">
				<a class="button" href="{{ urlFor('meeting', {meet: meeting.id}) }}">Cancel</a>
				<input class="button" type="submit" value="Change" >
			</div>
			<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" >
		</form>
	</div>
	<div id="contentSection">
		<ul class="peopleList wremove">
			<li class="search">
				<div class="container">
					<label class="inputLabel" for="searchperson">Add People</label><input class="text" id="searchperson" type="text" placeholder="Search for people" >
					<div class="searchResults hidden">
						<ul class="searchList">
							
						</ul>
					</div>
				</div>
			</li>
			{% for attendee in attendees %}
				<li>{{ attendee.last }}, {{ attendee.first }}<span class="wage">${{ attendee.wage }}/hour</span>	<input class="remove" type="button" value="X" ><input class="attid" type="hidden" value="{{ attendee.id }}" ></li>
			{% endfor %}
		</ul>
	</div>
{% endblock %}