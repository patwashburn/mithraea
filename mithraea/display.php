<html lang="en">
  <head>
    <title>The Mithras Index</title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="../stylesheets/master.css">
    <?php 
        include_once('db.php');

        $place = $_GET['place'];
        
        if (isset($place) && ($place === 'all')) {
            $q = 'SELECT * FROM mithraea ';
        }
        elseif ((isset($place)) && ($place === 'Legendary')) {
            $q = 'SELECT * FROM mithraea WHERE Continent = \'Legendary\' OR Continent = \'Mythical\' OR Continent = \'Textual\' ';
        }
        elseif ((isset($place)) && (($place === 'Africa') || ($place === 'Asia') || ($place === 'Europe') || ($place === 'Middle East'))) {
            $q = 'SELECT * FROM mithraea WHERE Continent = \'' . mysqli_real_escape_string($conn,$place) . '\' ';
        }
        elseif (($place !== 'all') && (!(isset($q)) && ($place !=='Middle East'))) {
            $q = 'SELECT * FROM mithraea WHERE Country = \'' . mysqli_real_escape_string($conn,$place) . '\' ';
        }

        $q .= 'ORDER BY Name ASC';
        ?>
  </head>

  <body>

    <div id="#content">
        <h1>The Mithras Index</h1>

        <table width="90%" align="center">
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Status</th>
                <th>Key Finds</th>
                <th>CIMRM/Other Ref</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Date Discovered</th>
                <th>Notes</th>
                </tr>

                <?php 
                if ($temples = mysqli_query($conn, $q)) {
                    while($row = mysqli_fetch_row($temples)) {
                        foreach($temples as $temple) { 
                            $tn = $temple['Name'];
                            $ta = urlencode($tn);
                            echo '<tr><td><a href="temple.php?temple=' . $ta . '">' . $tn . '</a></td>';
                            echo '<td>' . $temple['Location'] . '</td>';
                            echo '<td>' . $temple['Status'] . '</td>';
                            echo '<td>' . $temple['Key Finds'] . '</td>';
                            echo '<td>' . $temple['CIMRM/Other Ref'] . '</td>';
                            echo '<td>' . $temple['Latitude'] . '</td>';
                            echo '<td>' . $temple['Longitude'] . '</td>';
                            echo '<td>' . $temple['Date Discovered'] . '</td>';
                            echo '<td>' . $temple['Notes'] . '</td></tr>';
                   }
                    }
                }   

                ?>

       
        </table>
    </div>

<?php 
        // Free result set

    mysqli_close($conn);
    include_once('footer.php'); ?>