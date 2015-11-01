function prepareEventHandlers() {
    document.getElementById("stud_reg").onsubmit=function(){
        if ((document.getElementById("name").value=="") ||
        (document.getElementById("nwi").value=="") ||
        (document.getElementById("reg_no").value=="") ||
        (document.getElementById("index").value=="") ||
        (document.getElementById("address").value=="") ||
        (document.getElementById("contact_no").value=="") ||
        (document.getElementById("email").value=="") ||
        (document.getElementById("dob").value=="")
        ) {
            document.getElementById("errorMsg").innerHTML="Please enter required fields!";
            return false;
        }else{
            document.getElementById("errorMsg").innerHTML="Request successfuly";
            return true;
        }
    };
}

window.onload=function(){
    prepareEventHandlers();
}