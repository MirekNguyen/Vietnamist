<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Vietnamist</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="CSS.css">

<body>
   <?php
   // Load environment variables to connect to database
   require 'vendor/autoload.php';
   $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
   $dotenv->load();
   $host = $_ENV['PG_HOST'];
   $database = $_ENV['PG_DATABASE'];
   $user = $_ENV['PG_USER'];
   $pass = $_ENV['PG_PASSWORD'];
   $port = $_ENV['PG_PORT'];
   $key = $_ENV['VOICE_KEY'];

   $connection = pg_connect("host=$host port=$port dbname=$database user=$user password=$pass");
   if (!$connection)
      echo "Problem with connection" . "<br>";

   $number = pg_num_rows(pg_query($connection, "SELECT id FROM $database"));
   $random = rand(0, 0);

   $result = pg_query($connection, "select * from $database WHERE id='$random' ORDER BY id");
   $row = pg_fetch_object($result);
   if ($row->vietnamese_text != NULL) {
      $length = strlen($row->simple_word);
      $sentence = str_replace("$row->vietnamese_word", "<input type=\"text\" id=\"inputField\" value=\"\" size=\"$length\" maxlength=\"$length\" style=\"outline:none;  \" autofocus>", $row->vietnamese_text);
      echo "id: " . $row->id . "<br>" . $row->english_word . "<br>" . $sentence . " " . "<br>";
   } else
      echo $row->id . " " . $row->english_word . " " . $row->vietnamese_word . " " . $row->english_text . " " . $row->vietnamese_text . " " . "<br>";
   pg_close($connection);
   ?>
   <p id="englishText" style="display:none;"><?php echo $row->english_text ?></p>
   <input type="submit" id="submitButton" onclick="answer()"><br>
   <?php echo "<input id='answer' value='$row->simple_word' hidden>"; ?>
   <?php echo "<input id='phoneticAnswer' value='$row->vietnamese_word' hidden>"; ?>
   <?php echo "<input id='vietnameseText' value='$row->vietnamese_text' hidden>"; ?>
   <button onclick="wordToSpeech()">Play answer</button>
   <button onclick="textToSpeech()">Play sentence</button>
   <script src="Javascript.js"></script>
   <script src="https://code.responsivevoice.org/responsivevoice.js?key=<?php echo $key; ?>"></script>
</body>

</html>

</html>
