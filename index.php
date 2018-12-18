<?php
require 'vendor/autoload.php';

use App\SQLiteCreateTable as SQLiteCreateTable;
use App\Employee as Employee;
use App\Delivery as Delivery;

$table = new SQLiteCreateTable();

// check if database and tables within exist and create it if not
if(!$table->checkTables()) {
    $table->createTables();
}

if(isset($argc)) { // code to run if file was loaded through CLI
    $action = getopt(null, ["delivery:"]);

    if(isset($action['delivery'])) {
        switch($action['delivery']) {
            case 'boxes': // create boxes delivery and save it in stock
                (new Delivery())->deliverBoxes();

                break;
            case 'machines': // create machines delivery and save it in stock
                (new Delivery())->deliverMachines();

                break;
            case 'load': // show what is being loaded and load it
                $employee = new Employee();
                $employee->loadStock();

                break;
            default:
                echo 'Wrong action selected.';
        }
    } else {
        echo
        "Add ' --delivery={action}' whe launching php file for action. \r\n
        Available actions: \r\n
        boxes - Deliver boxes to hangar stock. \r\n
        machines - Deliver machines to hangar stock. \r\n
        load - Make hangar employee load boxes and machines from hangars stock on truck and plane. The database will automatically populate and output with items that are going to be load will be shown.";
    }
} else { // code to run if file was loaded through browser
    if(isset($_GET['delivery'])) {
        $action = $_GET['delivery'];

        switch($action) {
            case 'boxes': // create boxes delivery and save it in stock
                (new Delivery())->deliverBoxes();

                break;
            case 'machines': // create machines delivery and save it in stock
                (new Delivery())->deliverMachines();

                break;
            case 'load': // show what is being loaded and load it
                $employee = new Employee();
                $employee->loadStock();

                break;
            default:
                echo 'Wrong action selected.';
        }
    } else {
        echo
        'Add ?delivery={action} to address for action. <br>
        Available actions: <br>
        <strong>boxes</strong> - Deliver boxes to hangar stock <br>
        <strong>machines</strong> - Deliver machines to hangar stock <br>
        <strong>load</strong> - Make hangar employee load boxes and machines from hangars stock on truck and plane. The database will automatically populate and output with items that are going to be load will be shown.';
    }
}