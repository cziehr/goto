/*
 *@author    Myron Turner <turnermm02@shaw.ca> 
*/
function goto_redirect(which,mode) { 

     if(mode == 'extern') {
         location.href = which;
         return;
     }
	 var user = goto_getCookie("GOTO_LOGIN");      
      if(!user) {
          return;
      }   	 
      clearTimeout(goto_tm);
      if(mode == 'user')  {        
       which = which.replace(/user/, user);
      }
      location.href = which;

      clearTimeout(goto_tm);
      setGotoCookie("GOTO_LOGIN", "") ;
}
function goto_getCookie(name) {
    var re = new RegExp(name + "=([^;]+)");
    var value = re.exec(document.cookie);
    return (value != null) ?decodeURIComponent(value[1]) : null;
}

function setGotoCookie(cname, cvalue) {
    var d = new Date();  
    d.setTime(d.getTime() - (60*60*1000)); //60 minutes 
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path="+DOKU_BASE;    
}

jQuery( document ).ready(function() {
     if(JSINFO['update_version'] > 50) {
      var domval = window.document.getElementById("goto_go").innerHTML;
          var ar = domval.split(';');   
      if(ar) {      
         var url = ar[0]; var delay = ar[1];
         setTimeout(function(){ location.href = url; }, delay,url);
         return;
        }
      }
	  var which = goto_getCookie("GOTO_LOGIN");      
  
      if(!which) {
          return;
      }   
	   location.href = DOKU_BASE + 'doku.php?id=' + decodeURIComponent(which) ;
	   setGotoCookie("GOTO_LOGIN", "") ;
});