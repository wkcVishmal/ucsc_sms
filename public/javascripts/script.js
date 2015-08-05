function prepareEventHandlers() {
    document.getElementById("user_form").onsubmit=function(){
        if ((document.getElementById("username").value=="") ||
        (document.getElementById("password").value=="") ||
        (document.getElementById("radio").value=="")) {
            document.getElementById("errorMsg").innerHTML="Please enter required fields!";
            return false;
        }else{
            document.getElementById("errorMsg").innerHTML="The user account was successfully created";
            return true;
        }
    };
}

window.onload=function(){
    prepareEventHandlers();
}