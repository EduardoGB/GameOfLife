<?php
/*
*@author Eduardo Garcia Bravo <uker29@gmail.com>
*/
class GameOfLife_Source_World {
	public $_customWorld;
	public $_newWorld;
	public $_newWorldIds;

	//Create an array with the custom world data
	public function __construct($world){
		$this->_customWorld = explode(',', $world);
	}

	//Return the custom world values
	public function getCustomWorld(){
		return $this->_customWorld;
	}

	//Asing a new cell to the new words
	public function setCell($cell) {
		$this->_newWorldIds[$cell]	= "#$cell";
		$this->_newWorld[$cell]		= $cell;
		return true;
	}

	//Return the new world values
	public function getNewWorld(){
		$_SESSION['celds'] = implode(",", $this->_newWorld);
		return json_encode(array("ids" => implode(",",$this->_newWorldIds)));
	}
}
?>
