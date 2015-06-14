<?php 
/*
*@author Eduardo Garcia Bravo <uker29@gmail.com>
*/
include 'world.php';
class GameOfLife_Source_Life {
	public $_world;
	//Asing the custom word input
	public function __construct($world) {
		$this->_world = new GameOfLife_Source_World($world);
	}

	//Run the process to evolve the world
	public function run() {
		array_walk($this->_world->getCustomWorld(),function ($item, $key){$this->executeCell($item);});
		return $this->_world->getNewWorld();
	}

	//Evaluates a cell to give or take away life
	public function executeCell($item){
		$newCells = $this->initCells($item);
		$validCells = array_diff($newCells, $this->_world->getCustomWorld());
		$validCells[] = $item;
		array_walk($validCells,function ($item, $key){$this->newLife($item);});
	}

	//Create the new cells to evaluate
	public function initCells($item){
		$position = explode('-', $item);
		return $this->createNewCells($position[0],$position[1]);
	}

	//Create a new cell array
	public function createNewCells($x,$y){
		return  array($this->newKey($x-1,$y-1),$this->newKey($x,$y-1),$this->newKey($x+1,$y-1),
				$this->newKey($x+1,$y),$this->newKey($x+1,$y+1),$this->newKey($x,$y+1),
				$this->newKey($x-1,$y+1),$this->newKey($x-1,$y));
	}

	//Concat values an return an array key
	public function newKey($x,$y){
		return $x."-".$y;
	}

	//Life assigned to the New World
	public function newLife($item){
		$activeCells = array_intersect($this->_world->getCustomWorld(),$this->initCells($item));
		count($activeCells) == 2 && in_array($item, $this->_world->getCustomWorld())  ? $this->_world->setCell($item) : false;
		count($activeCells)  == 3 ? $this->_world->setCell($item) : false;
		return true;
	}
}