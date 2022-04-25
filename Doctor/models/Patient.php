<?php 

class Patient extends Model{

    public function __construct()
    {
        $this->table = 'user';
        
        $this->getConnection();
    }
    /**
     * Retourne un article en fonction de son slug

     */

    public function findId(string $slug){
        $sql = "SELECT * FROM ".$this->table." WHERE `id`='".$slug."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function checkEmail(string $email){
        $sql = "SELECT * FROM ".$this->table." WHERE `email`='".$email."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
            // var_dump('gg');
            die();
        } else {
            return false;
        }
    }

    public function create($data,$Reference){
        // die(var_dump($data->firstname));
        $chekEmail = $this->checkEmail($data->email);
        if ($chekEmail)
        {
            return false;
        }
        $query = 'INSERT INTO ' . $this->table . ' SET Reference = :Reference  , lastname = :LastName, firstname = :FirstName , email = :Email , password = :Password , age = :Age';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':Reference', $Reference);
        $stmt->bindParam(':LastName', $data->lastname);
        $stmt->bindParam(':FirstName', $data->firstname);
        $stmt->bindParam(':Email', $data->email);
        $stmt->bindParam(':Password', $data->password);
        $stmt->bindParam(':Age', $data->age);

        return $stmt->execute();
    }

    public function find ($Reference)
    {
        $sql = "SELECT * FROM ".$this->table . " WHERE `Reference`='". $Reference."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
       if (empty( $query->fetchAll(PDO::FETCH_ASSOC)))
       {
           return false;
       }
       else
       {
           return true;
       }
    }
  
}