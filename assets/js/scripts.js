$(document).ready(function () {

	/*
	var test = $.ajax("https://titan.csit.rmit.edu.au/~e54061/wp/moviesJSON.php")
		.done(function() {
			alert("success");
		})
		.fail(function() {
			alert("failed");
		})
		.always(function() {
			alert("complete");
		})

		.each(test, function(i, field) {
			alert("field: " + field + " ");
		});
	*/
	//var obj = JSON.parse("");

	//alert(obj);

	$(".moviepanelextra").hide();
    
    var movies = [];
	var times = [];
    
    $.ajax({
        dataType: "json",
        url: "https://jupiter.csit.rmit.edu.au/~e54061/wp/moviesJSON.php",
        //data: { get_param: "value" },
        success: function (data) {
            $.each(data, function(index, element) {

				/* Replace any quote marks in the strings to prevent conflict */
				var desc1 = element.description[0].replace(/\"/g, '&#34');
				var desc2 = element.description[1].replace(/\"/g, '&#34');
				var desc3 = element.description[2].replace(/\"/g, '&#34');
				var desc = desc1 + '<br><br>' + desc2 + '<br><br>' + desc3;
				
				var d = element.description[0] + element.description[1] + element.description[2];
				
				//alert(element.screenings['Monday']);
				var days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
			
				var times_string = "";
				
				days.forEach(function (day) {
					var time = element.screenings[day];
					
					if (time !== undefined)
						times.push(day + " : " + time);
					
					if (time !== undefined)
						times_string = times_string + day + " " + time + "<br><br>";
				});
				
		
				$("#allmovies").append('<div class="moviepanel noselect shadow" ' +
									  	'data-title="' + element.title + '"' +
									   	'data-rating="' + element.rating + '"' +
									   	//'data-genre="' + element.rating + '"' +
									   	'data-summary="' + element.summary + '"' +
									   	'data-trailer="' + element.trailer + '"' +
									   	//'data-description=\''  + desc + '\'' +
									   	'data-description="' + desc + '"' +
									   	'data-times="' + times_string + '"' +
									  	'>' + 
									   	'<img src="' + element.poster + '"/>' +
									   	'</div>');
            });

        }
    });
    
    
    //alert(movies);
    
    //var obj = $.parseJSON('https://titan.csit.rmit.edu.au/~e54061/wp/moviesJSON.php');
    /*
    $.getJSON("https://titan.csit.rmit.edu.au/~e54061/wp/moviesJSON.php", function(data) {
       
        var items = [];
        
        $.each(data, function(key, val) {
            items.push("<li id='" + key + "'>" + val + "</li>");
        });
        
        $("<ul>", {
            "class": "my-new-list",
            html: items.join("")
        }).appendTo("body");
        
    });
    */
	//$(".moviepanel").click(function () {
	$(document).on('click', '.moviepanel', function() {
		var selected = $(this);	/* Cache the selected Panel */

		/* Hide Panel if it's already showing */
		if ($(this).hasClass("active")) {
			$(".moviepanel").removeClass("active");
			$(".moviepanelextra").stop(false, false);
			$(".moviepanelextra").animate({
				margin: "0px 0px 0px 10px",
				padding: "0px 10px 0px 10px",
				opacity: "0",
				height: "toggle"
			}, 1000);
			return false;
		}
		else {
			$("#allmovies").find(".moviepanelextra").remove();
			$(".moviepanel").removeClass("active");
			$(this).addClass("active");
		}

		var pos = selected.index();

		$(".moviepanel").slice(pos).each(function (index) {
			/* Panel is the last element in a row */
			if ($(this).next().index() > 0) {

				if ($(this).position().top !== $(this).next().position().top) {
					createMoviePanelExtra(selected, pos, index);
					return false;
				}
			}
			/* Panel is in the last row */
			if ($(this).next().index() === -1) {
				createMoviePanelExtra(selected, pos, index);
				return false;
			}
		});
		return false;
	});

	function sessionsToButtons(movie) {
		
		var buttons = "";
		
		var sessions = movie.attr("data-times").substring(0, movie.attr("data-times").length - 8).split("<br><br>");
		
		sessions.forEach( function(session) {
			buttons = buttons + '<div class="booktickets">' + session + '</div>';
		});
		
		return buttons;	
	}
	
	function createMoviePanelExtra(movie, pos, index) {
		$("#allmovies>div:nth-child("+ (pos + index + 1) +")").after(
			
			'<div class="moviepanelextra noselect">' +
				'<section1>' +
					'<div id="title">' + movie.attr("data-title") + '</div>' +
					'<div id="summary">' + movie.attr("data-summary") + '</div>' +
					'<div id="description">' + movie.attr("data-description") + '</div>' +
					'<div id="trailer"><video width="480" height="320" controls> <source src="' + movie.attr("data-trailer") + '" type="video/mp4"></video></div>' +
				'</section1>' +
				'<section2>' +
					'<div id="rating"><img src=' + movie.attr("data-rating") + '></div>' +
					'<div id="times"><h2>Showing Times:</h2>' + sessionsToButtons(movie) + '</div>' +
				'</section2>' +
			'</div>');

		$(".moviepanelextra").stop(false, false);

		var heightx = $(".moviepanelextra").height();
		$(".moviepanelextra").height(0);

		$(".moviepanelextra").animate({
			margin: "20px 0px 20px 10px",
			padding: "10px 10px 10px 10px",
			opacity: "1",
			height: heightx
		}, 1000);

		$("html,body").animate({ scrollTop: movie.offset().top }, "slow");

		return false;
	}

	/* DIALOG BUTTON SHIT */
	var dialog = document.getElementById('ticketmenu');

	function showDialog() {
	}

	$(".close").click(function () {
		dialog.close();
		$("body").css("-webkit-filter", "blur(0.0px)");
	});

	$(document).keyup( function (e) {
		e = e || window.event;
		if (e.keyCode == 27) {
		$("body").css("-webkit-filter", "blur(0.0px)");
		}
	});



	/*************************************************************************/
	/* Dialog menu that requires input at each stage before showing more */
	var day;
	var movie;
	var time;
	var discount;

	$(document).on('click', '.booktickets', function() {
		resetFields("day", "time", "ticket");
		movie = $('.active').attr("data-genre");

		$('.movieselect').removeAttr("disabled");
		$('#titleRO').val($('.active').attr("data-title"));
		$('.movieselect').val(movie);
		//$('.movieselect').attr("disabled", "disabled");

		if (movie == "RC") { addDays(1,2,3,4,5,6,7); }
		if (movie == "AC") { addDays(3,4,5,6,7); }
		if (movie == "CH") { addDays(1,2,3,4,5,6,7); }
		if (movie == "AF") { addDays(1,2,6,7); }
		dialog.showModal();
		$("body").css("-webkit-filter", "blur(5.0px)");
	});

	/* Prompt and update the selected day */
	$(document).on('change', '.dayselect', function () {
		day = $(this).val();

		if (movie == "RC") {
			if (day == "Mon" || day == "Tue") { addTimes(9); }
			if (day == "Wed" || day == "Thu" || day == "Fri") { addTimes(1); }
			if (day == "Sat" || day == "Sun") { addTimes(6); }
		}

		if (movie == "AC") {
			if (day == "Wed" || day == "Thu" || day == "Fri") { addTimes(1); }
			if (day == "Sat" || day == "Sun") { addTimes(6); }
		}

		if (movie == "CH") {
			if (day == "Mon" || day == "Tue") { addTimes(1); }
			if (day == "Wed" || day == "Thu" || day == "Fri") { addTimes(6); }
			if (day == "Sat" || day == "Sun") { addTimes(12); }
		}
		if (movie == "AF") {
			if (day == "Mon" || day == "Tue") { addTimes(6); }
			if (day == "Sat" || day == "Sun") { addTimes(3); }
		}

		resetFields("time", "ticket");
		$("#timefield").slideDown(500);
	});

	/* Prompt and update the selected time */
	$(document).on('change', '.timeselect', function() {
		time = $(this).val();


		resetFields("ticket");
		$("#ticketfield").slideDown(1000);
		$("#pricefield").slideDown(1000);

		/* check if its discount time */
		if (day == "Mon" || day == "Tue") {
			discount = true;
		}
		else if (time == "1300") {
			discount = true;
		}
		else {
			discount = false;
		}

		$(".qty").each( function() {

			var currency;
			if (discount)
				currency = $(this).parents("tr").find(".priceDIS").html();
			else
				currency = $(this).parents("tr").find(".priceREG").html();

			$(this).parents("tr").find(".price").text("$" + removeCurrency(currency).toFixed(2));
		});
	});

	function addDays() {
		$(".dayselect").empty();
		$(".dayselect").append('<option value="" disabled selected>Select a day</option>');
		for (i = 0; i < arguments.length; i++) {
			if (arguments[i] == 1) { $(".dayselect").append('<option value="Mon">Monday</option>'); }
			if (arguments[i] == 2) { $(".dayselect").append('<option value="Tue">Tuesday</option>'); }
			if (arguments[i] == 3) { $(".dayselect").append('<option value="Wed">Wednesday</option>'); }
			if (arguments[i] == 4) { $(".dayselect").append('<option value="Thu">Thursday</option>'); }
			if (arguments[i] == 5) { $(".dayselect").append('<option value="Fri">Friday</option>'); }
			if (arguments[i] == 6) { $(".dayselect").append('<option value="Sat">Saturday</option>'); }
			if (arguments[i] == 7) { $(".dayselect").append('<option value="Sun">Sunday</option>'); }
		}
	}

	function addTimes() {
		$("#timefield").empty();
		$("#timefield").append('<label for="time">Session Time: </label><br>');
		for (i = 0; i < arguments.length; i++) {
			if (arguments[i] == 12) { $("#timefield").append('<input type="radio" name="time" class="timeselect" value="1200" required> 12:00 pm <br>'); }
			if (arguments[i] == 1) { $("#timefield").append('<input type="radio" name="time" class="timeselect" value="1300" required> 1:00 pm <br>'); }
			if (arguments[i] == 3) { $("#timefield").append('<input type="radio" name="time" class="timeselect" value="1500" required> 3:00 pm <br>'); }
			if (arguments[i] == 6) { $("#timefield").append('<input type="radio" name="time" class="timeselect" value="1800" required> 6:00 pm <br>'); }
			if (arguments[i] == 9) { $("#timefield").append('<input type="radio" name="time" class="timeselect" value="2100" required> 9:00 pm <br>'); }
		}
	}

	function resetFields() {
		/* set all the fields to hidden */
		for (var arg in arguments) {
			if (arguments[arg] == "day") {
				$(".dayselect").val("");
			}
			if (arguments[arg] == "time") {
				$(".timeselect").attr("checked", false);
				$("#timefield").hide();
			}
			if (arguments[arg] == "ticket") {
				$("#ticketfield").hide();
				$("#pricefield").hide();
				/* reset so all tickets are 0 */

				$(".qty").each( function() {
					$(this).val(0);
					$(this).parents("tr").find(".subtotal").text("$0.00");
				});

				updateTotalPrice();
			}
		}
	}

	/* Update Subtotal Price when Adding/Removing ticket */
	$(document).on('change', '.qty', function () {
		var numSeats = $(this).val();
		var currency;

		if (discount)
			currency = $(this).parents("tr").find(".priceDIS").html();
		else
			currency = $(this).parents("tr").find(".priceREG").html();

		var singlePrice = removeCurrency(currency);
		var totalPrice = parseFloat(singlePrice * numSeats).toFixed(2);

		/* Update subtotal value */
		$(this).parents("tr").find(".subtotal").text("$" + totalPrice);

		/* Update total value */
		updateTotalPrice();
	});

	function updateTotalPrice() {
		var total = 0.00;

		$(".qty").each( function() {
			var subtotal = $(this).parents("tr").find(".subtotal").text();
			total += removeCurrency(subtotal);
			//alert(subtotal + " --- " + total);
		});
		$("#price").val("$" + total.toFixed(2));
	}

	function removeCurrency(amount) {
		return Number(amount.replace(/[^0-9.]+/g,""));
	}

});

function Validate() {
    ///////////////////////////////////////Name Validation//////////////////////////
    var Nameletters = /^[A-Za-z' ]+$/;
    var NumbersMatch = /^[0-9]+$/;
    var ReturnCount = 0;

    if (document.myForm.name.value == "") {
        alert("Please fill out your name");
        document.myForm.name.focus();
        // return false;
    }

    if (document.myForm.name.value.match(Nameletters)) {
        ReturnCount += 1;
    }
    else {
        alert("Please use only valid letters");
        document.myForm.name.focus();
        //return false;
    }

    //////////////////////////////////////phoneNumber validation////////////////////////
    if (document.myForm.phone.value == "") {
        alert("Please fill out your Phone");
        document.myForm.phone.focus();
        //return false;
    }

    if (document.myForm.phone.value.match(NumbersMatch)) {
        if (document.myForm.phone.value.length < 10 || document.myForm.phone.value.length > 10) {
            alert("Please fill out your mobile number, mobile numbers have 10 digits");
            document.myForm.phone.focus();
        }
        else {
            if (document.myForm.phone.value[0] == "0" && document.myForm.phone.value[1] == "4") {
                ReturnCount += 1;
            }
            else {
                alert("Mobile Numbers start with '04'");
                document.myForm.phone.focus();
            }
        }
    }
    else {
        alert("Please type a number");
        document.myForm.phone.focus();
    }

    if (ReturnCount >= 2) {
        return true;
    }
    else {
        return false;
    }
}