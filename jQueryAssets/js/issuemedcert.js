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
	var p_id=$("input:text[name=RollNo]").val();
	if(p_id == "") {return;};
//	alert("ajax_pat_mod.php?q="+p_id);
	loadXMLDoc("../lib/ajax_pat_mod.php?id="+p_id,function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var x=xmlhttp.responseText;
//			alert(x);
			var arr = x.split("!+!");
			if( arr[0] == 1) {
				$("input:text[name=Name]").val(arr[1]);
				$("input:text[name=Dependent]").val(arr[2]);
				$("input:text[name=Dependent]").autocomplete('disable');	
			}
			else if( arr[0] == 2){
				$("input:text[name=Name]").val(arr[1]);
				$("input:text[name=Dependent]").val("");
				var dependents = arr.slice(9);
				//alert(dependents);
				$("input:text[name=Dependent]").autocomplete({
					source:dependents,
					minLength: 0,
					scroll:true
				}).focus(function() {
					$(this).autocomplete("search","");
				});
			}
			else if( arr[0] == 3){
				$("input:text[name=Name]").val(arr[1]);
				$("input:text[name=Dependent]").val("");
				var dependents = arr.slice(2);
				//alert(dependents);
				$("input:text[name=Dependent]").autocomplete({
					source:dependents,
					minLength: 0,
					scroll:true
				}).focus(function() {
					$(this).autocomplete("search","");
				});
			}
			else {
				alert("This patient id doesn't exist!! To add a new user goto Add Patient!!");
				$("input:text[name=Name]").val("");
				$("input:text[name=Dependent]").val("");
			}
		}
	});
}

function get_patient_by_name() {
	var name=$("input:text[name=Name]").val();
	if(name=="") {return;}
	//alert("ajax_pat_mod.php?name="+name);
	loadXMLDoc("../lib/ajax_pat_mod.php?name="+name,function()
	{
		$("input:text[name=RollNo]").val("");
		$("input:text[name=Dependent]").val("");
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var x=xmlhttp.responseText;
		//	alert(x);
			var out = x.split("@+@");
		//	alert(out[0] + " " +out[1]);
			var arr = out[0].split("!+!");
			var dependent = out[1].split("!+!");
			if( arr[0] == "1") {
				$("input:text[name=RollNo]").val(arr[1]);
				$("input:text[name=Dependent]").val(arr[2]);
			}
			else if( arr[0] == "2"){
				document.getElementsByName('Name')[0].setAttribute("value",arr[1]);
				var names = arr.slice(1);
				alert(names);
				var i;
				var ind=0;
				var name=names[0];
				for(i=1;i<names.length;i++) {
					if(names[i]!=name) {
						var j;
						for(j=ind+1;j<i;j++) {
							names.splice(index, j);
						}
						ind=i;
						name=names[i];
					}
				}
				if(names[i]!=name) {
					var j;
					for(j=ind+1;j<i;j++) {
						names.splice(index, j);
					}
				}
				
				alert(names);
				$("input:text[name=Name]").autocomplete({
					source:names,
					minLength: 0,
					scroll:true
				}).focus(function() {
					$(this).autocomplete("search","");
				});
				$dependent = $dependent.slice(1);
				$("input:text[name=Dependent]").autocomplete({
					source:dependent,
					minLength: 0,
					scroll:true
				}).focus(function() {
					$(this).autocomplete("search","");
				});
			}
			else {
				alert("This patient name doesn't exist!! To add a new user goto Add Patient!!");
				$("input:text[name=RollNo]").val("");
				$("input:text[name=Dependent]").val("");
			}
		}
	});
} 

function get_patient_by_dependent() {
	var dependent=$("input:text[name=Dependent]").val();
	var pid=$("input:text[name=RollNo]").val();
//	if(dependent=="") {return;}
//	alert("../lib/ajax_pat_mod.php?dependent=" + dependent + "&pid=" + pid);
	loadXMLDoc("../lib/ajax_pat_mod.php?dependent=" + dependent + "&pid=" + pid,function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var x=xmlhttp.responseText;
		//	alert(x + "11");
			var arr = x.split("!+!");
			if( arr[0] == "1") {
			}
			else {
				alert("This dependent name  doesn't exist!! To add a new user goto Add Patient!!");
			}
		}
	});
} 
