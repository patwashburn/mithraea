<html lang="en">
  <head>
    <title>The Mithras Index: Add</title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="../stylesheets/master.css">
     <?php 
        include_once('db.php');

        function display_errors($errors) {
            foreach($errors as $error) {
                echo $error;
            }
        }

        ?>
  </head>

  <body>
    
    <div id="#content" style="display:block; padding:10px;">
        <h1>Add an Entry</h1>
            <form action= "" method="POST">


                <dl>
                    <dt>Name</dt>
                    <dd><input type="text" name="newTempleName" /></dd>
                    <dt>Location</dt>
                    <dd><input type="text" name="newTemplePlace" /></dd>
                    <dt>Region</dt>
                    <dd><select name="newContinent" id="newContinent">
                        <?php 
                        $regions=['Africa', 'Asia', 'Europe', 'Middle East'];
                        foreach ($regions as $region) {

                
                
                            $opt = "<option value = \"" . $region . "\"";
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
                            $opt .= '>' . $country . '</option>';
                            echo $opt;
                        }
                        ?>
                        
                        </select></dd> 

                        <dt>Status</dt>
                                            <dd><input type="text" id="newTempleStatus" name="newTempleStatus" /></dd>
                        <dt>Key Finds</dt>
                    <dd><input type="text" id="newTempleFinds" name="newTempleFinds" /></dd>
                                        <dt>CIMRM/Other Ref</dt>
                    <dd><input type="text" id="newTempleRef" name="newTempleRef" /></dd>
                                        <dt>Latitude</dt>
                    <dd><input type="text" id="newTempleLat" name="newTempleLat" /></dd>
                                        <dt>Longitude</dt>
                    <dd><input type="text" id="newTempleLong" name="newTempleLong" /></dd>
                                        <dt>Date Discovered</dt>
                    <dd><input type="text" id="newTempleDate" name="newTempleDate" /></dd>
                                        <dt>Notes</dt>
                    <dd><input type="text" id="newTempleNotes" name="newTempleNotes" /></dd>
                                        <dt>Comments (long-form)</dt>
                    <dd><textarea rows="4" cols="50" id="newTempleComments" name="newTempleComments" /></textarea></dd>
                    </dl>
                    <input type="submit" value="Add Entry"><br />

            </form>
        </div>
            
                <?php 
                if ($_SERVER["REQUEST_METHOD"] == "POST") {  
                    // Only process the POST data if the form is submitted

                    // Cast form data into variables and check name for uniqueness
                    $newTempleName=htmlspecialchars($_POST['newTempleName']);
                    $nameTest = "SELECT * from mithraea ";
                    $nameTest .= "WHERE Name = '" . $newTempleName . "'";
                    $testSet = mysqli_query($conn, $nameTest);
                    $testRows = 0;
                    $testRows = mysqli_num_rows($testSet);

                    if ($testRows != 0){
                        $errors[] = "An entry already exists with this name.";
                    }
                    if (strlen($newTempleName) > 255) {
                        $errors[] = "Name too long.";
                    }
                    $newTemplePlace = htmlspecialchars($_POST['newTemplePlace']);
                    if (strlen($newTemplePlace) > 255) {
                        $errors[] = "Location too long.";;
                    }
                    $newTempleStatus = htmlspecialchars($_POST['newTempleStatus']);
                    if (strlen($newTempleStatus) > 255) {
                        $errors[] = "Status too long.";
                    }                          
                    $newTempleFinds = htmlspecialchars($_POST['newTempleFinds']);
                    if (strlen($newTempleFinds) > 255) {
                        $errors[] = "Key Finds too long.";
                    }       
                    $newTempleRef = htmlspecialchars($_POST['newTempleRef']);
                    if (strlen($newTempleRef) > 255) {
                        $errors[] = "Reference field too long.";
                    }
                    $newTempleLat = htmlspecialchars($_POST['newTempleLat']);
                    if (strlen($newTempleLat) > 255) {
                        $errors[] = "Latitude too long.";
                    } 
                    $newTempleLong = htmlspecialchars($_POST['newTempleLong']);
                    if (strlen($newTempleLong) > 255) {
                        $errors[] = "Longitude too long. Itude.";
                    }                                      
                    $newTempleDate = htmlspecialchars($_POST['newTempleDate']);
                    if (strlen($newTempleDate) > 255) {
                        $errors[] = "Date too long.";
                    }     
                    $newTempleNotes = htmlspecialchars($_POST['newTempleNotes']);
                    if (strlen($newTempleNotes) > 255) {
                        $errors[] = "Notes too long. Use Comments field for long-form information.";
                    }     
                    $newTempleComments = htmlspecialchars($_POST['newTempleComments']);
                    $newContinent = ($_POST['newContinent']);
                    $newCountry = ($_POST['newCountry']);
                    ?>

                    <p class="error">

                    <?php
                    if (empty($errors)) {

                        $sql = "INSERT INTO mithraea (Name, Location, Continent, Country, Status, `Key Finds`, `CIMRM/Other Ref`, Latitude, Longitude, `Date Discovered`, Notes, Comments) ";
                        $sql .= 'VALUES ("' . $newTempleName . '", "' . $newTemplePlace . '", "' . $newContinent . '", "' . $newCountry  . '", "' . $newTempleStatus . '", ';
                        $sql .= '"' . $newTempleFinds . '", "' . $newTempleRef . '", "' . $newTempleLat . '", "' . $newTempleLong . '", "' . $newTempleDate . '", "' . $newTempleNotes . '", "' . $newTempleComments . '")';

                        $result = mysqli_query($conn,$sql);

                        if ($result) {
                            echo('Entry added.');
                        }
                        else {
                            echo(mysqli_connect_error($conn));
                        }
                    mysqli_free_result($result_set);
                    mysqli_close($conn);
                    }
                    else {
                        display_errors($errors);
                        }
                    }
                    ?>
                    </p>

   <?php include_once('footer.php'); ?>