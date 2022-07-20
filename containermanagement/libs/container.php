<?php
/*
*container.php
*@author: Brian
*/

define("SMALL_CONTAINER_WIDTH", 100);
define("SMALL_CONTAINER_LENGTH", 100);
define("BIG_CONTAINER_WIDTH", 300);
define("BIG_CONTAINER_LENGTH", 200);
define("SMALL_CONTAINER_LIST", 1);
define("BIG_CONTAINER_LIST", 1);

$containerApp = (isset($_POST["createContainer"]) ? new Container($_POST) : time());

/**
*Creat new Containers.
*Allows users to use containers.
*/
class Container
{
  var $name;
  var $width;
  var $length;
  var $bigContainerWidth;
  var $bigContainerLength;
  var $smallContainerWidth;
  var $smallContainerLength;
  var $bigContainerArea;
  var $smallContainerArea;
  var $containerTypes;

  function __construct($containerX)
  {
    $nameX = $containerX["objectName"];
    $widthX = $containerX["width11"];
    $lengthX = $containerX["length11"];
    $this->name = filter_var($nameX, FILTER_SANITIZE_STRIPPED);
    $this->width = filter_var($widthX, FILTER_SANITIZE_STRIPPED);
    $this->length = filter_var($lengthX, FILTER_SANITIZE_STRIPPED);
    $this->containerAssets();
    $this->containerImage();
  }

  function containerAssets(){
    $this->bigContainerWidth = BIG_CONTAINER_WIDTH; //300;
    $this->bigContainerLength = BIG_CONTAINER_LENGTH; //200;
    $this->smallContainerWidth = SMALL_CONTAINER_WIDTH; //100;
    $this->smallContainerLength = SMALL_CONTAINER_LENGTH; //100;
    $this->containerTypes = array(array("name"=>"small", "width" => $this->smallContainerWidth, "length" => $this->smallContainerLength),
                                  array("name"=>"big", "width" => $this->bigContainerWidth, "length" => $this->bigContainerLength));
  }

  function containerImage(){
   /*
    try {
      $container = ImageCreate($this->width, $this->length);
      header("content-type: image/png");
      ImagePNG($container);
      ImageDestroy($container);
    } catch (Exception $e) {
      echo "containerImage: "+$e;
    }
    */
    echo "image: ".time()."<br/> width: ".$this->width."<br/> length: ".$this->length."<br/>";
  }

  function containerSize(){
    $area = this->width * this->length;
    return $area;
  }

}
