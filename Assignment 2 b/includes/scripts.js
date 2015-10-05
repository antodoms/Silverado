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

	checkCookie();
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
		var screenings = "<h2>Book a Session:</h2>";

		/* Break down description [] and session {} */
		$.each(movies[activeMovie].description, function(index, paragraph) {
			description = description + '<p>' + paragraph + '</p>';
		});

		$.each(movies[activeMovie].screenings, function(day, time) {
			screenings = screenings + '<div class="ticketBtn">' +
											'<div class="btnDay">' + day + '</div>' +
											'<div class="btnTime">' + time + '</div>' +
										'</div>';
		});

		/* Update extra panel information */
		extrapanel.find("#title").html(title);
		extrapanel.find("#summary").html(summary);
		extrapanel.find("#trailer").html('<source src=' + trailer + ' type=video/mp4>');
		extrapanel.find("#rating").html('<img src=' + rating + '>');
		extrapanel.find("#description").html(description);
		extrapanel.find("#sessions").html(screenings);


		setCookie("x_movie", pos + 1, 1);

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

	$(document).on('click', '.ticketBtn', function() {
		var selectedMovie = movies[activeMovie];

		/* Check if session is discount or not */
		var day = $(this).find(".btnDay").text();
		var time = $(this).find(".btnTime").text();

		setCookie("x_discount", checkDiscount(day, time), 1);

		dialog.showModal();
		$("body").css("-webkit-filter", "blur(5.0px)");
	});

	/* Returns whether the session should have a discount */
	function checkDiscount(day, time) {

		/* Check to make sure user hasn't modified day/time */
		var validScreening = false;

		$.each(movies[activeMovie].screenings, function(d, t) {
			if (day === d && time === t){
				validScreening = true;
			}
		});
		if (validScreening === false)
			return false;

		if (day.toString() === "Monday" || day.toString() === "Tuesday")
			return true;

		if (day.toString() !== "Saturday" && day.toString() !== "Sunday") {
			if (time.toString() === "1pm")
				return true;
		}
		return false;
	}

	$(document).on('click', '.ticketBtn2', function() {
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


//**********************************************************************************************************//
//**********************************************************************************************************//
// ANTO'S STUFF
//**********************************************************************************************************//
//**********************************************************************************************************//

/* Got this from http://stackoverflow.com/questions/1959455/how-to-store-an-array-in-jquery-cookie */
// Cookie List Generator Code starts here
var cookieList = function(cookieName) {
var cookie = jQuery.cookie(cookieName);
//console.log(cookie);
var items = cookie ? cookie.split(/,/) : new Array();

return {
	"add": function(val) {
		//Add to the items.
		items.push(val);
		$.cookie(cookieName,items);
	},
	"remove": function (val) {
		//EDIT: Thx to Assef and luke for remove.
		/** indexOf not support in IE, and I add the below code **/
		if (!Array.prototype.indexOf) {
			Array.prototype.indexOf = function(obj, start) {
				for (var i = (start || 0), j = this.length; i < j; i++) {
					if (this[i] === obj) { return i; }
				}
				return -1;
			}
		}
		var indx = items.indexOf(val);
		if(indx!=-1) items.splice(indx, 1);
		//if(indx!=-1) alert('lol');
		$.cookie(cookieName, items.join(','));
	},
	"clear": function() {
		items = null;
		//clear the cookie.
		$.cookie(cookieName, null);
	},
	"items": function() {
		//Get all the items.
		return items;
	}
}}
// CookieList Generator Code ends here

//The below cookie function is used from : http://www.w3schools.com/js/js_cookies.asp

// Adding Single Cookies Here
/* ********************************************************** */
function checkCookie() {
	var movie = getCookie("movie");
		if(movie!=null){
			movie = movie.trim(';')[0];
		}
	if (movie == 1 || movie == 2 || movie == 3 || movie== 4) {
		//showtime(movie);
		$("table").show();
		$("#ticket").hide();
		var pprice = getCookie("price");
		if( pprice == 1 || pprice ==2){
			$("#ticket").show();
			$('html, body').animate({
				scrollTop: $("#ticket").offset().top
			}, 1000);
		}
	}
	else{
		//showtime(1);
	}
}

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
}


function getCookie(name) {
	var dc = document.cookie;
	var prefix = name + "=";
	var begin = dc.indexOf("; " + prefix);
	if (begin == -1) {
		begin = dc.indexOf(prefix);
		if (begin != 0) return null;
	}
	else
	{
		begin += 2;
		var end = document.cookie.indexOf(";", begin);
		if (end == -1) {
		end = dc.length;
		}
	}
	return unescape(dc.substring(begin + prefix.length, end));
}

function deleteCookie(cname) {
	document.cookie = encodeURIComponent(cname) + "=deleted; expires=" + new Date(0).toUTCString();
}

function deleteAllCookies() {
	var cookies = document.cookie.split(";");

	for (var i = 0; i < cookies.length; i++) {
		var cookie = cookies[i];
		var eqPos = cookie.indexOf("=");
		var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
		document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";

	}
}


function loadid(element) {

	var dataid = element.id;
	return dataid;

}

//Function to select or deselect a theatre seat
function toggletheatre(dataid){
	var seatlist = new cookieList("selectedseat");
	var seattype = new cookieList(getCookie("seattype"));

	var data = seatlist.items();
	for(var i=0; i<data.length;i++){
		if(data[i]==dataid){
			seatlist.remove(dataid);
			seattype.remove(dataid);
			updateprice();
			return;
		}
	}
	seatlist.add(dataid);
	seattype.add(dataid);
	updateprice();
	return;
}

// Function to load the theatre when add seats is pressed
function loadtheatre(){

	if(getCookie("selectedseat") != null){
	var seatlist = new cookieList("selectedseat");
	var data = seatlist.items();
	for(var i=0; i<data.length;i++){
		var d = document.getElementById(data[i]);
		d.className = d.className + "enabled";
	}
	}
}

// reset the theatre value in html
function resettheatre(){
	for(var i=0; i< ticketcheck.length;i++){

		for(var j=0; j< ticketcheck[i].length;j++){

			document.getElementById(ticketcheck[i][j]).disabled = true;
		}
	}
}

// Fubction to set the theatre value as enabled in html
function settheatre(typeid){
	setCookie("seattype", typeid , 1);

	document.getElementById('theatre').style.display='block';
	document.getElementById('fade').style.display='block';

	var value = 0;
	resettheatre();

	for(var i=0;i< hidelist[typeid].length;i++){
		document.getElementById(hidelist[typeid][i]).disabled = false;
	}

	for(var i=0; i < seats.length ; i++){
		if(seats[i][0] == typeid){
			value = seats[i][1];
		}
	}

	for(var i=0; i < seats.length ; i++){
		if(seats[i][1] == value && seats[i][0] != typeid){
			var seattype = new cookieList(seats[i][0]);
			var data = seattype.items();

			for(var j=0; j < data.length ; j++){
				document.getElementById(data[j]).disabled = true;
			}
		}
	}
}
