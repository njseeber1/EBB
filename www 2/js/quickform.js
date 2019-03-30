function resetValues(what) {
  document.enquiry.name.value = "Name";
  document.enquiry.phone.value = "Phone Number";
  document.enquiry.email.value = "E-Mail";
  document.enquiry.requirement.value = "Requirement";
  return false;
}
function hasNumbers(t) {
  return /\d/.test(t);
}

function ltrim(s) {
  var l = 0;
  while (l < s.length && s[l] == " ") {
    l++;
  }
  return s.substring(l, s.length);
}

function verif_mail() {
  var id = document.enquiry.email.value;
  if (id == "") {
    alert(
      "Please enter valid email id (example@example.com). Click OK to re-enter"
    );
    document.enquiry.email.select();
    return false;
  }

  var apos = id.indexOf("@");
  var lpos = id.lastIndexOf("@");
  var dotpos = id.lastIndexOf(".");
  var id_len = id.length;
  //alert(dotpos);
  var dif = id_len - dotpos;
  //alert(dif);

  if (dif < 3 || dif > 5) {
    alert(
      "Please enter valid email id (example@example.com). Click OK to re-enter"
    );
    document.enquiry.email.select();
    return false;
  }

  if (apos != lpos) {
    alert(
      "Please enter valid email id (example@example.com). Click OK to re-enter"
    );
    document.enquiry.email.select();
    return false;
  }

  if (apos < 1 || dotpos - apos < 2) {
    alert(
      "Please enter valid email id (example@example.com). Click OK to re-enter"
    );
    document.enquiry.email.select();
    return false;
  }

  for (i = 0; i <= dotpos; i++) {
    var str = id;
    var ch = str.substring(i, i + 1);

    if (
      ch == " " ||
      ch == ";" ||
      ch == "," ||
      ch == "!" ||
      ch == "#" ||
      ch == "$" ||
      ch == "%" ||
      ch == "^" ||
      ch == "&" ||
      ch == "*"
    ) {
      alert(
        "Please enter valid email id (example@example.com). Click OK to re-enter"
      );
      document.enquiry.email.select();
      return false;
    }
  }
  var str = id.substring(dotpos + 1, id_len);
  //alert(str);

  for (var i = 0; i < str.length; i++) {
    var ch = str.substring(i, i + 1);
    //alert(ch)
    //if ( ((ch < "a" || "z" < ch) && (ch < "A" || "Z" < ch)) && (ch == '.'))
    if (
      ch == 1 ||
      ch == 2 ||
      ch == 3 ||
      ch == 4 ||
      ch == 5 ||
      ch == 6 ||
      ch == 7 ||
      ch == 8 ||
      ch == 9 ||
      ch == 0 ||
      ch == ";" ||
      ch == "$" ||
      ch == "@" ||
      ch == "*" ||
      ch == "^" ||
      ch == "&" ||
      ch == "%" ||
      ch == "#"
    ) {
      //if((ch < "0" || "9" < ch))
      alert(
        "Please enter valid email id (example@example.com). Click OK to re-enter"
      );
      document.enquiry.email.select();
      return false;
    }
  }
  return true;
}

function checkfirstemptyspace(Field) {
  var ivalue = " ";
  //	var ivalue ="*|,\":~&-=<>''![]{}`\';^_?()@$#+/.%\\";

  if (ivalue.indexOf(Field.substring(0, 1)) != -1) {
    alert(
      "Empty space is not allowed in the begining of the Name. Click OK to re-enter."
    );
    return false;
  }

  return true;
}

function checkfirstspecials(Field) {
  var isplvalue = "*|,\":~&-=<>''![]{}`';^_?()@$#+/.%\\";
  if (isplvalue.indexOf(Field.substring(0, 1)) != -1) {
    alert(
      "Special character not allowed in the begining of the Requirement. Click OK to re-enter."
    );
    return false;
  }
  return true;
}

function checkform() {
  debugger;
  var checknum = /^([0-9]+)$/;
  var checkchar = /^([a-zA-Z ]+)$/;
  var checksp = /^([a-zA-Z0-9.+():,-\/ ]+)$/;
  var emailadd = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  var invalid = " ";
  var name = ltrim(document.enquiry.name.value);

  if (name == "Name") {
    alert("Please enter your name. Click OK to re-enter");
    document.enquiry.name.focus();
    document.enquiry.name.select();
    return false;
  }
  if (document.enquiry.name.value == 0) {
    alert("Please enter valid name. Click OK to re-enter");
    document.enquiry.name.focus();
    document.enquiry.name.select();
    return false;
  }
  if (!checkfirstemptyspace(name)) {
    document.enquiry.name.focus();
    document.enquiry.name.select();
    return false;
  }
  var iChars = '|*&"';

  for (var i = 0; i < document.enquiry.name.value.length; i++) {
    if (iChars.indexOf(document.enquiry.name.value.charAt(i)) != -1) {
      alert(
        "Special characters are not allowed in the name field.Click OK to re-enter "
      );
      document.enquiry.name.focus();
      document.enquiry.name.select();
      return false;
    }
  }

  if (hasNumbers(name)) {
    alert("Please enter a valid name. Click OK to re-enter");
    document.enquiry.name.focus();
    document.enquiry.name.select();
    return false;
  }

  if (
    document.enquiry.email.value == "" ||
    document.enquiry.email.value == "E-Mail"
  ) {
    alert("Please enter your email id. Click OK to re-enter.");

    document.enquiry.email.focus();

    return false;
  }

  if (document.enquiry.email.value == 0) {
    alert(
      "Please enter valid email id (example@example.com). Click OK to re-enter"
    );
    document.enquiry.email.focus();
    document.enquiry.email.select();
    return false;
  }

  var email = document.enquiry.email.value;
  // var filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/;
  var filter = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
  if (!filter.test(email)) {
    alert(
      "Please enter valid email id (example@example.com). Click OK to re-enter"
    );
    document.enquiry.email.focus();
    document.enquiry.email.select();
    return false;
  }
  /*	if (document.enquiry.requirement.value == "Requirement") 
		{
		alert("Please enter your requirements. Click OK to re-enter.");
		document.enquiry.requirement.focus();
		document.enquiry.requirement.select();
		return false;
		}
	if (document.enquiry.requirement.value == 0) 
		{
		alert("Please enter valid requirements. Click OK to re-enter.");
		document.enquiry.requirement.focus();
		document.enquiry.requirement.select();
		return false;
		} */

  // document.enquiry.mode.value = "submit";
  return true;
  //alert("We value the interest you have taken in our services. We will attend to your query at the earliest and get back to you soon.");
  //document.enquiry.submit();
}
