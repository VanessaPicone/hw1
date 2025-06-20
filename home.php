<?php
   require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
    //carico le informazioni
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    //info utente
    $query = "SELECT * FROM users WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1);  
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>TripAdvisor</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link href = "fonts/TripAdvisor/stylesheet.css" rel = "stylesheet" type = "text/css" />-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="mhw3.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="funzionalità.css">
    <script src="funzionalità.js" defer></script>
    <script src="menu.js" defer></script>
    <script src="home.js" defer></script>
    <script src="mhw3-API1.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div id="overlay"></div>
    <header>
      <nav class="menu">
        <div id="newMenu">
          <div class="tendina">
            <img src="https://img.icons8.com/ios/50/menu--v1.png">
          </div>
          <div id="logo1">
            <img src="https://static.tacdn.com/img2/brand_refresh/Tripadvisor_lockup_horizontal_secondary_registered.svg">
          </div>
          <div id="accedi">
           <img src="https://img.icons8.com/windows/32/user-male-circle.png">
          </div>
        </div>
        <div id="links">
          <a id="b1" data-target="link1-view"><strong>Scopri</strong></a>
          <a id="b2" data-target="link2-view"><strong>Viaggi</strong></a>
          <a id="b3" data-target="link3-view"><strong>Recensioni</strong></a>
          <a id="b4" data-target="link4-view"><strong>Altro</strong></a>
        </div>

        <div id="link1-view" class="modal hidden">
          <div class="casella1">
            <div class="modal-text">
              <a>Travellers' Choice</a>
              <a>Storie di viaggio</a>
            </div>
          </div>
        </div>

        <div id="link2-view" class="modal hidden">
          <div class="casella2">
            <div class="modal-text">
              <a>Vedi i tuoi viaggi</a>
              <a>Inizia un nuovo viaggio</a>
              <a>Crea un viaggio con l'Intelligenza artificiale (AI)</a>
            </div>
          </div>
        </div>
        
        <div id="link3-view" class="modal hidden">
          <div class="casella3">
            <div class="modal-text">
              <a>Scrivi una recensione</a>
              <a>Pubblica una foto</a>
              <a id="post" href="add_post.php">Aggiungi un luogo</a>
            </div>
          </div>
        </div>
        <div id="link4-view" class="modal hidden">
          <div class="casella4">
            <div class="modal-text">
              <a>Crociere</a>
              <a>Autonoleggio</a>
              <a>Forum</a>
            </div>
          </div>
        </div>

          <div class="buttons">
            <div id="button1" data-modal="modal-view-Cambio">
              <img src="https://img.icons8.com/ios-glyphs/30/globe-earth--v1.png">
              <img src="https://img.icons8.com/ios/50/vertical-line.png">
              <a><strong>EUR</strong></a>
            </div>
            <div id="welcome" ><a>Benvenuto,</a>
              <a><?php echo htmlspecialchars($userinfo['username']); ?></a>
            </div>
<!-- Tendina-->
            <div id="tendina2" class="hidden">
              <div class="struttura"> 
                <div id="X-tendina"><i class="fa-solid fa-x"></i></div>
                <h1><?php echo htmlspecialchars($userinfo['username']); ?></h1>
                <a id="home" href="home.php">Home</a>
                <a>Il mio profilo</a>
                <a id="preferiti" href="preferiti.php">I miei preferiti</a>
                <a id="post" href="my_post.php">I miei post</a>
                <a id="logout" href="logout.php">Logout ->||</a>
              </div>
            </div>

<!-- Cambio valuta e lingua-->
            <div id="modal-view-Cambio" class="modal1 hidden">
              <div class="modal-content-Cambio" data-content="modal-content">
                <div id="X-Cambio"><i class="fa-solid fa-x"></i></div>
                <h2>Preferenze</h2>
                <div id="sottotitolo">
                  <div id="button_area"  data-cambio="area" class="active"><p>Area georgrafica e lingua</p></div>
                  <div id="button_valuta" data-cambio="valuta"><p>Valuta</p></div>
                </div>
                <div id="Area_Geografica">
                  <h3><strong>Scegli l'area geografica e la lingua</strong></h3>
                  <div id="Area">
                    <div id="riga">
                     <div class="linguaIT" data-lingua="IT">
                        <h3>Italia</h3>
                        <p>Italiano</p>
                      </div>
                      <div class="lingua" data-lingua>
                        <h3>Argentina</h3>
                        <p>Español</p>
                      </div>
                      <div class="lingua" data-lingua>
                        <h3>Australia</h3>
                        <p>English</p>
                      </div>
                      <div class="lingua" data-lingua>
                        <h3>België</h3>
                        <p>Nederlands</p>
                      </div>
                      <div class="lingua" data-lingua>
                        <h3>Belgique</h3>
                        <p>Français</p>
                      </div>
                    </div>
                    <div id="riga">
                      <div class="lingua" data-lingua>
                        <h3>Brasil</h3>
                        <p>Português</p>
                      </div>
                      <div class="lingua" data-lingua>
                        <h3>Canada (English)</h3>
                        <p>English</p>
                      </div>
                      <div class="lingua" data-lingua>
                        <h3>Canada (Français)</h3>
                        <p>Français</p>
                      </div>
                      <div class="lingua" data-lingua>
                        <h3>Chile</h3>
                        <p>Español</p>
                      </div>
                      <div class="lingua" data-lingua>
                        <h3>Colombia</h3>
                        <p>Español</p>
                      </div>
                    </div>
                  </div>
                  <footer>
                    <p>Eventuali modifiche alle preferenze sono facoltative e verranno mantenute per l'intera sessione utente.</p>
                  </footer>
                </div>
                <div id="Valuta-view" class="hidden">
                  <h3><strong>Scegli la valuta</strong></h3>
                  <div id="Area">
                    <div id="riga">
                      <div class="lingua linguaIT" data-valuta="IT">
                        <h3>Euro</h3>
                        <p>EUR</p>
                      </div>
                      <div class="lingua" data-valuta>
                        <h3>Afghani afgani</h3>
                        <p>AFN</p>
                      </div>
                      <div class="lingua" data-valuta>
                        <h3>Ariary malgascio</h3>
                        <p>MGA</p>
                      </div>
                      <div class="lingua" data-valuta>
                        <h3>Baht thailandese</h3>
                        <p>THB</p>
                      </div>
                      <div class="lingua" data-valuta>
                        <h3>Balboa panamense</h3>
                        <p>PAB</p>
                      </div>
                    </div>
                    <div id="riga">
                      <div class="lingua" data-valuta>
                        <h3>Birr etiope</h3>
                        <p>ETB</p>
                      </div>
                      <div class="lingua" data-valuta>
                        <h3>Boliviano boliviano</h3>
                        <p>BOB</p>
                      </div>
                      <div class="lingua" data-valuta>
                        <h3>Cedi ghanese</h3>
                        <p>GHS</p>
                      </div>
                      <div class="lingua" data-valuta>
                        <h3>Colon costaricano</h3>
                        <p>CRC</p>
                      </div>
                      <div class="lingua" data-valuta>
                        <h3>Cordoba nicaraguense</h3>
                        <p>NIO</p>
                      </div>
                    </div>
                  </div>
                  <footer>
                    <p>Eventuali modifiche alle preferenze sono facoltative e verranno mantenute per l'intera sessione utente.</p>
                  </footer>
                </div>
              </div>
              
              </div>
            </div>
          </div>
        </div>
      </nav>

      <h1 id="h1"><strong>Dove vuoi andare?</strong><br/></h1>
        <div class="Varianti">
          <div id="v1" 
            data-titolo="Dove vuoi andare?" 
            data-Bricerca="Luoghi da visitare, cose da fare, hotel..." 
            class="active">
            <img id="icone" src="https://img.icons8.com/fluency-systems-regular/48/home--v1.png"> 
            <a>Cerca tutto</a> 
          </div>
          <div id="v2" 
                data-titolo="Prenota un soggiorno unico" 
                data-Bricerca="Nome hotel o destinazione" >
            <img id="icone" src="https://img.icons8.com/windows/32/occupied-bed.png">
            <a>Hotel</a>
          </div>
          <div id="v3" 
          data-titolo="Dedicati a qualcosa di divertente" 
          data-Bricerca="Attrazione, attività o destinazione" >
            <img id="icone" src="https://img.icons8.com/material-outlined/24/camera--v2.png"> 
            <a>Attività</a>
          </div>
          <div id="v4" 
          data-titolo="Trova ristoranti" 
          data-Bricerca="Ristorante o destinazione" >
           <img id="icone" src="https://img.icons8.com/windows/32/dining-room.png"> 
            <a>Ristoranti</a>
          </div>
          <div id="v5">
            <img id="icone" src="https://img.icons8.com/ios/50/airport.png"> 
            <a>Voli</a>
          </div>
          <div id="v6" 
          data-titolo="Scopri alloggi in locazione" 
          data-Bricerca="Località">
            <img id="icone" src="https://img.icons8.com/windows/32/key.png">
            <a>Case vacanza</a>
          </div>
        </div>

        <section id="Ricerca">
          <form autocomplete="off">
           <div class="Cerca">
              <img id="icona" src="https://img.icons8.com/fluency-systems-filled/48/search.png">
              <input type="text" name="search" class="searchBar" placeholder="Hotel, case vacanze...">  
            </div>
              <input type="submit" value="Ricerca">
          </form>
        </section>

        <div id="RicercaVoli" class="hidden">
          <div id="RV">
            <div class="Cerca">
              <img id="icona" src="https://img.icons8.com/fluency-systems-regular/48/airplane-take-off.png">
              <p><strong>Da:</strong></p>
              <p>Partenza</p>
            </div>
            <div class="Cerca">
              <img id="icona" src="https://img.icons8.com/fluency-systems-regular/48/airplane-landing.png">
              <p><strong>Da:</strong></p>
              <p>Destinazione</p>
              </div>
              <div class="Info">
                <img id="icona" src="https://img.icons8.com/material-outlined/24/planner.png"/>
                  <p><strong>17 apr -> 24 apr</strong></p>
                </div>
                <div class="Info">
                  <img id="icona" src="https://img.icons8.com/windows/32/queue.png"/>
                    <p><strong>1 viaggiatore</strong></p>
              </div>
           <div id="buttonRicerca"><strong>Ricerca</strong></div>
          </div>
        </div>

      </header>

      <section class="container">

        <div id="results">

        </div>

      </section> 

      <section>
        <div class="IA">
          <div class="testoCompleto">
          <spam class="supporto">
            <div><strong>Supportato dall'IA</strong></div>
            <div id="button2"><strong>BETA</strong></div>
          </spam>
          <div id="testo"><strong>Pianifica il tuo viaggio</strong></div>
          <div id="testo2"><strong>Ricevi consigli per tutto ciò che ti interessa con l'AI trip planner.</strong></div>
          <div id="link1"><strong>&#9733 Inizia un viaggio con l'IA</strong></div>
          <link href="/TripBuilder">
        </div>
        </div>
      </section>

      <article class="Litorale" data-visita>
        <h3><strong>Esplora i litororali più incantevoli al mondo</strong></h3>
        <div id="sottotitolo">Spiagge vincitrici dei premi Travellers' Choice Best of the Best 2025</div>
        <div id="freccia" data-arrow-right>
          <img  src="https://img.icons8.com/ios/50/right--v1.png"></img>
        </div>
      <div id="annunci">
        <div id="box" data-box="b1">
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2e/c1/4f/f7/caption.jpg?w=800&h=-1&s=1">
          <div id="testo1"><strong>Mondo</strong></div>
        </div>
        <div id="box" data-box="b2">
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2e/c1/50/7b/caption.jpg?w=800&h=-1&s=1">
          <div id="testo1"><strong>Europa</strong></div>
        </div>
        <div id="box" data-box="b3">
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2e/c1/50/f6/caption.jpg?w=800&h=-1&s=1">
          <div id="testo1"><strong>Asia</strong></div>
        </div>
        <div id="box" data-box="b4">
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2e/c1/51/0b/caption.jpg?w=800&h=-1&s=1">
          <div id="testo1"><strong>Sud Pacifico</strong></div>
        </div>
        <div id="box" class="hidden" data-box-new>
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2e/c1/51/9a/caption.jpg?w=600&h=-1&s=1">
          <div id="testo1"><strong>Caraibi</strong></div>
        </div>
      </div>
      <div id="freccia-left" class="hidden" data-arrow-left>
        <img  src="https://img.icons8.com/ios/50/left--v1.png"></img>
      </div>
      </article>


      <article class="visite" data-visita>
        <h3><strong>Opzioni per visitare: Palermo</strong></h3>
        <div id="sottotitolo">Prenota questa esperienza per visistare Palermo da vicino.</div>
        <div id="freccia" data-arrow-right>
          <img  src="https://img.icons8.com/ios/50/right--v1.png"></img>
        </div>
       
      <div id="annuncio2">
        <ul id="visita" data-box="b1">
          <li>
            <div class="foto-container">
              <div data-cuore><img id="cuore" src="https://img.icons8.com/windows/32/hearts.png"/></div>
              <img id="foto2" src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/65/0d/71/caption.jpg?w=600&h=600&s=1">
            </div></li>
            <li><p><strong>Agrigento e Piazza Armerina da Palermo</strong></p></li>
            <li><div class="recensioni">
              <p>4,6</p>
              <div id="cerchio"></div>
              <div id="cerchio"></div>
              <div id="cerchio"></div>
              <div id="cerchio"></div>
              <div id="cerchio"></div>
              <p>(61)</p></div></li>
            <li><p id="descr">a partire da:</p><p class="simbolo">€</p><p class="prezzo">122</p><p id="descr1"> per adulto</p></li>
        </ul>
        <ul id="visita" data-box="b2">
          <li>
            <div class="foto-container">
              <div data-cuore><img id="cuore" src="https://img.icons8.com/windows/32/hearts.png"/></div>
              <img id="foto2" src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2a/50/60/72/caption.jpg?w=600&h=600&s=1">
            </div></li>
          <li><p><strong>Tour a piedi di Palermo privato</strong></p></li>
          <li><div class="recensioni">
            <p>4,9</p>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <p>(605)</p></div></li>
          <li><p id="descr">a partire da:</p><p class="simbolo">€</p><p class="prezzo">33</p><p id="descr1"> per adulto</p></li>
          </ul>
        <ul id="visita" data-box="b3">
          <li>
            <div class="foto-container">
              <div data-cuore><img id="cuore" src="https://img.icons8.com/windows/32/hearts.png"/></div>
              <img id="foto2" src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/8e/68/a0/caption.jpg?w=600&h=600&s=1">
            </div></li>
          <li><p><strong>Palazzo Conte Federico </strong></p></li>
          <li><div class="recensioni">
            <p>4,9</p>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <p>(300)</p></div></li>
          <li><p id="descr">a partire da:</p><p class="simbolo">€</p><p class="prezzo">15</p><p id="descr1"> per adulto</p></li>
        </ul>
        <ul id="visita" data-box="b4">
          <li>
            <div class="foto-container">
              <div data-cuore><img id="cuore" src="https://img.icons8.com/windows/32/hearts.png"/></div>
              <img id="foto2" src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1d/64/7f/34/caption.jpg?w=600&h=600&s=1">
            </div></li>
          <li><p><strong>SICILIA-Tour Culura & Sapori 8 giorni/7 notti </strong></p></li>
          <li><div class="recensioni">
            <p>5</p>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <p>(60)</p></div></li>
          <li><p id="descr">a partire da:</p><p class="simbolo">€</p><p class="prezzo">1400</p><p id="descr1"> per adulto</p></li>
        </ul>
        <ul id="visita" class="hidden" data-box-new>
          <li>
            <div class="foto-container">
              <div data-cuore><img id="cuore" src="https://img.icons8.com/windows/32/hearts.png"/></div>
              <img id="foto2" src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/9a/d6/ed/caption.jpg?w=600&h=600&s=1">
            </div></li>
          <li><p><strong>Tour serale a piedi degli eroi antimafia "Beat the Heat".</strong></p></li>
          <li><div class="recensioni">
            <p>5</p>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <div id="cerchio"></div>
            <p>(17)</p></div></li>
          <li><p id="descr">a partire da:</p><p class="simbolo">€</p><p class="prezzo">30</p><p id="descr1"> per adulto</p></li>
        </ul>
      </div>
      <div id="freccia-left" class="hidden" data-arrow-left>
        <img  src="https://img.icons8.com/ios/50/left--v1.png"></img>
      </div>
      </article>

      <section class="Esplorare" data-visita>
        <h3><strong>Altro da esplorare</strong></h3>
        <div id="freccia" data-arrow-right>
          <img  src="https://img.icons8.com/ios/50/right--v1.png"></img>
        </div>
      <div class="annuncio3">
        <div id="visita2" data-box="b1">
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/27/d5/74/caption.jpg?w=1000&h=800&s=1">
          <p><strong>Una giornata perfetta a Napoli</strong></p>
        </div>
        <div id="visita2" data-box="b2">
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/7a/19/95/caption.jpg?w=1000&h=800&s=1">
          <p><strong>Tre giornate perfette a Madrid</strong></p>
        </div>
        <div id="visita2" data-box="b3">
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/7a/1c/1f/caption.jpg?w=1000&h=800&s=1">
          <p><strong>Visiti Firenze con i bambini? Inizia da qui</strong></p>
        </div>
        <div id="visita2" class="hidden" data-box-new>
          <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/28/68/8d/72/caption.jpg?w=800&h=600&s=1">
          <p><strong>Le gite di un giorno migliori da Parigi in treno</strong></p>
        </div>
      </div>
      <div id="freccia-left" class="hidden" data-arrow-left>
        <img  src="https://img.icons8.com/ios/50/left--v1.png"></img>
      </div>
    </section>

    <article class="Viaggio" data-visita>
      <h3><strong>Sogna il tuo prossimo viaggio</strong></h3>
      <div id="sottotitolo"><strong>Le mete preferite per la tua prossima vacanza</strong></div>
      <div id="freccia" data-arrow-right>
        <img  src="https://img.icons8.com/ios/50/right--v1.png"></img>
      </div>
    <div id="annunci">
      <div id="box" data-box="b1">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1c/c9/6c/08/caption.jpg?w=800&h=800&s=1">
        <div id="testo1"><strong><p class="location">Rome</p>, Italy</strong></div>
      </div>
      <div id="box" data-box="b2">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/15/6d/d6/paris.jpg?w=800&h=800&s=1">
        <div id="testo1"><strong><p class="location">Paris</p>, France</strong></div>
      </div>
      <div id="box" data-box="b3">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2a/34/2d/28/caption.jpg?w=800&h=800&s=1&cx=662&cy=604&chk=v1_8984ddf3493edfb8c896">
        <div id="testo1"><strong><p class="location">Las Vegas</p>, NV</strong></div>
      </div>
      <div id="box" data-box="b4">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/27/84/4d/17/caption.jpg?w=800&h=800&s=1"> 
        <div id="testo1"><strong><p class="location">Reykjavik</p>, Iceland</strong></div>
      </div>
      <div id="box" class="hidden" data-box-new>
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0d/af/70/3c/the-white-tower-the-norman.jpg?w=600&h=-1&s=1"> 
        <div id="testo1"><strong><p class="location">London</p>, UK</strong></div>
      </div>
    </div>
    <div id="freccia-left" class="hidden" data-arrow-left>
      <img  src="https://img.icons8.com/ios/50/left--v1.png"></img>
    </div>
    </article>

    <div id="meteo">

    </div>

    <article class="Viaggio2" data-visita>
      <h3><strong>Le mete preferite per la tua prossima vacanza</strong></h3>
      <div id="sottotitolo">Ecco le destinazioni scelte dai viaggiatori come te</div>
      <div id="freccia" data-arrow-right>
        <img  src="https://img.icons8.com/ios/50/right--v1.png"></img>
      </div>
    <div id="annunci">
      <div id="box" data-box="b1">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/33/f9/46/lisbon.jpg?w=800&h=800&s=1">
        <div id="testo1"><strong><p class="location">Lisbon</p>, Portugal</strong></div>
      </div>
      <div id="box" data-box="b2">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/28/74/c9/cf/caption.jpg?w=300&h=300&s=1&pcx=1097&pcy=742&pchk=v1_15125732981dc7cf7364">
        <div id="testo2"><strong><p class="location">Amsterdam</p>, Netherlands</strong></div>
      </div>
      <div id="box" data-box="b3">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/25/c9/00/32/caption.jpg?w=800&h=800&s=1">
        <div id="testo1"><strong><p class="location">Munich</p>, Germany</strong></div>
      </div>
      <div id="box" data-box="b4">
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1c/c0/98/c5/caption.jpg?w=800&h=800&s=1&cx=960&cy=638&chk=v1_dd51d42e9a888a6b338f">
        <div id="testo1"><strong><p class="location">Athens</p>, Greece</strong></div>
      </div>
      <div id="box" class="hidden" data-box-new>
        <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/15/6d/d6/paris.jpg?w=600&h=600&s=1">
        <div id="testo1"><strong><p class="location">Paris</p>, France</strong></div>
      </div>
    </div>
    <div id="freccia-left" class="hidden" data-arrow-left>
      <img  src="https://img.icons8.com/ios/50/left--v1.png"></img>
    </div>
    </article>

    <article id="Premi">
      <div class="corpo">
        <div class="testo3">
         <img id="logo" src="https://static.tacdn.com/img2/travelers_choice/2023/TC_badge_yellow.svg">
          <h2><strong>Premi Travellers' Choice Best of the Best</strong></h2>
          <p>Tra i luoghi, gli alloggi, i ristoranti e le esperienze migliori, pari all'1%, scelti dai viaggiatori.</p>
          <div class="button"><a>Vedi i vincitori</a></div>
        </div>

        <div class="collage"><img src="https://static.tacdn.com/img2/brand/feed/tc_cards_2025.png"></div>
      </div>
    </div>
    </article>


    <footer>
      <div class="DisposizioneFooter">
        <div class="fine">
          <ul class="lista">
            <li>
              <div class="titolo">
                <img src="https://img.icons8.com/ios/50/plus-math--v1.png">
                <a id="title">Tripadvisore</a>
              </div></li>
            <li><a>Chi siamo</a></li>
            <li><a>Stampa</a></li>
            <li><a>Risorse e normative</a></li>
            <li><a>Opportunità d'impiego</a></li>
            <li><a>Fiducia e sicurezza</a></li>
            <li><a>Contattaci</a></li>
            <li><a>Informativa sull'accessibilità</a></li>
          </ul>
          <ul class="lista">
            <li>
              <div class="titolo">
                <img src="https://img.icons8.com/ios/50/plus-math--v1.png">
                <a id="title">Esplora</a>
              </div></li>
            <li><a>Scrivi una recensione</a></li>
            <li><a>Aggiungi una struttura</a></li>
            <li><a>Iscriviti</a></li>
            <li><a>Travellers' Choice</a></li>
            <li><a>Centro Assistenza</a></li>
            <li><a>Storie di viaggio</a></li>
          </ul>
          <ul class="lista">
            <li>
              <div class="titolo">
                <img src="https://img.icons8.com/ios/50/plus-math--v1.png">
                <a id="title">Collabora con noi</a>
              </div></li>
            <li><a>Proprietari</a></li>
            <li><a>Business Advantage</a></li>
            <li><a>Inserzioni sponsorizzate</a></li>
            <li><a>Pubblicità</a></li>
            <li><a>Accedi ai contenuti API</a></li>
            <li><br/></li>
            <li>
              <div class="titolo">
                <img src="https://img.icons8.com/ios/50/plus-math--v1.png">
                <a id="title">Scarica l'app</a>
              </div></li>
            <li><a>App per iPhone</a></li>
            <li><a>App per Andorid</a></li>
          </ul>
  
          <ul class="lista1">
            <li>
              <div class="titolo">
                <img src="https://img.icons8.com/ios/50/plus-math--v1.png">
                <a id="title">Siti di TripAdvisor</a>
              </div></li>
            <li><p>Prenota i ristoranti migliori con <a id="link3">TheFork</a></p></li>
            <li><p>Prenota biglietti per tour e attrazioni su <a id="link3">Viator</a></p></li>
          </ul>
        </div>
        <div class="fine2">
          <div class="f2part1">
            <img src="https://static.tacdn.com/img2/brand_refresh/Tripadvisor_logoset_solid_green.svg">
            <ul class="links">
              <li><a id="cap">&#169 2025 Tripadvisor LLC Tutti i diritti riservati.</a></li>
              <li><a><strong>Termini di utilizzo</strong></a><a><strong>Normativa sulla privacy e sui cookie</strong></a><a><strong>Consenti i cookie</strong></a><a><strong>Mappa del sito</strong></a></li>
             <li><a><strong>Uso del sito</strong></a><a><strong>Contatti</strong></a></li>
            </ul>
          </div>
          <div class="Opzioni">
            <div class="scelta">
              <div><strong>&euro; EUR</strong></div>
              <i class="fa-solid fa-angle-down"></i>
            </div>
            <div class="scelta">
              <div><strong>Italia</strong></div>
              <i class="fa-solid fa-angle-down"></i>
            </div>
          </div>
        </div>  
        
        <div class="fine3">
          <p>Questa è una versione del sito destinata in generale a chi parla italiano in Italia. Se risiedi in un altro paese o in un'altra area geografica, seleziona la versione appropriata di Tripadvisor dal menu a discesa.<a><strong>Mostra di più</strong></a></p>
        </div>
      </div>
        <div class="social">
          <a href="https://www.facebook.com/Tripadvisor/">
            <img src="https://img.icons8.com/ios-glyphs/30/facebook-new.png"></a>
          <a href="https://x.com/i/flow/login?redirect_after_login=%2Ftripadvisorit">
            <img src="https://img.icons8.com/ios/50/twitterx--v2.png"></a>
          <a href="https://www.instagram.com/tripadvisor/">
            <img src="https://img.icons8.com/ios/50/instagram-new--v1.png"></a>
          <a href="https://www.youtube.com/TripAdvisor">
            <img src="https://img.icons8.com/ios-filled/50/youtube-play.png"></a>
          <a href="https://www.tiktok.com/login?redirect_url=https%3A%2F%2Fwww.tiktok.com%2F%40tripadvisor&lang=en&enter_method=mandatory">
            <img src="https://img.icons8.com/ios-filled/50/tiktok--v1.png"></a>
        </div>
    </footer>
  </body>
</html>
