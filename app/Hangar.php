<?php
namespace App;

/**
 * main hangar class for hangar operations
 */
class Hangar {
    protected $pdo;

    public function __construct() {
        $this->pdo = (new SQLiteConnection())->connect();
    }

    // gets items that are in stock (their status is 1)
    public function getStock($table) {
        $query = "SELECT * FROM $table WHERE status = 1";

        $statement = $this->pdo->prepare($query);

        $statement->execute();

        $result = $statement->fetchAll();

        if(empty($result)) {
            echo "\r\n\r\n".((!isset($argc)) ? '<br>' : '')."All $table in stock have been loaded.";
        } else {
            return $result;
        }
    }

    // sets status of departed items
    public function updateStatus($table, $id_min, $id_max, $transport_id) {
        $column_name = ($table == 'boxes') ? 'truck_id' : 'plane_id';

        $query = "UPDATE $table SET `status` = 0, `departure_date` = :departure_date, `$column_name` = :$column_name WHERE `id` BETWEEN :id_min AND :id_max";

        $statement = $this->pdo->prepare($query);

        $statement->execute([
            ':departure_date' => date('Y-m-d H:i:s', time()),
            ':id_min' => $id_min,
            ':id_max' => $id_max,
            ":$column_name" => $transport_id
        ]);
    }

    // creates array with cumulative weight of items in stock
    public function sumWeight($array) {
        $count = count($array);
        $sum_weight = 0;
        $sum_array = [];

        for($i = 0; $i < $count; $i++) {
            $sum_weight = $sum_weight + $array[$i]["weight"];
            $sum_array[$array[$i]['id']] = $sum_weight;
        }

        return $sum_array;
    }

    // returns id of last loaded element
    public function getLastId($array, $capacity) {
        foreach($array as $key => $value) {
            if($value <= $capacity) {
                $last_id = $key;
            }
        }

        return $last_id;
    }

    // gets items from current load action
    public function getRows($table, $id_min, $id_max) {
        $query = "SELECT * FROM `$table` WHERE `id` BETWEEN '$id_min' AND '$id_max'";

        $statement = $this->pdo->prepare($query);

        $statement->execute();

        $result = $statement->fetchAll();

        return $result;
    }

    // renders items from current load action
    public function renderTable($rows) {
        foreach ($rows as $row) {
            echo "\r\n\r\n";

            if(!isset($argc)) {
                echo '<pre>';
            }

            $print_array = [];

            foreach ($row as $key => $value) {
                if(!is_int($key)) {
                    $print_array[$key] = $value;
                }
            }

            print_r($print_array);

            if(!isset($argc)) {
                echo '</pre>';
            }
        }
    }
}