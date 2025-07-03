	<?php
        $servername="mysql.mithracon.org";
        $username="solinvictus";
        $pw="\$ynd3xi0i-Taur0cton&";
        $dbname="mithraea";
        

	// Create connection
        $conn = new mysqli($servername,$username,$pw,$dbname);

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}



	?>
