<?php
/*
* index.php
* @author Brian
*/
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Container Management System</title>
    <link href="../public/css/main.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <header class="navbar">
      <ul>
        <li><a href="../index.php">home</a></li>
        <li><a href="./containers.php">containers</a></li>
        <li><a href="./objects.php">objects</a></li>
        <li><a href="./test01.php">test01</a></li>
        <li><a href="./test03.php">test03</a></li>
      </ul>
    </header>
    <div>
    <?php echo "<h1>Welcome to Container Management System</h1>";  ?>
    </div>
    <div id="info" class="gdvuiprofile">
      <a href="#/./views/containers.php"><img src="../public/assets/d5pink.jpg"/>containers</a>
    </div>

    <hr>
    <div>
      <form action='../libs/transport.php' method='POST'>
      <div>
      <p><label id="lblTransport">Transport:</label>
      <input name="transport" id="transport" type="text" value="Transport 2" placeholder="Transport name" required/>
      </p>
      <p><b>Object1:</b></p>
      Square <input class="cinpt01" type="radio" id="objecttype11" name="objecttype11" value="square" checked>
      Cirle <input class="cinpt01" type="radio" id="objecttype12" name="objecttype11" value="circle">
      Other <input class="cinpt01" type="radio" id="objecttype13" name="objecttype11" value="other">
      <p><label id="lblWidth">Width:</label>
      <input name="width11" id="width11" type="number" value="400" min="0"/>
      </p>
      <p><label id="lblLength">Length:</label>
      <input name="length11" id="length11" type="number" value="400" min="0"/>
      </p>
      <p><label id="lblRadius">Radius:</label>
      <input name="radius11" id="radius11" type="number" min="0"/>
      </p>
      </div>

      <div>
      <p><b>Object2:</b></p>
      Square <input class="cinpt01" type="radio" id="objecttype21" name="objecttype21" value="square">
      Cirle <input class="cinpt01" type="radio" id="objecttype22" name="objecttype21" value="circle" checked>
      Other <input class="cinpt01" type="radio" id="objecttype23" name="objecttype21" value="other">
      <p><label id="lblWidth21">Width:</label>
      <input name="width21" id="width21" type="number" min="0"/>
      </p>
      <p><label id="lblLength21">Length:</label>
      <input name="length21" id="length21" type="number" min="0"/>
      </p>
      <p><label id="lblRadius21">Radius:</label>
      <input name="radius21" id="radius21" type="number" value="100" min="0"/>
      </p>
      </div>

      <div>
      <p><b>Object3:</b></p>
      Square <input class="cinpt01" type="radio" id="objecttype31" name="objecttype31" value="square">
      Cirle <input class="cinpt01" type="radio" id="objecttype32" name="objecttype31" value="circle">
      Other <input class="cinpt01" type="radio" id="objecttype33" name="objecttype31" value="other" checked>
      <p><label id="lblWidth31">Width:</label>
      <input name="width31" id="width31" type="number" min="0"/>
      </p>
      <p><label id="lblLength31">Length:</label>
      <input name="length31" id="length31" type="number" min="0"/>
      </p>
      <p><label id="lblRadius31">Radius:</label>
      <input name="radius31" id="radius31" type="number" min="0"/>
      </p>
      </div>

      <div>
      <br>
      <input type="submit" name="btntransport" value="Submit"/>
      <br>
      </div>
      </form>
    </div>
  </body>
</html>
