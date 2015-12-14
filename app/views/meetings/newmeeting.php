{% extends 'templates/default.php' %}

{% block title %}New Meeting{% endblock %}
{% block mainClass %}fullForm{% endblock %}

{% block content %}

	<div class="newMeeting vcenter">
		<h1>Create new meeting</h1>
		
		<form action="{{ urlFor('meeting.new.post') }}" method="post">
			<ul class="form">
				<li><input class="text{% if errors.has('Name') %} error{% endif %}" name="name" type="text" placeholder="Meeting name"{% if request.post('name') %} value="{{ request.post('name') }}" {% endif %}></li>
				
				<!--
				<li class="half special clearfix">
					<div class="titleInput">Start Time</div>
					<div class="titleInput">End Time</div>
				</li>
				
				<li class="half clearfix">
					
					<div class="section three special">
						<div class="time clearfix">
							<input class="text" type="text" placeholder="Hours" >
							<input class="text middle" type="text" placeholder="Minutes" >
							<input class="text" type="text" placeholder="Seconds" >
							<div class="selection timeSelect">
								<input class="timeSelected" type="button" value="AM" >
								<input type="hidden" class="timeValue" name="startTime" value="AM" >
							</div>
						</div>
					</div>
					
					<div class="section three special">
						<div class="time clearfix">
							<input class="text" type="text" placeholder="Hours" >
							<input class="text middle" type="text" placeholder="Minutes" >
							<input class="text" type="text" placeholder="Seconds" >
							<div class="selection timeSelect">
								<input class="timeSelected" type="button" value="AM" >
								<input type="hidden" class="timeValue" name="startTime" value="AM" >
							</div>
						</div>
					</div>
					
				</li>
				
				<li class="special">
					<h4 class="title">People attending</h4>
					
					
					
					
					
					<table class="attendants" style="width:100%" cellspacing=0 cellpadding=0>
						<tr>
							<th><div>Name</div></th>
							<th><div>Hourly Salary</div></th>
						</tr>
					</table>
					
					<div class="foot clearfix">
						<span class="subTitle">Add person</span>
						<div class="searchBox">
							<input class="text" type="text" placeholder="Search for a person" id="searchperson" autocomplete="off" >
							<div class="searchResults hidden">
								<ul class="searchList">
									
								</ul>
							</div>
						</div>
						<input class="search" id="searchbttn" type="button" value="" >
					</div>
				</li>
				-->
				<li class="clearfix">
					<input class="button" type="submit" value="Create meeting" >
				</li>
				<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}" >
			</ul>
		</form>
	</div>
{% endblock %}