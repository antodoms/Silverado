var seats = [["SA",1], ["SP",1], ["SC",1], ["FA",2], ["FC",2], ["B1",3], ["B2",3], ["B3",3]];
var ticketcheck = [["A1","A2","A3","A4","A5","A6","A7","A8","A9","A10","A11","A12"], 
				   ["B1","B2","B3","B4","B5",
					"B11","B12","B13","B14","B15",
					"B21","B22","B23","B24","B25",
					"B31","B32","B33","B34","B35",
					"B6","B7","B8","B9","B10",
					"B16","B17","B18","B19","B20",
					"B26","B27","B28","B29","B30",
					"B36","B37","B38","B39","B40"],
				   ["C1","C2","C3","C4","C5","C6","C7","C8","C9","C10","C11","C12"]];
var hidelist = {"SA":ticketcheck[1],"SP":ticketcheck[1],"SC":ticketcheck[1],"FA":ticketcheck[0],"FC":ticketcheck[0],"B1":ticketcheck[2],"B2":ticketcheck[2],"B3":ticketcheck[2]};
var priceReg = ["$18","$15","$12","$30","$25","$30","$30","$30"];
var priceDis = ["$12","$10","$8","$25","$20","$20","$20","$20"];

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

	loadTheatre();
	resetTheatre();
	$(".moviepanelextra").hide();
	$("#ticketmenu").hide();

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
			$("#ticketmenu").hide();
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

		deleteAllCookies();
		setCookie("movie", pos + 1, 1);

		/* Show the hidden extra panel */
		$(".moviepanelextra").slideDown(1000);

		/* Slide the webpage down so that the extra panel is in better view */
		$("html,body").animate({ scrollTop: movie.offset().top }, "slow");

		return false;
	}

	$("#theatre button").click(function(){
		$(this).toggleClass("enabled");
	});

	$( "#theatre button" ).bind( "click",
		function(){
			toggleTheatre(loadid(this));
	});

	/********************************************************/
	/* Movie Booking Form Dialog (when a session is chosen) */
	/********************************************************/

	var dialog = document.getElementById('ticketmenu');

	$(".theatreOK").click(function () {
		$(".blurrable").css("-webkit-filter", "blur(0.0px)");
		$("#theatre").hide();
		
		/* set selected seats as hidden input value */
		var type = getCookie("seattype");
		
		var seats = getCookie(type);
		
		//alert(type + ": " + seats);
		
		$("input[name=" + type + "]").val(seats);
		
		if (seats === null)
			return false;
		
		var parent = $("input[name=" + type + "]").parents('tr');
		var numseats = seats.split(',').length;
		var price = removeCurrency(parent.children('.price').html());
		
		parent.children('.qty').html(numseats);
		
		parent.children('.subtotal').html("$" + (numseats * price).toFixed(2));
		
	});

	$(".close").click(function () {
		//dialog.close();
		$(dialog).slideUp(1000);
		$(".ticketBtn").removeClass("active");
		$(".blurrable").css("-webkit-filter", "blur(0.0px)");
	});

	$(document).keyup( function (e) {
		e = e || window.event;
		if (e.keyCode == 27) {
		$(".blurrable").css("-webkit-filter", "blur(0.0px)");
		}
	});

	function removeCurrency(amount) {
		return Number(amount.replace(/[^0-9.]+/g,""));
	}


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

		$(".ticketBtn").removeClass("active");
		$(this).addClass("active");
		
		resetSeats();
		setCookie("discount", checkDiscount(day, time), 1);
		
		$("input[name=movie]").val(activeMovie);
		$("input[name=day]").val(day);
		$("input[name=time]").val(time);

		$(dialog).slideDown(1000);
		
		//$("html,body").animate({ scrollTop: $(dialog).offset().top }, "slow");
		
		$(".price").each( function(index) {
			if (getCookie("discount") === "true")
				$(this).html(priceDis[index]);
			else
				$(this).html(priceReg[index]);
		});
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
function toggleTheatre(dataid){
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
function loadTheatre(){

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
function resetTheatre(){
	for(var i=0; i< ticketcheck.length;i++){

		for(var j=0; j< ticketcheck[i].length;j++){

			document.getElementById(ticketcheck[i][j]).disabled = true;
		}
	}
}

// Fubction to set the theatre value as enabled in html
function setTheatre(typeid){
	
	$(".blurrable").css("-webkit-filter", "blur(5.0px)");
	setCookie("seattype", typeid , 1);

	document.getElementById('theatre').style.display='block';

	var value = 0;
	resetTheatre();

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

//update the price of table whenever the function is called
function updateprice(){

}

//resetting the seat
function resetSeats(){

	for(var i=0; i < ticketcheck.length ; i++){
		for(var j=0; j< ticketcheck[i].length ; j++){
			document.getElementById(ticketcheck[i][j]).classList.remove("enabled");
		}
	}

	for(var i=0; i< seats.length ; i++){
		deleteCookie(seats[i][0]);
	}
	
	$(".qty").each(function() {
		$(this).html("0");
	});
	
	$(".price").each(function() {
		$(this).html("$0.00");	
	});
	
	$("input[type=hidden]").each(function() {
		$(this).val("0");
	});
}
