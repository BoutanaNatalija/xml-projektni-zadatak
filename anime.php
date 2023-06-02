<?php
header("Access-Control-Allow-Origin: *");
?>
<!DOCTYPE html>
<html>
<head>
    <title>anime</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Merriweather+Sans:wght@300&family=Open+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Secular+One&display=swap" rel="stylesheet">
    <style>
        header {
            padding-bottom: 10px;
        }
        .input-text {
            background-color: #4a4a4a;
            padding: 10px;
            color: #B9FFFF;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            width: 400px;
            box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
        }
        #anime-input {
            background-color: #B9FFFF;
            margin-top: 5px;
            font-family: 'Open Sans', sans-serif;
            font-size: 12px;
            font-style: italic;
            padding: 5px;
            border: 2px solid #129696;
            border-radius: 4px;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        }
    </style>
    <!--anime citat-->
      <script>
        function getQuoteByAnime(animeName) {
          fetch('baza.json')
            .then(response => response.json())
            .then(quotes => {
              const quotesByAnime = quotes.filter(quote => quote.anime.toLowerCase() === animeName.toLowerCase());
              if (quotesByAnime.length > 0) {
                const randomQuote = quotesByAnime[Math.floor(Math.random() * quotesByAnime.length)];
                document.getElementById("quote").textContent = randomQuote.quote;
                document.getElementById("character").textContent = randomQuote.character;
                document.getElementById("anime").textContent = randomQuote.anime;
                getAnimeImage(randomQuote.anime);
              } else {
                document.getElementById("quote").textContent = "Nema pronađenih citata vezano uz tu anime seriju. Ponovno napiši ime ili odaberi neku drugu.";
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
          document.getElementById("new-quote-btn").addEventListener("click", function() {
            const animeName = document.getElementById("anime-input").value;
            getQuoteByAnime(animeName);
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
    <h1>ANIME CITAT</h1>

    <div class="input-text" style="font-family: 'arial'; font-weight: bold;">
        Upiši ime Animea:
        <input type="text" id="anime-input" placeholder="npr. Black Clover">
        <button id="new-quote-btn" style="margin-top:20px;background-color: #129696;color: #ffffff; border: solid white;margin-left: 70%;box-shadow: 5px 0 5px -5px #333;">Pronađi</button>
    </div>

    <img id="anime-image" src="" alt="Anime Image" width="200px" style="margin-top: 50px;margin-bottom: 20px;border: 2px solid #129696;">
</div>

<div class="info">
    <p id="quote"></p>
    <p id="character"></p>
    <hr />
    <p id="anime"></p>
</div>
<br />
</body>
</html>
