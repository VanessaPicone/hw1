//visualizzo i miei post
const overlay = document.getElementById("overlay");
overlay.classList.add("hidden");

function fetchPost(){
    fetch("fetch_post.php").then(fetchResponse).then(fetchPostesJson);
}

function fetchResponse(response){
    if(!response.ok){
        return null;
    }
    return response.json();
}

function fetchPostesJson(json){
    console.log("Fetch");
    console.log(json);
    if (!json || !json.length) {
    noResults();
    return;
}

    const container=document.getElementById('results');
    container.innerHTML='';
    container.className='post';

    const postes = Array.isArray(json) ? json : [];

    if (!postes || postes.length === 0){
        noResults(); 
        return;
    }
    for(let post of postes){
        console.log(post);
        const card=document.createElement('div');
        card.classList.add('post');

        const img = document.createElement('img');
        img.src= post.photo;
        card.appendChild(img);

        const infoContainer = document.createElement('div');
        infoContainer.classList.add("infoContainer");
        card.appendChild(infoContainer);

        const info = document.createElement('div');
        info.classList.add("info");
        infoContainer.appendChild(info);

        //nome
        const name = document.createElement('strong');
        name.innerHTML = post.name;
        info.appendChild(name);

        //rataing
        const rating = document.createElement('p');
        rating.textContent = `Valutazione: ${post.rating}`;
        info.appendChild(rating);

        //indirizzo
        const address = document.createElement('p');
        address.innerHTML = post.address;
        info.appendChild(address);

        //description
        const description = document.createElement('p');
        description.textContent = post.description;
        description.classList.add('descrPost');
        info.appendChild(description);

        container.appendChild(card);
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


fetchPost();