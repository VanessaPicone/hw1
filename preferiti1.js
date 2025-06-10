//hotel nei preferiti
const overlay = document.getElementById("overlay");
overlay.classList.add("hidden");

function fetchHotels(){
    fetch("fetch_hotel.php").then(fetchResponse).then(fetchHotelsJson);
}

function fetchResponse(response){
    if(!response.ok){
        return null;
    }
    return response.json();
}

function fetchHotelsJson(json){
    console.log("Fetch");
    console.log(json);
    if (!json || !json.length) {
    noResults();
    return;
}

    const container=document.getElementById('results');
    container.innerHTML='';
    container.className='hotel';

    const hotels = Array.isArray(json) ? json.map(h => h.content) : [];

    if (!hotels || hotels.length === 0){
        noResults(); 
        return;
    }
    for(let hotel of hotels){
        console.log("hotel: " + hotel);
        const card=document.createElement('div');
        card.classList.add('hotel');

        const img = document.createElement('img');
        img.src= hotel.main_photo || hotel.image;
        card.appendChild(img);

        const infoContainer = document.createElement('div');
        infoContainer.classList.add("infoContainer");
        card.appendChild(infoContainer);

        const info = document.createElement('div');
        info.classList.add("info");
        infoContainer.appendChild(info);

        //nome
        const name = document.createElement('strong');
        name.innerHTML = hotel.name;
        info.appendChild(name);

        //rataing
        const rating = document.createElement('p');
        rating.innerHTML = `Valutazione: ${hotel.rating || 'N/A'}`;
        info.appendChild(rating);

        //indirizzo
        const address = document.createElement('p');
        address.innerHTML = 'Indirizzo: '+(hotel.address || 'Indirizzo non disponibile');
        info.appendChild(address);

    // Cuore per rimuovere preferito (opzionale)
    const saveForm = document.createElement("div");
    saveForm.classList.add("saveForm1");
    const cuoreImg = document.createElement("img");
    cuoreImg.src = "https://img.icons8.com/metro/26/hearts.png"; // pieno
    cuoreImg.classList.add("img_cuore");
    saveForm.appendChild(cuoreImg);
    saveForm.addEventListener("click", removeHotel);
    card.appendChild(saveForm);


    //salvataggio dataset
    card.dataset.id = hotel.id || hotel.hotel_id;
    card.dataset.name = hotel.name;
    card.dataset.info = hotel.rating;
    card.dataset.image = hotel.main_photo || hotel.image;
    card.dataset.address = hotel.address;

        container.appendChild(card);
    }
}

// Funzione opzionale per rimuovere un hotel dai preferiti
function removeHotel(event) {
  event.stopPropagation();
  console.log("Rimozione hotel dai preferiti")
  
  const cuore = event.currentTarget;
  const img = cuore.querySelector("img");
  const vuoto = "https://img.icons8.com/windows/32/hearts.png";
  img.src=vuoto;
  // get parent card
  const card = event.currentTarget.parentNode;
  console.log("Dati hotel:", card.dataset)
  const formData = new FormData();
  formData.append('hotel_id', card.dataset.id);
  formData.append('name', card.dataset.name);
  formData.append('rating', card.dataset.info);
  formData.append('image', card.dataset.image);
  formData.append('address', card.dataset.address);
  
  fetch('remove_hotel.php', {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
}
function dispatchResponse(response) {
  console.log(response);
  return response.json().then(databaseResponse); 
}

function dispatchError(error) { 
  console.log("Errore");
}

function databaseResponse(json) {
  if (!json.ok) {
      dispatchError();
      return null;
  }
  console.log("Json ricevuto:" +json);
}

function noResults() {
    // Definisce il comportamento nel caso in cui non ci siano contenuti da mostrare
    const container = document.getElementById('results');
    container.innerHTML = '';
    const nores = document.createElement('div');
    nores.className = "nores";
    nores.textContent = "Nessun risultato.";
    container.appendChild(nores);
}


fetchHotels();

/*
const overlay = document.getElementById("overlay");
overlay.classList.add("hidden");

function fetchHotels(){
    fetch("fetch_hotel.php").then(fetchResponse).then(fetchHotelsJson);
}

function fetchResponse(response){
    if(!response.ok){
        return null;
    }
    return response.json();
}

function fetchHotelsJson(json){
  const container = document.getElementById("results");
  container.innerHTML = '';

  if (!json || json.length === 0) {
    noResults(); 
    return;
  }

  for (const entry of json) {
    console.log("hotel: " + entry);
        const card=document.createElement('div');
        card.classList.add('hotel');

        const img = document.createElement('img');
        img.src= hotel.main_photo || hotel.image;
        card.appendChild(img);

        const infoContainer = document.createElement('div');
        infoContainer.classList.add("infoContainer");
        card.appendChild(infoContainer);

        const info = document.createElement('div');
        info.classList.add("info");
        infoContainer.appendChild(info);

        //nome
        const name = document.createElement('strong');
        name.innerHTML = hotel.name;
        info.appendChild(name);

        //rataing
        const rating = document.createElement('p');
        rating.innerHTML = `Valutazione: ${hotel.rating || 'N/A'}`;
        info.appendChild(rating);

        //indirizzo
        const address = document.createElement('p');
        address.innerHTML = 'Indirizzo: '+(hotel.address || 'Indirizzo non disponibile');
        info.appendChild(address);

        card.appendChild(info);

    // Cuore per rimuovere preferito (opzionale)
    const saveForm = document.createElement("div");
    saveForm.classList.add("saveForm");
    const cuoreImg = document.createElement("img");
    cuoreImg.src = "https://img.icons8.com/metro/26/hearts.png"; // pieno
    cuoreImg.classList.add("img_cuore");
    saveForm.appendChild(cuoreImg);
    saveForm.addEventListener("click", removeHotel);
    card.appendChild(saveForm);

    container.appendChild(card);
  }
}

// Funzione opzionale per rimuovere un hotel dai preferiti
function removeHotel(event) {
  event.stopPropagation();
  console.log("Rimozione hotel dai preferiti")
  const cuore = event.currentTarget;
  const img = cuore.querySelector("img");

  // get parent card
  const card = event.currentTarget.parentNode;
  const formData = new FormData();
  formData.append('id', card.dataset.id);
  formData.append('name', card.dataset.name);
  formData.append('rating', card.dataset.rating);
  formData.append('image', card.dataset.img);
  formData.append('address', card.dataset.address);
  
  fetch('remove_hotel.php', {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
}
function dispatchResponse(response) {
  console.log(response);
  return response.json().then(databaseResponse); 
}

function dispatchError(error) { 
  console.log("Errore");
}

function databaseResponse(json) {
  if (!json.ok) {
      dispatchError();
      return null;
  }
}


function noResults() {
    // Definisce il comportamento nel caso in cui non ci siano contenuti da mostrare
    const container = document.getElementById('results');
    container.innerHTML = '';
    const nores = document.createElement('div');
    nores.className = "nores";
    nores.textContent = "Nessun risultato.";
    container.appendChild(nores);
}

fetchHotels();
*/
