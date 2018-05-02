<?php    
     class UtilLogin extends UtilDB{
        
        
        //costruttore ereditato
        public function __construct($conn){
            $this->$db=$conn;
        }//costruttore
        
        /*@param username -> username dell' utente
          @param pw -> password dell' utente
          @return un array contente Ruolo e IdAccount
        */
        public function getUser($username,$pw){ 
            $stmt = $this->db->prepare("SELECT Ruolo,idAccount FROM ACCOUNT WHERE ACCOUNT.Username=? AND ACCOUNT.Password=?");
            $stmt->bind_param('ss', $username,$pw); // 's' specifies the variable type => 'string
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                die('Query fallita: '.$result->error." query='$query'"); 
            else{
                $row=$this->mysqli_fetch_array($result);
                $userInfo= array();
                foreach($row as $name=>$value)
                    if($name =='Ruolo'){
                            $userinfo = [
                                'Ruolo'=>$value,
                                'idAccount'=>$idAccount
                            ];
                            return $userinfo; 
                    }//if-foreach
            }//else - !result
        }//getUser
        
        public function getUserById($idA){
            $stmt = $this->db->prepare("SELECT Username FROM ACCOUNT WHERE ACCOUNT.idAccount=?");
            $stmt->bind_param('i', $idA); // 's' specifies the variable type => 'string
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                die('Query fallita: '.$result->error." query='$query'"); 
            else{
                $row=$this->mysqli_fetch_array($result);
                foreach($row as $name=>$value)
                    if($name =='Ruolo')
                        return $value;
            }//else
        }//getUserById
        
    }//UtilLogin
?>