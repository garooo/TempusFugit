<?php
     class UtilProf extends UtilDB{

        //costruttore ereditato
        public function __construct($conn){
            $this->$db=$conn;
        }//costruttore

//RICHIESTE PROFESSORE AL DB

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

        //ritorna tutti i corsi gestiti dal professore $idProf
        public function getCorsi($idProf){
            $stmt = $this->db->prepare("Select DISTINCT NomeCorso FROM CORSI where IdProf=?");
            $stmt->bind_param('i',$idProf);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getCorsi

        public function getIscrittiCorso($idCorso,$idProf){
            $stmt = $this->db->prepare("Select A.Nome,A.Cognome,A.dataNascita(FROM Iscrizioni as I JOIN Account as A ON I.idAccountI=A.idAccount)JOIN CORSI as C ON I.idCorsoI=C.idCorso WHERE I.idCorsoI=? AND C.idProf=?");
            $stmt->bind_param('ii',$idCorso,$idProf);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getIscrittiCorso

        public function getpPresenzeCorso($idCorso,$data){
            $stmt = $this->db->prepare("Select A.Nome,A.Cognome FROM PRESENZE as P JOIN Account as A ON P.idAccountP = A.idAccount WHERE P.idCorsoP=? AND P.dataP=?");
            $stmt->bind_param('is',$idCorso,$data);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getIscrittiCorso


        //INVIO DATI PROF DB

        /*Crea un nuovo corso*/
        public function creaCorso($idProf,$nomeCorso,$postiDisponibili,$descrizione){
            $stmt = $this->db->prepare("INSERT INTO CORSI(nomeCorso,idProf,postiDisponibili,descrizione) values(?,?,?,?)");
            $stmt->bind_param('siis',$nomeCorso,$idProf,$postiDisponibili,$descrizione);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//creaCorso

        /*rimuove uno studente da un corso*/
        public function removeStudente($idAccount,$idCorso){
            $stmt = $this->db->prepare("DELETE FROM ISCRIZIONI WHERE idAccountI=? AND idCorsoI=?");
            $stmt->bind_param('ii',$idAccount,$idCorso);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//removeStudente

        /*pubblica una comunicazione sul corso*/
        public function creaComunicazione($idCorso,$idProf,$data){
            $stmt = $this->db->prepare("INSERT INTO COMUNICAZIONI(idCorsoCom,idProfCom,dataCom) values(?,?,?)");
            $stmt->bind_param('iis',$idCorso,$idProf,$data);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//creaComunicazione

        /*pubblica una comunicazione sul corso allegata ad un evento*/
        public function creaComunicazioneEvento($idCorso,$idProf,$idEvento,$data){
            $stmt = $this->db->prepare("INSERT INTO COMUNICAZIONI(idCorsoCom,idProfCom,idEventoCom,dataCom) values(?,?,?,?)");
            $stmt->bind_param('iiis',$idCorso,$idProf,$idEvento,$data);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//creaComunicazioneEvento

        public function setPresenze($idStudente,$idEvento,$idCorso){
            $stmt = $this->db->prepare("INSERT INTO PRESENZE(idAccountP,idEventoP,idCorsoP,oraEntrata) values(?,?,?,".now().")");
            $stmt->bind_param('iii',$idStudente,$idEvento,$idCorsoP);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//setPresenze

        public function setPresenze($idStudente,$idEvento,$idCorso,$oraUscita){
            $stmt = $this->db->prepare("INSERT INTO PRESENZE(oraUscita) values(?) WHERE idAccountP=? AND idEventoP=? AND idCorsoP=?");
            $stmt->bind_param('siii',$oraUscita,$idStudente,$idEvento,$idCorsoP);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return false;
            else
                return true;
        }//setPresenze
    }//UtilProf
?>
