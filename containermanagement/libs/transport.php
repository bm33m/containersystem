<?php
/*
*transport.php
*@author: Brian
*/

include 'container.php';
include 'objecttypes.php';

$app = new Transport($_REQUEST["transport"], $_REQUEST["objecttype11"], $_REQUEST["objecttype21"], $_REQUEST["objecttype31"]);

/**
*Creat new Transport.
*Allows users to use transport.
*Check objects.
*Check containers.
*Calculate how many containers to use.
*/
class Transport
{
  var $name;
  var $width;
  var $length;
  var $radius;
  var $objectType;
  var $objectT1;
  var $objectT2;
  var $objectT3;
  var $bigContainerWidth;
  var $bigContainerLength;
  var $smallContainerWidth;
  var $smallContainerLength;
  var $bigContainerArea;
  var $smallContainerArea;
  var $smallContainer;
  var $bigContainer;
  var $otherContainer;
  var $smallContainerType;
  var $bigContainerType;
  var $otherContainerType;
  var $avalaibleSmallContainers;
  var $avalaibleBigContainers;

  function __construct($name, $objectX1, $objectX2, $objectX3)
  {
    $this->name = filter_var($name, FILTER_SANITIZE_STRIPPED);
    $this->objectT1 = filter_var($objectX1, FILTER_SANITIZE_STRIPPED);
    $this->objectT2 = filter_var($objectX2, FILTER_SANITIZE_STRIPPED);
    $this->objectT3 = filter_var($objectX3, FILTER_SANITIZE_STRIPPED);
    $this->smallContainer = array();
    $this->bigContainer = array();
    $this->otherContainer = array();
    $this->bigContainerWidth = BIG_CONTAINER_WIDTH; //300;
    $this->bigContainerLength = BIG_CONTAINER_LENGTH; //200;
    $this->smallContainerWidth = SMALL_CONTAINER_WIDTH; //100;
    $this->smallContainerLength = SMALL_CONTAINER_LENGTH; //100;
    $this->bigContainerArea = $this->bigContainerWidth * $this->bigContainerLength;
    $this->smallContainerArea = $this->smallContainerWidth * $this->smallContainerLength;
    $this->avalaibleSmallContainers = SMALL_CONTAINER_LIST;
    $this->avalaibleBigContainers = BIG_CONTAINER_LIST;
    $this->smallContainerType = array("name" => "smallContainer", "width" => $this->smallContainerWidth, "length" => $this->smallContainerLength, "list" => $this->avalaibleSmallContainers);
    $this->bigContainerType = array("name" => "bigContainer", "width" => $this->bigContainerWidth, "length" => $this->bigContainerLength, "list" => $this->avalaibleBigContainers);
    $this->otherContainerType = array("name" => "otherContainer", "width" => 0, "length" => 0, "list" => 0);
    $this->containerRequest($_REQUEST);
  }

  function containerRequest($objectsXY){
    echo "<hr>";
    echo "smallContainerArea: ".$this->smallContainerArea;
    echo " bigContainerArea: ".$this->bigContainerArea;
    echo "<hr>";
    echo $objectsXY["transport"];
    //
    $this->processObjectX1($objectsXY);
    $this->processObjectX2($objectsXY);
    $this->processObjectX3($objectsXY);
    //
    $this->sortObjects($this->smallContainer);
    foreach ($this->smallContainer as $key => $value) {
      echo $key.": width: ".$value['width'].", length: ".$value['length'].", type: ".$value['type']."<br/>";
    }
    $this->sortObjects($this->bigContainer);
    foreach ($this->bigContainer as $key => $value) {
      echo $key.": width: ".$value['width'].", length: ".$value['length'].", type: ".$value['type']."<br/>";
    }
    //
    $results1 = $this->loadSquareObjects($this->smallContainer, $this->smallContainerType);
    $results2 = $this->loadSquareObjects($this->bigContainer, $this->bigContainerType);
    $results3 = count($this->otherContainer);
    //
    echo "<hr>";
    echo "<h1>Results:</h1>";
    echo "<br/> Result1: ".$results1." containerType: ".$this->smallContainerType["name"];
    echo "<br/> Result2: ".$results2." containerType: ".$this->bigContainerType["name"];
    echo "<br/> Result3: ".$results3." containerType: ".$this->otherContainerType["name"];
    //
    if($results1 > $this->avalaibleSmallContainers){
      echo "<br/> <b>BackTracking....</b>";
      echo "<br/> You need ".$results1." Containers, but you only have ".$this->avalaibleSmallContainers.", of ".$this->smallContainerType["name"].".<br/>";
      echo "<br/>Try option 2....<br/>";

      $mixedResults4 = $this->backtrackSquareObjects($this->smallContainer, $this->bigContainer, $this->smallContainerType, $this->bigContainerType);
      echo "<br/> Result4a: ".$mixedResults4[0]." containerType: ".$this->smallContainerType["name"];
      echo "<br/> Result4b: ".$mixedResults4[1]." containerType: ".$this->bigContainerType["name"];
      echo "<br/> Result4c: ".$results3." containerType: ".$this->otherContainerType["name"];

      echo "<br/>";
      //
    }
    //
  }

  function processObjectX1($objectsXY){
    if ($this->objectT1 == "square"){
      $this->squareObject($objectsXY, $objectsXY["width11"], $objectsXY["length11"]);
    } elseif($this->objectT1 == "circle"){
      $this->circleObject($objectsXY, $objectsXY["radius11"]);
    }
  }

  function processObjectX2($objectsXY){
    if ($this->objectT2 == "square"){
      $this->squareObject($objectsXY, $objectsXY["width21"], $objectsXY["length21"]);
    } elseif($this->objectT2 == "circle"){
      $this->circleObject($objectsXY, $objectsXY["radius21"]);
    }
  }

  function processObjectX3($objectsXY){
    if ($this->objectT3 == "square"){
      $this->squareObject($objectsXY, $objectsXY["width31"], $objectsXY["length31"]);
    } elseif($this->objectT3 == "circle"){
      $this->circleObject($objectsXY, $objectsXY["radius31"]);
    }
  }

  function squareObject($objectsXY, $width, $length){
    $area = ($width * $length);
    echo "<hr>";
    echo "square: <br>";
    echo " width: ".$width;
    echo " length: ".$length;
    echo "<br>"."Area: ".$area;
    if (($width <= $this->smallContainerWidth) && ($length <= $this->smallContainerLength)){
      $this->smallContainer[] = array('width' => $width, 'length' => $length, 'type' => 'square');
    } elseif(($width <= $this->bigContainerWidth) && ($length <= $this->bigContainerLength)){
      $this->bigContainer[] = array('width' => $width, 'length' => $length, 'type' => 'square');
    }
    if(($width > $this->bigContainerWidth) || ($length > $this->bigContainerLength)){
      $this->otherContainer[] = array('width' => $width, 'length' => $length, 'type' => 'square');
    }
  }

  function circleObject($objectsXY, $radius){
    $PI = 3.14159;
    $area = $PI * ($radius * $radius);
    $diameter = $radius * 2;
    echo "<hr>";
    echo "circle: <br>";
    echo " radius: ".$radius;
    echo "<br> Diameter: ".$diameter;
    echo "<br> Area: ".$area;
    if (($diameter <= $this->smallContainerWidth) && ($diameter <= $this->smallContainerLength)){
      $this->smallContainer[] = array('width' => $diameter, 'length' => $diameter, 'type' => 'circle');
    } elseif(($diameter <= $this->bigContainerWidth) && ($diameter <= $this->bigContainerLength)){
      $this->bigContainer[] = array('width' => $diameter, 'length' => $diameter, 'type' => 'circle');
    }
    if(($diameter > $this->bigContainerWidth) || ($diameter > $this->bigContainerLength)){
      $this->otherContainer[] = array('width' => $diameter, 'length' => $diameter, 'type' => 'circle');
    }
  }

  function sortObjects(&$objectList){
    echo "<hr>";
    $big = 0;
    $temp = 0;
    $listSize = count($objectList);
    if ($objectList){
      echo "<h1>Step 01.</h1>";
      echo "Sort listSize: ".$listSize."<br/>";
    }
    foreach ($objectList as $key => $value) {
      echo $key.": width: ".$value['width'].", length: ".$value['length'].", type: ".$value['type']."<br/>";
    }
    for($x = 0; $x < $listSize; $x++){
      $big = $objectList[$x]["width"];
      for($y = ($x + 1); $y < $listSize; $y++){
        if($big < $objectList[$y]["width"]){
          $temp = $objectList[$x];
          $objectList[$x] = $objectList[$y];
          $objectList[$y] = $temp;
          $big = $objectList[$x]["width"];
        }
      }
    }
    //foreach ($objectList as $key => $value) {
    //  echo $key.": width: ".$value['width'].", length: ".$value['length'].", type: ".$value['type']."<br/>";
    //}
   echo "<br/>";
  }

  function loadSquareObjects($objectList, $containerType){
    echo "<hr>";
    $containerX = array();
    $spaceContainer = array();
    $results = array();
    $spaceX;
    $spaceY;
    $spaceSize;
    $widthX = $containerType["width"];
    $lengthY = $containerType["length"];
    $listSize = count($objectList);
    $objectDone = false;
    $done = false;
    $numberOfContainers = 0;
    if ($objectList){
      echo "<h1>Step 02.</h1>";
      echo "Container: ".$containerType["name"]."<br/>";
      echo "Load listSize: ".$listSize."<br/>";
    }
    for($x = 0; $x < $listSize; $x++){
      if(($widthX >= $objectList[$x]["width"]) && ($lengthY >= $objectList[$x]["length"])){
        $containerX[] = $objectList[$x];
        $spaceX = $widthX - $objectList[$x]["width"];
        $spaceY = $objectList[$x]["length"];  //$lengthY - $objectList[$x]["length"];
        $lengthY -= $objectList[$x]["length"];
        $spaceContainer[] = array("width" => $spaceX, "length" => $spaceY);
        $objectDone = true;
        $done = true;
        echo $x." done, width: ".$objectList[$x]["width"].", length: ".$objectList[$x]["length"]."<br/>";
      } else {
        $objectDone = false;
        $spaceSize = count($spaceContainer);
        for($y = 0; $y < $spaceSize; $y++){
          if(($spaceContainer[$y]["width"] >= $objectList[$x]["width"]) && ($spaceContainer[$y]["length"] >= $objectList[$x]["length"])){
            $containerX[] = $objectList[$x];
            $spaceX = $spaceContainer[$y]["width"] - $objectList[$x]["width"];
            $spaceY = $spaceContainer[$y]["length"] - $objectList[$x]["length"];
            $spaceContainer[$y]["width"] = $spaceX;
            $spaceContainer[] = array("width" => $spaceX, "length" => $spaceY);
            $objectDone = true;
            $done = true;
            echo $x."[".$y."] done, width: ".$objectList[$x]["width"].", length: ".$objectList[$x]["length"]."<br/>";
          }
        }
      }
      if(!$objectDone){
        echo $x." need more space, width: ".$objectList[$x]["width"].", length: ".$objectList[$x]["length"]."<br/>";
        $results[] = $containerX;
        $containerX = array();
        $spaceContainer = array();
        $numberOfContainers += 1;
      }
    }
    if($done){
      $numberOfContainers += 1;
    }
    $listSizeX = count($containerX);
    $listSizeX2 = count($spaceContainer);
    $listSizeA = count($results);
    //echo "<br/> listSizeX: ".$listSizeX."<br/> listSizeX2: ".$listSizeX2."<br/>"."<br/> listSizeA: ".$listSizeA."<br/>";
    echo "<p>Number of Containers: ".$numberOfContainers."</p>";

    return $numberOfContainers;
  }

  function loadCircleObjects($objectList, $containerType){
    $this->loadSquareObjects($objectList, $containerType);
  }

  function loadMixedSquareObjects($objectList, $containerSmallType, $containerBigType){
    echo "<hr>";
    $containerX = array();
    $spaceContainer = array();
    $results = array();
    $spaceX;
    $spaceY;
    $spaceSize;
    $widthX = $containerBigType["width"];
    $lengthY = $containerBigType["length"];
    $listSize = count($objectList);
    $objectDone = false;
    $done = false;
    $numberOfContainers = 0;
    $smallObjects = array();
    $numberOfSmallContainers = 0;
    //
    if ($objectList){
      echo "<h1>Step 02.</h1>";
      echo "Container: ".$containerBigType["name"]."<br/>";
      echo "Load listSize: ".$listSize."<br/>";
    }
    for($x = 0; $x < $listSize; $x++){
      if(($widthX >= $objectList[$x]["width"]) && ($lengthY >= $objectList[$x]["length"])){
        $containerX[] = $objectList[$x];
        $spaceX = $widthX - $objectList[$x]["width"];
        $spaceY = $objectList[$x]["length"];   //$lengthY - $objectList[$x]["length"];
        $lengthY -= $objectList[$x]["length"];
        $spaceContainer[] = array("width" => $spaceX, "length" => $spaceY);
        $objectDone = true;
        $done = true;
        echo $x." done, width: ".$objectList[$x]["width"].", length: ".$objectList[$x]["length"]."<br/>";
      } else {
        $objectDone = false;
        $spaceSize = count($spaceContainer);
        for($y = 0; $y < $spaceSize; $y++){
          if(($spaceContainer[$y]["width"] >= $objectList[$x]["width"]) && ($spaceContainer[$y]["length"] >= $objectList[$x]["length"])){
            $containerX[] = $objectList[$x];
            $spaceX = $spaceContainer[$y]["width"] - $objectList[$x]["width"];
            $spaceY = $spaceContainer[$y]["length"] - $objectList[$x]["length"];
            $spaceContainer[$y]["width"] = $spaceX;
            $spaceContainer[] = array("width" => $spaceX, "length" => $spaceY);
            $objectDone = true;
            $done = true;
            echo $x."[".$y."] done, width: ".$objectList[$x]["width"].", length: ".$objectList[$x]["length"]."<br/>";
          }
        }
      }
      if(!$objectDone){
        echo $x." need more space, width: ".$objectList[$x]["width"].", length: ".$objectList[$x]["length"]."<br/>";
        $numberOfContainers += 1;
        if($numberOfContainers < $containerBigType["list"]){
          $results[] = $containerX;
          $containerX = array();
          $spaceContainer = array();
        } else {
          if(($objectList[$x]["width"] <= $containerSmallType["width"]) && ($objectList[$x]["length"] <= $containerSmallType["length"])){
            $smallObjects[] = $objectList[$x];
          } else {
            $results[] = $containerX;
            $containerX = array();
            $spaceContainer = array();
          }
        }
      }
    }
    if($done){
      $numberOfContainers += 1;
    }
    $listSizeX = count($containerX);
    $listSizeX2 = count($spaceContainer);
    $listSizeA = count($results);
    $listSizeB = count($smallObjects);
    //echo "<br/> listSizeX: ".$listSizeX."<br/> listSizeX2: ".$listSizeX2."<br/>";
    //echo "<br/> listSizeA: ".$listSizeA."<br/> listSizeB: ".$listSizeB."<br/>";
    if($listSizeB > 0){
      $numberOfSmallContainers = $this->loadSquareObjects($smallObjects, $containerSmallType);
    }
    echo "<p>Number of Containers: ".$numberOfContainers."</p>";
    $mixedResults = array($numberOfSmallContainers, $numberOfContainers);
    return $mixedResults;
  }

  function backtrackSquareObjects($smallList, $bigList, $containerSmallType, $containerBigType){
    echo "<hr>";
    echo "<p>BackTracking...<p/>";
    echo "<h2>Option 2:</h2>";
    //
    $objectList = array();
    $results0;
    $results01;
    $mixedResults;

    foreach ($bigList as $objectX) {
      $objectList[] = $objectX;
    }
    foreach ($smallList as $objectY) {
      $objectList[] = $objectY;
    }
    $results0 = $this->loadSquareObjects($objectList, $containerBigType);
    if($results0 > $containerBigType["list"]){
      echo "<br/>Not enough containers. <br/>";
      $results01 = $this->loadMixedSquareObjects($objectList, $containerSmallType, $containerBigType);
      if(($results01[0] <= $containerSmallType["list"]) && ($results01[1] <= $containerBigType["list"])){
        return $results01;
      }
    }
    $mixedResults = array(0, $results0);
    return $mixedResults;
  }

}

echo '<hr><div><a href="../index.php">done</a></div><hr><br>';
