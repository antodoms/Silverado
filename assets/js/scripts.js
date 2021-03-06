var seats = [["SA",1], ["SP",1], ["SC",1],
			 ["FA",2], ["FC",2],
			 ["B1",3], ["B2",3], ["B3",3]];
var code;
var ticketcheck = [["A1","A2","A3","A4","A5","A6","A7","A8","A9","A10","A11","A12"],
				   ["B1","B2","B3","B4","B5","B11","B12","B13","B14","B15",
					"B21","B22","B23","B24","B25","B31","B32","B33","B34","B35",
					"B6","B7","B8","B9","B10","B16","B17","B18","B19","B20",
					"B26","B27","B28","B29","B30","B36","B37","B38","B39","B40"],
				   ["C1","C2","C3","C4","C5","C6","C7","C8","C9","C10","C11","C12"]];

var hidelist = {"SA":ticketcheck[1],"SP":ticketcheck[1],"SC":ticketcheck[1],
				"FA":ticketcheck[0],"FC":ticketcheck[0],
				"B1":ticketcheck[2],"B2":ticketcheck[2],"B3":ticketcheck[2]};

var priceReg = ["$18.00","$15.00","$12.00","$30.00","$25.00","$30.00","$30.00","$30.00"];
var priceDis = ["$12.00","$10.00","$8.00","$25.00","$20.00","$20.00","$20.00","$20.00"];

var app = angular.module('SilveradoApp', []);

var activeMovie = "AC";		/* Keep track of which movie the user is currently 'viewing' */

var movies = {};

var discounted = false;

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
	deleteAllCookies();
	$(".moviepanelextra").hide();
	$("#ticketmenu").hide();

	/**********************************************/
	/* Movie panel (when you click on the poster) */
	/**********************************************/
       
	$(document).on('click', '.moviepanel', function() {
		var selected = $(this);	/* Cache the selected Panel */
		deleteAllCookies();

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

		/* Update Dropdown Extra Panel information */
		extrapanel.find("#title").html(title);
		extrapanel.find("#summary").html(summary);
		extrapanel.find("#trailer").html('<source src=' + trailer + ' type=video/mp4>');
		extrapanel.find("#trailer").load();
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

	/*********************************************************************/
	/* Button for when user clicks on a Movie Screening (e.g. 12pm, 6pm) */
	/*********************************************************************/

	$(document).on('click', '.ticketBtn', function() {
		var selectedMovie = movies[activeMovie];

		/* Check if screening is discount or not */
		var day = $(this).find(".btnDay").text();
		var time = $(this).find(".btnTime").text();

		$(".ticketBtn").removeClass("active");
		$(this).addClass("active");

		resetSeats();
		setCookie("discount", checkDiscount(day, time), 1);

		$("input[name=movie]").val(activeMovie);
		$("input[name=day]").val(day);
		$("input[name=time]").val(time);

		/* Show ticket menu and update table prices */
		$("#ticketmenu").slideDown(1000);

		$("#ticketmenu .price").each( function(index) {
			if (getCookie("discount") === "true")
				$(this).html(priceDis[index]);
			else
				$(this).html(priceReg[index]);
		});
	});

	$(document).on('click', '.close', function() {
		$("#ticketmenu").slideUp(1000);
		$(".ticketBtn").removeClass("active");
	});
        
        
	/* Returns whether the screening should have a discount */
	function checkDiscount(day, time) {

		if (!screeningExists(movies[activeMovie], day, time))
			return false;

		if (day.toString() === "Monday" || day.toString() === "Tuesday")
			return true;

		if (day.toString() !== "Saturday" && day.toString() !== "Sunday") {
			if (time.toString() === "1pm")
				return true;
		}
		return false;
	}

	/* Returns whether the screening exists (in case user modified html) */
	function screeningExists(movie, day, time) {
		var validScreening = false;

		$.each(movies[activeMovie].screenings, function(d, t) {
			if (day === d && time === t) {
				validScreening = true;
			}
		});
		return validScreening;
	}

	/**************************************************/
	/* Theatre: Seat Booking Pop-up related functions */
	/**************************************************/

	/* Each 'seat', which represent individual buttons */
	$("#theatre button").click(function(){
		$(this).toggleClass("enabled");
	});

	$("#theatre button").bind("click", function(){
		toggleTheatre(loadid(this));
	});

	/* OK button when the user has finished choosing seats */
	$("#theatre .theatreOK").click(function () {
		$(".blurrable").css("-webkit-filter", "blur(0.0px)");
		$("#theatre").hide();

		/* set selected seats as hidden input value */
		var type = getCookie("seattype");
		var seats = getCookie(type);

		if (seats === null || seats === "") {
			deleteCookie(type);
			return false;
		}

		$("input[name=" + type + "]").val(seats);

		var parent = $("input[name=" + type + "]").parents('tr');
		var numseats = seats.split(',').length;
		var price = removeCurrency(parent.children('.price').html());

		parent.children('.qty').html(numseats);

		parent.children('.subtotal').html("$" + (numseats * price).toFixed(2));

	});
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

	$.getJSON("../booking/notavailable", function(result) {

	var movie = document.getElementById('movie').value;
	var day = document.getElementById('day').value;
	var time = document.getElementById('time').value;

	var a = result['unseat'][movie][day][time]['a'];
	var b = result['unseat'][movie][day][time]['b'];

	for (i=0;i< a.length; i++){
		document.getElementById(a[i]).disabled = true;
	}

	for (i=0;i< b.length; i++){
		document.getElementById(b[i]).disabled = true;
	}

	});
}


//update the price of table whenever the function is called
function updateprice(){

}

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

function toggleShowMore() {
	var showmorediv = $("#showmore");

	if (showmorediv.is(":hidden")) {
		showmorediv.slideDown(1000);
		$(event.target).text("Show Less");
	}
	else {
		showmorediv.slideUp(1000);
		$(event.target).text("Show More");
	}
}

function toggleUserDropdown() {
	var dropdown = $("#userDropdown");

	if (dropdown.is(":hidden"))
		dropdown.slideDown(500);
	else
		dropdown.slideUp(500);

}

function checkVoucher() {
	code = $("input[name=voucher]").val();
		if (ClientCheckCode(code)) {
			$.ajax({
				url: "checkvoucher",
				data: { code : code },
				type: "GET",
				dataType: "JSON",
				success: function(response) {
                                        
					if (response.success === 'true' && discounted==false && response.code === '') {
						var total = removeCurrency($(".totalprice").text());
						var newtotal = total * 0.8;

						alert("Successfully added voucher code.");

						$(".totalprice").text("Total price (discounted): $" + newtotal.toFixed(2));

						discounted = true;
                                                
                                                
					}
                                        else if(response.success === 'false' && discounted==true){
                                            var total = removeCurrency($(".totalprice").text());
                                            var newtotal = total/0.8;
                                            alert("Invalid voucher code.");
                                            $(".totalprice").text("Total price : $" + newtotal.toFixed(2));
                                            discounted = false;
                                            code='';
                                           
                                        }
                                        else if(response.success === 'true' && response.code != ''){
                                            alert("You have already added a voucher before.");
                                        }
                                        
				},
				error: function() {
					alert("Invalid voucher code.");
                                        $(".totalprice").text("Total price : $" + newtotal.toFixed(2));
                                        discounted = false;
                                        code='';
				}
			});
			return false;
		}
}

function ClientCheckCode(var1)
{       
        var1 = var1.split('-').join('');
        var dump=[];
   //     dump = var1[0]+var1[1]+var1[2]+var1[3]+var1[4]+var1[5]+var1[6]+var1[7]+var1[8]+var1[9]+var1[10].toUpperCase()+var1[11].toUpperCase();
    //    var1 = dump;
        
        for (i = 0; i < var1.length - 2; i ++)
        {
           dump += var1[i]; 
        }
        dump += var1[var1.length - 2].toUpperCase();
        dump += var1[var1.length - 1].toUpperCase();
        
        var1 = dump;
        console.log(var1.length);
	/* User didn't include hyphens */
	if (var1.length == 12)
	{
		console.log(var1, "Final output");
                code =var1;
		return true;
	}
	else
	{
            console.log(var1);
            alert("The code you entered is not formatted correctly");
            return false;
	}
}

function removeCurrency(amount) {
	return Number(amount.replace(/[^0-9.]+/g,""));
}

function removeflash(){
    
    var ab=document.getElementById('flash');
    ab.hidden = true;
    
}

