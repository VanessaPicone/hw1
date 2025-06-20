/*API WEATHERSTACK rilevamento del meteo e altri paramteri, delle città
presenti nei box della sezione "Sogna il tuo prossimo viaggio",
(nell'HTML di home.php nella sezione Viaggio e Viaggio2)*/

function onJsonMeteo(json){
    console.log('JSon Ricevuto' + json);
    //svuoto
    const previsione=document.getElementById('meteo');
    //previsione.classList.remove('hidden');
    previsione.innerHTML='';
    previsione.classList.remove('hidden');
    previsione.className='meteo';

     // Controllo se la risposta è valida
    if (!json.status || !json.data || !json.data.current) {
        const errore = document.createElement('div');
        errore.textContent = `Errore: ${json.error?.info || 'Dati meteo non disponibili'}`;
        previsione.appendChild(errore);
        return;
    }
    //risultato processo
    const location = json.data.location;
    const current = json.data.current;
    //creo il contenuto
    const meteoBox=document.createElement('div');
    meteoBox.classList.add('meteo');
    //immagine meteo
    const img = document.createElement('img');
    img.src = current.weather_icons?.[0];
    img.classList.add('icona-meteo');

    // Didascalia meteo
    const caption = document.createElement('span');
    caption.innerHTML ='';
    caption.classList.add('didascalia');
    
    const nome = document.createElement('div');
    nome.textContent = `${location.name}, ${location.country}`;
    nome.classList.add('nome-meteo');

    const descr = document.createElement('div');
    descr.textContent = current.weather_descriptions[0];

    const temp = document.createElement('div');
    temp.textContent = `Temperatura: ${current.temperature} °C`;

    const umidità = document.createElement('div');
    umidità.textContent = `Umidità: ${current.humidity}%`;

    caption.appendChild(nome);
    caption.appendChild(descr);
    caption.appendChild(temp);
    caption.appendChild(umidità);

    // Aggiungiamo immagine e testo
    meteoBox.appendChild(img);
    meteoBox.appendChild(caption);
    previsione.appendChild(meteoBox);
}


function onResponseMeteo(response){
    console.log('Risposta ricevuta' + response);
    return response.json().then(json => {
        console.log("JSON parsed:", json);
        return json;
    });
}


function meteo(event){
    event.preventDefault();
    //leggo la citta del meteo
    const city=event.currentTarget;
    const city_ricerca = city.querySelector('.location');
    
    //eseguo fetch
    fetch(`meteo.php?city=${encodeURIComponent(city_ricerca.textContent.trim())}`).then(onResponseMeteo).then(onJsonMeteo);

}
//sezione Viaggio

const cities=document.querySelectorAll('.Viaggio [data-box]');
for(i=0;i<cities.length;i++){
    const city=cities[i];
    city.addEventListener('click', meteo);
}

//per il box hidden
const citiesH=document.querySelectorAll('.Viaggio [data-box-new]');
for(i=0;i<citiesH.length;i++){
    const city=citiesH[i];
    city.addEventListener('click', meteo);
}

//sezione Viaggio2
const cities2=document.querySelectorAll('.Viaggio2 [data-box]');
for(i=0;i<cities2.length;i++){
    const city=cities2[i];
    city.addEventListener('click', meteo);
}

//per il box hidden
const citiesH2=document.querySelectorAll('.Viaggio2 [data-box-new]');
for(i=0;i<citiesH2.length;i++){
    const city=citiesH2[i];
    city.addEventListener('click', meteo);
}


function chiudiModale(event){
    console.log('cliccato');
    modale.classList.add('hidden');
    modale.innerHTML='';
}
const modale=document.querySelector('#meteo');
modale.addEventListener('click',chiudiModale);

/*
//secondo API sul cambio di valuta
//mappa dei simboli
const valutaSimboli = {
    EUR: "€",      // Euro
    AFN: "؋",      // Afghani afgani
    MGA: "Ar",     // Ariary malgascio
    THB: "฿",      // Baht thailandese
    PAB: "B/.",    // Balboa panamense
    ETB: "Br",     // Birr etiope
    BOB: "Bs.",    // Boliviano boliviano
    GHS: "₵",      // Cedi ghanese
    CRC: "₡",      // Colon costaricano
    NIO: "C$",     // Cordoba nicaraguense
};

function onJson_Valuta(json,box,valuta_value,amount){
    console.log('JSon Ricevuto');
    //svuoto
    const prezzo = box.querySelector('.prezzo');
    prezzo.innerHTML='';
    const simb=box.querySelector('.simbolo');
    simb.innerHTML='';

    if (!json || !json.conversion_rates || !json.conversion_rates[valuta_value]) {
        prezzo.textContent = 'Errore nella conversione.';
        return;
    }

    const rate = json.conversion_rates[valuta_value];
    const converted = rate * amount;

    const simbolo = valutaSimboli[valuta_value] || valuta_value;
    prezzo.textContent = converted.toFixed(2);
    simb.textContent = simbolo;

}

function onResponse(response){
    console.log('Risposta ricevuta');
    return response.json();
}
    

function cambioValuta(event){
    const valute=document.querySelectorAll('#Valuta-view [data-valuta]');
    valute.forEach(v=> v.classList.remove('click'));

    const valuta=event.currentTarget;
    const IT_totale = document.querySelectorAll('[data-valuta="IT"]');
    for(let i=0;i<IT_totale.length;i++){
        const IT=IT_totale[i];
        if(valuta && valuta!==IT){
            console.log('cliccato');
            valuta.classList.add('click');
            IT.classList.add('noclick');
        }
        else{
            IT.classList.remove('noclick');
        }
    }

    //attivo l'API del cambio-valuta da cambiare nella sezione in alto cambio lingua e valuta
    //e cambierà il prezzo presente nella sezione cosa visitare a Palermo
    //leggo la valuta
    event.preventDefault();
    console.log('cambioValuta');
    const valuta_ricerca = valuta.querySelector('.lingua p');
    const valuta_value = encodeURIComponent(valuta_ricerca.textContent.trim());
    console.log('Eseguo ricerca: ' +valuta_value);
    //preparo richiesta
    rest_url = 'https://v6.exchangerate-api.com/v6/secret/latest/EUR';
    console.log('URL: ' + rest_url);
    fetch(rest_url)
        .then(onResponse)
        .then(json => {
            const tot_box = document.querySelectorAll('#annuncio2 [data-box]');
            for (let i = 0; i < tot_box.length; i++) {
                const box = tot_box[i];
                const prezzo = box.querySelector('.prezzo');
                const amount = parseFloat(prezzo.textContent.trim());

                onJson_Valuta(json, box, valuta_value, amount);
            }
        });
}

const scegli_valuta=document.querySelectorAll('#Valuta-view [data-valuta]');
for(let i=0;i<scegli_valuta.length;i++){
    const valuta=scegli_valuta[i];
    valuta.addEventListener('click', cambioValuta);
}
*/

//secondo API sul cambio di valuta
//mappa dei simboli
const valutaSimboli = {
    EUR: "€",      // Euro
    AFN: "؋",      // Afghani afgani
    MGA: "Ar",     // Ariary malgascio
    THB: "฿",      // Baht thailandese
    PAB: "B/.",    // Balboa panamense
    ETB: "Br",     // Birr etiope
    BOB: "Bs.",    // Boliviano boliviano
    GHS: "₵",      // Cedi ghanese
    CRC: "₡",      // Colon costaricano
    NIO: "C$",     // Cordoba nicaraguense
};

function onJson_Valuta(json,box,valuta_value,amount){
    console.log('JSon Ricevuto' + json);
    //svuoto
    const prezzo = box.querySelector('.prezzo');
    prezzo.innerHTML='';
    const simb=box.querySelector('.simbolo');
    simb.innerHTML='';

    if (!json || !json.status || !json.data.conversion_rates || !json.data.conversion_rates[valuta_value]) {
        prezzo.textContent = 'Errore nella conversione.';
        return;
    }

    const rate = json.data.conversion_rates[valuta_value];
    const converted = rate * amount;

    const simbolo = valutaSimboli[valuta_value] || valuta_value;
    prezzo.textContent = converted.toFixed(2);
    simb.textContent = simbolo;

}

function onResponseValuta(response){
    console.log('Risposta ricevuta: ' + response);
    return response.json().then(json => {
        console.log("JSON parsed:", json);
        return json;
    });
}
    

function cambioValuta(event){
    event.preventDefault();
    const valute=document.querySelectorAll('#Valuta-view [data-valuta]');
    valute.forEach(v=> v.classList.remove('click'));

    const valuta=event.currentTarget;
    const IT_totale = document.querySelectorAll('[data-valuta="IT"]');
    for(let i=0;i<IT_totale.length;i++){
        const IT=IT_totale[i];
        if(valuta && valuta!==IT){
            console.log('cliccato');
            valuta.classList.add('click');
            IT.classList.add('noclick');
        }
        else{
            IT.classList.remove('noclick');
        }
    }

    //attivo l'API del cambio-valuta da cambiare nella sezione in alto cambio lingua e valuta
    //e cambierà il prezzo presente nella sezione cosa visitare a Palermo
    //leggo la valuta
    console.log('cambioValuta');
    const valuta_ricerca = valuta.querySelector('.lingua p');
    const valuta_value = encodeURIComponent(valuta_ricerca.textContent.trim());
    //preparo richiesta
    fetch(`cambio_valuta.php?valuta=${valuta_value}`)
        .then(onResponseValuta)
        .then(json => {
            const tot_box = document.querySelectorAll('#annuncio2 [data-box]');
            for (let i = 0; i < tot_box.length; i++) {
                const box = tot_box[i];
                const prezzo = box.querySelector('.prezzo');
                const amount = parseFloat(prezzo.textContent.trim());

                onJson_Valuta(json, box, valuta_value, amount);
            }
        });
}

const scegli_valuta=document.querySelectorAll('#Valuta-view [data-valuta]');
for(let i=0;i<scegli_valuta.length;i++){
    const valuta=scegli_valuta[i];
    valuta.addEventListener('click', cambioValuta);
}
