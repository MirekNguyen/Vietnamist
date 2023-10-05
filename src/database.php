<?php

class Database
{
    private $connection;

    public function __construct()
    {
        $host = $_ENV["PG_HOST"];
        $database = $_ENV["PG_DATABASE"];
        $user = $_ENV["PG_USER"];
        $pass = $_ENV["PG_PASSWORD"];
        $port = $_ENV["PG_PORT"];

        $this->connection = pg_connect(
            "host=$host port=$port dbname=$database user=$user password=$pass"
        );

        if (!$this->connection) {
            throw new Exception("Failed to connect to the database.");
        }
    }

    public function getRandomRow()
    {
        $number = pg_num_rows(
            pg_query(
                $this->connection,
                "SELECT vietnamese_word FROM $database WHERE vietnamese_word IS NOT NULL"
            )
        );

        $random = rand(0, $number - 1);

        $result = pg_query(
            $this->connection,
            "SELECT * FROM $database WHERE id='$random' ORDER BY id"
        );

        return pg_fetch_object($result);
    }

    public function closeConnection()
    {
        pg_close($this->connection);
    }
}
