function loadAll()
{
	if (window.XMLHttpRequest)
	{
		var xmlhttp = new XMLHttpRequest();
	}
	else
	{
		var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("IAmData").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","index.background.php?cmd=all",true);
	xmlhttp.send();
}

function KeywordQuery()
{
	var key = document.getElementById("keyword").value;
	
	if(window.XMLHttpRequest){
		var xmlhttp = new XMLHttpRequest();
	}
	else{
		var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("IAmData").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","index.background.php?cmd=query&key=" + key);
	xmlhttp.send();
}