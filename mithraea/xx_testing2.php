  <html>
  <head>
    <title>The Mithras Index</title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="../stylesheets/master.css">
    <?php 
        include_once('db.php');
        ?>
  </head>

  <body>

  <h1>a title</h1>
  <p>
  <?php     

// Perform query
if ($result = mysqli_query($conn, "SELECT * FROM mithraea")) {
  while($row = mysqli_fetch_row($result)) {
    //echo $row['column_name']; // Print a single column data
    echo print_r($row['0']);       // Print the entire row data
  }


  // Free result set
  mysqli_free_result($result);
}

mysqli_close($conn);

    ?>
    </p>
    </body>
    </html>