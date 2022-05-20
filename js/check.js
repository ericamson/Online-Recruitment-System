function check(form)
{
if(form.dd.value=='00' || form.mm.value=='00' || form.yyyy.value=='00')
{
alert("Please select a valid date.")
return false;
}
else if(form.mm.value=='02')
{
if((form.yyyy.value)%4==0)
{
if(form.dd.value>29)
{
alert("Please select a valid date.")
return false;
}
}
else
{
if(form.dd.value>28)
{
alert("Please select a valid date.")
return false;
}
}
}
else if(form.mm.value=='04' || form.mm.value=='04' || form.mm.value=='09' || form.mm.value=='11')
{
if(form.dd.value>30)
{
alert("Please select a valid date.")
return false;
}
}
if(form.qual.value=='00')
{
alert("Please select your highest qualification.")
return false;
}
pass = form.pass.value;
cnfpass = form.cnfpass.value;
if (pass != cnfpass)
{
alert ("Password did not match")
return false;
}
else
return true;
}


function isNumberKey(evt){
var charCode = (evt.which) ? evt.which : evt.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
{
alert ("Only numerical value accepted.")
return false;
}
return true;
}