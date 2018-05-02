<?php
	include ("../../Util/UtilStudente.php");

    session_start();
	
    if(isset($_SESSION['ruolo'])){
		
        if(($_SESSION['ruolo'] == 's')||($_SESSION['ruolo'] == 'p')){ 
		
			if(!empty($_POST['idDiscussione'])){
				$uSt = new UtilStudente();
				
				$result = $uSt->getComunicazioni($_SESSION['id'], $_POST['idDiscussione']);
				
				$uSt->close();
				
				if($result){
					$return = $result->fetch_all(MYSQL_ASSOC);
					echo json_encode(array_merge(array("esito"=> "ok"), $return));
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