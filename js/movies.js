
$(document).ready(function(){
    $("table").hide();
   
    $(".movies").click(function(){
        $("#datetime").show();
        $("#datetime").animate({width: "95%" }, "fast");
        $("#datetime").animate({width: "100%" }, "slow");
        $("#ticket").hide();
    });
    
    $("#datetime").on("click", "button.timebutton", function(){
        
        $("#ticket").show();
       $('html, body').animate({
        scrollTop: $("#ticket").offset().top
    }, 2000);
    });
    
});

function showtime(type) {
    
  resettable();
  var price = { 1:"a", 2:"a", 3: "b", 4:"b", 5:"b", 6: "b", 7: "b", 8: "a", 9: "a", 10: "b", 11: "b", 12:"b", 13: "b" , 14: "b", 15:"a", 16:"a", 17:"b", 18:"b", 19:"b", 20:"b", 21:"b", 27:"b", 28:"b" };
  var  ch = [ 1, 2, 6, 7, 10, 11, 12 ];
  var ar = [ 8, 9, 13, 14];
  var rc = [ 3, 4, 5, 15, 16, 20, 21 ];
  var ac = [ 17, 18, 19, 27, 28 ];
  var time =[];
  //a = [ 12, 10,  8, 25, 20, 20 ];
  //b = [ 18, 15, 12, 30, 25, 30 ];
  
  if(type == 1){
     time = ch;
  }
  else if(type == 2){
     time = ar;
  }
  else if(type == 3){
     time = rc;
  }
  else{
      time = ac;
  }
  
  
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
       
       table[x].cells[y-1].innerHTML ="<button class=\"timebutton\" onclick=\"selectmode("+price[time[i]]+");\">"+text +"</button>";
       
     //   table[x].cells[y-1].disabled = true;
       //console.log(table[x].cells[y-1].innerHTML);
      // table[x].cells[y-1].disabled = false;
    }

}


function resettable() {
    var datareset = [["1:00 pm", "1:00 pm", "1:00 pm", "1:00 pm", "1:00 pm", "12:00 pm", "12:00 pm"],["6:00 pm", "6:00 pm", "6:00 pm", "6:00 pm", "6:00 pm", "3:00 pm", "3:00 pm"],["9:00 pm", "9:00 pm", "9:00 pm", "9:00 pm", "9:00 pm", "6:00 pm", "6:00 pm"],["-NA-", "-NA-", "-NA-", "-NA-", "-NA-", "9:00 pm", "9:00 pm"]];
    var table = document.getElementById('datetime').rows;
    for( var i=1; i< table.length; i++){
        
        for( var j=1; j<= table[i].cells.length; j++){
            
       table[i].cells[j-1].innerHTML = datareset[i-1][j-1];
       
        }
    }
    
    
}


function selectmode(type) {
    
    console.log(type);
    

    
}