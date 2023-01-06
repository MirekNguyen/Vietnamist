<?php

if (isset($_GET["id"])) {
    // Load environment variables to connect to database
    require "vendor/autoload.php";
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $host = $_ENV["PG_HOST"];
    $database = $_ENV["PG_DATABASE"];
    $user = $_ENV["PG_USER"];
    $pass = $_ENV["PG_PASSWORD"];
    $port = $_ENV["PG_PORT"];

    $connection = pg_connect(
        "host=$host port=$port dbname=$database user=$user password=$pass"
    );
    if (!$connection || !isset($_GET["id"])) {
        echo "400";
    } else {
        $number = pg_num_rows(
            pg_query(
                $connection,
                "SELECT vietnamese_word FROM $database WHERE vietnamese_word IS NOT NULL"
            )
        );
        $random = rand(0, $number - 1);
        $result = pg_query(
            $connection,
            "select * from $database WHERE id='$random' ORDER BY id"
        );
        $row = pg_fetch_object($result);

        $length = strlen($row->simple_word);
        $row->fullText = $row->vietnamese_text;
        $row->vietnamese_text = str_replace(
            "$row->vietnamese_word",
            "<input class=\"sentence\" type=\"text\" id=\"inputField\" value=\"\" size=\"$length\" 
            maxlength=\"$length\" style=\"outline:none; font-family: serif; \" autofocus>",
            $row->vietnamese_text
        );
        echo json_encode($row);
    }
    pg_close($connection);
}
