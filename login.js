/*La modal-view accedi rimane visibile se è presente un errore nell'inserimento della pagina */
const errore = document.querySelector('.error');
const modal = document.getElementById('modal-view-Accedi');
const username = document.querySelector("input[name='username']");
const password = document.querySelector("input[name='password']");


if (errore && modal) {
    modal.classList.remove('hidden');

    if (username) username.value = '';
    if (password) password.value = '';
}