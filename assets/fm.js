function myFunction(){
    if(document.getElementById("pass").value !== document.getElementById("copass").value){
        document.getElementById("errorMessage").style.color = "red";
        document.getElementById("errorMessage").innerHTML = "passwords do not match";
        event.preventDefault()
    }else{
        document.getElementById("errorMessage").innerHTML = "";
    }
}
function checkLength(){
    let passlength = document.getElementById("pass").value;
    if (passlength.length >= 6) {
    document.getElementById("length").innerHTML = ""
    }else{
    document.getElementById("length").innerHTML = "passwords must contain six characters or more"
    event.preventDefault()
    }
}
function clickBut(){
    return (fNameCheck(), lNameCheck(), emailCheck(), oNameCheck(), checkLength(), myFunction());
}
function fNameCheck() {
    let fname = document.getElementById("fname").value;
    if (fname.length >= 3) {
        document.getElementById("fName").style.color = "green"
        document.getElementById("fName").innerHTML = "Looks good"
    }else{
        document.getElementById("fName").style.color = "red"
        document.getElementById("fName").innerHTML = "Invalid First Name"
        event.preventDefault()
    }
}
function lNameCheck() {
    let lname = document.getElementById("lname").value;
    if (lname.length >= 3) {
        document.getElementById("lName").style.color = "green"
        document.getElementById("lName").innerHTML = "Looks good"
    }else{
        document.getElementById("lName").style.color = "red"
        document.getElementById("lName").innerHTML = "Invalid Last Name"
        event.preventDefault()
    }
}
function emailCheck() {
    let email = document.getElementById("Email").value;
    if (email.includes("@gmail.com")) {
        document.getElementById("email").style.color = "green"
        document.getElementById("email").innerHTML = "Looks good"
    }else{
        document.getElementById("email").style.color = "red"
        document.getElementById("email").innerHTML = "Invalid Email"
        event.preventDefault()
    }

    document.getElementById("submit").addEventListener("click", function(event){
        event.preventDefault();
        

        var xhttp = new XMLHttpRequest();
         const FD = new FormData( document.getElementById('reg') );
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
           document.getElementById("response").innerHTML = this.responseText
           
          }
        };
        xhttp.open("POST", "Welcome/register", true);
        xhttp.send(FD);
      });
}
