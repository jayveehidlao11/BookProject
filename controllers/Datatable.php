<?php
include('../database/db.php');

class Datatable {
    public function __construct($conn) {
        $this->connection = $conn;
    }
    
    public function index() {
        $getData = "SELECT * FROM tblbooksinfo";
        $result = $this->connection->query($getData);
        
        $books = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode($books);
        exit;
    }
}

$datatable = new Datatable($conn);
$datatable->index();
?>