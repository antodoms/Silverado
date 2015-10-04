var app = angular.module('SilveradoApp', []);

var activeMovie = "AC";		/* Keep track of which movie the user is currently 'viewing' */

var movies = {};

app.controller('moviesController', function($scope, $http) {
	$http.get("https://jupiter.csit.rmit.edu.au/~e54061/wp/moviesJSON.php")
	.success(function(data) {
		/* Store data in global scope variable for php page to access */
		$scope.movies = data;

		/* Store data in local movies dictionary for easy local access */
		$.each(data, function(index, value) {
			movies[index] = value;
		});
	});
});

$(document).ready(function () {

	$(".moviepanelextra").hide();

	/**********************************************/
	/* Movie panel (when you click on the poster) */
	/**********************************************/

	$(document).on('click', '.moviepanel', function() {
		var selected = $(this);	/* Cache the selected Panel */

		/* Check if any movie panel was previously active. Hide/show accordingly */
		if ($(this).hasClass("active")) {
			$(".moviepanel").removeClass("active");
			$(".moviepanelextra").stop(false, false);
			$(".moviepanelextra").slideUp(1000);
			return false;
		}
		else {
			$(".moviepanel").removeClass("active");
			$(this).addClass("active");
		}

		/* Cache the selected movie by its code i.e.(AC, AF, CH, RC) */
		$.each(movies, function(key, value) {
			if (selected.find("#movie-code").text() === key.toString()) {
				activeMovie = key;
			}
		});

		/* Temporarily move the extra panel outside to prevent screwing up the indexes */
		$(document.getElementById("extrapanel")).insertAfter($("#allmovies"));

		/* Check where the detailed information panel should be inserted */
		var pos = selected.index();

		$(".moviepanel").slice(pos).each(function (index) {

			/* Panel is the last element in a row */
			if ($(this).next().index() > 0) {

				if ($(this).position().top !== $(this).next().position().top) {
					moveMoviePanelExtra(selected, pos, index);
					return false;
				}
			}
			/* Panel is in the last row */
			if ($(this).next().index() === -1) {
				moveMoviePanelExtra(selected, pos, index);
				return false;
			}
		});
		return false;
	});

	/******************************************/
	/* Extra movie information panel dropdown */
	/******************************************/

	function moveMoviePanelExtra(movie, pos, index) {

		var extrapanel = $(document.getElementById("extrapanel"));

		extrapanel.insertAfter($("#allmovies>div:nth-child(" + (pos + index + 1) + ")"));

		var title = movies[activeMovie].title;
		var summary = movies[activeMovie].summary;
		var trailer = movies[activeMovie].trailer;
		var rating = movies[activeMovie].rating;
		var description = "";
		var screenings = "Book a Session:";

		/* Break down description [] and session {} */
		$.each(movies[activeMovie].description, function(index, paragraph) {
			description = description + '<p>' + paragraph + '</p>';
		});

		$.each(movies[activeMovie].screenings, function(day, time) {
			screenings = screenings + '<div class="booktickets">' + day + " " + time + '</div>';
		});

		/* Update extra panel information */
		extrapanel.find("#title").html(title);
		extrapanel.find("#summary").html(summary);
		extrapanel.find("#trailer").html('<source src=' + trailer + ' type=video/mp4>');
		extrapanel.find("#rating").html('<img src=' + rating + '>');
		extrapanel.find("#sessions").html(screenings);
		extrapanel.find("#description").html(description);



		/* Show the hidden extra panel */
		$(".moviepanelextra").slideDown(1000);

		/* Slide the webpage down so that the extra panel is in better view */
		$("html,body").animate({ scrollTop: movie.offset().top }, "slow");

		return false;
	}

	/********************************************************/
	/* Movie Booking Form Dialog (when a session is chosen) */
	/********************************************************/

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
