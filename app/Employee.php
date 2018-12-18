<?php
namespace App;

/**
 * employee of hangar class for loading items from stock
 */
class Employee extends Hangar {
    // takes action od loading items from stock to their transports
    public function loadStock() {
        echo "Boxes:";

        while($stock = $this->getStock('boxes')) {
            $query = "INSERT INTO trucks (departure_date) VALUES (:departure_date)";

            $statement = $this->pdo->prepare($query);

            $statement->execute([':departure_date' => date('Y-m-d H:i:s', time())]);

            $this->loadOnTruck();
        }

        echo "\r\n\r\n".((!isset($argc)) ? '<br><br>' : '').'Machines:';

        while($stock = $this->getStock('machines')) {
            $query = "INSERT INTO planes (departure_date) VALUES (:departure_date)";

            $statement = $this->pdo->prepare($query);

            $statement->execute([':departure_date' => date('Y-m-d H:i:s', time())]);

            $this->loadOnPlane();
        }
    }

    // takes action od loading boxes from stock on truck
    public function loadOnTruck() {
        $truck_id = $this->pdo->lastInsertId();

        $stock = $this->getStock('boxes');

        $first_id = $stock[0]['id'];

        $sum_weight = $this->sumWeight($stock);

        $last_id = $this->getLastId($sum_weight, Config::TRUCK);

        $this->updateStatus('boxes', $first_id, $last_id, $truck_id);

        $this->renderTable($this->getRows('boxes', $first_id, $last_id));
    }

    // takes action od loading machines from stock on plane
    public function loadOnPlane() {
        $plane_id = $this->pdo->lastInsertId();

        $stock = $this->getStock('machines');

        $first_id = $stock[0]['id'];

        $sum_weight = $this->sumWeight($stock);

        $last_id = $this->getLastId($sum_weight, Config::AIRPLANE);

        $this->updateStatus('machines', $first_id, $last_id, $plane_id);

        $this->renderTable($this->getRows('machines', $first_id, $last_id));
    }
}