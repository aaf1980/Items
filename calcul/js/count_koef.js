function askServer()
{
  req = new XMLHttpRequest(); 

    if (req) {      
        var number1 = document.getElementById("score1").value;
        var number2 = document.getElementById("score2").value;
		var number3 = document.getElementById("score3").value;
        var number4 = document.getElementById("score4").value;
		var number5 = document.getElementById("score5").value;
        
	    var dataToSend = "score1=" + number1 + "&score2=" + number2 + "&score3=" + number3 + "&score4=" + number4 + "&score5=" + number5;
		req.open("POST", "config/count_ajax.php", true)
        //req.open("POST", 'count_ajax.php' + dataToSend, true); 
        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
        req.onreadystatechange = handleServerResponse; 
        req.send(dataToSend); 
    }
}
   
function handleServerResponse()
{
 var statusElem = document.getElementById('result')   
 if (req.readyState == 4) {	
	if (req.status == 200) {
		var a = req.responseText;
					
		statusElem.innerHTML = a;
	} else {
		alert("Не удалось получить данные:\n" +req.statusText);
	}   
 }
}