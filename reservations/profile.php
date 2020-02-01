<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
	include('includes/title-meta.htm');
?>
<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
</head>
<body bgcolor="#8993A3" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" alink="#0000FF"onLoad="document.form1.chrFirst.focus()">
<?php
	include('includes/top.htm');
?>
<table width="698" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" background="images/fadeleft.gif"><img src="images/fadeleft.gif" width="10" height="1"></td>
    <td bgcolor="#ffffff"><form name="form1" method="post" action="insertprofile.php">
      <table width="100%"  border="0" cellspacing="0" cellpadding="10">
        <tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td><strong><font face="Arial, Helvetica, sans-serif" size="3">Attendee Information</font></strong></td>
            </tr>
            <tr>
              <td bgcolor="#CCCCCC"><font size="1" face="Arial, Helvetica, sans-serif">Please enter your information below. All information in blue is required.</font></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">First Name (Required)<br>
                  <input name="First_Name" type="text" id="chrFirst" size="35" maxlength="25" tabindex="1">
              </font></td>
              <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">Last Name (Required)<br>
                  <input name="Last_Name" type="text" id="chrLast" size="35" maxlength="25" tabindex="2">
              </font></td>
            </tr>
            <tr>
              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">Company Name<br>
                  <input name="chrCompany" type="text" id="chrCompany" size="50" maxlength="50" tabindex="3"> 
                  </font></td>
              </tr>
            <tr>
              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">Address<br>
                  <input name="chrAddress" type="text" id="chrAddress" size="50" maxlength="50" tabindex="4">
              </font></td>
            </tr>
            <tr>
              <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">City<br>
                  <input name="chrCity" type="text" id="chrCity" size="25" maxlength="50" tabindex="5">
              </font></td>
              <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">State<br>
                  <input name="chrState" type="text" id="chrState" size="25" maxlength="50" tabindex="6">
              </font></td>
            </tr>
			<tr>
              <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">Zip/Postal Code <br>
                  <input name="chrZip" type="text" id="chrZip" size="12" maxlength="20" tabindex="7">
              </font></td>
              <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">Country<br>
                  <input name="chrCountry" type="text" id="chrCountry" size="30" maxlength="40" tabindex="8">
              </font></td>
            </tr>
            <tr>
              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">Telephone</font><br>
                    <input name="chrPhone" type="text" id="chrPhone" size="30" maxlength="100" tabindex="9">
                  </font></td>
              </tr>
			<tr>
              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">Email Address (Used to send confirmation email)</font><br>
                  
                    <input name="Email_Address" type="text" id="chrEmail" size="30" maxlength="100" tabindex="10">
                  </font></td>
              </tr>
            <tr>
              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
            </tr>
            <tr>
              <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">
                  	<input name="Q6" type="checkbox" id="Q6" value="Yes" checked>
                  </font></td>
                <td width="100%"><font size="1" face="Arial, Helvetica, sans-serif"><strong> I would you like to find out more information about Logic Studio and it's partners?</strong></font></td>
                </tr>
              </table>                
              </td>
            </tr>
            <tr>
              <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td align="center"><font color="#0000FF" size="1" face="Arial, Helvetica, sans-serif">
                    <input name="chrContact" type="checkbox" id="chrContact" value="Yes" checked>
                  </font></td>
                  <td><font size="1" face="Arial, Helvetica, sans-serif"><strong>Stay in touch!</strong> Keep me up to date with Apple news, software updates, and the latest information on products and services to help me make the most of my Apple products.</font></td>
                </tr>
              </table></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td><input name="Submit" type="submit" onClick="MM_validateForm('chrFirst','','R','chrLast','','R','chrEmail','','RisEmail');return document.MM_returnValue" value="Register and Proceed to Classes">
          &nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.apple.com/legal/privacy/" target="_blank"><font size="1" face="Arial, Helvetica, sans-serif">Apple Privacy Policy</font></a></td>
        </tr>
      </table>
    </form></td>
    <td width="10" background="images/faderight.gif">s</td>
  </tr>
</table>
<?php
	include('includes/bottom.htm');
?>
</body>
</html>
