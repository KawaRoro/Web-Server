const buttonContact = document.getElementById('button-3'); // button 

function checkInputName(valName) {
    var email = document.getElementById("email").value;
    var name = valName;

    checkValidForm(name, email);
}

function checkInputEmail(valName) {
    var email = valName;
    var name = document.getElementById("name").value;

    checkValidForm(name, email);
}

function validForm() {
    
    if (email.indexOf('@') != -1) {
        document.getElementById("button-ok").disabled = false;
        //alert("Votre demande a bien été prise en compte, vous serez contacté très prochainement");
        document.getElementById("contact-us").innerHTML = "Déjà contacté";
        /*document.getElementById("contact-us").className = "form-done";
        document.getElementById("name").disabled = true;
        document.getElementById("email").disabled = true;
        document.getElementById("button-ok").disabled = true;*/
    } else {
        alert("Le format de l'adresse mail n'est pas correcte");
    }
    //resetForm();
}

function resetForm() {
    document.getElementById("email").value = "";
    document.getElementById("name").value = "";
}

function checkValidForm(name, email) {
    if (name != "" && email != "") {
        document.getElementById("button-ok").disabled = false;
    } else {
        document.getElementById("button-ok").disabled = true;
    }
}

/*buttonContact.addEventListener('onmouseover', function (event) {
    alert("là");
    if (document.getElementById("name").value != "" && document.getElementById("email").value != "") {
        document.getElementById("button-ok").disabled = false;
        //validForm();
    } else {
        document.getElementById("button-ok").disabled = true;
        //validForm();
    }
});

document.getElementById("email").addEventListener('keyup', function (event) {
    if(document.getElementById("name").value != "" && document.getElementById("email").value != ""){
        document.getElementById("button-ok").disabled = false;
        //validForm();
    }else{
        document.getElementById("button-ok").disabled = true;
    }
});*/