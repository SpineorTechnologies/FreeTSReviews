var PU=PU||{};PU.isOpen=!1,PU.setCookie=function(e,o,i){var n="";if(days){var t=new Date;t.setTime(t.getTime()+i),n="; expires="+t.toUTCString()}document.cookie=e+"="+o+n+"; path=/"},PU.getCookie=function(e){for(var o=e+"=",i=document.cookie.split(";"),n=0;n<i.length;n++){for(var t=i[n];" "==t.charAt(0);)t=t.substring(1,t.length);if(0==t.indexOf(o))return t.substring(o.length,t.length)}return null},PU.eraseCookie=function(e){PU.setCookie(e,"",-1)},PU.puWindow=function(e){!function(e){try{var o=e.window.open("about:blank");o&&o.close()}catch(e){}try{e.opener.window.focus()}catch(e){}}(e)},PU.puTab=function(e){var o=window.open(e,e,"width=800,height=600,toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizeable=1,alwaysLowered=yes");o.blur(),o.opener.window.focus(),window.self.window.focus(),window.focus()},PU.puSimple=function(e){try{e.blur()}catch(e){}window.focus()},PU.puOpen=function(e,o,i){window.location.href;var n={ie:!!/msie|trident/i.test(navigator.userAgent),oldIE:!!/msie/i.test(navigator.userAgent),ff:!!/firefox/i.test(navigator.userAgent),o:!!/opera/i.test(navigator.userAgent),g:!!/chrome/i.test(navigator.userAgent),w:!!/webkit/i.test(navigator.userAgent),fl:!!navigator.mimeTypes["application/x-shockwave-flash"]};if(!0===n.g)window.open("javascript:window.focus()","_self",""),PU.puTab(e);else if(!0===n.ie){var t=window.open(e,o,i);PU.puSimple(t)}else{var r=window.open(e,o,i);PU.puWindow(r)}},PU.open=function(e,o){var i="width="+o.width+",height="+o.height+",toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizeable=1,alwaysLowered=yes";return PU.puOpen(e,o.cookie,i),PU.isOpen=!0,!0},PU.switchOpen=function(e,o,i){var n="width="+i.width+",height="+i.height+",toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizeable=1,alwaysLowered=yes";return winname="win_"+Math.floor(100*Math.random()+1),popwin=window.open(e,winname,n),popwin&&setTimeout(function(){window.location.href=o},300),PU.isOpen=!0,!0},window.PU=PU;