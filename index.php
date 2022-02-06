<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Vietnamist</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="CSS.css">

<body>
   <div class="center">
      <div class="card" style="height: 50px; line-height: 50px; border-top-left-radius: 15px; border-top-right-radius: 15px; background-color: #F5F6F9;    padding-top: 10px; padding-bottom: 10px;font-size: 30px; font-weight: bold;">Vietnamist</div>
      <div class="card" style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;box-shadow: 6px 8px rgba(100, 100, 100, 0.3);">
         <div id='id'></div>
         <div id='englishWord'></div>
         <br>
         <div class='sentence' id='sentence'></div>
         <p id="englishText"></p>
         <input id='answer' hidden>
         <input id='phoneticAnswer' hidden>
         <input id='vietnameseText' hidden>
         <br>
         <button onclick="wordToSpeech()">Play answer</button>
         <button onclick="textToSpeech()">Play sentence</button>
      </div>
   </div>
   <!--- End of class "center" --->
   <script src="Javascript.js"></script>
   <?php
   // Load environment API key for 'responsivevoice.org'
   require 'vendor/autoload.php';
   $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
   $dotenv->load();
   ?>
   <script src="https://code.responsivevoice.org/responsivevoice.js?key=<?php echo $_ENV['VOICE_KEY']; ?>"></script>
</body>

</html>
