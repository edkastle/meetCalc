$( document ).ready(function(){
	var flag = false;
	var pSearch = "";
	var timeing = false;
	
	var timer = [];
	
	timer["timer"] = $("#timerWasted");
	timer["timerH"] = $("#timerH");
	timer["timerM"] = $("#timerM");
	timer["timerS"] = $("#timerS");
	timer["wasted"] = $("#allWasted");
	timer["wage"] = $("#hourlyWasted");
	
	if(timer["timerH"].length > 0 && timer["timerM"].length > 0 && timer["timerS"].length > 0){
		if(timer["timerH"].val() > 0 || timer["timerM"].val() > 0 || timer["timerS"].val() > 0){
			timeing = true;
		} else {
			$("#timeH").html("00");
			$("#timeM").html("00");
			$("#timeS").html("00");
		}
	}
	
	if(timeing){
		setInterval(function() { 
			var adder = 1;
			
			if(timer["timer"].val() >= 0){
				adder = -1;
			} else if(timer["timerH"].val() == 0 && timer["timerM"].val() == 0 && timer["timerS"].val() == 0){
				adder = 0;
			}
			
			timer["timer"].val(timer["timer"].val() - (-1));
			
			if(timer["timer"].val() > 0){
				var numb = Math.round((timer['timer'].val() * (timer['wage'].val() / 60)) * 100) / 100;
				
				timer["wasted"].val(numb);
			} else {
				timer["wasted"].val(0);
			}
			
			if(adder == 1){
				if(timer["timerS"].val() > 0){
				
					timer["timerS"].val(timer["timerS"].val() - adder);
					
					if(timer["timerS"].val() < 10){
						timer["timerS"].val("0"+ timer["timerS"].val());
					}
					
				} else {
					timer["timerS"].val(59);
					
					if(timer["timerM"].val() > 0){
						timer["timerM"].val(timer["timerM"].val() - adder);
						
						if(timer["timerM"].val() < 10){
							timer["timerM"].val("0"+ timer["timerM"].val());
						}
					} else {
						timer["timerM"].val(59);
						
						if(timer["timerH"].val() > 0){
							timer["timerH"].val(timer["timerH"].val() - adder);
							
							if(timer["timerH"].val() < 10){
								timer["timerH"].val("0"+ timer["timerH"].val());
							}
						}
					
					}
					
				}
			
			} else {
				
				if(timer["timerS"].val() < 59){
				
					timer["timerS"].val(timer["timerS"].val() - adder);
					
					if(timer["timerS"].val() < 10){
						timer["timerS"].val("0"+ timer["timerS"].val());
					}
					
				} else {
					timer["timerS"].val("00");
					
					if(timer["timerM"].val() < 59){
						timer["timerM"].val(timer["timerM"].val() - adder);
						
						if(timer["timerM"].val() < 10){
							timer["timerM"].val("0"+ timer["timerM"].val());
						}
					} else {
						timer["timerM"].val("00");
						
						if(timer["timerH"].val() > 0){
							timer["timerH"].val(timer["timerH"].val() - adder);
							
							if(timer["timerH"].val() < 10){
								timer["timerH"].val("0"+ timer["timerH"].val());
							}
						}
					
					}
					
				}
				
				
			}
			
			if(timer["timer"].val() < 0){
				$("#timerTitle").html("Starts in");
			} else if(timer["timer"].val() == 0){
				$("#timerTitle").html("Timer");
				timer["timerH"].val("00");
				timer["timerM"].val("00");
				timer["timerS"].val("00");
			} else {
				$("#timerTitle").html("Timer");
			}
			
			$("#timeH").html(timer["timerH"].val());
			$("#timeM").html(timer["timerM"].val());
			$("#timeS").html(timer["timerS"].val());
			
			$(".counter").html('$'+ timer["wasted"].val());
		}, 1000)
	}
	
	$(".peopleList>li .text, .inputLabel").click(function(){
		flag = true;
	});
	$(".searchResults").click(function(){
		flag = false;
	});
	
	$("#searchperson").on('input focus', function(){
		var val = $("#searchperson").val();
		val = $.trim(val);
		
		if(val.length > 0){
			if(pSearch != val){
				pSearch == val;
				getPeople(val, $(".searchResults"));
			}
		} else {
			flag = false;
			$(".searchResults").toggle(false);
		}
		
	});
	
	$(".remove").click(function(){
		var usrid = $(this).siblings(".attid");
		removePeople(usrid.val());
		attendee($("#meetid").val());
	});
	
	$(".timeSelected").click(function(){
	
		var valInput = $(this).siblings(".timeValue");
		if(valInput.val() == 'AM'){
			valInput.val("PM");
		} else {
			valInput.val("AM");
		}
		
		$(this).val(valInput.val());
		
	});
	
	$("html").click(function(){
		if(!flag){
			$(".searchResults").toggle(false);
		} else {
			flag = false;
		}
	});
	
});

function addPeople(person){
	
	if(person != null){
		$.get(addpeopleURL, { userid: person, meetid: $("#meetid").val() });
	}
}

function removePeople(person){
	
	if(person != null){
		$.get(removepeopleURL, { userid: person, meetid: $("#meetid").val() });
	}
	
}

function getPeople(search, ele, type){

	if(type == null){
		type = 'search';
	}
	
	if(search != null && ele != null){
		$.get(peopleURL, { person: search }, function( data ){
			if(data.length > 0){
				$(".searchList").empty();
				ele.show();
				$.each(data, function(index, value){
					if(type == 'search'){
						var child = ele.children("ul.searchList");
						child.append(
							'<li><input type="hidden" value="'+ value["id"] +'" ><span>'+ value["last"] +', '+ value["first"] +'</span><span class="sal">$'+ value["wage"] +'/hour</span></li>'
						);
					}
				});
				$(".searchList li").on("click", function(){
					var usrid = $(this).children("input");
					addPeople(usrid.val());
					attendee($("#meetid").val());
				});
			} else {
				ele.hide();
			}
		}, "json");
	} else {
		ele.hide();
	}
}

function attendee(people, type){
	
	if(type == null){
		type = 'normal';
	}
	
	if(people != null){
		var origin = $(".peopleList>li").length;
		
		$(".peopleList>li").length;
		$.get(meetingURL, { meetid: people }, function( data ){
			
			var retry = true;
			var retries = 0;

			if(data.length > 0){
				var datalength = data.length + 1;
				
				if(data != 'empty'){
					while(retry && retries < 3){
						retries++;
						$(".peopleList>li").not(".search").remove();
						$.each(data, function(index, value){

							$(".peopleList").append(
								'<li>'+ value['last'] +', '+ value['first'] +'<span class="wage">$'+ value['wage'] +'/hour</span>	<input class="remove" type="button" value="X" ><input class="attid" type="hidden" value="'+ value["id"] +'" ></li>'
							);
							
						});
						if(origin != $(".peopleList>li").length){
							retry = false;
						}
					}
					if(retries == 3){
						if(type == 'normal'){
							attendee(people, 'retry');
						}
					}
				} else {
					if(type == 'normal'){
						attendee(people, 'retry');
					} else {
						$(".peopleList>li").not(".search").remove();
					}
				}
				
				$(".remove").click(function(){
					var usrid = $(this).siblings(".attid");
					removePeople(usrid.val());
					attendee($("#meetid").val());
				});
			}
			
		}, "json");
		
	}

}