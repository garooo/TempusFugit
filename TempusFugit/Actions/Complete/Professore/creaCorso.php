<?php
	include ("../../Util/UtilProf.php");

    session_start();

    if(isset($_SESSION['ruolo'])){

        if($_SESSION['ruolo'] == 'p'){

			if((!empty($_POST['nomeCorso']))&&(!empty($_POST['postiDisponibili']))&&(!empty($_POST['descrizione']))){
				$uPr = new UtilProf();

				$esito = $uPr->creaCorso($_POST['nomeCorso'], $_SESSION['id'], (int)$_POST['postiDisponibili'], $_POST['descrizione']);

				$uPr->close();

				if($esito){
					$a = array('esito' => 'ok');
					echo json_encode($a);
				}else{
					$a = array('esito' => 'dberror');
					echo json_encode($a);
				}
			}else
				$a = array('esito' => 'postnotfound');
				echo json_encode($a);
        }else{
            $a = array('esito' => 'roleerror');
						echo json_encode($a);
        }//if-else
    }else{
        $a = array('esito' => 'notlogged');
		echo json_encode($a);
    }//if-else
?>
