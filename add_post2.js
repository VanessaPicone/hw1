function checkImage(event) {
    console.log("check image");
    const input = event.currentTarget;
    const url = input.value.trim();
    const validUrl = /^(https?:\/\/[^\s]+)$/i;

    if (validUrl.test(url)) {
        formStatus.photo = true;
        input.parentNode.classList.remove('errorj');
    } else {
        formStatus.photo = false;
        input.parentNode.classList.add('errorj');
    }
}

function checkRating(event) {
    console.log("check rating");
    const input = event.currentTarget;
    
     const value = input.value.trim();

    if (/^[0-5]$/.test(value)) {
        formStatus.rating = true;
        input.parentNode.classList.remove('errorj');
    } else {
        formStatus.rating = false;
        input.parentNode.classList.add('errorj');
    }
}

function checkName(event) {
    console.log("check name");
    const input = event.currentTarget;

    if (input.value.trim().length > 0) {
        formStatus.name = true;
        input.parentNode.classList.remove('errorj');
    } else {
        formStatus.name = false;
        input.parentNode.classList.add('errorj');
    }
}

function checkAddress(event) {
    console.log("check name");
    const input = event.currentTarget;
    
    if (input.value.trim().length > 0) {
        formStatus.address = true;
        input.parentNode.classList.remove('errorj');
    } else {
        formStatus.address = false;
        input.parentNode.classList.add('errorj');
    }
}


const formStatus = {'upload': true};
 const photoInput = document.querySelector('.add_photo input');
    const nameInput = document.querySelector('.add_name input');
    const ratingInput = document.querySelector('.add_rating input');
    const addressInput = document.querySelector('.add_address input');

    if (photoInput) photoInput.addEventListener('blur', checkImage);
    if (nameInput) nameInput.addEventListener('blur', checkName);
    if (ratingInput) ratingInput.addEventListener('blur', checkRating);
    if (addressInput) addressInput.addEventListener('blur', checkAddress);
