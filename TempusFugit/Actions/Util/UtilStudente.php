<?php
    include'UtilDB.php';

    class UtilStudente extends UtilDB{

        public function __construct(){
            $this->db=new mysqli("annoiato.net","studente","IbDvwikDfB","tempusfugit");
            if ($this->db->connect_error){
                die('Connessione fallita: '.$this->db->connect_error);
            }//if
        }//costruttore senza parametri


/**RICHIESTE STUDENTE**/

        /*ritorna i corsi disponibili allo studente $idUT - Controllato il funzionamento*/
        public function getCorsiDisp($idUt){
            $stmt = $this->db->prepare("SELECT C.idCorso, C.nomeCorso, CONCAT (P.nome , \" \", P.cognome) as Prof,C.descrizione,C.nPosti - count(I.idAccountI) as postiDisponibili
                                        FROM (corsi as C join account as P on C.idProf = P.idAccount) left join iscrizioni as I on C.idCorso = I.idCorsoI
                                        where I.idAccountI <> ? OR I.idAccountI IS NULL
                                        Group by C.idCorso, C.nPosti
                                        having C.nPosti > count(I.idAccountI) ");
            $stmt->bind_param('i',$idUt);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!$result)
                return null;
            else
                return $result;
        }//getCorsiDisp

        //ritorna tutti i corsi a cui � iscritto lo studente $idUT- Controllato il funzionamnto
        public function getCorsiIscritto($idUt){
            $stmt = $this->db->prepare("SELECT C.idCorso, C.nomeCorso, CONCAT (P.nome , \" \", P.cognome) as Prof,C.descrizione
					FROM (corsi as C join account as P on C.idProf = P.idAccount) Join iscrizioni as I on C.idCorso = I.IdCorsoI
					where I.IdAccountI = ?");
            $stmt->bind_param('i',$idUt);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!$result)
                return null;
            else
                return $result;
        }//getCorsiIscritto

        /*ritorna tutte le comunicazioni in una discussione in un corso  Controllato il funzionamento*/
        public function getComunicazioni($idCorso){
            $stmt = $this->db->prepare("SELECT * FROM comunicazioni where idCorsoCom=?");
            $stmt->bind_param('i',$idCorso);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!$result)
                return null;
            else
                return $result;
        }//getComunicazioni


        //ritorna tutti gli eventi a cui lo studente è iscritto a partire dalla data odierna. - Controllato il funzionamento
        public function getProssimiEventi($idStudente){
            $stmt = $this->db->prepare("SELECT e.idEvento, e.titolo, e.descrizione,e.dataOraInizio,e.luogo, c.nomeCorso
                                        FROM (eventi as e join iscrizioni as i on e.idCorso=i.idCorsoI) join corsi as c on e.idCorso = c.idCorso
                                        WHERE i.idAccountI=? AND e.dataOraInizio >= NOW()");
            $stmt->bind_param('i',$idStudente);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!$result)
                return null;
            else
                return $result;
        }//getEventi

/**INVIO DATI STUDENTE QUERY FUNZIONANO MANCA IL CONtrOLLO DEL RISULTATO**/

       //iscrizione corso CONTROLLATO
       public function iscrizioneCorso($idAc,$idC){
            $stmt = $this->db->prepare("INSERT INTO iscrizioni(idAccountI,idCorsoI) values(?,?)");
            $stmt->bind_param('ii',$idAc,$idC);
            $stmt->execute();
            return 1==$stmt->affected_rows;

       }//iscrizioneCorso


       //inserisce una presenza
       public function confermaPresenza($idAccount,$idEvento,$idCorso){
            $stmt = $this->db->prepare("INSERT INTO presenze(idAccountP,idEventoP,idCorsoP) values(?,?,?)");
            $stmt->bind_param('iii', $idAccount,$idEvento,$idCorso);
            $stmt->execute();
            return 1==$stmt->affected_rows;
       }//confermaPresenza

       public function confermaLettura($idAccount,$idComunicazione){
            $stmt = $this->db->prepare("INSERT INTO visualizzazioni(idAccountV,idComunicazioneV) values(?,?)");
            $stmt->bind_param('ii', $idAccount,$idComunicazione);
            $stmt->execute();
            return 1==$stmt->affected_rows;
       }//confermaLettura

   }//UtilStudente
?>
