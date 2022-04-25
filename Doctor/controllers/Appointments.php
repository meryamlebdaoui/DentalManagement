<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, DELETE, GET ,PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');




class appointments extends Controller{
    public function index(){
        $this->loadModel('Appointment');
        $appointments = $this->Appointment->getAll();
        echo json_encode($appointments);
       die();
        $this->render('index', compact('appointments'));
    }
    public function create(){
        
        $this->loadModel('Appointment');
        $data = json_decode(file_get_contents("php://input"));
        $acc= $this->Appointment->create($data);
        if ($acc ) {
            echo json_encode([http_response_code(200),$data]);
        } else {
            echo json_encode(['error' => 'appointement not created']);
        }
    }
    public function findAppointment($DateConsult){
        $this->loadModel('Appointment');
        // $data = json_decode(file_get_contents("php://input"));
        $result= $this->Appointment->findByDate($DateConsult);
        if ($result) 
            {
                echo json_encode(array('success',$result));

            } else {
                echo json_encode(array('status' => 'errore'));
            }
         
    }
    public function update($id){
        // die(var_dump($id));

        $this->loadModel('Appointment');
        $data = json_decode(file_get_contents("php://input"));
       
        $acc= $this->Appointment->update($data,$id);
        if ($acc ) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }
    public function delete($id){
        $this->loadModel('Appointment');
        // $data = json_decode(file_get_contents("php://input"));
        $acc= $this->Appointment->delete($id);
        if ($acc ) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function get($Reference)
    {
        $this->loadModel('Appointment');
        $res = $this->Appointment->get($Reference);
        if ($res) {
          
            echo  json_encode([200,$res]);
        } else {

            echo json_encode (400,['Patient not found']);
        }

    }
    public function find($id)
    {
        
        $this->LoadModel('Appointment');
        $result = $this->Appointment->findone($id);

        if ($result) {
            echo json_encode(['success', $result]);
        } else {
            echo json_encode(['status', 'error']);
        }
    }
}