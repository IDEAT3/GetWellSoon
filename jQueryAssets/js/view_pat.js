var xmlhttp;

function loadXMLDoc(url,cfunc)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=cfunc;
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function get_patient_by_id() {
	var p_id=document.getElementById("pat_id").value;
	if(p_id == "") {return;};
//	alert("../lib/ajax_view_pat.php?id="+p_id);
	loadXMLDoc("../lib/ajax_view_pat.php?id="+p_id,function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var x=xmlhttp.responseText;
//			alert(x);
			var arr = x.split("!+!");
//			alert(arr[0]);
			if( arr[0] == 1) 
			{
//			alert("yes");
				$("#pat_name").val(arr[1]);
				$("#pat_dep").val(arr[2]);
				$(".hidden").show();
				$(".hidden_records").hide();
				if (arr[3]=="Female") {document.getElementById("sex").innerHTML="Female";} else {document.getElementById("sex").innerHTML="Male";}
				document.getElementById("age").innerHTML=arr[4];
				document.getElementById("Phone").innerHTML=arr[5];
				document.getElementById("DOB").innerHTML=arr[7];
				document.getElementById("addr").innerHTML=arr[8];

				$("#pat_dep").autocomplete('disable');	
			}
			else if( arr[0] == 2)
			{
				$("#pat_name").val(arr[1]);
				$("#pat_dep").val("");
				$(".hidden").show();
				$(".hidden_records").hide();
				if (arr[2]=="Female") {document.getElementById("sex").innerHTML="Female";} else {document.getElementById("sex").innerHTML="Male";}
				document.getElementById("age").innerHTML=arr[3];
				document.getElementById("Phone").innerHTML=arr[4];
				document.getElementById("DOB").innerHTML=arr[6];
				document.getElementById("addr").innerHTML=arr[7];

				var dependents = arr.slice(9);
				//alert(dependents);
				$('#pat_dep').autocomplete({
					source:dependents,
					minLength: 0,
					scroll:true
				}).focus(function() {
					$(this).autocomplete("search","");
				});
			}
			else 
			{
				alert("This patient id doesn't exist!! To add a new user goto Add Patient!!");
				$("#pat_name").val("");
				$("#pat_dep").val("");
				$(".hidden").show();
				$(".hidden_records").hide();
				$("#sex").val("");
				document.getElementById("age").innerHTML="";
				document.getElementById("Phone").innerHTML="";
				document.getElementById("DOB").innerHTML="";
				document.getElementById("addr").innerHTML="";
			}
		}
	});

}

function get_patient_by_name() {
	var name=$("#pat_name").val();
	if(name=="") {return;}
	//alert("ajax_pat_mod.php?name="+name);
	loadXMLDoc("../lib/ajax_view_pat.php?name="+name,function()
	{
		$("#pat_id").val("");
		$("#pat_dep").val("");
		$("age").val("");
		$("Phone").val("");
		$("DOB").val("");
		$("addr").val("");
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var x=xmlhttp.responseText;
			//alert(x);
			var out = x.split("@+@");
			var arr = out[0].split("!+!");
			var dependent = out[1].split("!+!");
			if( arr[0] == 1) 
			{
				$("#pat_id").val(arr[1]);
				$("#pat_dep").val(arr[2]);
				$(".hidden").show();
				$(".hidden_records").hide();
				if (arr[3]=="Female") {document.getElementById("sex").innerHTML="Female";} else {document.getElementById("sex").innerHTML="Male";}
				document.getElementById("age").innerHTML=arr[4];
				document.getElementById("Phone").innerHTML=arr[5];
				document.getElementById("DOB").innerHTML=arr[7];
				document.getElementById("addr").innerHTML=arr[8];
			}
			else if( arr[0] == 2){
				document.getElementsByName('pat_name')[0].setAttribute("value",arr[1]);
				var names = arr.slice(1);
				//alert(names);
				$('#pat_name').autocomplete({
					source:names,
					minLength: 0,
					scroll:true
				}).focus(function() {
					$(this).autocomplete("search","");
				});
				$dependent = $dependent.slice(1);
				$('#pat_dep').autocomplete({
					source:dependent,
					minLength: 0,
					scroll:true
				}).focus(function() {
					$(this).autocomplete("search","");
				});
			}
			else 
			{
				alert("This patient id doesn't exist!! To add a new user goto Add Patient!!");
				$("#pat_name").val("");
				$("#pat_dep").val("");
				$(".hidden").show();
				$(".hidden_records").hide();
				$("#sex").val("");
				document.getElementById("age").innerHTML="";
				document.getElementById("Phone").innerHTML="";
				document.getElementById("DOB").innerHTML="";
				document.getElementById("addr").innerHTML="";
			}
		}
	});
} 


function get_patient_by_dependent() 
{
	var dependent=$("#pat_dep").val();
	var pid=$("#pat_id").val();
//	if(dependent=="") {return;}
//	alert("../lib/ajax_pat_mod.php?dependent=" + dependent + "&pid=" + pid);
	loadXMLDoc("../lib/ajax_view_pat.php?dependent=" + dependent + "&pid=" + pid,function()
	{
		document.getElementById("age").innerHTML="";
		document.getElementById("Phone").innerHTML="";
		document.getElementById("DOB").innerHTML="";
		document.getElementById("addr").innerHTML="";
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var x=xmlhttp.responseText;
		//	alert(x + "11");
			var arr = x.split("!+!");
			if( arr[0] == 1) 
			{
				$(".hidden").show();
				$(".hidden_records").hide();
				if (arr[1]=="Female") {document.getElementById("sex").innerHTML="Female";} else {document.getElementById("sex").innerHTML="Male";}
				document.getElementById("age").innerHTML=arr[2];
				document.getElementById("Phone").innerHTML=arr[3];
				document.getElementById("DOB").innerHTML=arr[5];
				document.getElementById("addr").innerHTML=arr[6];
			}
			else 
			{
				alert("This dependent name  doesn't exist!! To add a new user goto Add Patient!!");
			}
		}
	});
} 
