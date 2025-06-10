//sezione centrale
const barra_ricerca=document.querySelector("#Ricerca .searchBar");
const ricerca=document.querySelector("#Ricerca");
const ricercaVoli=document.querySelector("#RicercaVoli");
const testo=document.querySelector("#h1");

function changeSection(event){
    const section=event.currentTarget;
    const titolo= section.dataset.titolo;
    const Bricerca=section.dataset.bricerca;

    if(section){
        console.log("Cliccato");
        testo.textContent=titolo;
        barra_ricerca.placeholder=Bricerca;
        ricerca.classList.remove('hidden');
        ricercaVoli.classList.add('hidden');

        // Rimuove la sottolineatura da tutti
        variabili.forEach(btn => btn.classList.remove('active'));
        // Aggiunge sottolineatura solo a quello cliccato
        section.classList.add('active');
    }
}
function changeSectionVolo(event){
    testo.textContent="Trova il volo migliore";
    ricerca.classList.add('hidden');
    ricercaVoli.classList.remove('hidden');
    
    //sottolineatura
    variabili.forEach(btn => btn.classList.remove('active'));
    volo.classList.add('active');
}
const variabili=document.querySelectorAll('.Varianti div[data-titolo]');
for(let i=0;i<variabili.length;i++){
    const variabile=variabili[i];
    variabile.addEventListener('click', changeSection);
}
const volo=document.querySelector('#v5 a');
volo.addEventListener('click',changeSectionVolo);

//SCORRERE ANNUNCI
const arrows_right=document.querySelectorAll('[data-arrow-right]');
const arrows_left=document.querySelectorAll('[data-arrow-left]');

function scrollRight(event){
    console.log("Cliccato");

    const this_arrowR = event.currentTarget;
    const visita = this_arrowR.closest('[data-visita]'); // prende solo il blocco corrente

    const box = visita.querySelector('[data-box="b1"]');
    const box_hidden = visita.querySelector('[data-box-new]');
    const arrow_left = visita.querySelector('[data-arrow-left]');

    box.classList.add('hidden');
    box_hidden.classList.remove('hidden');

    this_arrowR.classList.add('hidden');
    arrow_left.classList.remove('hidden');
        
}
function scrollLeft(event){
    console.log("Cliccato");

    const this_arrowL = event.currentTarget;
    const visita = this_arrowL.closest('[data-visita]'); //prende solo il blocco corrente

    const box = visita.querySelector('[data-box="b1"]');
    const box_hidden = visita.querySelector('[data-box-new]');
    const arrow_right = visita.querySelector('[data-arrow-right]');

    box.classList.remove('hidden');
    box_hidden.classList.add('hidden');

    this_arrowL.classList.add('hidden');
    arrow_right.classList.remove('hidden');
}

//MAIN

arrows_right.forEach(arrow => arrow.addEventListener('click', scrollRight));
arrows_left.forEach(arrow => arrow.addEventListener('click', scrollLeft));


//PREFERITI
function riempiCuore(event) {
    const cuore = event.currentTarget;
    const img = cuore.querySelector("img");

    const pieno = "https://img.icons8.com/metro/26/hearts.png";
    const vuoto = "https://img.icons8.com/windows/32/hearts.png";

    // Controlla lo stato attuale dell'immagine
    if (img.src === pieno) {
        img.src = vuoto;
    } else {
        img.src = pieno;
    }
}

const cuori=document.querySelectorAll('[data-cuore]');
for(let i=0;i<cuori.length;i++){
    const cuore=cuori[i];
    cuore.addEventListener('click', riempiCuore);
}
