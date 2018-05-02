<?php    
     class UtilSudo extends UtilProf{
        
        /*Eredita da util prof:
            getUser($username,$pw)
            getUserById($idA)
            getCorsi($idProf)
            getIscrittiCorso($idCorso,$idProf)
            getPresenzeCorso($idCorso,$data)
            creaCorso($idProf,$nomeCorso,$postiDisponibili,$descrizione)
            removeStudente($idAccount,$idCorso)
            creaComunicazione($idCorso,$idProf,$data)
            creaComunicazioneEvento($idCorso,$idProf,$idEvento,$data)
            setPresenze($idStudente,$idEvento,$idCorso)
            setUscita($idStudente,$idEvento,$idCorso,$oraUscita)
        */ 
         
        //costruttore ereditato
        public function __construct($conn){
            $this->$db=$conn;
        }//costruttore
         
//RICHIESTE
    
       //ritorna tutti i corsi presenti nel sito
       public function getAllCorsi(){
            $stmt = $this->db->prepare("Select DISTINCT * FROM CORSI ");
            $stmt->bind_param('i',$idProf); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else 
                return $result;
        }//getCorsi  
        
        //ritorna tutte quante le presenze del corso dato 
        public function getPresenzeCorso($idCorso){
            $stmt = $this->db->prepare("Select A.Nome,A.Cognome FROM PRESENZE as P JOIN Account as A ON P.idAccountP = A.idAccount WHERE P.idCorsoP=? AND P.dataP=".now()."");
            $stmt->bind_param('i',$idCorso); 
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else 
                return $result;
        }//getPresenzeCorso
         
//INVIO DATI
         
        //crea un nuovo account che non è studente o genitore
        public function createNotStudente($nome,$cognome,$dataNascita,$numCell,$password,$mail,$nomeUtente,$ruolo){
            $stmt = $this->db->prepare("INSERT INTO ACCOUNT (nome,cognome,dataNascita,cellulare,password,mail,nomeUtente) values (?,?,?,?,?,?,?)");
            $stmt->bind_param('sssissi',$nome,$cognome,$dataNascita,$numCell,$password,$mail,$nomeUtente); 
            $stmt->execute();
            $last_id = $this->$db->insert_id;
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else {
                insertNotStudente($last_id,$ruolo);
            }//else
        }//createUser
         
        //inserisce un nuovo account prof o sudo nelle rispettive tabelle
        public function insertNotStudente($idAccountUser,$ruolo){
            if($ruolo=='Professore')
                $stmt = $this->db->prepare("INSERT INTO PROFESSORI (idProfessore) values (?)");
                $stmt->bind_param('i',$idAccountUser); 
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$result)
                    return false;
                else 
                    return true;
            else if ($ruolo=='sudo'){
                $stmt = $this->db->prepare("INSERT INTO SUPERUSER (idSuperUser) values (?)");
                $stmt->bind_param('i',$idAccountUser); 
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$result)
                    return false;
                else 
                    return true;
            }//else if
        }//insertNotStudente
         
        //metodo per inserire uno stidente all' interno del sistema
        public function insertStudente($nome,$cognome,$dataNascita,$numCell,$password,$mail,$nomeUtente,$matricola){
            $stmt = $this->db->prepare("INSERT INTO ACCOUNT (nome,cognome,dataNascita,cellulare,password,mail,nomeUtente) values (?,?,?,?,?,?,?)");
            $stmt->bind_param('sssissi',$nome,$cognome,$dataNascita,$numCell,$password,$mail,$nomeUtente); 
            $stmt->execute();
            //ottengo l'ultimo id inserito nell' account
            $last_id = $this->$db->insert_id;
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else {
                //collegamento dell' account appena creato con la relazione studenti.
                $stmt = $this->db->prepare("INSERT INTO STUDENTI (idStudente,matricola) values (?,?)");
                $stmt->bind_param('ii',$last_id,$matricola); 
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$result)
                    return false;
                else 
                    return true;
            }//else
        }//insertStudente
     }//UtilSudo
?>