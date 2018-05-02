<?php
include'UtilDB.php';
     class UtilProf extends UtilDB{


        public function __construct(){
            $this->db=new mysqli("annoiato.net","professore","UZnXcEZ40p","tempusfugit");
            if ($this->db->connect_error){
                die('Connessione fallita: '.$this->db->connect_error);
            }//if
        }//costruttore senza parametri

//RICHIESTE PROFESSORE AL DB

         //date le credenziali di accesso ritorna l'id dell' utente CONTROLLATO

        //ritorna tutti i corsi gestiti dal professore $idProf //OK il funzionamento
        public function getCorsi($idProf){
            $stmt = $this->db->prepare("Select DISTINCT nomeCorso FROM corsi where idProf=?");
            $stmt->bind_param('i',$idProf);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!$result)
                return null;
            else
                return $result;
        }//getCorsi

        public function getIscrittiCorso($idCorso,$idProf){//OK funzionamento
            $stmt = $this->db->prepare("Select A.nome,A.cognome,A.dataNascita FROM iscrizioni as I JOIN account as A ON I.idAccountI=A.idAccount JOIN corsi as C ON I.idCorsoI=C.idCorso WHERE I.idCorsoI=? AND C.idProf=?");
            $stmt->bind_param('ii',$idCorso,$idProf);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getIscrittiCorso

        public function getPresenzeCorso($idCorso,$data){//OK funzionamento
            $stmt = $this->db->prepare("Select A.nome,A.cognome FROM presenze as P JOIN account as A ON P.idAccountP = A.idAccount WHERE P.idEventoP=? AND P.dataP=?");
            $stmt->bind_param('is',$idCorso,$data);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getIscrittiCorso


//INVIO DATI PROF DB MANCA LA CONFERMA ok il funzionamento

        /*Crea un nuovo corso OK funzia*/
        public function creaCorso($nomeCorso,$idProf,$postiDisponibili,$descrizione){
            $stmt = $this->db->prepare("INSERT INTO corsi(idCorso,nomeCorso,idProf,nPosti,descrizione) values(UUID(),?,?,?,?)");
            $stmt->bind_param('siis',$nomeCorso,$idProf,$postiDisponibili,$descrizione);
            $stmt->execute();
            return 1==$stmt->affected_rows;

        }//creaCorso

        /*rimuove uno studente da un corso OK funzia*/
        public function removeStudente($idAccount,$idCorso){
            $stmt = $this->db->prepare("DELETE FROM iscrizioni WHERE idAccountI=? AND idCorsoI=?");
            $stmt->bind_param('ii',$idAccount,$idCorso);
            $stmt->execute();
            return 1==$stmt->affected_rows;
        }//removeStudente

        /*pubblica una comunicazione sul corso*/
        public function creaComunicazione($idCorso,$data,$idProf,$testo){
            $stmt = $this->db->prepare("INSERT INTO comunicazioni(idCorsoCom,dataCom,idProfCom,testo) values(?,?,?,?)");
            $stmt->bind_param('isis',$idCorso,$data,$idProf,$testo);
            $stmt->execute();
            return 1==$stmt->affected_rows;
        }//creaComunicazione

        /*pubblica una comunicazione sul corso allegata ad un evento*/
        public function creaComunicazioneEvento($idCorso,$data,$idProf,$idEvento,$testo){
            $stmt = $this->db->prepare("INSERT INTO comunicazioni(idCorsoCom,dataCom,idEventoCom,idProfCom,testo) values(?,?,?,?,?)");
            $stmt->bind_param('isiis',$idCorso,$data,$idEventoCom,$idProfCom,$testo);
            $stmt->execute();
            return 1==$stmt->affected_rows;
        }//creaComunicazioneEvento


        //mette presente uno studente ad un evento
        public function setPresenze($idStudente,$idEvento,$oraEntr,$idProfF){
            $stmt = $this->db->prepare("INSERT INTO presenze(idAccountP,idEventoP,oraEntrata,idProfFirma) values(?,?,?,?,?)");
            $stmt->bind_param('iisi',$idStudente,$idEvento,$oraEntr,$idProfF);
            $stmt->execute();
            return 1==$stmt->affected_rows;
        }//setPresenze

        //mette presente uno studente ad un evento
        public function updatePresenze($idStudente,$idEvento,$oraEntr, $oraUsc, $idOra,$idProfF){
            $stmt = $this->db->prepare("UPDATE  presenze SET oraEntrata = ?, oraUscita = ?, idProfFirma = ? WHERE idAccountP = ? AND idEventoP = ?");
            $stmt->bind_param('ssiii',$oraEntr, $oraUsc,$idProfF, $idStudente, $idEvento);
            $stmt->execute();
            return 1==$stmt->affected_rows;
        }//setPresenze

	public function terminaEvento($idEvento, $idProfF){
            $stmt = $this->db->prepare("UPDATE  presenze SET oraUscita = CURTIME(), idProfFirma = ? WHERE oraUscita IS NULL AND idEventoP = ?");
            $stmt->bind_param('ii', $idProfF,$idEvento);
            $stmt->execute();
            return 1==$stmt->affected_rows;

	}

        //setta un' uscita di uno studente
        public function setUscita($idStudente,$idEvento, $idProfF){
            $stmt = $this->db->prepare("UPDATE  presenze SET oraUscita = CURTIME(), idProfFirma = ? WHERE oraUscita IS NULL AND idAccountP = ? AND idEventoP = ?");
            $stmt->bind_param('iii', $idProfF,$idStudente,$idEvento);
            $stmt->execute();
            return 1==$stmt->affected_rows;
        }//setUscita

        //crea evento
        public function creaEvento($idCorso,$dataOra,$luogo,$postiDisponibili){
            $stmt = $this->db->prepare("INSERT INTO eventi(idEvento,idCCorso,dataOra,luogo,nPart) values(UUID(),?,?,?,?)");
            $stmt->bind_param('issi',$idCorso,$dataOra,$luogo,$postiDisponibili);
            $stmt->execute();
            return 1==$stmt->affected_rows;
        }//creaCorso


    }//UtilProf
?>
