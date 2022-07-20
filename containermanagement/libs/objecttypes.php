<?php
/*
*objecttypes.php
*@author: Brian
*/

$objectApp = (isset($_POST["createObject"]) ? new Objecttypes($_POST) : time());

/**
*Creat new Objecttypes.
*Allows users to use objecttypes.
*/
class Objecttypes
{
  var $name;
  var $width;
  var $length;
  var $radius;


  function __construct($objectX)
  {
    $nameX = $objectX["objectName"];
    $widthX = $objectX["width11"];
    $lengthX = $objectX["length11"];
    $radiusX = $objectX["radius11"];
    $this->name = filter_var($nameX, FILTER_SANITIZE_STRIPPED);
    $this->width = filter_var($widthX, FILTER_SANITIZE_STRIPPED);
    $this->length = filter_var($lengthX, FILTER_SANITIZE_STRIPPED);
    $this->radius = filter_var($radiusX, FILTER_SANITIZE_STRIPPED);
    $this->objecttypesImage();
  }

  function objecttypesImage(){
      /*
      try {
        $objectX = ImageCreate($this->width, $this->length);
        header("content-type: image/png");
        ImagePNG($objectX);
        ImageDestroy($objectX);
      } catch (Exception $e) {
        echo "objecttypesImage: "+$e;
      }
      */
      echo "image: ".time()."<br/> name: ".$this->name."<br/> width: ".$this->width."<br/> length: ".$this->length."<br/> radius: ".$this->radius."<br/>";
  }


  function squareSize(){
    $area = this->width * this->length;
    return $area;
  }

  function circleSize(){
    $PI = 3.14159;
    $area = $PI * this->radius * this->radius;
    return $area;
  }

}
