<?php 
class gameM{
    private $conn;
    
    public $gameID;
    public $gameName;
    public $gameLink;

    public function __construct($db){
        $this->conn = $db;        
    }

    //GetAll
    public function GetAll(){
        $sql = "SELECT * FROM game";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $arr = [];
            while ($row = $stmt->fetch_assoc()){
                extract($row);
                $arr_item = array(
                    'gameID' => $gameID,
                    'gameName' => $gameName,
                    'gameLink' =>$gameLink
                );
                $arr[]=$arr_item;
            }
            return $arr;
        }
    }

    //GetById
    public function GetbyId(int $id){
        $sql = "SELECT * FROM game WHERE game.gameID =".$id." LIMIT 1";
        $stmt = mysqli_query($this->conn, $sql);
        if(mysqli_num_rows($stmt) > 0){
            $row = $stmt->fetch_assoc();
            $result = array(
                'gameID' => $row['gameID'],
                'gameName' => $row['gameName'],
                'gameLink' => $row['gameLink']
            );
            return $result;
        }else{
            return false;
        }
    }

    //Post
    public function Post(){
        
        $gameName = htmlspecialchars(strip_tags($this->gameName));
        $gameLink =  htmlspecialchars(strip_tags($this->gameLink));
        $sql = "INSERT INTO game (gameName, gameLink) VALUES ( ?,?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $gameName, $gameLink);
        $stmt->execute();
        $this->conn->close();
        return true;
    }
    //Put
    public function Put(int $id){

        $labelName = "";
        $labelLink = "";

        $gameName = htmlspecialchars(strip_tags($this->gameName));
        if($gameName != ""){
            $labelName = "game.gameName = ";
            $gameName = "'".$gameName."'";
        }
        $gameLink =  htmlspecialchars(strip_tags($this->gameLink));
        if($gameLink != ""){
            $labelLink = ",game.gameLink = ";
            $gameLink = "'".$gameLink."'";
        }
        $sql = "UPDATE game SET ".$labelName.$gameName.$labelLink.$gameLink." WHERE game.gameID = ".$id;

        $stmt = mysqli_query($this->conn, $sql);
        mysqli_close($this->conn);
        return true;
    }
    //Delete
    public function Delete(int $id){
        
        $sql = "DELETE FROM game WHERE game.gameID =".$id;

        $stmt = mysqli_query($this->conn, $sql);
        mysqli_close($this->conn);
        return true;
    }
}
?>