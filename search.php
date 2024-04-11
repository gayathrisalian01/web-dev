<html> 
<head> 
<script> 
function showUser(str) { 
    if (str == "") { 
        document.getElementById("txtHint").innerHTML = ""; 
        return; 
    } else {  
        if (window.XMLHttpRequest) { 
            // code for IE7+, Firefox, Chrome, Opera, Safari 
            xmlhttp = new XMLHttpRequest(); 
        } else { 
            // code for IE6, IE5 
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); 
        } 
        xmlhttp.onreadystatechange = function() { 
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) { 
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText; 
            } 
        }; 
        xmlhttp.open("GET","getuser.php?q="+str,true); 
        xmlhttp.send(); 
    } 
} 
</script> 
</head> 
<body> 
 
<form> 
<img src="2.jpg" width=500px height=900px /> 
<select name="users" onchange="showUser(this.value)"> 
  <option value="">Select a person:</option> 
  <option value="1">Record 1</option> 
  <option value="2">Record 2</option> 
  <option value="3">Record 3</option> 
 
  </select> 
</form> 
<br> 
<div id="txtHint"><b>Person information...</b></div> 
</body> 
</html> 
