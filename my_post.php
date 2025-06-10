<?php
    require_once 'auth.php';
    if(!$userid= checkAuth()){
        header("Location: login.php");
        exit;
    }
?>

<html>
    <?php
        //carico le informazioni dell'utente loggato per visualizzarle
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1); 
    ?>

    <head>
        <meta charset="utf-8">
    <title>TripAdvisor</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link href = "fonts/TripAdvisor/stylesheet.css" rel = "stylesheet" type = "text/css" />-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="mhw3.css">
    <link rel="stylesheet" href="add_post.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="funzionalità.css">
    <script src="menu.js" defer></script>
    <script src="funzionalità.js" defer></script>
    <script src="add_post2.js" defer></script>
    <script src="my_post.js" defer></script>
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
              <a id="preferiti" href="add_post.php">Aggiungi un luogo</a>
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
                  <div id="button_area" data-cambio="area"><p>Area georgrafica e lingua</p></div>
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
                      <div class="linguaIT" data-valuta="IT">
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
<h1><strong><?php echo htmlspecialchars($userinfo['username']); ?>, ecco i tuoi Post</strong><br/></h1>
</header>

<section class="container">

    <div id="results">

    </div>
</section>

<div class="altro">
    <p>Vuoi caricare un altro post?</p>
    <a id="add" href="add_post.php">Aggiungi un nuovo post</a>
</div>
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

<?php mysqli_close($conn) ?>