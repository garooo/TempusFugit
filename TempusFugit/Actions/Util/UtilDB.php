<?php
    class UtilDB{
        protected $db;
        protected $host;//stringa che contiene l'host
        protected $database;//stringa che contiene il nome del db

        public function __construct($host,$user,$password,$database){
             $this->db=new mysqli($host,$user,$password,$database);
            if ($this->db->connect_error){
                die('Connessione fallita: '.$this->db->connect_error);
            }//if
        }//costruttore senza parametri

        public function interrogazione($query) {
            $result=$this->db->query($query);
            if(!$result)
                die('Query fallita: '.$result->error." query='$query'");
            else
                return $result;
        }//interrogazione

        public function close(){
            $this->db->close();
        }//close

        public function mysql_fetch_arr($obj){
            $this->db->mysql_fetch_array($obj);
        }//mysql_fetch_arr

                //modifica il colore dell' utente CONTROLLATO
        public function editColor($newColor,$idUt){
            $stmt = $this->db->prepare("INSERT INTO account(Colore) values(?) where IdUtente=?");
            $stmt->bind_param('si', $newColor,$idUt); // 's' specifies the variable type => 'string'
            $stmt->execute();
            return 1==$stmt->affected_rows;
        }//editColor

   }//UtilDB
?>
