var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject() {

	var xmlHttp;

	if (window.ActiveXObject){
		try{
			xmlHttp = new ActiveXObject("Microsofot.XMLHTTP");
		} catch (e) {
			xmlHttp = false;
		}
	}else{
		try{
			xmlHttp = new XMLHttpRequest();
		} catch (e) {
			xmlHttp = false;
		}
	}

	if (!xmlHttp) {
		alert("Could not create XML Object");
	} else {
		return xmlHttp;
	}
}

function process(send_to) {
	new_message = document.getElementById("new_message").value ;
	
	document.getElementById("new_message").value="";
	
	var table = document.getElementById("message_table");
    var row = table.insertRow(2);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
	cell1.style.backgroundColor="pink";
    cell1.innerHTML = new_message;
    cell2.innerHTML = "";
	
	xmlHttp.open("GET","save_msg.php?message="+new_message+"&to="+send_to+"&subject=&read_status="+0,true);
	xmlHttp.send();
}