<?php
require_once '../php/api/config.inc.php';
require_once '../php/api/ASG2-classes.php';
include '../php/nav-header.php';

session_start();
$userId = $_SESSION['id'];
//$favorites = $_SESSION['PaintingID'];
try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$sql = "SELECT * from customers INNER JOIN customerlogon ON customerlogon.CustomerID = customers.CustomerID";
    $sql = "SELECT * from customers WHERE CustomerID= '" . $userId . "'";
    $result = $pdo->query($sql);
    $row1 = $result->fetch();

    $firstName = $row1['FirstName'];
    $lastName = $row1['LastName'];
    $city = $row1['City'];
    $country = $row1['Country'];
} catch (Exception $e) {
    die($e->getMessage());
}

function outputRecommended($paintings)
{
    foreach ($paintings as $row) {
        $fileName = "images/paintings/square/" . $row['ImageFileName'];

        echo '<li>';
        echo '<a href="single-painting.php?PaintingID="' . $row['PaintingID'] . '"">';
        echo "'<img src='" . $fileName . ".jpg' width='100'>'";
        echo '</a>';
        echo '</li>';
    }
}


function findRecommended()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM favourite INNER JOIN ON favourite.PaintingID = Paintings.PaintingID";
        $sql .= " WHERE favorite.ArtistID = Paintings.ArtistID OR favorite.GalleryID = Paintings.GalleryID";
        $sql .= " LIMIT 20";

        $statement = $pdo->prepare($sql);
        //$statement->bindValue(1, '%' . $search . '%');
        $statement->execute();

        $result = $pdo->query($sql);
        $paintings = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($paintings as $row) {
            $fileName = "images/paintings/square/" . $row['ImageFileName'];

            echo '<li>';
            echo '<a href="single-painting.php?PaintingID="' . $row['PaintingID'] . '"">';
            echo "'<img src='" . $fileName . ".jpg' width='100'>'";
            echo '</a>';
            echo '</li>';
        }
        $pdo = null;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Homepage</title>

    <link href="https://fonts.googleapis.com/css2?family=Oxygen&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/home.css">
</head>

<body>

    <main id="home">
        <div class="box userInfo">
            <h2>User Info </h2>
            <ul class="info">
                <li><?php echo '<strong>' . 'Name: ' . '</strong>' . $firstName . ' ' . $lastName; ?></li>
                <li><?php echo '<strong>' . 'City: ' . '</strong>' . $city; ?></li>
                <li><?php echo '<strong>' . 'Country: ' . '</strong>' . $country; ?></li>
            </ul>
        </div>
        <div class="box favoritePainting">
            <h2>Favorite Paintings</h2>
            <?php include 'favorites.php'; ?>
        </div>
        <div class="box search">
            <section>
                <form method="post" class="searchBar">
                    <a class="browse" href="browse-paintings.php"><input type="text" placeholder="Search a painting" name="search" /></a>                
                </form>
            </section>
        </div>
        <div class="box paintingsLike">
            <h2>Paintings You May Like</h2>
            <ul id="paintingList">
                <?php findRecommended(); ?>
            </ul>
        </div>
    </main>
</body>

</html>