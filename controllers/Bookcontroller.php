<?php


class Bookcontroller{

    public function __construct($request,$conn) {
        $this->request = $request;
        $this->connection = $conn;
    }
    private function update($req){
        $title = $req['title'];
        $isbn = $req['isbn'];
        $author = $req['author'];
        $publisher = $req['publisher'];
        $yearpublished = $req['yearpublished'];
        $cat = $req['category'];
        $id = $req['book_id'];

        $update = "UPDATE tblbooksinfo SET 
            Title='" . mysqli_real_escape_string($this->connection, $title) . "',
            isbn='" . mysqli_real_escape_string($this->connection, $isbn) . "',
            Author='" . mysqli_real_escape_string($this->connection, $author) . "',
            Publisher='" . mysqli_real_escape_string($this->connection, $publisher) . "',
            YearPublished='" . mysqli_real_escape_string($this->connection, $yearpublished) . "',
            Category='" . mysqli_real_escape_string($this->connection, $cat) . "'
            WHERE ID='" . mysqli_real_escape_string($this->connection, $id) . "'";
            
            $update = $this->connection->query($update);
            if($update){
                return 1;
            }
            return 0;
    }
    private function insert($req){
        $title = $req['title'];
        $isbn = $req['isbn'];
        $author = $req['author'];
        $publisher = $req['publisher'];
        $yearpublished = $req['yearpublished'];
        $cat = $req['category'];

        

        $insertQuery =  "INSERT INTO tblbooksinfo (Title, isbn, Author,Publisher, YearPublished,Category,DateCreated)
                        VALUES ('".$title."', '".$isbn."','".$author."','".$publisher."',".$yearpublished.",'".$cat."','".date('Y-m-d h:i:s')."')";
        $insert = $this->connection->query($insertQuery);

        if($insert){
            return 1;
        }
        return 0;
    }
    private function checkIfExist($req) {
        global $conn; // assuming you're using a global DB connection
    
        $title = mysqli_real_escape_string($this->connection, $req['title']);
        $isbn = mysqli_real_escape_string($this->connection, $req['isbn']);
        $author = mysqli_real_escape_string($this->connection, $req['author']);
        $publisher = mysqli_real_escape_string($this->connection, $req['publisher']);
        $yearpublished = mysqli_real_escape_string($this->connection, $req['yearpublished']);
        $cat = mysqli_real_escape_string($this->connection, $req['category']);
    
        $isExistQuery = "SELECT COUNT(*) as total FROM tblbooksinfo WHERE Title = '$title' 
            AND ISBN = '$isbn' 
            AND Author = '$author' 
            AND Publisher = '$publisher' 
            AND YearPublished = '$yearpublished' 
            AND Category = '$cat'";
        $result = mysqli_query($conn, $isExistQuery);
        $data = mysqli_fetch_assoc($result);
    
        return $data['total'] > 0;
    }
    
    public function save(){
        try{
            $req = $this->request;
            $response = array('status' => 'error', 'message' => 'Failed to save data.');
            $isExist = $this->checkIfExist($req);
            if(!empty($req['book_id']) && isset($req['book_id'])){
                $update = $this->update($req);
                if($update){
                    $response['status'] = 'success';
                    $response['message'] = 'Successfully updated.';
                }
            }else{
                if($isExist > 0){
                    $response['message'] = 'Data already exists.';
                }else{
                    $insert = $this->insert($req);
                    if($insert){
                        $response['status'] = 'success';
                        $response['message'] = 'Successfully saved.';
                    }
                }
                
            }
            echo json_encode($response);
        }catch(\Exception $e){
            echo json_encode(['status' => 'error' , 'message' =>'Failed to save data.']);
        }
    }
    public function edit(){
        $id = $this->request['id'] ?? "";
        if(!empty($id)){
            $getData = "SELECT * FROM tblbooksinfo WHERE ID=".$id;
            $result = $this->connection->query($getData);
            echo json_encode($result->fetch_assoc());
        }
       
    }
    public function delete(){
        try {
            $id = $this->request['id'] ?? "";
            if(!empty($id)){
                $delete = "DELETE FROM tblbooksinfo WHERE ID=".$id;
                $result =   $this->connection->query($delete);
                if($result){
                    echo json_encode(['status' => 'success' , 'message' =>'Deleted Successfully']);
                }else{
                    echo json_encode(['status' => 'error' , 'message' =>'Failed to delete data.']);
                }
            }
        } catch (\Throwable $th) {
            echo json_encode(['status' => 'error' , 'message' =>'Failed to delete data.']);
        }
    }
}

@include('../database/db.php');

$bookController = new Bookcontroller($_POST,$conn);

if(isset($_POST['action'])){
    switch($_POST['action']){
        case "add":
            $bookController->save();
            break;
        case "editsaved":
            $bookController->save();
            break;
        case "delete":
            $bookController->delete();
            break;
        case "edit":
            $bookController->edit();
            break;
        default:
            break;
    }
}

?>