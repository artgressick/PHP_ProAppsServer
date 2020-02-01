<?php

	include('includes/redirector.php');

  // clean up leading/trailing white-space
  //
  $badge = ltrim(rtrim($_POST['chrBadge']));

  // remove unwanted characters (NOTE: I'm removing spaces, might not be wanted...)
  //
  $remove_chars = array("%","?","\n"); // put whatever characters in here you want removed
  for ($i = 0 ; $i < count($remove_chars) ; $i++)
    $badge = str_replace($remove_chars[$i], "", $badge);

  // split the string on "^" and tease out the paramters.  If the badge string
  // doesn't contain the "^" character, then we just skip this whoooah.
  //
  // Set for Siggraph2005
  //
  if (!(strpos($badge,"^") === false)) {
    $tokens     = explode("^", $badge, 50 /* limiting the number of tokens to 20 */);
	$id_Badge   = ($tokens[5] ? stripslashes($tokens[5]) : ""); //The first field on GV expo is 1 not 0
    $first_name = ($tokens[8] ? stripslashes($tokens[8]) : "");
	$last_name  = ($tokens[11] ? stripslashes($tokens[11]) : "");
    $company  	= ($tokens[17] ? stripslashes($tokens[17]) : "");
    $address1   = ($tokens[20] ? stripslashes($tokens[20]) : "");
    $address2   = ($tokens[23] ? stripslashes($tokens[23]) : "");
	$city		= ($tokens[26] ? stripslashes($tokens[26]) : "");
	$state		= ($tokens[29] ? stripslashes($tokens[29]) : "");
	$zip		= ($tokens[32] ? stripslashes($tokens[32]) : "");
	$country	= ($tokens[35] ? stripslashes($tokens[35]) : "");
	$phone		= ($tokens[38] ? stripslashes($tokens[38]) : "");
	$fax		= ($tokens[41] ? stripslashes($tokens[41]) : "");
	$email		= ($tokens[44] ? stripslashes($tokens[44]) : "");
	$title		= ($tokens[14] ? stripslashes($tokens[14]) : "");

    // to tease out the email, we look for the FIRST token which has the following
    // requirements :
    //
    // 1. contains the '*' (to be replaced with the '@')
    // 2. AFTER the '*' there is atleast one '.' character
    // 3. there is something BEFORE the '*' character
    //
    //for ($i = 5 ; $i < count($tokens) ; $i++) {
    //  $j = strpos($tokens[$i],"*");

    //  if (($j > 0) && !(strpos($tokens[$i],".",$j+1) === false)) {
    //    $email = str_replace("*", "@", $tokens[$i]);
    //    break;
    //  }
    //}
  }

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php
	include('includes/title-meta.htm');
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function YY_checkform() { //v4.71
//copyright (c)1998,2002 Yaromat.com
  var a=YY_checkform.arguments,oo=true,v='',s='',err=false,r,o,at,o1,t,i,j,ma,rx,cd,cm,cy,dte,at;
  for (i=1; i<a.length;i=i+4){
    if (a[i+1].charAt(0)=='#'){r=true; a[i+1]=a[i+1].substring(1);}else{r=false}
    o=MM_findObj(a[i].replace(/\[\d+\]/ig,""));
    o1=MM_findObj(a[i+1].replace(/\[\d+\]/ig,""));
    v=o.value;t=a[i+2];
    if (o.type=='text'||o.type=='password'||o.type=='hidden'){
      if (r&&v.length==0){err=true}
      if (v.length>0)
      if (t==1){ //fromto
        ma=a[i+1].split('_');if(isNaN(v)||v<ma[0]/1||v > ma[1]/1){err=true}
      } else if (t==2){
        rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-zA-Z]{2,4}$");if(!rx.test(v))err=true;
      } else if (t==3){ // date
        ma=a[i+1].split("#");at=v.match(ma[0]);
        if(at){
          cd=(at[ma[1]])?at[ma[1]]:1;cm=at[ma[2]]-1;cy=at[ma[3]];
          dte=new Date(cy,cm,cd);
          if(dte.getFullYear()!=cy||dte.getDate()!=cd||dte.getMonth()!=cm){err=true};
        }else{err=true}
      } else if (t==4){ // time
        ma=a[i+1].split("#");at=v.match(ma[0]);if(!at){err=true}
      } else if (t==5){ // check this 2
            if(o1.length)o1=o1[a[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!o1.checked){err=true}
      } else if (t==6){ // the same
            if(v!=MM_findObj(a[i+1]).value){err=true}
      }
    } else
    if (!o.type&&o.length>0&&o[0].type=='radio'){
          at = a[i].match(/(.*)\[(\d+)\].*/i);
          o2=(o.length>1)?o[at[2]]:o;
      if (t==1&&o2&&o2.checked&&o1&&o1.value.length/1==0){err=true}
      if (t==2){
        oo=false;
        for(j=0;j<o.length;j++){oo=oo||o[j].checked}
        if(!oo){s+='* '+a[i+3]+'\n'}
      }
    } else if (o.type=='checkbox'){
      if((t==1&&o.checked==false)||(t==2&&o.checked&&o1&&o1.value.length/1==0)){err=true}
    } else if (o.type=='select-one'||o.type=='select-multiple'){
      if(t==1&&o.selectedIndex/1==0){err=true}
    }else if (o.type=='textarea'){
      if(v.length<a[i+1]){err=true}
    }
    if (err){s+='* '+a[i+3]+'\n'; err=false}
  }
  if (s!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+s)}
  document.MM_returnValue = (s=='');
}
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
          <td align="left"><input name="Submit" type="submit" value="Register and Proceed to Classes"></td>
        </tr>
        <tr>
          <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">First Name <br>
                  <input name="chrFirst" type="text" id="chrFirst" size="35" maxlength="25" tabindex="1" value="<?php echo htmlspecialchars($first_name, ENT_QUOTES); ?>">
              </font></td>
              <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">Last Name<br>
                  <input name="chrLast" type="text" id="chrLast" size="35" maxlength="25" tabindex="2" value="<?php echo htmlspecialchars($last_name, ENT_QUOTES); ?>">
              </font></td>
            </tr>
            <tr>
              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">Company Name<br>
                  <input name="chrCompany" type="text" id="chrCompany" size="50" maxlength="50" value="<?php echo htmlspecialchars($company, ENT_QUOTES); ?>"> 
                  </font></td>
              </tr>
            <tr>
              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">Address<br>
                  <input name="chrAddress" type="text" id="chrAddress" size="50" maxlength="50" value="<?php echo htmlspecialchars($address1, ENT_QUOTES); ?>"> 
                  </font></td>
              </tr>
			<tr>
              <td><font size="1" face="Arial, Helvetica, sans-serif">City<br>
                  <input name="chrCity" type="text" id="chrCity" size="25" maxlength="50" value="<?php echo htmlspecialchars($city, ENT_QUOTES); ?>"> 
                  </font></td>
              <td><font size="1" face="Arial, Helvetica, sans-serif">State<br>
                  <input name="chrState" type="text" id="chrState" size="25" maxlength="50" value="<?php echo htmlspecialchars($state, ENT_QUOTES); ?>">
              </font></td>
			</tr>
			<tr>
              <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">Zip/Postal Code <br>
                  <input name="chrZip" type="text" id="chrZip" size="12" maxlength="20" value="<?php echo htmlspecialchars($zip, ENT_QUOTES); ?>">
              </font></td>
              <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">Country<br>
                  <input name="chrCountry" type="text" id="chrCountry" size="30" maxlength="40" value="<?php echo htmlspecialchars($country, ENT_QUOTES); ?>">
              </font></td>
            </tr>
            <tr>
              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">Telephone</font><font size="1" face="Arial, Helvetica, sans-serif"><br>
                  
                    <input name="chrPhone" type="text" id="chrPhone" size="30" maxlength="100" value="<?php echo htmlspecialchars($phone, ENT_QUOTES); ?>">
                  </font>                </td>
              </tr>
			<tr>
              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">Email Address</font><font size="1" face="Arial, Helvetica, sans-serif"></font><font size="1" face="Arial, Helvetica, sans-serif"><br>
                  
                    <input name="chrEmail" type="text" id="chrEmail" size="30" maxlength="100" tabindex="3" value="<?php echo htmlspecialchars($email, ENT_QUOTES); ?>">
                  </font>                </td>
              </tr>
            <tr>
              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
            </tr>
            <tr>
              <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td colspan="2"><font color="#0000FF" size="1" face="Arial, Helvetica, sans-serif"><strong>1</strong></font><strong><font size="1" face="Arial, Helvetica, sans-serif">. Do you want to be contacted by Apple?</font></strong><font size="1" face="Arial, Helvetica, sans-serif"> (Please select one.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td width="100%"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td width="25%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="chrContact" type="radio" value="No" checked>
                        </label>
                        No                      </font></td>
                      <td width="75%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="chrContact" type="radio" value="Yes">
                        </label>
                        Yes                      </font></td>
                    </tr>
                  </table></td>
                </tr>
				<tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                </tr>
                <tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#0000FF">2</font>. What best describes your Organization Type?</strong> (Please select one.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td>
                          <select name="chrOrgType" size="1" id="chrOrgType">
                            <option value="0" selected>Please choose</option>
                            <option value="creation/production">Business - Music creation/production</option>
                            <option value="production/mixing">Business - Audio production/mixing</option>
                            <option value="post production">Business - Audio post production for Video and Film</option>
                            <option value="video and film">Business - Primarily Video and Film</option>
                            <option value="education">Org Type is K-12 or Higher Education</option>
                            <option value="student">I am a student</option>
                                </select>                      </td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#0000FF">3</font>. What is your Organization's Size?</strong> (Please select one.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td>
                            <select name="chrOrgSize" size="1" id="chrOrgSize">
                              <option value="0" selected>Please choose</option>
                              <option value="1">1</option>
                              <option value="2-19">2-19</option>
                              <option value="20-49">20-49</option>
                              <option value="50+">50+</option>
                                </select>                        </td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                </tr>
                <tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#0000FF">4</font>. Do you purchase Apple products from a Value Added Pro Audio Reseller?</strong> (Please select one.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td width="25%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="Q2a" type="radio" value="No" checked>
                        </label>
                        No </font></td>
                      <td width="75%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="Q2a" type="radio" value="Yes">
                        </label>
                        Yes </font></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#0000FF">5</font>. Are you currently using G4's?</strong> (Please select one.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td width="25%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="Q2b" type="radio" value="No" checked>
                        </label>
                        No </font></td>
                      <td width="75%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="Q2b" type="radio" value="Yes">
                        </label>
                        Yes </font></td>
                    </tr>
                  </table></td>
                </tr>
				<tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#0000FF">6</font>. Are you considering upgrading to G5's?</strong> (Please select one.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td width="25%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="Q2c" type="radio" value="No" checked>
                        </label>
                        No </font></td>
                      <td width="75%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="Q2c" type="radio" value="Yes">
                        </label>
                        Yes </font></td>
                    </tr>
                  </table></td>
                </tr>
				<tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#0000FF">7</font>. Are you interested in Server and Storage Solutions for Pro Audio?</strong> (Please select one.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td width="25%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="Q2d" type="radio" value="No" checked>
                        </label>
                        No </font></td>
                      <td width="75%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="Q2d" type="radio" value="Yes">
                        </label>
                        Yes </font></td>
                    </tr>
                  </table></td>
                </tr>
				<tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#0000FF">8</font>. Are you currently using Pro Tools Hardware and Software's?</strong> (Please select one.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td width="25%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="Q2e" type="radio" value="No" checked>
                        </label>
                        No </font></td>
                      <td width="75%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="Q2e" type="radio" value="Yes">
                        </label>
                        Yes </font></td>
                    </tr>
                  </table></td>
                </tr>
				<tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#0000FF">9</font>. Is this a Hot Lead - Needs Sales Follow Up Immediately?</strong> (Please select one.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td width="25%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="Q2f" type="radio" value="No" checked>
                        </label>
                        No </font></td>
                      <td width="75%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <label>
                        <input name="Q2f" type="radio" value="Yes">
                        </label>
                        Yes </font></td>
                    </tr>
                  </table></td>
                </tr>
              </table>             </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><input name="Submit" type="submit" value="Register and Proceed to Classes">
&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.apple.com/legal/privacy/" target="_blank"><font size="1" face="Arial, Helvetica, sans-serif">Apple Privacy Policy</font></a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form></td>
    <td width="10" background="images/faderight.gif"><img src="images/faderight.gif" width="10" height="1"></td>
  </tr>
</table>
<?php
	include('includes/bottom.htm');
?>
</body>
</html>
