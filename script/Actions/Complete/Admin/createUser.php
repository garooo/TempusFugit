<?php
	$a = array('esito	' => 'ok');
	echo json_encode($a);

		/*include "../../Util/UtilProf.php";

    session_start();

    if(isset($_SESSION['ruolo'])){
        if($_SESSION['ruolo'] == 'a'){
					if(!empty($_POST)){
						$dbAdmin = new UtilProf(new mysqli("localhost", "root", "", "tempusfugit"));
						//$esito = $dbAdmin->insertNotStudente($_SESSION['id'], $_SESSION['ruolo']);
						$esito= $dbAdmin->query("INSERT INTO professori(idProf) VALUES(rand())");
						$dbProfessore->close();
						if($esito){
							$a = array('esito' => 'ok');
							echo json_encode($a);
						}else{
							$a = array('esito' => 'dberror');
							echo json_encode($a);
						}//if-else
					}else{
						$a = array('esito' => 'postnotfound');
						echo json_encode($a);
					}//if-else
        }else{
            $a = array('esito' => 'roleerror');
						echo json_encode($a);
        }//if-else
    }else{
        $a = array('esito' => 'notlogged');
				echo json_encode($a);
    }//if-else*/
?>
