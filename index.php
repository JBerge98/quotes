<?php
session_start();

$_SESSION['lastpage'] = 'index';

// set the current page to one of the main buttons
$nav_selected = "HOME";

// make the left menu buttons visible; options: YES, NO
$left_buttons = "NO";

// set the left menu button selected; options will change based on the main selection
$left_selected = "";

include("nav.php");
?>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="styles/main_style.css" type="text/css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
  <title>Scrambler Puzzles</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/mainStyleSheet.css">
  <style>
    table.puzzle {
      margin-left: auto;
      margin-right: auto;
      align: center;

    }

    table.puzzle tr td.filled {
      /* width: 48px; */
      /* height: 48px; */
      font-size: 12px;
      text-align: center;
      border: 3px solid #000000;
      padding: 5px;
      font-weight: bold;
    }
  </style>
</head>

<body>

  <div class="container-fluid">
    <div class="panel">
      <div class="panel-group">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-sm-12">
                <div align="center">
                  <h2><?php echo 'Welcome to the Quotes! Get inspired!'; ?></h2>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div align="center">
              <h3><?php echo 'What do you want to play?'; ?></h3>
              <br>
            </div>


            <!-- =========================================
Retrive the preferences, store those in session variables
These vars get updated whenever the user clicks HOME page 
DEFAULT_COLUMN_COUNT, DEFAULT_LANGUAGE, DEFAULT_HOME_PAGE_DISPLAY,  
DEFAULT_CHUNK_SIZE, NO_OF_QUOTES_TO_DISPLAY, FEELING_LUCKY_MODE, FEELING_LUCKY_TYPE
========================================= -->

            <?php

            $sql = "SELECT `id`, `name`, `value`, `comments` FROM `preferences`";
            mysqli_set_charset($db, "utf8");
            $result = mysqli_query($db, $sql);


            // in each row, we will display 6 icons
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $_SESSION[$row['name']] = $row['value'];
              } // end while
            } // end if
            ?>


            <?php

            //$quotes_to_show = 10;
            $quotes_to_show = $_SESSION['NO_OF_QUOTES_TO_DISPLAY'];


            // Get the last 'quotes_to_show' number of quotes
            // We just need id, author and topic 
            // SELECT id, author, topic FROM quote_table ORDER BY id DESC LIMIT 20
            $sql = "SELECT id, author, topic FROM quote_table ORDER BY id DESC LIMIT $quotes_to_show";

            // to get the unicode characters from the database
            mysqli_set_charset($db, "utf8");
            $result = mysqli_query($db, $sql);

            echo '<table class="puzzle">';


            // in each row, we will display 6 icons
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {

                echo '<tr>';
                echo  '<td class="filled"><a href="feelingLucky/feelingLucky.php?type=drop_quote&id=' . $row['id'] . '">
          <img src="./images/drop_quote.png" height="50" width="50">
          <br>' . $row['topic'] . '<br>' . $row['author'] . '</a></td>';

                echo  '<td class="filled"><a href="feelingLucky/feelingLucky.php?type=float_quote&id=' . $row['id'] . '">
          <img src="./images/float_quote.png" height="50" width="50">
          <br>' . $row['topic'] . '<br>' . $row['author'] . '</a></td>';

                echo  '<td class="filled"><a href="feelingLucky/feelingLucky.php?type=drop_float&id=' . $row['id'] . '">
          <img src="./images/drop_float.png" height="50" width="50">
          <br>' . $row['topic'] . '<br>' . $row['author'] . '</a></td>';

                echo  '<td class="filled"><a href="feelingLucky/feelingLucky.php?type=scrambler&id=' . $row['id'] . '">
          <img src="./images/scrambler.png" height="50" width="50">
          <br>' . $row['topic'] . '<br>' . $row['author'] . '</a></td>';

                echo  '<td class="filled"><a href="feelingLucky/feelingLucky.php?type=splitter&id=' . $row['id'] . '">
          <img src="./images/splitter.png" height="50" width="50">
          <br>' . $row['topic'] . '<br>' . $row['author'] . '</a></td>';

                echo  '<td class="filled"><a href="feelingLucky/feelingLucky.php?type=slider16&id=' . $row['id'] . '">
          <img src="./images/slider16.png" height="50" width="50">
          <br>' . $row['topic'] . '<br>' . $row['author'] . '</a></td>';

                echo '</tr>';
              }
            }

            echo '</table>';

            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Process the mysqli_result now 
Based on the count of word_sets received (it will be = $puzzles_to_show or all puzzles),
display the puzzle icons on the home page as follows.
Show $puzzles_per_row per row. 
So, by default, users will see the last 100 puzzles with latest one showing up first.

Based on the "type", we can identify the ICON.
Below the ICON, show the "title" and below the title, show "subtitle"
Set the HREF link to the ICON as   href="feelinglucky.php?id=N"  where N is the set_id
So, the users can play any puzzle they want from the home page.
And random = feeling lucky = feelinglucky.php is same as clicking the first icon on the home page. -->

  <!-- </p> -->
</body>

</html>