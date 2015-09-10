var price = { 1:1, 2:1, 3:2, 4:2, 5:2, 6:2, 7:2, 8:1, 9:1, 10:2, 11:2, 12:2, 13:2 , 14:2, 15:1, 16:1, 17:2, 18:2, 19:2, 20:2, 21:2, 27:2, 28:2 };
var  data = [[ 1, 2, 6, 7, 10, 11, 12 ],[ 8, 9, 13, 14],[ 3, 4, 5, 15, 16, 20, 21 ],[ 17, 18, 19, 27, 28 ]];
var rate = [[ 12, 10,  8, 25, 20, 20, 20, 20],[ 18, 15, 12, 30, 25, 30, 30, 30]];
var seats = [["SA",1], ["SP",1], ["SC",1], ["FA",2], ["FC",2], ["B1",3], ["B2",3], ["B3",3]];
var ticketcheck = [["A1","A2","A3","A4","A5","A6","A7","A8","A9","A10","A11","A12"],["B1","B2","B3","B4","B5","B11","B12","B13","B14","B15","B21","B22","B23","B24","B25","B31","B32","B33","B34","B35","B6","B7","B8","B9","B10","B16","B17","B18","B19","B20","B26","B27","B28","B29","B30","B36","B37","B38","B39","B40"],["C1","C2","C3","C4","C5","C6","C7","C8","C9","C10","C11","C12"]];
var hidelist = {"SA":ticketcheck[1],"SP":ticketcheck[1],"SC":ticketcheck[1],"FA":ticketcheck[0],"FC":ticketcheck[0],"B1":ticketcheck[2],"B2":ticketcheck[2],"B3":ticketcheck[2]};
var movies = ["CH", "AF", "RC", "AC"];
var day = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
var datareset = [["1:00 pm", "1:00 pm", "1:00 pm", "1:00 pm", "1:00 pm", "12:00 pm", "12:00 pm"],["6:00 pm", "6:00 pm", "6:00 pm", "6:00 pm", "6:00 pm", "3:00 pm", "3:00 pm"],["9:00 pm", "9:00 pm", "9:00 pm", "9:00 pm", "9:00 pm", "6:00 pm", "6:00 pm"],["-NA-", "-NA-", "-NA-", "-NA-", "-NA-", "9:00 pm", "9:00 pm"]];

// JQuerry Starts Here  
$(document).ready(function(){
    $("table").hide();
    
    showtime(getCookie("movie"));
    loadtheatre();
    updateprice();
    resettheatre();
    
    $(".movies").click(function(){
        $(".movies").removeClass("enabled");
        $(this).addClass("enabled");
        
        $("#datetime").show();
        $("#datetime").animate({width: "95%" }, "fast");
        $("#datetime").animate({width: "100%" }, "slow");
        $("#ticket").hide();
    });
    
    $("#datetime").on("click", "button.timebutton", function(){
        $("#ticket").show();
       $('html, body').animate({
        scrollTop: $("#ticket").offset().top
    }, 1000);
    });
    
    $("#list .movies").click(function(){
       $('html, body').animate({
        scrollTop: $("#datetime").offset().top
    }, 500);
    });
    
    $("#theatre button").click(function(){
        $(this).toggleClass("enabled");
    });
    $( "#theatre button" ).bind( "click",
        function(){
            toggletheatre(loadid(this));
    });
    
});
// JQuerry ends here 

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

// Adding Single Cookies Here
/* ********************************************************** */
function checkCookie() {
    var movie=getCookie("movie");
    if (movie == 1 || movie ==2 || movie == 3 || movie==4) {
        showtime(movie);
        $("table").show();
        $("#ticket").hide();
        var pprice = getCookie("price");
        if( pprice == 1 || pprice ==2){
            $("#ticket").show();
            $('html, body').animate({
                scrollTop: $("#ticket").offset().top
            }, 2000);
        }
    }
    else{
        document.cookie = "";
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
    
    updateprice();
}
/* ********************************************************** */
// Single Cookies End here



function loadid(element) {

    var dataid = element.id;
    return dataid;

}

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

function resettheatre(){
    for(var i=0; i< ticketcheck.length;i++){
        
        for(var j=0; j< ticketcheck[i].length;j++){
            
            document.getElementById(ticketcheck[i][j]).disabled = true;
        }
    }
}

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

function updateprice(){
    var total = 0.00;
    var table = document.getElementById('ticket').rows;
   
    if(getCookie("price") != null){
    for( var i=1; i< (table.length-1); i++){
        
        var seattype = new cookieList(seats[i-1][0]);
        console.log(seattype.items().length);
        var val = seattype.items().length * rate[getCookie("price") -1][i-1];
        total = total + val;
            
       table[i].cells[2].innerHTML = "<input type=\"hidden\" name=\""+seats[i-1][0]+"\" value="+ seattype.items().length +"> AUD $" + val;
    }
   var moviename = movies[ (getCookie('movie').trim(';')[0] - 1)];
    var dayname = getday(getCookie('time'));
    table[9].cells[1].innerHTML = "<input type=\"hidden\" name=\"price\" value=\"" + parseFloat(total).toFixed(2) + "\"><input type=\"hidden\" name=\"movie\" value=\""+ moviename +"\"><input type=\"hidden\" name=\"day\" value=\""+ dayname +"\"><input type=\"hidden\" name=\"time\" value=\""+ gettime(getCookie('time')) + "\"> AUD $"+ total;
    }}

function getday(number){
    number = number.trim(';');
    number = number[0];
    var flag=1;
    for (var i=0;i< 7;i++){
        
        for(var j=0; j < 7; j++){
            if(flag==number){
                return day[j];
            }
            flag++;
        }
        
    }
}

function gettime(number){
    number = number.trim(';');
    number = number[0];
    var flag=1;
    for (var i=0;i< datareset.length;i++){
        
        for(var j=0; j< datareset[i].length; j++){
            if(flag==number){
                return datareset[i][j];
            }
            flag++;
        }
        
    }
}

function showdescription(type){
    for(i=1;i<=4;i++){
        document.getElementById(i).hidden = true;
    }
    document.getElementById(type).hidden = false;
}


function showtime(type) {
    
    if(type!=1 || type != 2 || type !=3 || type!=4){
        type=1;
    }
  updateprice();
  showdescription(type);
  
    var selector = document.getElementsByClassName('movies');
    selector[type-1].classList.add("enabled");
  
  var time =[];
  
  if(type == 1){
     time = data[0];
  }
  else if(type == 2){
     time = data[1];
  }
  else if(type == 3){
     time = data[2];
  }
  else{
      time = data[3];
  }
  
  setCookie("movie", type , 1);

    // console.log(time); 
    var table = document.getElementById('datetime').rows;
    for( var i=0; i< time.length; i++){
        
       var x= parseInt(time[i] / 7) + 1;
       var y= time[i] % 7 ;
       if(y == 0){
           y = ( (time[i]-1) % 7) + 1;
           x -=1;
       } 
       var text = table[x].cells[y-1].innerHTML;
       
       table[x].cells[y-1].innerHTML ="<button class=\"timebutton\" onclick=\"selectmode("+time[i]+");\">"+text +"</button>";
       
    }

}


function resettable() {
    var table = document.getElementById('datetime').rows;
    for( var i=1; i< table.length; i++){
        
        for( var j=1; j<= table[i].cells.length; j++){
            
       table[i].cells[j-1].innerHTML = datareset[i-1][j-1];
       
        }
    }
    

    
    
}

function resetseats(){
    
    for(var i=0; i < ticketcheck.length ; i++){
        for(var j=0; j< ticketcheck[i].length ; j++){
            document.getElementById(ticketcheck[i][j]).classList.remove("enabled");
        }
    }
    
    for(var i=0; i< seats.length ; i++){
        deleteCookie(seats[i][0]);
    }
}


function selectmode(type) {
    
    //console.log(type);
    setCookie("time", type , 1);
    setCookie("price", price[type],1);
    resetseats();
    updateprice();
}