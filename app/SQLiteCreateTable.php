<?php
namespace App;
 
/**
 * SQLite Create Table
 */
class SQLiteCreateTable {
    private $pdo;
 
    public function __construct() {
        $this->pdo = (new SQLiteConnection())->connect();
    }

    // creates necessary tables in database
    public function createTables() {
        $commands = [
            'CREATE TABLE IF NOT EXISTS boxes ( id INTEGER PRIMARY KEY, weight DECIMAL(4, 2) NOT NULL, reception_date TEXT, status INTEGER(1), departure_date TEXT, truck_id INTEGER )',
            'CREATE TABLE IF NOT EXISTS machines ( id INTEGER PRIMARY KEY, weight DECIMAL(4, 2) NOT NULL, reception_date TEXT, status INTEGER(1), departure_date TEXT, plane_id INTEGER )',
            'CREATE TABLE IF NOT EXISTS trucks ( id INTEGER PRIMARY KEY, departure_date TEXT )',
            'CREATE TABLE IF NOT EXISTS planes ( id INTEGER PRIMARY KEY, departure_date TEXT )'
        ];

        foreach($commands as $command) {
            $this->pdo->exec($command);
        }
    }

    // checks if database contains tables
    public function checkTables() {
        $tables = [];
        $statement = $this->pdo->query("SELECT name FROM sqlite_master WHERE type = 'table' ORDER BY name");

        while($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $tables[] = $row['name'];
        }
 
        return (count($tables) > 0) ? true : false;
    }
}