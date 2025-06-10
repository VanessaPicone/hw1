//tendina
function onTendina(event){
    console.log("apertura tendina");
    const tendina=document.querySelector('#tendina2');
    tendina.classList.remove('hidden');
    document.body.classList.add('no-scroll');
}
function offTendina(event){
    console.log("chiusura tendina");
    const tendina=document.querySelector('#tendina2');
    tendina.classList.add('hidden');
    document.body.classList.remove('no-scroll');
}

const welcome=document.querySelector('.buttons #welcome');
welcome.addEventListener('click', onTendina);

const close=document.querySelector('#X-tendina');
close.addEventListener('click', offTendina);

//LINKS del MENU principale
function ModalsView(event){
    const targetId= this.dataset.target;
    const modal=document.getElementById(targetId);
    if(modal){
        console.log("Cliccato");
        modal.classList.remove('hidden');
    }
}
function ModalsHidden(event){
    this.classList.add('hidden');
}
const buttons=document.querySelectorAll('#links a[data-target]');
for(let i=0;i<buttons.length;i++){
    const button=buttons[i];
    button.addEventListener('click',ModalsView);
}

const modals=document.querySelectorAll('.modal');
for(let i=0;i<modals.length;i++){
    const modal=modals[i];
    modal.addEventListener('click',ModalsHidden);
}

//Bottone ACCEDI e Cambio lingua e valuta
function ModalsView1(event){
    const targetId= this.dataset.modal;
    const modal=document.getElementById(targetId);
    if(modal){
        console.log("Cliccato");
        modal.classList.remove('hidden');
        document.body.classList.add('no-scroll');
    }
}
function ModalHidden_Back(event){  //chiusura cliccando sullo sfondo
    document.body.classList.remove('no-scroll');
    this.classList.add('hidden');
}
function noModalClick(event){  //non si chiude se clicco sulla modale
    event.stopPropagation();
}


function onClickClose_Accedi(event){ //chiudo con la X-Accedi
    document.body.classList.remove('no-scroll');
    const mymodal=document.querySelector('#modal-view-Accedi');
    mymodal.classList.add('hidden');
}

function onClickClose_Cambio(event){ //chiudo con la X-Cambio
    console.log("Cliccato");
    document.body.classList.remove('no-scroll');
    const mymodal=document.querySelector('#modal-view-Cambio');
    mymodal.classList.add('hidden');
}
const buttons1=document.querySelectorAll('.buttons div[data-modal]');
for(let i=0;i<buttons1.length;i++){
    const button1=buttons1[i];
    button1.addEventListener('click', ModalsView1);
}
const modals1=document.querySelectorAll('.modal1');
for(let i=0;i<modals1.length;i++){
    const modal1=modals1[i];
    modal1.addEventListener('click',ModalHidden_Back);
    const content=modal1.querySelector('[data-content]');
    if(content){
        content.addEventListener('click', noModalClick);
    }

    const closeButton_Accedi = modal1.querySelector('#X-Accedi');
    if(closeButton_Accedi){
        closeButton_Accedi.addEventListener('click', onClickClose_Accedi);
    }
    
    const closeButton_Cambio = modal1.querySelector('#X-Cambio');
    if(closeButton_Cambio){
        closeButton_Cambio.addEventListener('click', onClickClose_Cambio); 
    }
    

}
//Tasti dentro imposto-lingua
function cambioLingua(event){
    const lingue=document.querySelectorAll('[data-lingua]');
    lingue.forEach(l=> l.classList.remove('click'));

    const lingua=event.currentTarget;
    const IT_totale = document.querySelectorAll('[data-lingua="IT"]');
    for(let i=0;i<IT_totale.length;i++){
        const IT=IT_totale[i];
        if(lingua && lingua!==IT){
            console.log('cliccato');
            lingua.classList.add('click');
            IT.classList.add('noclick');
        }
        else{
            IT.classList.remove('noclick');
        }
    }
   
}

const scegli_lingua=document.querySelectorAll('[data-lingua]');
for(let i=0;i<scegli_lingua.length;i++){
    const lingua=scegli_lingua[i];
    lingua.addEventListener('click', cambioLingua);
}

//Passo dal cambio lingua al cambio VALUTA dentro il tasto Cambio
const area=document.querySelector('#Area_Geografica');
const valuta=document.querySelector('#Valuta-view');

function changeInside(event){
    const scelta=event.currentTarget;
    console.log("cliccato");

    // Rimuove la sottolineatura da tutti
    cambio_inside.forEach(el => el.classList.remove('active'));

    // Aggiunge sottolineatura solo a quello cliccato
    scelta.classList.add('active');

    const myscelta=scelta.dataset.cambio;
    if(myscelta === 'valuta'){
        valuta.classList.remove('hidden');
        area.classList.add('hidden');
    }
    else{
        area.classList.remove('hidden');
        valuta.classList.add('hidden');
    }
}
const cambio_inside=document.querySelectorAll('[data-cambio]');
for(let i=0;i<cambio_inside.length;i++){
    const scelta=cambio_inside[i];
    scelta.addEventListener('click', changeInside);
}