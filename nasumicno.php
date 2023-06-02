<?php
header("Access-Control-Allow-Origin: *");
?>
<!DOCTYPE html>
<html>
<head>
    <title>nasumicno</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Merriweather+Sans:wght@300&family=Open+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Secular+One&display=swap" rel="stylesheet">
    <style>
        header{
            padding-bottom: 10px;
        }
    </style>
      <!--random anime citat-->
      <script>
          function getRandomQuote() {
            fetch("baza.json")
              .then(response => response.json())
              .then(quotes => {
                if (quotes.length > 0) {
                  const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
                  document.getElementById("quote").textContent = randomQuote.quote;
                  document.getElementById("character").textContent = randomQuote.character;
                  document.getElementById("anime").textContent = randomQuote.anime;
                  getAnimeImage(randomQuote.anime);
                } else {
                  document.getElementById("quote").textContent = "Nema pronađenih citata. Provjeri bazu.";
                  document.getElementById("character").textContent = "";
                  document.getElementById("anime").textContent = "";
                  document.getElementById("anime-image").src = "";
                }
              })
              .catch(error => {
                document.getElementById("quote").textContent = "Pogreška.";
                console.log(error);
              });
          }
      
          function getAnimeImage(animeTitle) {
            fetch(`https://kitsu.io/api/edge/anime?filter[text]=${encodeURIComponent(animeTitle)}`)
              .then(response => response.json())
              .then(data => {
                if (data.data.length > 0) {
                  const image = data.data[0].attributes.posterImage.original;
                  document.getElementById("anime-image").src = image;
                }
              })
              .catch(error => {
                console.log(error);
              });
          }
      
          document.addEventListener("DOMContentLoaded", function() {
            getRandomQuote();
      
            document.getElementById("new-quote-btn").addEventListener("click", function() {
              getRandomQuote();
            });
          });
        </script>
</head>
<body>
  <header>
        <ul>
            <li id="animeleft"><a href="#home">ANIME CITATI</a></li>
            <li><a href="anime.php">Anime </a></li>
            <li><a href="likovi.php">Likovi  |</a></li>
            <li><a href="nasumicno.php">Nasumično  | </a></li>
            <li><a href="index.html">Početna  |</a></li>
        </ul>
  </header>
  <div class="random">
    <h1>RANDOM ANIME CITAT</h1>

    <img id="anime-image" src="" alt="Anime Image" width="200px" style="margin-top: 50px;margin-bottom: 20px;border: 2px solid #129696;">
  </div>

  <div class="info">
    <p id="quote"></p>
    <p id="character"></p>
    <hr />
    <p id="anime"></p>
  </div>
    
  <div class="gumbic"><button id="new-quote-btn">Pronađi</button></div>

  <br />
</body>
</html>
