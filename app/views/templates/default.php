<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title>Wasted | {% block title %}{% endblock %}</title>
	<link rel="icon" type="image/png" href="{{ mainUrl }}/app/assets/style/favicon2.png">
	
	<script src="{{ mainUrl }}/app/assets/style/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" href="{{ mainUrl }}/app/assets/style/fonts/brandon-grotesque/brandon_grotesque.css">
	<script type="text/javascript" src="{{ mainUrl }}/app/assets/style/fonts/brandon-grotesque/brandon_grotesque.js"></script>
	
	<script id="source" language="javascript" type="text/javascript">
		var peopleURL = "{{ baseUrl }}" + "{{ urlFor('meeting.getpeople') }}";
		var meetingURL = "{{ baseUrl }}" + "{{ urlFor('meeting.getattendants') }}";
		var addpeopleURL = "{{ baseUrl }}" + "{{ urlFor('meeting.addpeople') }}";
		var removepeopleURL = "{{ baseUrl }}" + "{{ urlFor('meeting.removeattendees') }}";
	</script>
	<link rel="stylesheet" type="text/css" href="{{ mainUrl }}/app/assets/style/stylesheet.css" />
	<script src="{{ mainUrl }}/app/assets/style/javascript.js"></script>
	
</head>
<body class="{% block mainClass %}{% endblock %}" >
	<div id="mainWrap" class="clearfix">
		
		{% include 'templates/partials/navigation.php' %}
		
		<div id="mainContent">
			{% block content %}{% endblock %}
		</div>
	</div>
</body>
</html>