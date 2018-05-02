<?php
	include ("../../Util/UtilProf.php");

    session_start();

    if(isset($_SESSION['ruolo'])){

        if($_SESSION['ruolo'] == 'p'){

	          if((!empty($_POST['idCorso']))&&(!empty($_POST['testo']))){
	    				$uPr = new UtilProf();

	    				$esito = $uPr->creaComunicazione($_POST['idCorso'],date("yyyy-MM-dd"), $_SESSION['id'], $_POST['testo']);

	    				$uPr->close();

	    				if($esito){
	    					$a = array('esito' => 'ok');
	    					echo json_encode($a);
	    				}else{
	    					$a = array('esito' => 'dberror');
	    					echo json_encode($a);
	    				}
	    			}else{
	    				$a = array('esito' => 'postnotfound');
	    				echo json_encode($a);
						}
    			}else{
            $a = array('esito' => 'roleerror');
			echo json_encode($a);
        }//if-else
    }else{
        $a = array('esito' => 'notlogged');
		echo json_encode($a);
    }//if-else
?>
