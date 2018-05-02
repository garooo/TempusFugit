<?php
    include'UtilDB.php';
    class UtilGenitore extends UtilDB{

        public function __construct(){
            $this->db=new mysqli("annoiato.net","genitore","0gFdDuFR2x","tempusfugit");
            if ($this->db->connect_error){
                die('Connessione fallita: '.$this->db->connect_error);
            }//if
        }//costruttore senza parametri


        //ritorna i corsi a cui è iscirtto il figlio e le info del professore che gestisce il corso //OK
        public function getCorsiFiglio($idFiglio){
            $stmt = $this->db->prepare("SELECT DISTINCT aa.nome,aa.cognome, C.idCorso,C.nomeCorso,C.descrizione FROM iscrizioni as I JOIN corsi as C ON I.idCorsoI=C.idCorso JOIN account as a ON C.idProf=P.idAccount JOIN account as aa on P.IdProfessore= aa.idAccount WHERE I.idAccountI=?");
            $stmt->bind_param('i',$idUt);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getCorsiFiglio
	
	 public function getPresenzeFiglio($idFiglio){
            $stmt = $this->db->prepare("SELECT e.idEvento, e.Titolo as evento, c.idCorso, c.nomeCorso, e.dataOraInizio, e.luogo, CONCAT(a.nome, \" \", a.cognome) as firmatoDa, p.oraEntrata, p.oraUscita
					FROM ((presenze as p join eventi as e on p.idEventoP = e.idEvento) join corsi as c on e.idCorso = c.idCorso) Join account as a on p.idProfFirma = a.idAccount
					WHERE p.idAccountP = ?
					ORDER BY  e.dataOraInizio");
            $stmt->bind_param('i',$idFiglio);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else
                return $result;
         }

         public function getPresenzeCorso($idCorso,$idFiglio){//OK
            $stmt = $this->db->prepare("SELECT e.idEvento, e.Titolo as evento, c.nomeCorso, e.dataOraInizio, e.luogo, CONCAT(a.nome, \" \", a.cognome) as firmatoDa, p.oraEntrata, p.oraUscita
                                        FROM ((presenze as p join eventi as e on p.idEventoP = e.idEvento) join corsi as c on e.idCorso = c.idCorso) Join account as a on p.idProfFirma = a.idAccount
                                        WHERE p.idAccountP = ? AND c.idCorso = ?
                                        ORDER BY  e.dataOraInizio");
            $stmt->bind_param('ii',$idFiglio,$idCorso);
            $stmt->execute();
            $result = $stmt->get_result();
            if(!$result)
                return null;
            else
                return $result;
        }//getIscrittiCorso

        public function confermaLettura($idAccount,$idComunicazione){//ok
            $stmt = $this->db->prepare("INSERT INTO visualizzato(idAccountV,idComunicazione) values(?,?)");
            $stmt->bind_param('ii', $idAccount,$idComunicazione);
            $stmt->execute();
            return 1==$stmt->affected_rows;
        }//confermaLettura

?>
