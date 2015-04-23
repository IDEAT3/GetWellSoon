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
	var p_id=document.getElementById("Patient_Id").value;
	if(p_id == "") {return;};
//	alert("ajax_pat_mod.php?q="+p_id);
	loadXMLDoc("../lib/ajax_pat_mod.php?id="+p_id,function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var x=xmlhttp.responseText;
			//alert(x);
			var arr = x.split("!+!");
			if( arr[0] == "1") {
				$("#Name").val(arr[1]);
				$("#Dependent").val(arr[2]);
				if(arr[3]=="Female") {$( "#F" ).prop("checked", true);} else {$( "#M" ).prop("checked", true);}
				$("input:text[name=Age]").val(arr[4]);
				$("input:text[name=Ph_No]").val(arr[5]);
				$("input:text[name=AltPh_No]").val(arr[6]);
				$("input:text[name=DOB]").val(arr[7]);
			//	alert(arr[1]);
				$("textarea[name=Permanent_Address]").val(arr[8]);
				$("textarea[name=Local_Address]").val(arr[9]);
				$("#Dependent").autocomplete('disable');	
			}
			else if( arr[0] == "2"){
				$("#Name").val(arr[1]);
				$("#Dependent").val("");
				if(arr[2]=="Female") {$( "#F" ).prop("checked", true);} else {$( "#M" ).prop("checked", true);}
				$("input:text[name=Age]").val(arr[3]);
				$("input:text[name=Ph_No]").val(arr[4]);
				$("input:text[name=AltPh_No]").val(arr[5]);
				$("input:text[name=DOB]").val(arr[6]);
				$("textarea[name=Permanent_Address]").val(arr[7]);
				$("textarea[name=Local_Address]").val(arr[8]);
				var dependents = arr.slice(9);
				//alert(dependents);
				$('#Dependent').autocomplete({
					source:dependents,
					minLength: 0,
					scroll:true
				}).focus(function() {
					$(this).autocomplete("search","");
				});
			}
			else {
				alert("This patient id doesn't exist!! To add a new user goto Add Patient!!");
				$("#Name").val("");
				$("#Dependent").val("");
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
	var name=$("#Name").val();
	if(name=="") {return;}
	//alert("ajax_pat_mod.php?name="+name);
	loadXMLDoc("../lib/ajax_pat_mod.php?name="+name,function()
	{
		$("#Patient_Id").val("");
		$("#Dependent").val("");
		$("input:text[name=Age]").val("");
		$("input:text[name=Ph_No]").val("");
		$("input:text[name=AltPh_No]").val("");
		$("input:text[name=DOB]").val("");
		$("textarea[name=Permanent_Address]").val("");
		$("textarea[name=Local_Address]").val("");
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var x=xmlhttp.responseText;
		//	alert(x);
			var out = x.split("@+@");
		//	alert(out[0] + " " +out[1]);
			var arr = out[0].split("!+!");
			var dependent = out[1].split("!+!");
			if( arr[0] == "1") {
				$("#Patient_Id").val(arr[1]);
				$("#Dependent").val(arr[2]);
				if(arr[3]=="Female") {$( "input:radio[id=F]:checked" ).val(true);} else {$( "input:radio[id=M]:checked" ).val(true);}
				$("input:text[name=Age]").val(arr[4]);
				$("input:text[name=Ph_No]").val(arr[5]);
				$("input:text[name=AltPh_No]").val(arr[6]);
				$("input:text[name=DOB]").val(arr[7]);
			//	alert(arr[1]);
				$("textarea[name=Permanent_Address]").val(arr[8]);
				$("textarea[name=Local_Address]").val(arr[9]);
			}
			else if( arr[0] == "2"){
				document.getElementsByName('Name')[0].setAttribute("value",arr[1]);
				var names = arr.slice(1);
		//		alert(names);
				$('#Name').autocomplete({
					source:names,
					minLength: 0,
					scroll:true
				}).focus(function() {
					$(this).autocomplete("search","");
				});
				$dependent = $dependent.slice(1);
				$('#Dependent').autocomplete({
					source:dependent,
					minLength: 0,
					scroll:true
				}).focus(function() {
					$(this).autocomplete("search","");
				});
			}
			else {
				alert("This patient name doesn't exist!! To add a new user goto Add Patient!!");
				$("#Patient_Id").val("");
				$("#Dependent").val("");
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

function get_patient_by_dependent() {
	var dependent=$("#Dependent").val();
	var pid=$("#Patient_Id").val();
//	if(dependent=="") {return;}
	alert("../lib/ajax_pat_mod.php?dependent=" + dependent + "&pid=" + pid);
	loadXMLDoc("../lib/ajax_pat_mod.php?dependent=" + dependent + "&pid=" + pid,function()
	{
		$("input:text[name=Age]").val("");
		$("input:text[name=Ph_No]").val("");
		$("input:text[name=AltPh_No]").val("");
		$("input:text[name=DOB]").val("");
		$("textarea[name=Permanent_Address]").val("");
		$("textarea[name=Local_Address]").val("");
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var x=xmlhttp.responseText;
			alert(x + "11");
			var arr = x.split("!+!");
			if( arr[0] == "1") {
				if(arr[1]=="Female") {$( "input:radio[id=F]:checked" ).val(true);} else {$( "input:radio[id=M]:checked" ).val(true);}
				$("input:text[name=Age]").val(arr[2]);
				$("input:text[name=Ph_No]").val(arr[3]);
				$("input:text[name=AltPh_No]").val(arr[4]);
				$("input:text[name=DOB]").val(arr[5]);
			//	alert(arr[1]);
				$("textarea[name=Permanent_Address]").val(arr[6]);
				$("textarea[name=Local_Address]").val(arr[7]);
			}
			else {
				alert("This dependent name  doesn't exist!! To add a new user goto Add Patient!!");
			}
		}
	});
} 