<?php

require_once 'PHPUnit/Autoload.php';
include 'life.php';
class Gol_Source_Test extends PHPUnit_Framework_TestCase{

	public function testRun(){
		$gol= new GameOfLife_Source_Life("10-11,10-12,10-13");
		$this->assertInternalType('string', $gol->run());
	}

	public function testExecuteCell(){
		$gol= new GameOfLife_Source_Life("10-11,10-12,10-13");
		$this->assertNull($gol->executeCell('5-5'));
	}

	public function testInitCells(){
		$gol= new GameOfLife_Source_Life("10-11,10-12,10-13");
		$this->assertNotEmpty($gol->initCells('5-5'));
	}

	public function testCreateNewCells(){
		$gol= new GameOfLife_Source_Life("10-11,10-12,10-13");
		$this->assertNotEmpty($gol->createNewCells(5,5));
	}

	public function testNewKey(){
		$gol= new GameOfLife_Source_Life("10-11,10-12,10-13");
		$this->assertInternalType('string',$gol->newKey(5,5));
	}

	public function testNewLife(){
		$gol= new GameOfLife_Source_Life("10-11,10-12,10-13");
		$this->assertTrue($gol->newLife("5-5"));
	}

	public function testGetCustomWorld(){
		$world = new GameOfLife_Source_World("10-11,10-12,10-13");
		$this->assertNotEmpty($world->getCustomWorld());
		$this->assertTrue($world->setCell('5-8'));
		$this->assertInternalType('string',$world->getNewWorld());
	}
}

