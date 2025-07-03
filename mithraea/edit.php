<html lang="en">
  <head>
    <title>The Mithras Index: Update</title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="../stylesheets/master.css">
     <?php 
        include_once('db.php');

        $temple = urldecode($_GET['temple']);

        if (isset($temple)) {
            $tem = 'SELECT * FROM mithraea WHERE Name = "' . $temple . '"';
        }
        ?>
  </head>

  <body>
    
    <div id="#content" style="display:block; padding:10px;">
        <?php 
        $result_set = mysqli_query($conn, $tem); 
       
        if(mysqli_connect_errno()) {
            $msg = "Database connection failed: ";
            $msg .= mysqli_connect_error();
            $msg .= " (" . mysqli_connect_errno() . ")";
            exit($msg);
        }
        if ($result_set) { 
           $t=mysqli_fetch_assoc($result_set);
           $templeName = $t['Name'];
           $templePlace = $t['Location'];
           $templeContinent = $t['Continent'];
           $templeCountry = $t['Country'];
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
           echo('Database query failed.');
       }
           ?>
           
        <table width="100%" style="margin:10px;">
            <tr><td width="50%" valign="top">
            <h1>Updating '<?php echo($templeName); ?>'</h1>
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
<p>
        </td>
        <td valign="top">

            <form action= "" method="POST">


                <dl>
                    <dt>Name</dt>
                    <dd><input type="text" name="newTempleName" value="<?php echo($templeName); ?>" /></dd>
                    <dt>Location</dt>
                    <dd><input type="text" name="newTemplePlace" value="<?php echo($templePlace); ?>" /></dd>
                    <dt>Region</dt>
                    <dd><select name="newContinent" id="newContinent">
                        <?php 
                        $regions=['Africa', 'Asia', 'Europe', 'Middle East'];
                        foreach ($regions as $region) {
                            $opt = "<option value = \"" . $region . "\"";
                            if ($region == $templeContinent) {
                                $opt .= ' selected';
                            }
                            $opt .= '>' . $region . '</option>';
                            echo $opt;
                        }
                        ?>

                        </select>
                    <dt>Country</dt>
                    <dd><select name="newCountry" id="newCountry">
                        <?php 
                        $country='';
                        $countries=['Algeria', 'Armenia', 'Austria', 'Belgium', 'Bulgaria', 'Crimea', 'Croatia', 'Egypt', 'France', 'Georgia', 'Germany', 'Greece', 'Hungary', 'Iraq', 'Israel', 'Italy',
                        'Jordan', 'Lebanon', 'Libya', 'Moldova', 'Morocco', 'North Macedonia', 'Portugal', 'Romania', 'Saudia Arabia', 'Serbia', 'Slovenia', 'Spain', 'Switzerland','Syria','Tunisia',
                        'Turkey', 'UK', 'Ukraine', 'Yemen', 'Legendary'];
                        foreach ($countries as $country) {
                            $opt = "<option value = \"" . $country . "\"";
                            if ($country == $templeCountry) {
                                $opt .= ' selected';
                            }
                            $opt .= '>' . $country . '</option>';
                            echo $opt;
                        }
                        ?>
                        
                        </select></dd> 

                        <dt>Status</dt>
                                            <dd><input type="text" id="newTempleStatus" name="newTempleStatus" value="<?php echo($templeStatus); ?>" /></dd>
                        <dt>Key Finds</dt>
                    <dd><input type="text" id="newTempleFinds" name="newTempleFinds" value="<?php echo($templeFinds); ?>" /></dd>
                                        <dt>CIMRM/Other Ref</dt>
                    <dd><input type="text" id="newTempleRef" name="newTempleRef" value="<?php echo($templeRef); ?>" /></dd>
                                        <dt>Latitude</dt>
                    <dd><input type="text" id="newTempleLat" name="newTempleLat" value="<?php echo($templeLat); ?>" /></dd>
                                        <dt>Longitude</dt>
                    <dd><input type="text" id="newTempleLong" name="newTempleLong" value="<?php echo($templeLong); ?>" /></dd>
                                        <dt>Date Discovered</dt>
                    <dd><input type="text" id="newTempleDate" name="newTempleDate" value="<?php echo($templeDate); ?>" /></dd>
                                        <dt>Notes</dt>
                    <dd><input type="text" id="newTempleNotes" name="newTempleNotes" value="<?php echo($templeNotes); ?>" /></dd>
                                        <dt>Comments (long-form)</dt>
                    <dd><textarea rows="4" cols="50" id="newTempleComments" name="newTempleComments" value="<?php echo($templeComments); ?>" /></textarea></dd>
                    </dl>
                    <input type="submit" value="Update Entry"><br />
                <?php 
                if ($_SERVER["REQUEST_METHOD"] == "POST") {  
                    // Only process the POST data if the form is submitted
                    if ($_POST['newTempleName'] != $templeName) {
                        $newTempleName = $_POST['newTempleName'];
                        echo $newTempleName;
                    }
                    if ($_POST['newTemplePlace'] != $templePlace) {
                        $newTempleLocation = $_POST['newTemplePlace'];
                        $newTempleLat = $_POST[newTempleLat];
                        $newTempleLong = $_POST[newTempleLong];
                    }
                    if ($_POST['newTempleStatus'] != $templeStatus) {
                        $newTempleStatus = $_POST['newTempleStatus'];
                    }
                    if ($_POST['newTempleFinds'] != $templeFinds) {
                        $newTempleFinds = $_POST['newTempleFinds'];
                    }
                    if ($_POST['newTempleRef'] != $templeRef) {
                        $newTempleRef = $_POST['newTempleRef'];
                    }
                    if ($_POST['newTempleDate'] != $templeDate) {
                        $newTempleDate = $_POST['newTempleDate'];
                    }
                    if ($_POST['newTempleNotes'] != $templeNotes) {
                        $newTempleNotes = $_POST['newTempleNotes'];
                    }
                    if ($_POST['newTempleComments'] != $templeComments) {
                        $newTempleComments = $_POST['newTempleComments'];
                    }

                    $sql = "UPDATE mithraea SET ";
                    if ($newTempleName) {
                        $newTempleName = htmlspecialchars($newTempleName);
                        $sql .= "Name = '" . $newTempleName . "',";
                    }
                    if ($newTemplePlace) {
                        $newTemplePlace = htmlspecialchars($newTemplePlace);
                        $sql .= "Location = '" . $newTemplePlace . "',";
                    }
                    if ($newTempleContinent) {
                        $sql .= "Continent = '" . $newContinent . "',";
                    }
                    if ($newTempleCountry) {
                        $sql .= "Country = '" . $newCountry . "',";
                    }
                    if ($newTempleStatus) {
                        $newTempleStatus = htmlspecialchars($newTempleStatus);
                        $sql .= "Status = '" . $newTempleStatus . "',";
                    }
                    if ($newTempleFinds) {
                        $newTempleFinds = htmlspecialchars($newTempleFinds);
                        $sql .= "`Key Finds` = '" . $newTempleFinds . "',";
                    }
                    if ($newTempleRef) {
                        $newTempleRef = htmlspecialchars($newTempleRef);
                        $sql .= "`CIMRM/Other Ref` = '" . $newTempleRef . "',";
                    }
                    if ($newTempleLat) {
                        $newTempleLat = htmlspecialchars($newTempleLat);
                        $sql .= "Latitude = '" . $newTempleLat . "',";
                    }
                    if ($newTempleLong) {
                        $newTempleLong = htmlspecialchars($newTempleLong);
                        $sql .= "Longitude = '" . $newTempleLong . "',";
                    }
                    if ($newTempleDate) {
                        $newTempleDate = htmlspecialchars($newTempleDate);
                        $sql .= "`Date Discovered` = '" . $newTempleDate . "',";
                    }
                    if ($newTempleNotes) {
                        $newTempleNotes = htmlspecialchars($newTempleNotes);
                        $sql .= "Notes = '" . $newTempleNotes . "',";
                    }
                    if ($newTempleComments) {
                        $newTempleComments = htmlspecialchars($newTempleComments);
                        $sql .= "Comments = '" . $newTempleComments . "' ";
                    }
                    if (substr($sql, -1) == ',') {
                        $sql = substr_replace($sql, ' ', -1);
                    }

                    $sql .= "WHERE Name = '" . $t['Name'] . "' ";
                    $sql .= "LIMIT 1;";

                    $result = mysqli_query($conn,$sql);

                    if ($result) {
                        header('Location: temple.php?temple="' . $newTempleName);
                    }
                    else {
                        echo(mysqli_connect_error($conn));
                    }

                }

                 ?>
                    </form>

                    </td></tr></table>
                


                </div>
                
   <?php mysqli_free_result($result_set);
    mysqli_close($conn);
    include_once('footer.php'); ?>