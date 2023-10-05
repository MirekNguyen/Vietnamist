<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vietnamist</title>
    <link rel="stylesheet" href="./public/styles/styles.css">
</head>

<body>
    <div class="center">
        <div class="card main-card">
            <div id='id' class="card-header"></div>
            <div class='card-content'>
                <span id='englishWord' class='word-badge'></span>
                <div class='sentence' id='sentence'></div>
                <p id="englishText"></p>
                <input id='answer' hidden>
                <input id='phoneticAnswer' hidden>
                <input id='vietnameseText' hidden>
            </div>
            <div class='card-footer'>
                <p>[Press Enter to answer or click <button id="answerBtn">Answer ↵</button>]</p>
                <span>Audio hint: </span>
                <button id="playAnswerBtn">♫ Play answer</button>
                <button id="playSentenceBtn">♫ Play sentence</button>
            </div>
        </div>
    </div>
    <script src="./public/js/scripts.js"></script>
    <?php
    // Load environment API key for 'responsivevoice.org'
    require __DIR__ . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/config/");
    $dotenv->load();
    ?>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=<?php echo $_ENV['VOICE_KEY']; ?>"></script>
</body>

</html>
