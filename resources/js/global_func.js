export function showFlashMessage(message) {

    let flashElement = document.querySelector('#flash-message');
    flashElement.classList.add('show');
    flashElement.querySelector('span').innerHTML = message;
    // Hide the flash message after 3 seconds
    setTimeout(function () {
        flashElement.classList.remove('show');
    }, 3000);
}

