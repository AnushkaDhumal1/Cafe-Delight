const icon = document.querySelector('.icon');
var search = document.querySelector('.search');
search.onmouseenter = function(){
    search.classList.toggle('active')
} 
function reset(){
    document.getElementById('mysearch').value = '';
}
 	search.onmouseleave = function(){
     search.classList.toggle('reset');
}


var welcome;  
    var date = new Date();  
    var hour = date.getHours();  
    var minute = date.getMinutes();  
    var second = date.getSeconds();  
    if (minute < 10) {  
      minute = "0" + minute;  
    }  
    if (second < 10) {  
      second = "0" + second;  
    }  
    if (hour < 12) {  
      welcome = "good morning";  
    } else if (hour < 17) {  
      welcome = "good afternoon";  
    } else if (hour < 20){  
      welcome = "good evening";  
    } else  {  
      welcome = "good night";  
    } 
$(document).ready(function(){
	const body = document.querySelector('body');
	const toggled = document.getElementById('toggle');
toggled.onclick = function(){
		body.classList.toggle('light');
	toggled.classList.toggle('active')
}
	$('#dashboard').mouseenter(function(){
		this.innerHTML = `${welcome}`;
	});
	$('#dashboard').mouseleave(function(){
		this.innerHTML = "DASHBOARD";
	});
	$('#kleenpulse').mouseenter(function(){
		this.innerHTML = "Welcome";
	});
	$('#kleenpulse').mouseleave(function(){
		this.innerHTML = "Cafe Delight";
	});
});