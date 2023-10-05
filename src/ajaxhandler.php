<?php

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/database.php";

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(400);
    return;
}

try {
    $db = new Database();
    $row = $db->getRandomRow();

    $length = strlen($row->simple_word);
    $row->fullText = $row->vietnamese_text;
    $row->vietnamese_text = str_replace(
        $row->vietnamese_word,
        "<input class=\"sentence\" type=\"text\" id=\"inputField\" value=\"\" size=\"$length\" 
        maxlength=\"$length\" style=\"outline:none; font-family: serif; \" autofocus>",
        $row->vietnamese_text
    );

    echo json_encode($row);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
} finally {
    $db->closeConnection();
}
