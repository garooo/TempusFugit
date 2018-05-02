<?php
	include ("../../Util/UtilStudente.php");

    session_start();

    if(isset($_SESSION['ruolo'])){

			if($_SESSION['ruolo'] == 's'){
				if(!empty($_SESSION['id'])){
						$uSt = new UtilStudente();

						$result = $uSt->getProssimiEventi($_SESSION['id']);

						$uSt->close();

						if($result != NULL){
							$return = $result->fetch_all(MYSQLI_ASSOC);
							echo json_encode(array_merge(array("esito"=> "ok"), ARRAY("risultati" => $return)));
						}else{
							echo json_encode(array_merge(array("esito"=> "ok"), ARRAY("risultati" => array())));
						}
					}else
						echo json_encode(array('esito' => 'postnotfound'));
        }else{
            $a = array('esito' => 'roleerror');
			echo json_encode($a);
        }//if-else
    }else{
        $a = array('esito' => 'notlogged');
		echo json_encode($a);
    }//if-else
?>
