{% extends 'templates/default.php' %}

{% block title %}Meeting{% endblock %}

{% block content %}

	<div class="newMeeting">
		<h1>Meetings</h1>
		<ul class="form">
			<li class="clearfix">
				<a href="{{ urlFor('meeting.new') }}" class="button center" >Create new meeting</a>
			</li>
			<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" >
		</ul>
		<ul class="peopleList allMeetings">
			{% for meet in meetings %}
				<li><a href="{{ urlFor('meeting', {meet: meet.id}) }}">{{ meet.name }}</a> <a class="remove" href="{{ urlFor('delete.meet', {meet: meet.id}) }}" >X</a><a href="{{ urlFor('meeting.edit', {meet: meet.id}) }}" class="edit">Edit</a></li>
			{% endfor %}
		</ul>
	</div>
{% endblock %}