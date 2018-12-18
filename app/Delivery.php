<?php
namespace App;

/**
 * class populating database with records from delivery
 */
class Delivery {
    private $pdo;

    public function __construct() {
        $this->pdo = (new SQLiteConnection())->connect();
    }

    // creates records of boxes in database (hangars stock)
    public function deliverBoxes() {
        $amount = rand(5, 40);
        
        for($i = 0; $i < $amount; $i++) {
            $weight = rand(1000, 2000) / 100;

            $query = "INSERT INTO boxes (weight, reception_date, status) VALUES ( :weight, :reception_date, :status)";

            $statement = $this->pdo->prepare($query);

            $statement->execute([
                ':weight' => $weight,
                ':reception_date' => date('Y-m-d H:i:s', time()),
                ':status' => 1
            ]);
        }
    }

    // creates records of machines in database (hangars stock)
    public function deliverMachines() {
        $weight_1 = 1500;
        $weight_2 = 2000;

        $query = "INSERT INTO machines (weight, reception_date, status) VALUES ( :weight, :reception_date, :status)";

        $statement = $this->pdo->prepare($query);

        $statement->execute([
            ':weight' => $weight_1,
            ':reception_date' => date('Y-m-d H:i:s', time()),
            ':status' => 1
        ]);

        $query = "INSERT INTO machines (weight, reception_date, status) VALUES ( :weight, :reception_date, :status)";

        $statement = $this->pdo->prepare($query);

        $statement->execute([
            ':weight' => $weight_2,
            ':reception_date' => date('Y-m-d H:i:s', time()),
            ':status' => 1
        ]);
    }
}