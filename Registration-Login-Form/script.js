
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

function validateForm() {
    var x = document.forms["myForm"]["name"].value;

    if (x == "") {

        alert("Name must be filled out");
        return false;
    }
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var y = document.forms["myForm"]["email"].value;
    if (!(re.test(document.forms["myForm"]["email"].value))) {
        alert("Email must be valid");
        return false;
    }
    if (y == "") {
        alert("Email must be filled out");
        return false;
    }
    if(!re.test(y))
        return false;
    var z =document.getElementById("password").value;
    if (z == "") {
        alert("Password must be filled out");
        return false;
    }
    var s = document.getElementById("password1").value;
    if (s == "") {
        alert("Confirm your password please");
        return false;
    }
    if(s!=z)
    {
        alert("Your password doesnt match !");
        return false;
    }


}
function validateForm1(){
    var y = document.forms["myForm2"]["email2"].value;
    if (y == "") {
        alert("Email must be filled out");
        return false;
    }
    var z =document.getElementById("password2").value;
    if (z == "") {
        alert("Password must be filled out");
        return false;
    }
}