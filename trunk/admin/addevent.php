<?php	include('includes/security.php');?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><?php	include('includes/title-meta.htm');?><script language="JavaScript" type="text/JavaScript"><!--function MM_findObj(n, d) { //v4.01  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);  if(!x && d.getElementById) x=d.getElementById(n); return x;}function YY_checkform() { //v4.71//copyright (c)1998,2002 Yaromat.com  var a=YY_checkform.arguments,oo=true,v='',s='',err=false,r,o,at,o1,t,i,j,ma,rx,cd,cm,cy,dte,at;  for (i=1; i<a.length;i=i+4){    if (a[i+1].charAt(0)=='#'){r=true; a[i+1]=a[i+1].substring(1);}else{r=false}    o=MM_findObj(a[i].replace(/\[\d+\]/ig,""));    o1=MM_findObj(a[i+1].replace(/\[\d+\]/ig,""));    v=o.value;t=a[i+2];    if (o.type=='text'||o.type=='password'||o.type=='hidden'){      if (r&&v.length==0){err=true}      if (v.length>0)      if (t==1){ //fromto        ma=a[i+1].split('_');if(isNaN(v)||v<ma[0]/1||v > ma[1]/1){err=true}      } else if (t==2){        rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-zA-Z]{2,4}$");if(!rx.test(v))err=true;      } else if (t==3){ // date        ma=a[i+1].split("#");at=v.match(ma[0]);        if(at){          cd=(at[ma[1]])?at[ma[1]]:1;cm=at[ma[2]]-1;cy=at[ma[3]];          dte=new Date(cy,cm,cd);          if(dte.getFullYear()!=cy||dte.getDate()!=cd||dte.getMonth()!=cm){err=true};        }else{err=true}      } else if (t==4){ // time        ma=a[i+1].split("#");at=v.match(ma[0]);if(!at){err=true}      } else if (t==5){ // check this 2            if(o1.length)o1=o1[a[i+1].replace(/(.*\[)|(\].*)/ig,"")];            if(!o1.checked){err=true}      } else if (t==6){ // the same            if(v!=MM_findObj(a[i+1]).value){err=true}      }    } else    if (!o.type&&o.length>0&&o[0].type=='radio'){          at = a[i].match(/(.*)\[(\d+)\].*/i);          o2=(o.length>1)?o[at[2]]:o;      if (t==1&&o2&&o2.checked&&o1&&o1.value.length/1==0){err=true}      if (t==2){        oo=false;        for(j=0;j<o.length;j++){oo=oo||o[j].checked}        if(!oo){s+='* '+a[i+3]+'\n'}      }    } else if (o.type=='checkbox'){      if((t==1&&o.checked==false)||(t==2&&o.checked&&o1&&o1.value.length/1==0)){err=true}    } else if (o.type=='select-one'||o.type=='select-multiple'){      if(t==1&&o.selectedIndex/1==0){err=true}    }else if (o.type=='textarea'){      if(v.length<a[i+1]){err=true}    }    if (err){s+='* '+a[i+3]+'\n'; err=false}  }  if (s!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+s)}  document.MM_returnValue = (s=='');}//--></script></head><body bgcolor="#8993A3" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" alink="#0000FF" onLoad="document.form1.chrEvent.focus()"><?php	include('includes/top.htm');?><table width="698" border="0" align="center" cellpadding="0" cellspacing="0">  <tr>    <td width="10" background="images/fadeleft.gif"><img src="images/fadeleft.gif" width="10" height="1"></td>    <td bgcolor="#ffffff"><form name="form1" method="post" action="insertevent.php">      <table width="100%"  border="0" cellspacing="0" cellpadding="10">        <tr>          <td>&nbsp;</td>        </tr>        <tr>          <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">            <tr>              <td><font face="Arial, Helvetica, sans-serif" size="3"><strong>Add Event </strong></font></td>              </tr>            <tr>              <td bgcolor="#CCCCCC"><font size="1" face="Arial, Helvetica, sans-serif">To create and new event please enter the name of the event. You will directed back to the administrator page after the record has been added. </font></td>            </tr>          </table></td>        </tr>        <tr>          <td>&nbsp;</td>        </tr>        <tr>          <td><table width="100%"  border="0" cellspacing="0" cellpadding="3">            <tr>              <td><font size="1" face="Arial, Helvetica, sans-serif">Event Name<br>                  <input name="chrEvent" type="text" id="chrEvent" size="30" maxlength="50">              </font> </td>            </tr>          </table></td>        </tr>        <tr>          <td>&nbsp;</td>        </tr>        <tr>          <td><input name="Submit" type="submit" onClick="YY_checkform('form1','chrEvent','#q','0','Please enter the name of the event.');return document.MM_returnValue" value="Add Event"></td>        </tr>        <tr>          <td>&nbsp;</td>        </tr>      </table>    </form></td>    <td width="10" background="images/faderight.gif"><img src="images/faderight.gif" width="10" height="1"></td>  </tr></table><?php	include('includes/bottom.htm');?></body></html>