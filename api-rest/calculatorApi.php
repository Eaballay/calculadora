<?php
require_once 'calculatorDb.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of calculator-api
 *
 * @author eze
 */
class calculatorApi {
    public function API(){
        $db = new calculatorDb();
        header('Content-Type: application/JSON'); 
        $method =  filter_input(INPUT_SERVER, 'REQUEST_METHOD');   
        switch ($method){
            case 'GET':
                    if ($_GET['action']==='result'){  
                    $this->getOperations();
                    }else{
                        $this->response(400);   
                    }
                break;
            case 'POST':
                if ($_GET['action']==='session'){  
                    $this->saveSession();
                }else if ($_GET['action']==='result'){   
                    $this->saveOperation(); 
                    }else if ($_GET['action']=== 'calculator'){
                        $this-> calculator();
                    }else if ($_GET['action']=== 'getsession'){
                            $this->getSession();
                        }else{
                            $this->response(400);  
                        }
                      
                break;
            default:
                echo 'METODO NO SOPORTADO';
        }
    }
    function response($code=200, $status="", $message="") {
        http_response_code($code);
        if( !empty($status) && !empty($message) ){
            $response = array("status" => $status ,"message"=>$message);  
            echo json_encode($response,JSON_PRETTY_PRINT);    
        }  
    }
    function getOperations(){       
        $db = new calculatorDb();
        if(isset($_GET['id'])){               
            $response = $db->getOpertation($_GET['id']);                
            echo json_encode($response,JSON_PRETTY_PRINT);
        }else{
            $response = $db->getOperations();              
            echo json_encode($response,JSON_PRETTY_PRINT);
        }
         
           
 }
    function getSession(){ 
        $obj =file_get_contents('php://input');
        $string = trim($obj, "--=");      
        $db = new calculatorDb();                  
        $id_session = $db->getsessionid($string);
        $id =($id_session[0]);
         $id = $id['id'];
        $id =$id;
        $response = $db->getOpertation($id);
        echo json_encode($response,JSON_PRETTY_PRINT);
        
       
 }
    function saveSession(){
        $obj =file_get_contents('php://input');
        $string = trim($obj, "--=");
        $db = new calculatorDb();     
        $db->insertSession($string);        
        $this->response(200,"success","new record added");                             

    
    }
    function saveOperation(){
        $obj = file_get_contents('php://input');   
        $string = trim($obj, "result");
        $string = trim($string, "ing=");
        $string = str_replace("%3D", "=", $string);
        $string = str_replace("%2B", "+", $string); 
        $db = new calculatorDb();  
        $id_session= $db->lastRecord();
        $id =($id_session[0]);
        $id =$id['id'];
        $db->insertOperation($string, $id );
        $this->response(200,"success","new record added");                             
    }
    function multiexplode($delimiters,$string) {    
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
    return  $launch;
}
    function calculator(){
        $obj =file_get_contents('php://input');
        $string = trim($obj, "chain=");
        $string = str_replace("%2B", "+", "$string");
        $string = str_replace("%C3%B7", "÷", $string);
       $numeros = $this->multiexplode(array("+","-","*","÷"), $string );
       $result = "";
       $sum= strpos($string, "+");
       $subtraction = strpos($string, "-");
       $multiplication = strpos($string, "*");
       $division = strpos($string, "÷");
      if ($sum){
           $result = floatval($numeros[0]) + floatval($numeros[1]);
            echo ($result);
       }
       if($subtraction){
            $result = floatval($numeros[0]) - floatval($numeros[1]);
            echo ($result);   
       }
       if($multiplication){
            $result = floatval($numeros[0]) * floatval($numeros[1]);
            echo ($result);   
       }
       if($division){
           if ($numeros[1]=== "0"){
            echo "Error";   
           }else{
            $result = floatval($numeros[0]) / floatval($numeros[1]);
            echo ($result);
             }
       }
       //echo($string);
    }

}
