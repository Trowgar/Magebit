let input = document.querySelector(".subs__input").value.trim();
let error = document.querySelector(".error");
let terms = document.querySelector(".checked");
let btn = document.querySelector(".submit");

let success = document.querySelector(".success");
let subscription = document.querySelector(".subscription");

const regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,3}$/;

btn.disabled = true;
btn.style.cursor = "not-allowed";

function validate(){
    let input = document.querySelector(".subs__input").value.trim();
    
    if (input === ""){
        setError("Email address is required");
    } else if (!(regex.test(input))) {
        setError("Please provide a valid e-mail address");
    } else if (input.split('.')[input.split('.').length - 1] === 'co') {
        setError("We are not accepting subscriptions from Colombia emails");
    }else if(!terms.checked) {
        setError("You must accept the terms and conditions");
    }
    else {
        removeError();
    }
}

function setError(message){
    error.innerHTML = message;
    btn.disabled = true;
    btn.style.cursor = "not-allowed";
}

function removeError(){
    error.innerHTML = "";
    btn.disabled = false;
    btn.style.cursor = "pointer";
}

