<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


class Patients extends Controller 
{
    /**
     * 
     *
     * @return void
     */

public function uniquReference($lenght = 8)
{

        
        $bytes = random_bytes(ceil($lenght / 2));
        $uid = uniqid($bytes, true);
        
        return substr(bin2hex($uid),0, $lenght);
        
}
//  create funccion retunr random string 8 char

public function create()
{   
    
    $Reference = $this->uniquReference();

    $data = json_decode(file_get_contents("php://input"));
 
    
   
    // var_dump($Reference);
    // die();  

    $this->loadModel('Patient');
   $acc= $this->Patient->create($data,$Reference);

   if ($acc ) {
      echo json_encode([http_response_code(200),$Reference]);
    //   echo json_encode($Reference);
   } else {
    echo json_encode([http_response_code(400),'error']);
   }
    
}
public function login ()
{
    
        $data = json_decode(file_get_contents("php://input"));
       
        $this->loadModel('Patient');
        $result= $this->Patient->find($data->Reference);

        if ($result) {
            echo json_encode([http_response_code(200),$data->Reference]);
        } else {
            echo json_encode([http_response_code(400),'Patient not found']);
        } 
      
    
}
}