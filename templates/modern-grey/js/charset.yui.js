/*
	SHChat
	(C) 2006-2014 by Scripthosting.net
	http://www.shchat.net

	Free for non-commercial use:
	Licensed under the "Creative Commons 3.0 BY-NC-SA"
	http://creativecommons.org/licenses/by-nc-sa/3.0/
	
	Support-Forum: http://board.scripthosting.net/viewforum.php?f=18
	Don't send emails asking for support!!
*/
function translate_charset(c){var b=base64_encode(c);var a=replaceAll(b,"+","%2B");return a}function replaceAll(c,b,a){c=c.toString();while(c.indexOf(b)!=-1){c=c.replace(b,a)}return c}function base64_encode(h){var d="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";var c,b,a,m,l,k,j,n,g=0,o=0,f="",e=[];if(!h){return h}h=this.utf8_encode(h+"");do{c=h.charCodeAt(g++);b=h.charCodeAt(g++);a=h.charCodeAt(g++);n=c<<16|b<<8|a;m=n>>18&63;l=n>>12&63;k=n>>6&63;j=n&63;e[o++]=d.charAt(m)+d.charAt(l)+d.charAt(k)+d.charAt(j)}while(g<h.length);f=e.join("");switch(h.length%3){case 1:f=f.slice(0,-2)+"==";break;case 2:f=f.slice(0,-1)+"=";break}return f}function utf8_encode(a){var h=(a+"");var i="";var b,e;var c=0;b=e=0;c=h.length;for(var d=0;d<c;d++){var g=h.charCodeAt(d);var f=null;if(g<128){e++}else{if(g>127&&g<2048){f=String.fromCharCode((g>>6)|192)+String.fromCharCode((g&63)|128)}else{f=String.fromCharCode((g>>12)|224)+String.fromCharCode(((g>>6)&63)|128)+String.fromCharCode((g&63)|128)}}if(f!==null){if(e>b){i+=h.substring(b,e)}i+=f;b=e=d+1}}if(e>b){i+=h.substring(b,h.length)}return i}function dump(a,g){var f="";if(!g){g=0}var e="";for(var b=0;b<g+1;b++){e+="    "}if(typeof(a)=="object"){for(var c in a){var d=a[c];if(typeof(d)=="object"){f+=e+"'"+c+"' ...\n";f+=dump(d,g+1)}else{f+=e+"'"+c+"' => \""+d+'"\n'}}}else{f="===>"+a+"<===("+typeof(a)+")"}return f};