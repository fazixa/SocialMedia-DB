// JavaScript Document
function do_register(){
	var u=document.getElementById("username");
	var p=document.getElementById("password");
	var e=document.getElementById("email");
	var s=document.getElementById("selection");
	var a=document.getElementById("answer");
	if(u.value==""){
		alert("Enter your username please");
		u.focus();
		return false;
	}else if(p.value==""){
		alert("Enter your password please");
		p.focus();
		return false;
	}else if(e.value==""){
		alert("Enter your email please");
		e.focus();
		return false;
	}else if(s.value==0){
		alert("Select your question please");
		s.focus();
		return false;
	}else if(a.value==""){
		alert("Enter your answer please");
		a.focus();
		return false;
	}
	
	
	
}





function foo() {
   alert("Submit button clicked!");
   return true;
}
//end of func