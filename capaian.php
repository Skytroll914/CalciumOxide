<?php

	$capaiDB=mysqli_connect('localhost','root','','fraud_detection_prevention_system');

	if(!$capaiDB){
		echo "Capaian ke pangkalan data tidak berjaya.";
		?>
                        <script type="text/javascript">
                            window.alert("Fail");
                            window.location='home.php';
                        </script>   
                        <?php 
	}

?>