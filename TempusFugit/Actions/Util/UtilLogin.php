<?php

     include 'UtilDB.php';
     class UtilLogin extends UtilDB{

        public function __construct(){
            $this->db=new mysqli("annoiato.net","login","B3rBJSGU","tempusfugit");
            if ($this->db->connect_error){
                die('Connessione fallita: '.$this->db->connect_error);
            }//if
        }//costruttore senza parametri

        /**
         * @param username -> username dell' utente
         * @param pw -> password dell' utente
         * @return un array contente Ruolo e IdAccount
	 */
        public function getUser($username,$pw){
            //quattro query una per tabella
            $stmt = $this->db->prepare("SELECT ruolo,idAccount FROM account WHERE nomeUtente=? AND password=?");
            $stmt->bind_param('ss', $username,$pw); // 's' specifies the variable type => 'string
            $stmt->execute();
            $result = $stmt->get_result();
            if($row=$result->fetch_assoc())
                    return $row;
            else{
                    return false;
            }//if-else
      	    
        }//getUser
        public function getUserNameById($idA){
            $stmt = $this->db->prepare("SELECT nomeUtente FROM account WHERE idAccount=?");
            $stmt->bind_param('i', $idA); // 's' specifies the variable type => 'string
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                die('Query fallita: '.$result->error." query='$query'");
            else{
                $row=$this->mysqli_fetch_array($result);
                foreach($row as $name=>$value)
                    if($name =='nomeUtente')
                        return $value;
            }//else
        }//getUserById
        //date le credenziali di accesso ritorna l'id dell' utente CONTROLLATO
        public function getIdUser($username,$pw){
            $stmt = $this->db->prepare("Select idAccount FROM account WHERE nomeUtente=? AND password=?");
            $stmt->bind_param('ss', $username,$pw); // 's' specifies the variable type => 'string
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getIdUser
    }//UtilLogin
?>
