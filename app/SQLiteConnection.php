<?php
namespace App;

/**
 * SQLite connnection
 */
class SQLiteConnection {
    private $pdo;

    public function connect() {
        if ($this->pdo == null) {
            try {
                $this->pdo = new \PDO("sqlite:" . Config::SQLITE_PATH);
            } catch (\PDOException $e) {
                echo 'Whoops, could not connect to the SQLite database!';
            }
        }

        return $this->pdo;
    }
}