<?php
    include'UtilProf.php';
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


        public function __construct(){
            $this->db=new mysqli("annoiato.net","admin","tWgGYEY6SY","tempusfugit");
            if ($this->db->connect_error){
                die('Connessione fallita: '.$this->db->connect_error);
            }//if
        }//costruttore senza parametri


//RICHIESTE

       //ritorna tutti i corsi presenti nel sito - OK
       public function getAllCorsi(){
            $stmt = $this->db->prepare("Select DISTINCT * FROM corsi");
           var_dump($stmt);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!$result)
                return null;
            else
                return $result;
        }//getCorsi



        //ritorna tutte quante le presenze del corso dato - OK
        public function getPresenzeCorso($idCorso,$data){
            $stmt = $this->db->prepare("Select A.Nome,A.Cognome FROM presenze as P JOIN account as A ON P.idAccountP = A.idAccount WHERE P.idEventoP=? AND P.dataP=?");
            $stmt->bind_param('is',$idCorso,$data);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!$result)
                return null;
            else
                return $result;
        }//getPresenzeCorso

//INVIO DATI

        //crea un nuovo account che non � studente o genitore - OK
        public function createUser($nome,$cognome,$dataNascita,$numCell,$password,$mail,$nomeUtente,$ruolo){
            $stmt = $this->db->prepare("INSERT INTO account (nome,cognome,dataNascita,cellulare,password,mail,nomeUtente,ruolo) values (?,?,?,?,?,?,?,?)");
            $stmt->bind_param('sssissis',$nome,$cognome,$dataNascita,$numCell,$password,$mail,$nomeUtente,$ruolo);
            $stmt->execute();
            $last_id = $this->$db->insert_id;

            return 1 ===$stmt->affected_rows;
        }//createUser


        //metodo per unire un genitore al figlio dentro il sistema - OK
        public function insertFiglio($idGenitore,$idFiglio){
                //collegamento dell' account appena creato con la relazione studenti.
                $stmt = $this->db->prepare("INSERT INTO genitorefiglio (idGenitore,idFiglio) values (?,?)");
                $stmt->bind_param('ii',$idGenitore,$idFiglio);
                $stmt->execute();
                return 1==$stmt->affected_rows;
            }//else
        }//insertStudente

     }//UtilSudo
?>
