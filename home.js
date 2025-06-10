//ricerca hotel
const hotel=document.querySelector("#Ricerca form");
hotel.addEventListener("submit",search);

const overlay = document.getElementById("overlay");
overlay.addEventListener('click', closeModal);
document.querySelector("#Ricerca form").addEventListener("submit", search);

function closeModal(event){
  console.log("Close modal");
  event.currentTarget.classList.add("hidden");
  const card = document.querySelector('.selected');
  card.classList.remove("selected");
  card.classList.remove("unselected");
  card.querySelector('img').classList.remove("img-selected");
  card.querySelector('.infoContainer').classList.remove("infoSelected");
  const form = card.querySelector('.saveForm');
  form.classList.remove("hidden");

}

function resizeHotel(event){  
  console.log("Resize hotel");
  const track = event.currentTarget;
  // check if is already selected
  if (!event.currentTarget.classList.contains("selected")){
  overlay.classList.remove("hidden");

  event.currentTarget.classList.remove("unselected");
  event.currentTarget.classList.add("selected");
  event.currentTarget.querySelector('img').classList.add("img-selected"); 
  event.currentTarget.querySelector('.infoContainer').classList.add("infoSelected");

  // hide form inside modal
  const form = event.currentTarget.querySelector('.saveForm');
  form.classList.add("hidden");

} else {
  console.log('already selected');
}
}

function jsonHotel(json){
    //svuoto i risultati
    console.log(json);
    const container=document.getElementById('results');
    container.innerHTML='';
    container.className= 'hotels';

    const hotels = Array.isArray(json.data?.data) ? json.data.data : [];

    if (!hotels || hotels.length === 0){
        noResults(); 
        return;
    }

    for(let hotel of hotels){
        console.log(hotel);
        const card=document.createElement('div');
        card.classList.add('hotel');

        const img = document.createElement('img');
        img.src= hotel.main_photo;
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
        rating.textContent = `Valutazione: ${hotel.rating || 'N/A'}`;
        info.appendChild(rating);

        //indirizzo
        const address = document.createElement('p');
        address.innerHTML = 'Indirizzo: '+(hotel.address || 'Indirizzo non disponibile');
        info.appendChild(address);
        
        //descrizione
        const description=document.createElement('button');
        description.textContent= 'Descrizione';
        description.classList.add("descrButton");
        info.appendChild(description);
        
        const descrHotel=document.createElement('a');
        descrHotel.innerHTML= hotel.hotelDescription;
        descrHotel.classList.add("descrHotel");
        descrHotel.classList.add('hidden');
        info.appendChild(descrHotel);

        description.addEventListener('click', showDescr);

        const saveForm = document.createElement('div');
        saveForm.classList.add("saveForm");
        card.appendChild(saveForm);

        const save = document.createElement('img');
        save.src='https://img.icons8.com/windows/32/hearts.png';
        save.classList.add("img_cuore");
        saveForm.appendChild(save);
        saveForm.addEventListener('click',saveHotel);

        //salvataggio dataset
        card.dataset.id = hotel.id;
        card.dataset.name = hotel.name;
        card.dataset.info= hotel.rating;
        card.dataset.address = hotel.address;
        card.dataset.image = hotel.main_photo;

        card.classList.add("unselected");
        // aggiungiamo l'event listener per il resize
        card.addEventListener('click', resizeHotel);
        // aggiungiamo la canzone al container
        container.appendChild(card);

    }
}

function showDescr(event){
    event.stopPropagation();
    const button = event.currentTarget;            //bottone cliccato
    const descrHotel = button.parentNode.querySelector('.descrHotel');  // descrizione associata

  if (descrHotel.classList.contains('hidden')) {
    descrHotel.classList.remove('hidden');
    button.textContent = 'Nascondi';
  } else {
    descrHotel.classList.add('hidden');
    button.textContent = 'Descrizione';
  }
}

function noResults(){
    //nel caso in cui non ci siano contenuti
    const container=document.getElementById('results');
    container.innerHTML='';
    const nores=document.createElement('div');
    nores.className="loading";
    nores.textContent="Nessun risultato.";
    container.appendChild(nores);
}

function search(event){
    //evito che la pagina sia ricaricata
    event.preventDefault();
    //leggo il contenuto da cercare e lo mando al php
    const form_data= new FormData(hotel);
    const city = form_data.get('search');

    fetch(`search_content.php?city=${encodeURIComponent(city)}`).then(searchResponse).then(jsonHotel);
}

function searchResponse(response){
    console.log(response);
    //return response.json();
    return response.json().then(json => {
        console.log("JSON parsed:", json);
        return json;
    });
}


function saveHotel(event){
    event.stopPropagation();
  // Preparo i dati da mandare al server e invio la richiesta con POST
  console.log("Salvataggio")
  const cuore = event.currentTarget;
  const img = cuore.querySelector("img");

  const pieno = "https://img.icons8.com/metro/26/hearts.png";
  const vuoto = "https://img.icons8.com/windows/32/hearts.png";

  // Controlla lo stato attuale dell'immagine
  let url;
  if (img.src === pieno) {
      img.src = vuoto;
      url="remove_hotel.php";
  } else {
      img.src = pieno;
      url="save_hotel.php";
  }
  // get parent card
  const card = event.currentTarget.parentNode;
  const formData = new FormData();
  formData.append('id', card.dataset.id);
  formData.append('name', card.dataset.name);
  formData.append('rating', card.dataset.info);
  formData.append('image', card.dataset.image);
  formData.append('address', card.dataset.address);
  
  fetch(url, {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
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
