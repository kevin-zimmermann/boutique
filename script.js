const nom = document.getElementById('nom');
const prenom = document.getElementById('prenom');
const email = document.getElementById('email');
const phone = document.getElementById('phone')
const password = document.getElementById('password');
const confPassword = document.getElementById('confpassword');
var checkvalid = true;

$(document).ready(function () {
    $(".form-ajax").submit(function (e) {
        e.preventDefault();
        if ($(this).find("[name=type]").val() === "inscription") {
            checkInputs();
        }

        if (checkvalid){
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "json",
                success: (data) => {
                    console.log(data)
                    if (data[1].length) {
                        $(".error").html(renderHtml(data[1]))
                    } else {
                        location.replace(data[0])

                    }
                },
                error: (error) => {
                    console.log(error.responseText)
                },
            })
        }

    })
})

function renderHtml(errors)
{
    let output = "";
    if(errors.length === 1)
    {
        output = errors[0];
    }
    else
    {
        output += "<ul>";
        errors.forEach((value) => {
            output += "<li>" + value + "</li>";
        });
        output += "</ul>";
    }
    return output;
}

function checkInputs() {
    const nomValue = nom.value.trim();
    const prenomValue = prenom.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const phoneValue = phone.value.trim();
    const confPasswordValue = confPassword.value.trim();

    if (nomValue === '') {
        setErrorFor(nom, 'Le nom ne peut pas être vide');
        checkvalid = false;
    } else {
        setSuccessFor(nom);
    }
    if (prenomValue === '') {
        setErrorFor(prenom, 'Le prenom ne peut pas être vide');
        checkvalid = false;
    } else {
        setSuccessFor(prenom);
    }

    if (emailValue === '') {
        setErrorFor(email, " l'adresse email vide");
        checkvalid = false;
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Adresse mail non valide');
        checkvalid = false;
    } else {
        setSuccessFor(email);
    }
    if (phoneValue === ""){
        setErrorFor(phone, 'Votre numéro de téléphone ne doit être vide');
        checkvalid = false;
    } else if (!isphone(phoneValue)) {
        setErrorFor(phone, 'Votre numéro ne correspond pas à la norme');
        checkvalid = false;

    }

    if (passwordValue === "") {
        setErrorFor(password, 'le mot de passe ne peut pas être vide');
        checkvalid = false;
    } else if (!ismdp(passwordValue)) {
        setErrorFor(password, 'Votre mdp ne correspond pas à la norme ( un caractère en majuscule, en minuscule, un nombre et un caractère spécial au minimum (min: 6 caractères, max:20 caractères))');
        checkvalid = false;
    } else {
        setSuccessFor(password);
    }

    if (confPasswordValue === '') {
        setErrorFor(confPassword, 'La confirmation du mot de passe ne peut pas être vide');
        checkvalid = false;
    } else if (passwordValue !== confPasswordValue) {
        setErrorFor(confPassword, 'les mdp ne correspondent pas ');
        checkvalid = false;
    } else {
        setSuccessFor(confPassword);
    }

}

function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    formControl.className = 'form-control error';
    small.innerText = message;
}

function setSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-control success';
}

function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function ismdp(password) {
    return /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/.test(password);
}

function isphone(phone){
    return /^(06|07)[0-9]{8}/.test(phone);
}

