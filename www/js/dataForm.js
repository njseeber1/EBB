function resetValues(what) 
{
  return false;
}

function hasNumbers(t)
{
	return /\d/.test(t);
}

function ltrim(s)
{
	var l=0;
	while(l < s.length && s[l] == ' ')
	{	l++; }
	return s.substring(l, s.length);
}

function verif_mail() 
{
	var id = document.enquiry.email.value;
	if(id == "")  
	{
	alert("Please enter valid email id (example@example.com). Click OK to re-enter");
	document.enquiry.email.select();
	return false;
	}
	  
	var apos=id.indexOf("@");
	var lpos=id.lastIndexOf("@");
	var dotpos=id.lastIndexOf(".");
	var id_len=id.length;
	//alert(dotpos);
	var dif=id_len-dotpos;
	//alert(dif);
	
	
	if(dif<3 || dif>5)
	{
	alert("Please enter valid email id (example@example.com). Click OK to re-enter");
	document.enquiry.email.select();
	return false;
	}
	
	if(apos!=lpos)
	{
	alert("Please enter valid email id (example@example.com). Click OK to re-enter");
	document.enquiry.email.select();
	return false;
	}
	
	if (apos<1||dotpos-apos<2) 
	{
		alert("Please enter valid email id (example@example.com). Click OK to re-enter");
		document.enquiry.email.select();
		return false;
	}
	  
	for(i=0;i<=dotpos;i++)
	{
		var str=id;
		var ch=str.substring(i,i+1);
		
		if(ch==' ' || ch==';' || ch==',' || ch=='!' || ch=='#' || ch=='$' || ch=='%' || ch=='^' || ch=='&' || ch=='*' )
		{
			alert("Please enter valid email id (example@example.com). Click OK to re-enter");
			document.enquiry.email.select();
			return false;
		}
	}
	var str=id.substring(dotpos+1,id_len);
	//alert(str);
	
		for (var i = 0; i < str.length; i++) 
		{
			var ch = str.substring(i, i + 1);
		//alert(ch)
			//if ( ((ch < "a" || "z" < ch) && (ch < "A" || "Z" < ch)) && (ch == '.')) 
			if(ch==1 || ch==2 || ch==3 || ch==4 || ch==5 || ch==6 || ch==7 || ch==8 || ch==9 || ch==0 || ch==';' || ch=='$' || ch=='@' || ch=='*' || ch=='^' || ch=='&' || ch=='%' ||ch=='#')
			//if((ch < "0" || "9" < ch))
			{
				alert("Please enter valid email id (example@example.com). Click OK to re-enter");
				document.enquiry.email.select();
				return false;
			}
		}
		return true;
	}
	
	
function checkfirstemptyspace(Field)
{
	var ivalue =" ";
	//	var ivalue ="*|,\":~&-=<>''![]{}`\';^_?()@$#+/.%\\";
	
	if (ivalue.indexOf(Field.substring(0,1)) != -1)
	{
		alert ("Empty space is not allowed in the begining of the Name. Click OK to re-enter.");
		return false;
	}
		
	return true;
}

function checkfirstspecials(Field)
{
	var isplvalue = "*|,\":~&-=<>''![]{}`\';^_?()@$#+/.%\\";
	if (isplvalue.indexOf(Field.substring(0,1)) != -1)
	{
		alert ("Special character not allowed in the begining of the Requirement. Click OK to re-enter.");
		return false;
	}
	return true;
}

function validateWebAddress(url) 
{
	var urlregex = new RegExp("^(http|https)\://([a-zA-Z0-9\.\-]+(\:[a-zA-Z0-9\.&amp;%\$\-]+)*@)*((25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])|([a-zA-Z0-9\-]+\.)*[a-zA-Z0-9\-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\?\'\\\+&amp;%\$#\=~_\-]+))*$");
	return urlregex.test(url);
}

function validateName(name)
{
	var flag = true;
	if (name == "") flag = false;
	if (flag && !checkfirstemptyspace(name)) flag = false;
	return flag;
}

function checkBrokerForm()
{	
	var name=ltrim(document.dataForm.brokerName.value);
	if(!validateName(name))
	{
		alert("Please enter name. Click OK to re-enter");
		document.dataForm.brokerName.focus();
		document.dataForm.brokerName.select();
		return false;
	}
 		
document.dataForm.submit();
}

function checkTestimonialForm()
{	
	var name=ltrim(document.dataForm.testimonial.value);
	if(!validateName(name))
	{
		alert("Please enter testimonial. Click OK to re-enter");
		document.dataForm.testimonial.focus();
		document.dataForm.testimonial.select();
		return false;
	}
	
	var author=ltrim(document.dataForm.author.value);
	if(!validateName(author))
	{
		alert("Please enter Author. Click OK to re-enter");
		document.dataForm.author.focus();
		document.dataForm.author.select();
		return false;
	}
	
 		
document.dataForm.submit();
}

function checkBannerForm()
{	
	var name=ltrim(document.dataForm.banner.value);
	if(!validateName(name))
	{
		alert("Please enter Banner Name. Click OK to re-enter");
		document.dataForm.banner.focus();
		document.dataForm.banner.select();
		return false;
	}
 		
document.dataForm.submit();
}

function checkListingForm()
{	
	if(document.dataForm.listingDate.value == ""){
		alert('Please enter Lising Date. Click OK to re-enter');
		document.dataForm.listingDate.focus();
		document.dataForm.listingDate.select();
		return false;
	}
	
	if(document.dataForm.status.value == "0"){
		alert('Please Select Status. Click OK to re-enter');
		var status = document.getElementById('status');
		status.focus();
		status.selectedIndex = 0;
		return false;
	}
	
	if(document.dataForm.priority.value == "0"){
		alert('Please Select Priority. Click OK to re-enter');
		var priority = document.getElementById('priority');
		priority.focus();
		priority.selectedIndex = 0;
		return false;
	}
	
	if(document.dataForm.remarks.value == ""){
		alert('Please enter remarks. Click OK to re-enter');
		document.dataForm.remarks.focus();
		document.dataForm.remarks.select();
		return false;
	}
	
	var title=ltrim(document.dataForm.title.value);
	if(!validateName(title))
	{
		alert("Please enter Listing Title. Click OK to re-enter");
		document.dataForm.title.focus();
		document.dataForm.title.select();
		return false;
	}
	
	if(document.dataForm.category.value == "0"){
		alert('Please Selecdt a Category. Click OK to re-enter');
		var category = document.getElementById('category');
		category.focus();
		category.selectedIndex = 0;
		return false;
	}
	
	if(document.dataForm.classification.value == "0"){
		alert('Please Select a Classification. Click OK to re-enter');
		var classification = document.getElementById('classification');
		classification.focus();
		classification.selectedIndex = 0;
		return false;
	}
	
	if(document.dataForm.location.value == ""){
		alert('Please enter location. Click OK to re-enter');
		document.dataForm.location.focus();
		document.dataForm.location.select();
		return false;
	}
	
	if(document.dataForm.city.value == ""){
		alert('Please enter city. Click OK to re-enter');
		document.dataForm.city.focus();
		document.dataForm.city.select();
		return false;
	}
	
	if(document.dataForm.area.value == ""){
		alert('Please enter Square Feet. Click OK to re-enter');
		document.dataForm.area.focus();
		document.dataForm.area.select();
		return false;
	}
	
	if(document.dataForm.rent.value == ""){
		alert('Please enter rent. Click OK to re-enter');
		document.dataForm.rent.focus();
		document.dataForm.rent.select();
		return false;
	}
	
	if(document.dataForm.listPrice.value == ""){
		alert('Please enter List Price. Click OK to re-enter');
		document.dataForm.listPrice.focus();
		document.dataForm.listPrice.select();
		return false;
	}
	
	if(document.dataForm.annualSales.value == ""){
		alert('Please enter Annual Sales. Click OK to re-enter');
		document.dataForm.annualSales.focus();
		document.dataForm.annualSales.select();
		return false;
	}
	
	if(document.dataForm.inventory.value == ""){
		alert('Please enter inventory. Click OK to re-enter');
		document.dataForm.inventory.focus();
		document.dataForm.inventory.select();
		return false;
	}
	if(document.dataForm.grossIncome.value == ""){
		alert('Please enter Gross Income. Click OK to re-enter');
		document.dataForm.grossIncome.focus();
		document.dataForm.grossIncome.select();
		return false;
	}
	if(document.dataForm.yearEstablished.value == ""){
		alert('Please enter Year Established. Click OK to re-enter');
		document.dataForm.yearEstablished.focus();
		document.dataForm.yearEstablished.select();
		return false;
	}
	if(document.dataForm.brokerId.value == "0"){
		alert('Please Select a Broker ID. Click OK to re-enter');
		var brokerId = document.getElementById('brokerId');
		brokerId.focus();
		brokerId.selectedIndex = 0;
		return false;
	}
 		
document.dataForm.submit();
}

function checkHomeLinkForm()
{	
	var name=ltrim(document.dataForm.linkName.value);
	if(!validateName(name))
	{
		alert("Please enter name. Click OK to re-enter");
		document.dataForm.linkName.focus();
		document.dataForm.linkName.select();
		return false;
	}
	
	if(document.dataForm.templateId.value == ""){
		alert('Please Select a Template. Click OK to re-enter');
		document.dataForm.templateId.focus();
		document.dataForm.templateId.select();
		return false;
	}
	
	if(document.dataForm.url.value != ''){
		if (!validateWebAddress(document.dataForm.url.value)) {
			alert('Please enter a valid url. Click OK to re-enter');
			document.dataForm.url.focus();
			document.dataForm.url.select();
			return false;
		}
	}
 		
document.dataForm.submit();
}

function checkPageForm()
{	
	var name=ltrim(document.dataForm.mainHeading.value);
	if(!validateName(name))
	{
		alert("Please enter Heading. Click OK to re-enter");
		document.dataForm.mainHeading.focus();
		document.dataForm.mainHeading.select();
		return false;
	}
 		
document.dataForm.submit();
}

function checkContentForm()
{	
	var name=ltrim(document.dataForm.sectionHeading.value);
	if(!validateName(name))
	{
		alert("Please enter Heading. Click OK to re-enter");
		document.dataForm.sectionHeading.focus();
		document.dataForm.sectionHeading.select();
		return false;
	}
 		
document.dataForm.submit();
}

function checkBlogForm(){	
	
	if(document.dataForm.blogDate.value == ""){
		alert('Please enter a Date. Click OK to re-enter');
		document.dataForm.blogDate.focus();
		document.dataForm.blogDate.select();
		return false;
	}
	
	var name = ltrim(document.dataForm.heading.value);
	if(!validateName(name))
	{
		alert("Please enter Heading. Click OK to re-enter");
		document.dataForm.heading.focus();
		document.dataForm.heading.select();
		return false;
	}
 		
document.dataForm.submit();
}

function checkResourceForm(){	

	var name = ltrim(document.dataForm.documentName.value);
	if(!validateName(name))
	{
		alert("Please enter Document Name. Click OK to re-enter");
		document.dataForm.documentName.focus();
		document.dataForm.documentName.select();
		return false;
	}
	if(document.dataForm.description.value == ""){
		alert('Please enter description. Click OK to re-enter');
		document.dataForm.description.focus();
		document.dataForm.description.select();
		return false;
	}
	
 		
document.dataForm.submit();
}