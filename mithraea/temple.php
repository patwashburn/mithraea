<html lang="en">
  <head>
    <title>The Mithras Index</title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="../stylesheets/master.css">
     <?php 
        include_once('db.php');

        $temple = urldecode($_GET['temple']);

        if (isset($temple)) {
            $tem = 'SELECT * FROM mithraea WHERE Name = "' . mysqli_real_escape_string($conn,$temple) . '"';
        }
        ?>
  </head>

  <body>

    <div id="#content" style="display:block; padding:10px;">
        <?php $result_set = mysqli_query($conn, $tem); 

         if(mysqli_connect_errno()) {
      $msg = "Database connection failed: ";
      $msg .= mysqli_connect_error();
      $msg .= " (" . mysqli_connect_errno() . ")";
      exit($msg);
    }
?>
       <?php if ($result_set) { 
           $t=mysqli_fetch_assoc($result_set);
           $templeName = $t['Name'];
           $templePlace = $t['Location'];
           $templeStatus = $t['Status'];
           $templeFinds = $t['Key Finds'];
           $templeRef = $t['CIMRM/Other Ref'];
           $templeLat = $t['Latitude'];
           $templeLong = $t['Longitude'];
           $templeDate = $t['Date Discovered'];
           $templeNotes = $t['Notes'];
           $templeComments = $t['Comments'];
       }
       else {
           exit('Database query failed.');
       }
           ?>
           
        
            <h1><?php echo($templeName); ?></h1>
            <p><?php echo($templePlace); ?></p>
            <p>Status: <?php echo($templeStatus); ?></p>
            <p>Key Finds: <?php echo($templeFinds); ?></p>
            <p><?php if (strlen($templeRef) > 4) {
                echo('CIMRM/Other Ref: ');
                echo($templeRef); 
            }
            ?></p>
            <p>Latitude: <?php echo($templeLat); ?> Longitude: <?php echo($templeLong); ?></p>
            <p>Date Discovered: <?php echo($templeDate); ?></p>
            <p>Notes: <?php echo($templeNotes)?></p>
            <?php if ($templeComments) {
                echo("Comments: ");
                echo ($templeComments);
            } 
       ?>


<?php 
    mysqli_free_result($result_set);
    mysqli_close($conn);
    include_once('footer.php'); ?>