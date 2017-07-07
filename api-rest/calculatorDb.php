<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of calculator-db
 *
 * @author eze
 */
class calculatorDb {
    protected $mysqli;
    const LOCALHOST ='127.0.0.1';
    const USER = 'root';
    const PASSWORD = '';
    const DATABASE = 'calculatondb';
    
        public function __construct() {           
        try{
            //conexión a base de datos
       $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
        }catch (mysqli_sql_exception $e){
            //Si no se puede realizar la conexión
            http_response_code(500);
            exit;
        }     
    } 
    
    public function getOpertation($id=""){      
        $stmt = $this->mysqli->prepare("SELECT result FROM result WHERE id_session=? ; ");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();        
        $operation = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $operation;              
    }
        public function getsessionid($session=""){      
        $stmt = $this->mysqli->prepare("SELECT id FROM session WHERE session=? ; ");
        $stmt->bind_param('s', $session);
        $stmt->execute();
        $result = $stmt->get_result();        
        $session1 = $result->fetch_all(MYSQLI_ASSOC); 
        $stmt->close();
        return $session1;              
    }
    
    public function getOperations(){       
        $result = $this->mysqli->query('SELECT * FROM result');       
        $operations = $result->fetch_all(MYSQLI_ASSOC);          
        $result->close();
        return $operations; 
    }
    
    public function getSession(){       
        $result = $this->mysqli->query('SELECT * FROM session');       
        $operation = $result->fetch_all(MYSQLI_ASSOC);          
        $result->close();
        return $operation; 
    }
    
    public function insertSession( $session=''){
        $stmt = $this->mysqli->prepare("INSERT INTO session(session) VALUES (?); ");
        $stmt ->bind_param('s', $session);
        $r = $stmt->execute();
        return $session;
    }

    public function insertOperation($operation='', $session=''){
        $stmt = $this->mysqli->prepare("INSERT INTO result(result, id_session) VALUES (?,?); ");
        $stmt->bind_param('ss', $operation, $session);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;        
    }
    public function delete($id=0) {
        $stmt = $this->mysqli->prepare("DELETE FROM operation WHERE id = ? ; ");
        $stmt->bind_param('s', $id);
        $r = $stmt->execute(); 
        $stmt->close();
        return $r;
    }
    public function lastRecord(){
        $stmt = $this->mysqli->query("SELECT id FROM session ORDER BY id DESC LIMIT 1");
        $lastSession = $stmt->fetch_all(MYSQLI_ASSOC);          
        $stmt->close();
        return $lastSession; 
    }
 
}
