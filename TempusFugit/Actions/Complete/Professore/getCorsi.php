<?php
	include ("../../Util/UtilProf.php");

    session_start();

    if(isset($_SESSION['ruolo'])){

        if($_SESSION['ruolo'] == 'p'){
					$uSt = new UtilProf();

					$result = $uSt->getCorsi($_SESSION['id']);

					$uSt->close();

					if($result != NULL){
						$return = $result->fetch_all(MYSQLI_ASSOC);
						echo json_encode(array_merge(array("esito"=> "ok"), ARRAY("risultati" => $return)));
					}else{
							echo json_encode(array_merge(array("esito"=> "ok"), ARRAY("risultati" => array())));
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
