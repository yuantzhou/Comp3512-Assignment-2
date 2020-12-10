<?php
require_once 'api/config.inc.php';
require_once 'api/ASG2-classes.php';
include 'nav-header.php';

try {
    $id = $_GET['paintingID'];
    $conn = DatabaseHelper::createConnection(array(
        DBCONNSTRING,
        DBUSER, DBPASS
    ));
    $gateway = new PaintingDB($conn);
    $paintings = $gateway->getAll();
    $conn = null;
    $painting = "";
    $json = "";

    foreach ($paintings as $row) {
        if ($id == $row['PaintingID']) {
            $painting = $row;
            $json = json_decode($row['JsonAnnotations'], true);
        }
    }
} catch (PDOException $e) {
    die($e->getMessage());
}

session_start();

?>
<!DOCTYPE html>
<html lang=en>

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='../css/single-painting.css' rel='stylesheet' type='text/css'>
</head>

<body>
    <main id='container'>
        <!--section to display image-->
        <section id='image'>
            <!--image to display goes here, for now a default is in place-->
            <img src="../images/paintings/square/<?= $painting['ImageFileName'] ?>.jpg" alt="<?= $painting['Title'] ?>" id="imgInUse"></img>
        </section>
        <!--section to show painting information-->
        <section id='descriptionSec'>
            <h2><?= $painting['Title'] ?></h2>
            <!--button for favs is hidden when user is not logged in-->
            <?php
            if (isset($_SESSION['loggedin'/*chage if you used a different name*/]) && $_SESSION['loggedin'] == true) {
                echo "<button id='favourites' onclick=''>Add to Favourites</button>";
            } elseif (isset($_SESSION['loggedin'/*chage if you used a different name*/]) && $_SESSION['loggedin'] == true && $alreadyFav == 'true') {
                echo "<button id='favourites' onclick=''>Already a Favourite</button>";
            } else {
                //displays no button
            }
            // display artist name
            if (is_null($painting['FirstName'])) {
                echo "<h3>" . $painting['LastName'] . "</h3>";
            } else if (is_null($painting['LastName'])) {
                echo "<h3>" . $painting['FirstName'] . "</h3>";
            } else {
                echo "<h3>" . $painting['FirstName'] . " " . $painting['LastName'] . "</h3>";
            }
            ?>
            <h3><?= $painting['GalleryName'] ?>, <?= $painting['YearOfWork'] ?></h3>

            <!--Tab of links-->
            <div class='tab'>
                <button class='tablinks' onclick='openTab(event, "description")'>Description</button>
                <button class='tablinks' onclick='openTab(event, "details")'>Details</button>
                <button class='tablinks' onclick='openTab(event, "colours")'>Colours</button>
            </div>
            <!--Tab contents-->
            <div id='description' class='tabcontent'>
                <?php
                if (is_null($painting['Description'])) {
                    echo "<p>" . 'Description Not Available at the moment.' . "</p>";
                }
                echo "<p>" . $painting['Description'] . "</p>";
                ?>
            </div>
            <div id='details' class='tabcontent'>
                <?php
                echo "<p>" . "Medium: " . $painting['Medium'] . "</p>";
                echo "<p>" . "Width: " . $painting['Width'] . "</p>";
                echo "<p>" . "Height: " . $painting['Height'] . "</p>";
                echo "<p>" . " Copyright: " . $painting['CopyrightText'] . "</p>";

                if (is_null($painting['WikiLink'])) {
                    echo "<p>" . 'Wikipedia Link Not Available at the moment.' . "</p>";
                } else {
                    echo "<a href='" . $painting['WikiLink'] . "'>Wikipedia Link</a><br>";
                }
                echo "<a href='" . $painting['MuseumLink'] . "'>Museum Link</a>";
                ?>
            </div>
            <div id='colours' class='tabcontent'>
                <!--CITATION: stackoverflow: how to find the dominant color in image. Retrieved from: https://stackoverflow.com/questions/8730661/how-to-find-the-dominant-color-in-image-->

                <?php
                foreach ($json['dominantColors'] as $hex) {
                    echo "<span id=hexBlocks style='background-color:" . $hex['web'] . ";'></span>";
                }
                echo "<br><br>";
                foreach ($json['dominantColors'] as $hex) {
                    echo "<span id=hex>" . $hex['web'] . "</span>";
                }
                echo "<br>";
                foreach ($json['dominantColors'] as $hex) {
                    echo "<span id=hexNames>" . $hex['name'] . "</span>";
                }
                ?>
            </div>
            </div>
            <!--CITATION: How To- Tabs: from w3school.com retrieved from: https://www.w3schools.com/howto/howto_js_tabs.asp-->
            <!--script for tabs-->
            <script>
                function openTab(evt, tabName) {
                    var i;
                    var tabcontent;
                    let tablinks;
                    let idTag = "#" + tabName;

                    tabcontent = document.querySelectorAll(".tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }

                    tablinks = document.querySelectorAll(".tablinks");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace("active", "");
                    }

                    document.querySelector(idTag).style.display = "block";
                    evt.currentTarget.className += " active";
                }
            </script>
        </section>
    </main>
</body>

</html>