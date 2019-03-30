<?php
//error_reporting(E_ALL);
/* ***************************************************** */
/*       Multiple Calculator MOD FOR OPEN REALTY         */
/*                   VERSION 200903                      */
/*              RealtyOne www.outbackweb.net             */
/* ***************************************************** */
include("../../include/common.php");
global $action, $lang, $config;
include("$config[template_path]/user_top.html");
?> 
<SCRIPT language=javascript>
<!-- Begin script...
function PopUpPrint () {
	var input_string = "";
	if (CalQualAmt()) {
		input_string = "loanqualifier_calc_displaycertificate_frame.asp";
		input_string = input_string + "?IncOne=" + document.qualify.IncOne.value;
		input_string = input_string + "&IncTwo=" + document.qualify.IncTwo.value;
		input_string = input_string + "&OthInc=" + document.qualify.OthInc.value;
		input_string = input_string + "&RentInc=" + document.qualify.RentInc.value;
		input_string = input_string + "&income1=" + document.qualify.income1.options[document.qualify.income1.selectedIndex].text;
		input_string = input_string + "&income2=" + document.qualify.income2.options[document.qualify.income2.selectedIndex].text;
		input_string = input_string + "&incomeother=" + document.qualify.incomeother.options[document.qualify.incomeother.selectedIndex].text;
		input_string = input_string + "&incomerental=" + document.qualify.incomerental.options[document.qualify.incomerental.selectedIndex].text;
		input_string = input_string + "&Applicants=" + returnRadioValue(document.qualify.Applicants);
		input_string = input_string + "&HomeLoan=" + document.qualify.HomeLoan.value;
		input_string = input_string + "&OthLoan=" + document.qualify.OthLoan.value;
		input_string = input_string + "&CardLim=" + document.qualify.CardLim.value;
		input_string = input_string + "&NumbDep=" + document.qualify.NumbDep.value;
		input_string = input_string + "&IntRate=" + document.qualify.IntRate.value;
		input_string = input_string + "&TermYear=" + document.qualify.TermYear.value;
		input_string = input_string + "&TermMonth=" + document.qualify.TermMonth.value;
		input_string = input_string + "&LoanAmt=" + document.qualify.LoanAmt.value;
		input_string = input_string + "&loanType=" + returnRadioValue(document.qualify.loanType);
		
		window.open(input_string,'certificate','width=640,height=600,scrollbars=yes,resizable=yes,screenX=0,screenY=0,left=0,top=0');
	}
}


function returnRadioValue(sFieldName) {
	var cFields = sFieldName;

	for (x = 0; x < cFields.length; x++) {
		if (cFields[x].checked) {
			return cFields[x].value;
			break;
		}
	}

	return null;
}


function checkEnter(pfield, pname) {
    var field = pfield.value
    var msg
    var status = true

    if (field.length == 0) {
        msg = "The '" + pname + "' field must be entered."
        alert(msg)
        status = false
    }

    return status
}

function checkNumberofApplicants(pfield, pname) {
    var field = returnRadioValue(pfield)
    var msg
    var status = true

    if ((field == 2) && (document.qualify.IncTwo.value.length==0)) {
        msg = "You have entered Joint for the No. of Applicants. The Income 2 field must be entered."
        alert(msg)
        status = false
    }

    if ((field == 1) && (ParseDollar(document.qualify.IncTwo.value)>0)) {
        msg = "You have entered Single for the No. of Applicants. The Income 2 field cannot be entered."
        alert(msg)
        status = false
    }

    return status
}


function checkLoanType(pfield) {
    var field = returnRadioValue(pfield)
    var msg
    var status = true

    if (field == "Home") {
		document.qualify.IntRate.value = "8.16"
		ACF=10 // Account Keeping Fee
		fixedInterestRate = false    //sets the intrest rate text box to a free form box
        status = false
    }

    if (field == "Personal") {
        document.qualify.IntRate.value = "12.95"
		ACF=0 // Account Keeping Fee
		fixedInterestRate = false  //sets the intrest rate text box to a free form box
        status = false
    }

    return status
}


function checkIfFixInterestRateApplies() {
	if (fixedInterestRate == true) {  // remove focus
		document.qualify.TermYear.focus();
	}
}


function checkNumb(pnumb, pname) {
    var numb = pnumb.value
    var message
    var indx
    var status = false

    if (numb.length == 0) {
        status = true
    }

    for (var indx = 0; indx < numb.length; indx++) {  /* the field should contain at least one digit */
        if (numb.charAt(indx)>= "0" && numb.charAt(indx) <= "9") {
            status = true
        }
    }

    for (var indx = 0; indx < numb.length; indx++) {
        if (!((numb.charAt(indx)>= "0" && numb.charAt(indx) <= "9") ||
             numb.charAt(indx) == " " ||
             numb.charAt(indx) == "." ||
             numb.charAt(indx) == ",")) {
            status = false
        }
    }

    if (!status) {
        msg = "The '" + pname + "' field must be a number."
        alert(msg)
    }
    return status
}

function parseNumb(pnumbstr) {
    var numb = pnumbstr.value
    var indx

    if (numb.length> 0) {
        indx = numb.indexOf(",")
    } else {
        indx = -1
    }
    while (indx != -1) {
        numb = numb.substring(0,indx) + numb.substring(indx*1 + 1,numb.length)
        indx = numb.indexOf(",")
    }

    if (numb.length> 0) {
        indx = numb.indexOf(" ")
    } else {
        indx = -1
    }
    while (indx != -1) {
        numb = numb.substring(0,indx) + numb.substring(indx*1 + 1,numb.length)
        indx = numb.indexOf(" ")
    }
    if (numb == "") {
        numb = 0
    }
    return numb
}

function parseMonth(pyear, pmonth) {
    var year  = parseNumb(pyear)
    var month = parseNumb(pmonth)
    var period
    var indx

    period = Math.ceil(month*1 + year*12)

    return period
}

function ParseDollar(pNumber) {
    var money = ""
    var numb = Math.round(pNumber)
    var indx1
    var indx2 = 0

    numb = "" + numb
    indx1 = numb.length - 1

    while (indx1> -1) {
        indx2 += 1
        if (indx2 == 4) {
            money = "," + money
            indx2 = 1
        }
        money = numb.substring(indx1,indx1*1 + 1) + money
        indx1 -= 1
    }

    money = "$ " + money

    return money
}

function checkIncOne(pInc) {
    var Inc = pInc
    var status = false

    if (checkEnter(Inc,"First Income")) {
        status = checkNumb(Inc,"First Income")
    }

    return status
}


function checkIntRate(pIntRate) {
    var IntRate = pIntRate
    var status  = true

    if (checkEnter(IntRate,"Interest Rate")) {
        if (checkNumb(IntRate,"Interest Rate")) {
            if (IntRate.value == 0) {
                alert("The Interest Rate can not be zero.")
                status = false
            }
        } else {
            status = false
        }
    } else {
        status = false
    }

    return status
}

function checkTermY(pYear) {
    var TermYear = pYear
    var status   = true

    if (checkEnter(TermYear,"Year Period")) {
        if (checkNumb(TermYear,"Year Period")) {
            if (TermYear.value> 30) {
                alert("The Term of Loan can not be longer than 30 years.")
                status = false
            }
        } else {
            status = false
        }
    } else {
        status = false
    }

    return status
}

function checkTermM(pYear, pMonth) {
    var TermYear  = pYear
    var TermMonth = pMonth
    var status    = true
    var ValMonth  = pMonth.value

    if (ValMonth.length != 0) {
        if (checkNumb(TermMonth,"Month Period")) {
           if (TermMonth.value> 0 && TermYear.value> 29) {
                alert("The Term of Loan can not be longer than 30 years.")
                status = false
            }
            if (TermMonth.value> 11) {
                alert("Please use the Year field to enter a period longer than 11 months.")
                status = false
            }
        } else {
            status = false
        }
    }

    return status
}

var ACF = 10 //Account Keeping Fee
var fixedInterestRate = true //default interest rate type

function CalQualAmt() {
    var IncOne
    var IncTwo
    var OthInc
    var RentInc
    var TotInc

    var HomeLoan
    var OthLoan
    var CardLim
    var NumbDep
	var AmtDep
    var OthExp
    var TotExp

    var IntRate
    var MonthTerm
    var RepayAmt
    var QualAmt

    if (checkIncOne(document.qualify.IncOne) &&
	  checkNumb(document.qualify.IncTwo,"Second Income") &&
	  checkNumb(document.qualify.OthInc,"Other Income") &&
	  checkNumb(document.qualify.RentInc,"Rental Income") &&
	  checkNumberofApplicants(document.qualify.Applicants, "No. of Applicants") &&
	  checkNumb(document.qualify.HomeLoan,"Home Loan") &&
	  checkNumb(document.qualify.OthLoan,"Other Loan") &&
	  checkNumb(document.qualify.CardLim,"Card Limit") &&
	  checkNumb(document.qualify.NumbDep,"Number of Dependants") &&
	  checkIntRate(document.qualify.IntRate) &&
      checkTermY(document.qualify.TermYear) &&
      checkTermM(document.qualify.TermYear,document.qualify.TermMonth)) {
        IncOne  = (parseNumb(document.qualify.IncOne)/12)*document.qualify.income1.options[document.qualify.income1.selectedIndex].value;
        IncTwo =  (parseNumb(document.qualify.IncTwo)/12)*document.qualify.income2.options[document.qualify.income2.selectedIndex].value;
        OthInc =  (parseNumb(document.qualify.OthInc)/12)*document.qualify.incomeother.options[document.qualify.incomeother.selectedIndex].value;
        RentInc = (parseNumb(document.qualify.RentInc)/12)*document.qualify.incomerental.options[document.qualify.incomerental.selectedIndex].value;
        HomeLoan = parseNumb(document.qualify.HomeLoan);
        OthLoan = parseNumb(document.qualify.OthLoan);
        CardLim = parseNumb(document.qualify.CardLim);
        NumbDep = parseNumb(document.qualify.NumbDep);

        IntRate = parseNumb(document.qualify.IntRate)/1200
        MonthTerm = parseMonth(document.qualify.TermYear,document.qualify.TermMonth)

		// if SINGLE app, make sure only one income box is filled in.
		if ((returnRadioValue(document.qualify.Applicants)==1) && (IncTwo> 0)) {
			IncTwo = 0;
			document.qualify.IncTwo.value = 0;
			alert ("You have selected Single Application and entered a value for 'Income Two'. This value has now been reset to $0. If you require a Joint Income, please select it under 'Application Type'");
		}

        TotInc = IncOne + IncTwo + OthInc
		
		OthExp = TotInc * 0.35;
		
		if (OthExp < 1000 && returnRadioValue(document.qualify.Applicants)==1) { //IncTwo == 0)
			OthExp = 1000;
		} else if (OthExp < 1300 && returnRadioValue(document.qualify.Applicants)==2) {
			OthExp = 1300;
		} else if (OthExp> 2000 && returnRadioValue(document.qualify.Applicants)==1) {
			OthExp = 2000;
		} else if (OthExp> 2600 && returnRadioValue(document.qualify.Applicants)==2) {
			OthExp = 2600;
		}
		
		if (NumbDep> 0)
			AmtDep = 175 + (NumbDep - 1) * 125;
		else
			AmtDep = 0;
		
		TotExp = AmtDep*1 + HomeLoan*1 + OthLoan*1 + (CardLim * 0.03) + OthExp*1;
		
		RepayAmt = TotInc + (RentInc * 0.7) - TotExp
		
		// no ACF on personal loans
		LoanAmt = (RepayAmt - ACF) * (1 - Math.pow((1 + IntRate*1),-MonthTerm))/IntRate
		
		if (LoanAmt> 0) {
            document.qualify.LoanAmt.value = ParseDollar(Math.round(LoanAmt))
			return true;
        } else {
			document.qualify.LoanAmt.value = "$ 0"
			return true;
		}
    } else {
		document.qualify.LoanAmt.value = " "
		return false;
    }
}

function Init_Page() {
	document.qualify.IncOne.focus();
	document.qualify.IncOne.select();
}

// Calculate loan, open new window, submit form.
function PopUpPrint () {
	CalcRepay();
	inputstring = "repayment_calc_displaycertificate_frame.asp"
	inputstring = inputstring + "?LoanAmt1=" + document.repay.LoanAmt1.value
	inputstring = inputstring + "&IntRate1=" + document.repay.IntRate1.value
	inputstring = inputstring + "&TermYear1=" + document.repay.TermYear1.value
	inputstring = inputstring + "&TermMonth1=" + document.repay.TermMonth1.value
	inputstring = inputstring + "&RepayAmt1=" + document.repay.RepayAmt1.value
	window.open(inputstring,'certificate','width=640,height=600,scrollbars=yes,resizable=yes,screenX=0,screenY=0,left=0,top=0')
}

function checkEnter(pfield, pname) {
	var field = pfield.value
	var msg
	var status = true
	
	if (field.length == 0) {
		msg = "The " + pname + " field must be entered."
		alert(msg)
		status = false
	}
	
	return status
}

function checkNumb(pnumb, pname) {
	var numb = pnumb.value
	var message
	var indx
	var status = false
	
	for (var indx = 0; indx < numb.length; indx++) { /* the field should contain at least one digit */
		if (numb.charAt(indx)>= "0" && numb.charAt(indx) <= "9") {
			status = true
		}
	}
	for (var indx = 0; indx < numb.length; indx++) {
		if (!((numb.charAt(indx)>= "0" && numb.charAt(indx) <= "9") ||
		  numb.charAt(indx) == " " ||
		  numb.charAt(indx) == "." ||
		  numb.charAt(indx) == ",")) {
			status = false
		}
	}
	if (!status) {
		msg = "The " + pname + " field must be a number."
		alert(msg)
	}
	
	return status
}

function parseNumb(pnumbstr) {
	var numb = pnumbstr.value
	var indx
	
	indx = numb.indexOf(",")
	while (indx != -1) {
		numb = numb.substring(0,indx) + numb.substring(indx*1 + 1,numb.length)
		indx = numb.indexOf(",")
	}
	
	indx = numb.indexOf(" ")
	while (indx != -1) {
		numb = numb.substring(0,indx) + numb.substring(indx*1 + 1,numb.length)
		indx = numb.indexOf(" ")
	}
	
	return numb
}

function parseMonth(pyear, pmonth) {
	var year  = parseNumb(pyear)
	var month = parseNumb(pmonth)
	var period
	var indx
	
	period = Math.ceil(month*1 + year*12)
	
	return period
}

function checkLoan(pLoan) {
	var LoanAmt = pLoan
	var status
	
	if (checkEnter(LoanAmt,"Loan Amount")) {
		status = checkNumb(LoanAmt,"Loan Amount")
	}
	
	return status
}

function checkRepay(pRepay) {
	var RepayAmt = pRepay
	var status   = true
	
	if (checkEnter(RepayAmt,"Repay Amount")) {
		if (checkNumb(RepayAmt,"Repay Amount")) {
			if (RepayAmt.value == 0) {
				alert("The Repay Amount can not be zero.")
				status = false
			}
		} else {
			status = false
		}
	} else {
		status = false
	}
	
	return status
}

function checkIntRate(pIntRate) {
	var IntRate = pIntRate
	var status  = true
	
	if (checkEnter(IntRate,"Interest Rate")) {
		if (checkNumb(IntRate,"Interest Rate")) {
			if (IntRate.value == 0) {
				alert("The Interest Rate can not be zero.")
				status = false
			}
		} else {
			status = false
		}
	} else {
		status = false
	}
	
	return status
}

function checkTermY(pYear) {
	var TermYear = pYear
	var status   = true
	
	if (checkEnter(TermYear,"Year Period")) {
		if (checkNumb(TermYear,"Year Period")) {
			if (TermYear.value> 30) {
				alert("The Year Period can not be longer than 30 years.")
				status = false
			}
		} else {
			status = false
		}
	} else {
		status = false
	}
	
	return status
}

function checkTermM(pMonth) {
	var TermMonth = pMonth
	var status    = true
	
	if (checkEnter(TermMonth,"Month Period")) {
		if (checkNumb(TermMonth,"Month Period")) {
			//if (TermMonth.value> 11) {
				//alert("Please use the Year field to enter a period longer than 11 months.")
				//status = false
			//}
		} else {
			status = false
		}
	} else {
		status = false
	}
	
	return status
}

function CalcRepayAmt(pLoanAmt, pIntRate, pTerm) {
	var RepayAmt
	
	RepayAmt = pLoanAmt * pIntRate/(1 - Math.pow((1 + pIntRate*1),-pTerm))
	RepayAmt = Math.ceil(RepayAmt)
	
	return RepayAmt
}
/////////////////////////////////////////////////////////
function CalcRepay() {
	var LoanAmount
	var InterestRate
	var MonthTerm
	
	if (checkLoan(document.repay.LoanAmt1) &&
	  checkIntRate(document.repay.IntRate1) &&
	  checkTermY(document.repay.TermYear1) &&
	  checkTermM(document.repay.TermMonth1)) {
		LoanAmount   = parseNumb(document.repay.LoanAmt1)
		InterestRate = parseNumb(document.repay.IntRate1)/1200
		MonthTerm    = parseMonth(document.repay.TermYear1,document.repay.TermMonth1)
		
		document.repay.RepayAmt1.value = CalcRepayAmt(LoanAmount, InterestRate, MonthTerm)
	} else {
		document.repay.RepayAmt1.value = " "
	}
}
/////////////////////////////////////////////////////
function CalcTerm() {
	/* Calculate the Repaid Period */
	
	var MonthTerm    = 0
	var YearTerm     = 0
	var MaxTerm      = 30 * 12     /* 30 years */
	var LoanAmount
	var RepayAmount
	var InterestRate
	var MinRepay
	
	if (checkLoan(document.repay.LoanAmt2) &&
	  checkRepay(document.repay.RepayAmt2) &&
	  checkIntRate(document.repay.IntRate2)) {
		LoanAmount   = parseNumb(document.repay.LoanAmt2)
		RepayAmount  = parseNumb(document.repay.RepayAmt2)
		InterestRate = parseNumb(document.repay.IntRate2)/1200
		MinRepay     = CalcRepayAmt(LoanAmount, InterestRate, MaxTerm)
		
		if (RepayAmount < MinRepay) {
			Msg = "Sorry, the minimum repayment amount must be " + MinRepay + " dollars."
			alert(Msg)
			document.repay.TermYear2.value  = " "
			document.repay.TermMonth2.value = " "
		} else {
			MonthTerm = Math.log(RepayAmount/(RepayAmount - LoanAmount * InterestRate)) / Math.log(1 + InterestRate)
			MonthTerm = Math.ceil(MonthTerm)
			YearTerm = Math.floor(MonthTerm / 12)
			MonthTerm = MonthTerm - (YearTerm * 12)
			
			document.repay.TermYear2.value  = YearTerm
			document.repay.TermMonth2.value = MonthTerm 
		}
	} else {
		document.repay.TermYear2.value  = " "
		document.repay.TermMonth2.value = " "
	}
}
/////////////////////////////////////////////////////////
function CalcLoan() {
	var LoanAmt
	var RepayAmount
	var InterestRate
	var MonthTerm
	
	if (checkRepay(document.repay.RepayAmt3) &&
	  checkIntRate(document.repay.IntRate3) &&
	  checkTermY(document.repay.TermYear3) &&
	  checkTermM(document.repay.TermMonth3)) {
		RepayAmount  = parseNumb(document.repay.RepayAmt3)
		InterestRate = parseNumb(document.repay.IntRate3)/1200
		MonthTerm    = parseMonth(document.repay.TermYear3,document.repay.TermMonth3)
		LoanAmt = RepayAmount * (1 - Math.pow((1 + InterestRate*1),-MonthTerm))/InterestRate
		
		document.repay.LoanAmt3.value = Math.floor(LoanAmt)
	} else {
		document.repay.LoanAmt3.value = " "
	}
}

//...end script -->
</SCRIPT>
<table border="<? echo $style['admin_listing_border'] ?>" cellspacing="<? echo $style['admin_listing_cellspacing'] ?>" cellpadding="<? echo $style['admin_listing_cellpadding'] ?>" width="<? echo $style['admin_table_width'] ?>" class="form_main">
		  <tr>
<td width='100%' align="center"> 
 <!--  header content here - you could put your links to your virtual pages here - simply use: $_SERVER[PHP_SELF]?action=1 (or 2,3,4 etc) as the href.  --><b>
[<a href="<?$PHP_SELF?>?action=1">Loan Term</a>]&nbsp;[<a href="<?$PHP_SELF?>?action=2">Loan Qualifier </a>]&nbsp;[<a href="<?$PHP_SELF?>?action=3">Loan Repayment </a>]&nbsp;[<a href="<?$PHP_SELF?>?action=4">Loan Amount </a>]<!-- &nbsp;[<a href="<?$PHP_SELF?>?action=6">Calc one</a>]&nbsp;--></b>
  </td>
    </tr>      
<tr> 
<td> 
<?php  
if (!isset($action))  
{  
  $action = "1";  ?>
 <table width='100%' border='0' cellspacing='2' cellpadding='2'> 
  <tr> 
  <td width='100%'> 
    <p>The Calculators offered for your use are an indication of the results and all information you may recieve can be based only on information that you supply.</p> <p>No information is held in anyway by the site or your browser after the completion of your calculations. All calculations are proceessed completly by this page so no information leaves your sight at any time, It is available for your viewing only. For that reason these calculators are completely secure to use and enter any detail you want.</p>

  </td>  <td valign="top"><?php renderFeaturedListingsVertical(4); ?></td>
    </tr> 
</table>  
    
<?php }  
else if ($action == "1")  
{  
  $action = "2";  
  echo " 
  <table width='100%' border='0' cellspacing='2' cellpadding='2'> 
  <tr> 
  <td> 
 <P>
                  <H1>Loan Term Calculator</H1>
                  <P></P>
                  <P>How long will it take to repay my loan? Providing a loan 
                  amount, regular repayment amount and an annual interest rate, 
                  this calculator provides the approximate years and months it 
                  will take to repay the loan.</P>
                  <FORM name=repay>
                  <TABLE cellSpacing=0 cellPadding=2 border=0>
                    <TBODY>
                    <TR>
                      <TD vAlign=top>Loan amount</TD>
                      <TD vAlign=top rowSpan=3><IMG height=1 hspace=0 src=\"Loan Term Calculator_files/spacer.gif\" width=1 
                        border=0></TD>
                      <TD vAlign=top><INPUT onblur=checkLoan(LoanAmt2); 
                        size=12 value=100000 name=LoanAmt2> [$]</TD></TR>
                    <TR>
                      <TD vAlign=top>Regular repayment amount</TD>
                      <TD vAlign=top><INPUT onblur=checkRepay(RepayAmt2); 
                        size=12 value=700 name=RepayAmt2> <SELECT 
                          name=RepayFreq> <OPTION value=12 selected>per 
                          month</OPTION> <OPTION value=26>per fortnight</OPTION> 
                          <OPTION value=52>per week</OPTION></SELECT> </TD></TR>
                    <TR>
                      <TD vAlign=top>Annual interest rate</TD>
                      <TD vAlign=top><INPUT size=12 value=7.00 name=IntRate2 
                        aonblur=\"checkIntRate(IntRate2);\"> 
                  [%]</TD></TR></TBODY></TABLE>
                  <TABLE cellSpacing=2 cellPadding=2 width=\"100%\" border=0>
                    <TBODY>
                    <TR>
                      <TD vAlign=baseline align=right><INPUT onclick=CalcTerm(); type=button value=Calculate name=Calculate></TD></TR>
                    <TR>
                      <TD vAlign=top align=right><B>It will take <INPUT size=5 
                        name=TermYear2> years and <INPUT size=5 name=TermMonth2> 
                        months to repay the loan amount.</B></TD></TR></TBODY></TABLE>
                  </FORM><BR><BR>
  </td> 
  </tr> 
</table>";  
}  
else if ($action == "2")  
{  
  $action = "3";  
  echo " 
  <table width='100%' border='0' cellspacing='2' cellpadding='2'> 
  <tr> 
  <td> 
<P>
                  <H1>Loan Qualifier Calculator</H1>
                  <P></P>
                  <P>Use our simple calculator to find out the approximate 
                  amount you should be able to borrow given your income and expenses. Remember this is an 
                  estimate only and other factors may need to be taken into 
                  consideration.</P>
                                  <P>Scroll down entering your <B>Income,</B> your 
                  <B>expenses,</B> the <B>loan details</B> then click 
                  <B>'Calculate.'</B></P>
                  <FORM name=qualify>
                  <TABLE cellSpacing=0 cellPadding=0 width=\"100%\" border=0>
                    <TBODY>
                    <TR>
                      <TD vAlign=top>Application Type </TD>
                      <TD vAlign=top><INPUT type=radio CHECKED value=1 
                        name=Applicants> Single <INPUT type=radio value=2 
                        name=Applicants> Joint </TD></TR>
                    <TR>
                      <TD vAlign=top>Loan Type </TD>
                      <TD vAlign=baseline><INPUT 
                        onclick=checkLoanType(loanType); type=radio CHECKED 
                        value=Home name=loanType>Home/Investment Loan<BR><INPUT 
                        onclick=checkLoanType(loanType); type=radio 
                        value=Personal name=loanType>Personal Loan </TD></TR>
                    <TR>
                      <TD colSpan=2><B>Income</B> </TD></TR>
                    <TR>
            <TD vAlign=top>Enter income 1, net after tax </TD>
           <TD vAlign=top>
<INPUT size=12 name=IncOne> 
<SELECT name=income1> 
<OPTION value=1 selected>per year</OPTION> 
<OPTION value=12>per month</OPTION> 
<OPTION value=26>per fortnight</OPTION> 
<OPTION  value=52>per week</OPTION>
</SELECT> 
</TD></TR><TR>
<TD vAlign=top>Enter income 2, net after tax<BR>(if any)</TD>
<TD vAlign=top>
<INPUT size=12 value=0 name=IncTwo> 
<SELECT name=income2> 
<OPTION value=1 selected>per year</OPTION> 
<OPTION value=12>per month</OPTION> 
<OPTION value=26>per fortnight</OPTION> 
<OPTION value=52>per week</OPTION>
</SELECT> 
</TD></TR>
<TR>
<TD vAlign=top>Enter other income, net after tax<BR>(if any) </TD>
<TD vAlign=top>
<INPUT size=12 name=OthInc> 
<SELECT name=incomeother> 
<OPTION value=1 selected>per year</OPTION> 
<OPTION value=12>per month</OPTION> 
<OPTION value=26>per fortnight</OPTION> 
<OPTION value=52>per week</OPTION>
</SELECT> 
</TD></TR><TR>
<TD vAlign=top>Enter rental/investment income<BR>(if any) </TD>
<TD vAlign=top><INPUT size=12 name=RentInc> 
<SELECT name=incomerental> 
<OPTION value=1 selected>per year</OPTION> 
<OPTION value=12>per month</OPTION> 
<OPTION value=26>per fortnight</OPTION> 
<OPTION value=52>per week</OPTION>
</SELECT> 
</TD></TR><TR>
<TD colSpan=2><BR><B>Expenses</B> 
</TD></TR><TR>
<TD vAlign=top>Enter investment loan repayment<BR>(if any) </TD>
<TD vAlign=top><INPUT size=12 name=HomeLoan> [per month] 
 </TD></TR><TR>
<TD vAlign=top>Enter other loan repayments<BR>(if any) 
</TD>
<TD vAlign=top><INPUT size=12 name=OthLoan> [per month] 
</TD></TR><TR>
<TD vAlign=top>Enter your total credit card limit<BR>(if any) </TD>
<TD vAlign=top><INPUT size=12 name=CardLim> [$] </TD></TR>
<TR><TD vAlign=top>Enter number of dependants<BR>(if any) 
</TD>
<TD vAlign=top><INPUT size=12 name=NumbDep> </TD></TR>
                    <TR>
<TD colSpan=2><I>
Note: Other living expenses are calculated as a percentage of your income.</I> 
</TD></TR><TR>
<TD colSpan=2><BR><B>Loan Details</B> </TD></TR>
<TR>
<TD vAlign=top>Qualification Interest Rate </TD>
<TD vAlign=baseline>
<INPUT size=6 value=8.16 name=IntRate> [%] 
</TD></TR><TR><TD vAlign=top>Enter term of loan </TD>
<TD vAlign=top>
<TABLE cellSpacing=0 cellPadding=0><TBODY><TR><TD>
<INPUT size=6 value=25 name=TermYear></TD>
<TD>
<INPUT size=2 name=TermMonth>
</TD></TR><TR><TD>[Years]</TD><TD>[Months]</TD>
                            </TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=2 cellPadding=2 width=\"100%\" border=0>
                    <TBODY>
                    <TR>
<TD vAlign=baseline align=right><INPUT onclick=CalQualAmt(); type=button value=Calculate name=Calculate> 
</TD></TR><TR>
<TD vAlign=top align=right><B>
The amount you can borrow will be approximately 
<INPUT align=right value=0 name=LoanAmt></B> </TD></TR></TBODY></TABLE></FORM><BR><BR>
  </td> 
  </tr> 
</table>";  
}  
else if ($action == "3")  
{  
  $action = "4";  
  echo " 
  <table width='100%' border='0' cellspacing='2' cellpadding='2'> 
  <tr> 
  <td> 
 <P>
                  <H1>Loan Repayment Calculator</H1>
                  <P></P>
                  <P>What will your repayments be? Providing a loan amount, 
                  annual interest rate and repayment period, this calculator 
                  provides the approximate repayment amount per month 
                  required.</P>
                  <FORM name=repay>
                  <TABLE cellSpacing=0 cellPadding=2 border=0>
                    <TBODY>
                    <TR>
                      <TD vAlign=top>Loan amount</TD>
                      <TD vAlign=top rowSpan=4><IMG height=1 hspace=0 
                        src=\"Loan Repayment Calculator_files/spacer.gif\" width=1 
                        border=0></TD>
                      <TD vAlign=top colSpan=2><INPUT 
                        onblur=checkLoan(LoanAmt1); size=12 value=100000 
                        name=LoanAmt1> [$]</TD></TR>
                    <TR>
                      <TD vAlign=top>Annual interest rate</TD>
                      <TD vAlign=top colSpan=2><INPUT 
                        onblur=checkIntRate(IntRate1); size=5 value=7.00 
                        name=IntRate1> [%]</TD></TR>
                    <TR>
                      <TD vAlign=top>Loan term</TD>
                      <TD vAlign=top><INPUT onblur=checkTermY(TermYear1); 
                        size=3 value=25 name=TermYear1></TD>
                      <TD vAlign=top><INPUT onblur=checkTermM(TermMonth1); 
                        size=3 value=0 name=TermMonth1></TD></TR>
                    <TR>
                      <TD vAlign=top></TD>
                      <TD vAlign=baseline>[Years]</TD>
                      <TD vAlign=baseline>[Months]</TD></TR></TBODY></TABLE>
                  <TABLE cellSpacing=2 cellPadding=2 width=\"100%\" border=0>
                    <TBODY>
                    <TR>
                      <TD vAlign=baseline align=right><INPUT onclick=CalcRepay(); type=button value=Calculate name=Calculate></TD></TR>
                    <TR>
                      <TD vAlign=top align=right><B>Your repayment amount will 
                        be approximately $ <INPUT size=10 value=0 
                        name=RepayAmt1> per month</B></TD></TR></TBODY></TABLE>
                  </FORM><BR><BR>
  </td> 
  </tr> 
</table>";  
}  
else if ($action == "4")  
{  
  $action = "5";  
  echo " 
  <table width='100%' border='0' cellspacing='2' cellpadding='2'> 
  <tr> 
  <td> 
 <P>
                  <H1>Loan Amount Calculator</H1>
                  <P></P>
                  <P>How much can you borrow? Providing a regular repayment 
                  amount, annual interest rate and repayment period, this 
                  calculator provides the approximate loan amount you are able 
                  to borrow.</P>
                  <FORM name=repay>
                  <TABLE cellSpacing=0 cellPadding=1 border=0>
                    <TBODY>
                    <TR>
                      <TD vAlign=top>Regular repayment amount</TD>
                      <TD vAlign=top rowSpan=4><IMG height=1 hspace=0 
                        src=\"Loan Amount Calculator_files/spacer.gif\" width=1 
                        border=0></TD>
                      <TD vAlign=top colSpan=2><INPUT 
                        onblur=checkRepay(RepayAmt3) size=12 value=500 
                        name=RepayAmt3> [monthly]</TD></TR>
                    <TR>
                      <TD vAlign=top>Annual interest rate</TD>
                      <TD vAlign=top colSpan=2><INPUT 
                        onblur=checkIntRate(IntRate3) size=5 value=7.00 
                        name=IntRate3> [%]</TD></TR>
                    <TR>
                      <TD vAlign=top>Loan term</TD>
                      <TD vAlign=top><INPUT onblur=checkTermY(TermYear3) 
                        size=3 value=25 name=TermYear3></TD>
                      <TD vAlign=top><INPUT onblur=checkTermM(TermMonth3) 
                        size=3 value=0 name=TermMonth3></TD></TR>
                    <TR>
                      <TD vAlign=top></TD>
                      <TD vAlign=baseline>[Years]</TD>
                      <TD vAlign=baseline>[Months]</TD></TR></TBODY></TABLE>
                  <TABLE cellSpacing=2 cellPadding=2 width=\"100%\" border=0>
                    <TBODY>
                    <TR>
                      <TD vAlign=baseline align=right><INPUT onclick=CalcLoan(); type=button value=Calculate name=Calculate></TD></TR>
                    <TR>
                      <TD vAlign=top noWrap align=right><B>The total loan 
                        amount will be $ <INPUT size=10 
                    name=LoanAmt3></B></TD></TR></TBODY></TABLE></FORM>
                  <BR><BR>
  </td> 
  </tr> 
</table>";  
}  
else if ($action == "5")  
{  
  $action = "6";  
  echo " 
  <table width='100%' border='0' cellspacing='2' cellpadding='2'> 
  <tr> 
  <td> 

  </td> 
  </tr> 
</table>";  
}  

?>    
<P><SMALL>These calculators and the resulting calculations do not constitute a loan application, loan offer or loan approval. </SMALL></P>

</td> 
</tr> 
</table> 
  <?  include("$config[template_path]/user_bottom.html"); ?>    