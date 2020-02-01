<?php

	include('includes/redirector.php');

  // clean up leading/trailing white-space
  //
  $badge = ltrim(rtrim($_POST['chrBadge']));
  
  $badge = substr($badge,19);

  // remove unwanted characters (NOTE: I'm removing spaces, might not be wanted...)
  //
  $remove_chars = array("%","?","\n","2"); // put whatever characters in here you want removed
  for ($i = 0 ; $i < count($remove_chars) ; $i++)
    $badge = str_replace($remove_chars[$i], "", $badge);

  // split the string on "^" and tease out the paramters.  If the badge string
  // doesn't contain the "^" character, then we just skip this whoooah.
  //
  if (!(strpos($badge,"^") === false)) {
    $tokens     = explode("^", $badge, 22 /* limiting the number of tokens to 20 */);
	//$id_Badge   = ($tokens[1] ? stripslashes($tokens[1]) : ""); //The first field on GV expo is 1 not 0
    $first_name = ($tokens[0] ? stripslashes($tokens[0]) : "");
	$last_name  = ($tokens[2] ? stripslashes($tokens[2]) : "");
    $company  	= ($tokens[4] ? stripslashes($tokens[4]) : "");
    $address1   = ($tokens[5] ? stripslashes($tokens[5]) : "");
    //$address2   = ($tokens[8] ? stripslashes($tokens[8]) : "");
	$city		= ($tokens[7] ? stripslashes($tokens[7]) : "");
	$state		= ($tokens[9] ? stripslashes($tokens[9]) : "");
	$zip		= ($tokens[11] ? stripslashes($tokens[11]) : "");
	//$country	= ($tokens[12] ? stripslashes($tokens[12]) : "");
	$phone		= ($tokens[13] ? stripslashes($tokens[13]) : "");
	//$fax		= ($tokens[14] ? stripslashes($tokens[14]) : "");
	$email		= ($tokens[14] ? stripslashes($tokens[14]) : "");
	//$title		= ($tokens[4] ? stripslashes($tokens[4]) : "");

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
              <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">Title<br>
                  <input name="chrTitle" type="text" id="chrTitle" size="50" maxlength="50" value="<?php echo htmlspecialchars($title, ENT_QUOTES); ?>"> 
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
              <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">City<br>
                  <input name="chrCity" type="text" id="chrCity" size="25" maxlength="50" value="<?php echo htmlspecialchars($city, ENT_QUOTES); ?>">
              </font></td>
              <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">State<br>
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
                  <td colspan="2"><font color="#0000FF" size="1" face="Arial, Helvetica, sans-serif"><strong>1</strong></font><strong><font size="1" face="Arial, Helvetica, sans-serif">. Contact me about:</font></strong><font size="1" face="Arial, Helvetica, sans-serif"> (Choose all that apply.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td width="100%"><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <input name="Q1a" type="checkbox" id="Q1a" value="Apple Enews">
      Apple eNews </font></td>
                      <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <input name="Q1d" type="checkbox" id="Q1d" value="AppleCare">
                        AppleCare/Support</font></td>
                    </tr>
                    <tr>
                      <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <input name="Q1b" type="checkbox" id="Q1b" value="Product Info/Sales">
                        Product Info/Sales </font></td>
                      <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <input name="Q1e" type="checkbox" id="Q1e" value="All of above">
                        All of above 
                      </font></td>
                    </tr>
                    <tr>
                      <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">
                        <input name="Q1c" type="checkbox" id="Q1c" value="Training">
      Training</font></td>
                      <td width="50%"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;
                        </font></td>
                    </tr>
                  </table></td>
                </tr>
				<tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                </tr>
				<tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#0000FF">2</font>. How large is your organization?</strong> (Please select one.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td>
                            <select name="chrOrgSize" size="1" id="chrOrgSize">
                              <option value="0" selected>Please choose</option>
                              <option value="1-19">1 to 19</option>
                              <option value="20-49">20 to 49</option>
                              <option value="50-99">50 to 99</option>
                              <option value="100-499">100 to 499</option>
                              <option value="500-999">500 to 999</option>
                              <option value="1000+">1000+</option>
                              <option value="Personal">Personal</option>
                                </select>                        </td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                </tr>
                <tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#0000FF">3</font>. What is your organization type?</strong> (Please select one.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                      <tr>
                        <td>
                            <select name="chrOrgType" size="1" id="chrOrgType">
                              <option value="0" selected>Please choose</option>
                              <option value="Business/Commercial">Business/Commercial</option>
                              <option value="High Ed">Education (High Ed)</option>
                              <option value="K-12">Education (K-12)</option>
                              <option value="Student">Student</option>
                              <option value="Government">Government</option>
                              <option value="Non-Profit">Non-Profit</option>
                              <option value="Personal">Personal</option>
                              <option value="Reseller">Reseller</option>
                                </select>                        </td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
				<tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#0000FF">4</font>. If your Org Types is a business, which of the following best describes it?</strong> (Please select one.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td>
                          <select name="Q4" size="1" id="Q4">
                            <option value="0" selected>Please choose</option>
                            <option value="Nat Cable Company">National Cable Company</option>
                            <option value="Nat Network Broadcaster">National Network Broadcaster</option>
                            <option value="Reg Cable Company">Regional Cable Company</option>
                            <option value="Reg Broadcast Station">Regional Broadcast Station</option>
                            <option value="Advertising agency">Advertising agency</option>
                            <option value="Design/Branding company">Design/Branding company</option>
                            <option value="3D Animation Facility">3D Animation Facility</option>
                            <option value="Post Production Facility">Post Production Facility</option>
                            <option value="Production Company">Production Company</option>
                            <option value="Educational Facility">Educational Facility</option>
                            <option value="Other">Other</option>
                              </select>                      </td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
				<tr>
                  <td colspan="2"><font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#0000FF">5</font>. What job title best describes you?</strong> (Please select one.) </font></td>
                </tr>
                <tr>
                  <td><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td>
                          <select name="Q6" size="1" id="Q6">
                            <option value="0" selected>Please choose</option>
                            <option value="Animator">Animator</option>
                            <option value="Art Director">Art Director</option>
                            <option value="Creative Director">Creative Director</option>
                            <option value="Graphics Designer">Graphics Designer</option>
                            <option value="Editor">Editor</option>
                            <option value="Producer">Producer</option>
                            <option value="Other">Other</option>
                              </select>                      </td>
                    </tr>
                  </table></td>
                </tr>
              </table>              </td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><input name="Submit" type="submit" value="Register and Proceed to Classes"><input name="badge" type="hidden" value="<?php echo htmlspecialchars($badge, ENT_QUOTES); ?>">
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
