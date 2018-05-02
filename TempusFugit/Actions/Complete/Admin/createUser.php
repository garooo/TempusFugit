<?php
	include (../../Util/UtilProfessore.php);

    session_start();
	
    if(isset($_SESSION['ruolo'])){
		
        if($_SESSION['ruolo'] == 'a'){ 
		
			if(!empty($_POST)){
				$dbProfessore = new UtilProfessore(new mysqli("localhost", "root", "", "TempusFugit");
				
				$esito = $dbProfessore->query("insert into ");
				
				$dbProfessore->close();
				
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
?>-