<?php
/*
* container.php
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
        <li><a href="./objects.php">objects</a></li>
        <li><a href="./test01.php">test01</a></li>
        <li><a href="./test02.php">test02</a></li>
        <li><a href="./test03.php">test03</a></li>
      </ul>
    </header>
    <div>
    <?php echo "<h1>Welcome to Container Management System</h1>";  ?>
    </div>
    <div id="info" class="gdvuiprofile">
      <a href="#/./views/containers.php"><img src="../public/assets/d5purple.jpg"/>containers</a>
    </div>
    <div>
      <hr>
      <h1>Containers:</h1>
      <ul>
        <li>
          Name: <b>Small Container</b>, Width: 100, Length: 100
        </ii>
        <li>
          Name: <b>Big Container</b>, Width: 300, Length: 200
        </ii>
      </ul>
    </div>
    <hr>
    <div>
      <form action='../libs/container.php' method='POST'>
      <div>
      <p><label id="lblContainer">Container:</label>
      <input name="containerName" id="containerName" type="text" value="" placeholder="Container name" required/>
      </p>
      <p><label id="lblWidth">Width:</label>
      <input name="width11" id="width11" type="number" min="0"/>
      </p>
      <p><label id="lblLength">Length:</label>
      <input name="length11" id="length11" type="number" min="0"/>
      </p>
      <p><label id="lblRadius">Radius:</label>
      <input name="radius11" id="radius11" type="number" min="0"/>
      </p>
      <p>
        <label>Color:</label>
        <select name="containerColor">
          <option value="0,0,0">Black</option>
          <option value="255,255,255">White</option>
          <option value="255,0,0">Red</option>
          <option value="0,255,0">Green</option>
          <option value="0,0,255">Blue</option>
        </select>
      </p>
      <p>
        <b>Backgroung Color:</b><br/>
        R:<input type="number" name="red" id="red" min="0" max="255" />
        G:<input type="number" name="green" id="green" min="0" max="255" />
        B:<input type="number" name="blue" id="blue" min="0" max="255" />
      </p>
      <p><labe>Save:</label><input type="checkbox" name="saveContainer" id="saveContainer" /></p>
      <input type="hidden" name="createContainer" id="createContainer" value="createNewContainer" />
      </div>
      <div>
      <br>
      <input type="submit" name="btnContainer" value="Submit"/>
      <br>
      </div>
      </form>
    </div>
  </body>
</html>
