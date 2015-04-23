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
	//alert("ajax_pat_mod.php?q="+p_id);
	loadXMLDoc("../lib/ajax_view_pat.php?id="+p_id,function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var x=xmlhttp.responseText;
			//alert(x);
			var arr = x.split("!+!");
			if( arr[0] == "1") 
			{
				$("#pat_name").val(arr[1]);
				$("#pat_dep").val(arr[2]);
				$(".hidden").show();
				$(".hidden_records").hide();
				if(arr[3]=="Female") {document.getElementById("sex").innerHTML="Female";} else {document.getElementById("sex").innerHTML="Male";}
				document.getElementById("age").innerHTML=arr[4];
				document.getElementById("Phone").innerHTML=arr[5];
				document.getElementById("DOB").innerHTML=arr[7];
				document.getElementById("addr").innerHTML=arr[8];

				$("#pat_dep").autocomplete('disable');	
			}
			else if( arr[0] == "2")
			{
				$("#pat_name").val(arr[1]);
				$("#pat_dep").val("");
				if(arr[2]=="Female") {$( "#F" ).prop("checked", true);} else {$( "#M" ).prop("checked", true);}
				$("input:text[name=Age]").val(arr[3]);
				$("input:text[name=Ph_No]").val(arr[4]);
				$("input:text[name=AltPh_No]").val(arr[5]);
				$("input:text[name=DOB]").val(arr[6]);
				$("textarea[name=Permanent_Address]").val(arr[7]);
				$("textarea[name=Local_Address]").val(arr[8]);
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
				$( "input:radio[id=M]:checked" ).val(true);
				$("input:text[name=Age]").val("");
				$("input:text[name=Ph_No]").val("");
				$("input:text[name=AltPh_No]").val("");
				$("input:text[name=DOB]").val("");
				$("textarea[name=Permanent_Address]").val("");
				$("textarea[name=Local_Address]").val("");
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
			var arr = x.split("!+!");
			if( arr[0] == "1") 
			{
				$("#pat_id").val(arr[1]);
				$("#pat_dep").val(arr[2]);
				$(".hidden").show();
				$(".hidden_records").hide();
				if(arr[3]=="Female") {document.getElementById("sex").innerHTML="Female";} else {document.getElementById("sex").innerHTML="Male";}
				document.getElementById("age").innerHTML=arr[4];
				document.getElementById("Phone").innerHTML=arr[5];
				document.getElementById("DOB").innerHTML=arr[7];
				document.getElementById("addr").innerHTML=arr[8];

				$("#pat_dep").autocomplete('disable');
			}
			else if( arr[0] == "2"){
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
			}
			else {
				alert("This patient name doesn't exist!! To add a new user goto Add Patient!!");
				$("#pat_name").val("");
				$("#pat_dep").val("");
				$("input:text[name=Age]").val("");
				$("input:text[name=Ph_No]").val("");
				$("input:text[name=AltPh_No]").val("");
				$("input:text[name=DOB]").val("");
				$("textarea[name=Permanent_Address]").val("");
				$("textarea[name=Local_Address]").val("");
			}
		}
	});
} 

