<?php
require_once 'api/ASG2-classes.php'
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>COMP-3512 ASG1</title>
    <link rel="stylesheet" href="galleries.css">

</head>

<body>
    <header>
        <h1>COMP 3512 Assign 1</h1>
        <h5>By: Hatoon Al-Nakshabandi, Andre Co</h5>
    </header>
    <main id="main">

        <!-- this section initially displayed for the user to select
        a gallery of their choice. This section can be toggled off
        by a button to make more space for the other sections -->
        <section id="galleryList">
            <h2>Gallery List</h2>
            <img src="~/imgs/loading.gif" alt="loading" id="loader">
            <ul id="galleries"></ul>

        </section>

        <!-- button to toggle galleryList's visibility on or off -->
        <button id="toggleListButton"></button>

        <section id="galleryInfo">
            <!-- for gallery info -->
            <h2>Gallery Information</h2>
            <div class="info">
                <h3 id="galleryName"></h3>
                <label>Native Name:</label>
                <span id="galleryNative"></span>
                <label>City:</label>
                <span id="galleryCity"></span>
                <label>Address:</label>
                <span id="galleryAddress"></span>
                <label>Country:</label>
                <span id="galleryCountry"></span>

                <a id="website">Visit Website</a>
            </div>
        </section>

        <!-- this section is populated with information from the API depending
        on which gallery from galleryList section is selected by user click -->
        <section id="paintingsList">
            <!-- for paintings -->
            <h2>Paintings</h2>
            <div id="paintings">

                <table id="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th id="artist">Artist</th>
                            <th id="title">Title</th>
                            <th id="year">Year</th>

                        </tr>

                    </thead>
                    <tbody></tbody>
                </table>

            </div>
        </section>

        <!--for map  -->
        <div id="map"></div>
    </main>

    <!-- this section is shown when the 
    title or the picture is clicked within the paintings list -->
    <section id="hidden">
        <img id="bigImg">

        <div id="hiddenDiv">

            <h2 id="paintingTitle"></h2>

            <label>Artist Name: </label>
            <span id="artistName"></span>
            <label>Year of Work:</label>
            <span id="yow"></span>
            <label>Medium:</label>
            <span id="medium"></span>
            <label>Width:</label>
            <span id="width"></span>
            <label>Height:</label>
            <span id="height"></span>
            <label>Copyright:</label>
            <span id="copyright"></span>
            <label>Gallery Name:</label>
            <span id="gName"></span>
            <label>Gallery City:</label>
            <span id="gCity"></span>
            <label>Museum Link:</label>
            <a id="mLink"></a>
            <label>Description:</label>
            <span id="description"></span>
            <br><br><br>
            <label>Colours</label><br><br>
            <div id="coloursBlock"></div>

        </div>
        <!-- this button is only visible in single painting view mode -->
        <button id="closeButton">Close Button</button>
    </section>
    <div><img id="biggerImg"></div>


    <script src="asg1.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzKtg9zVIqY-SrEfnsFS50glx-eBLZN9Q&callback=initMap" async defer></script>
</body>

</html>