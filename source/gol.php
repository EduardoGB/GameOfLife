	<?php 
class Gol_Source_Gol {
	public $_responseArray ;
	public $_requestArray ;

	public function Run($initData){
		$this->_requestArray = $initData;
		array_walk_recursive($initData,function ($item, $key){
			$this->runprocess($item,$key);
		});
		return $this->_responseArray;
	}

	public function runprocess($item, $key){
		$position 	= explode(',', $key);
		$topIndex 		= ($position[0]).','.($position[1]-1);
		$bottomindex 	= ($position[0]).','.($position[1]+1);
		$resultBottom	= (($this->bottomLive($position)) ? $this->setIndex($bottomindex) : "");
		$resultTop		= (($this->topLive($position)) ? $this->setIndex($topIndex) : "");
	}

	public function topLive($position){
		return ($this->getTopGol($position[0],$position[1]) == 2 ||  
				$this->getTopGol($position[0],$position[1]) == 3);
	}

	public function bottomLive($position){
		return ($this->getBottomGol($position[0],$position[1]) == 2 ||  
				$this->getBottomGol($position[0],$position[1]) == 3) ? true :false;;
	}


	public function getBottomGol($x,$y){
		return $this->isActive($x,$y)+$this->isActive($x+1,$y)+$this->isActive($x+1,$y+1)+
			   $this->isActive($x+1,$y+2)+$this->isActive($x,$y+2)+$this->isActive($x-1,$y+2)+
			   $this->isActive($x-1,$y+1)+$this->isActive($x-1,$y);
	}

	public function getTopGol($x,$y){
		return $this->isActive($x,$y)+$this->isActive($x,$y+1)+$this->isActive($x+1,$y-1)+
			   $this->isActive($x+1,$y-2)+$this->isActive($x,$y-2)+$this->isActive($x-1,$y-2)+
			   $this->isActive($x-1,$y-1)+$this->isActive($x-1,$y);
	}

	public function isActive($x,$y){
		$key = $x.','.$y;
		return (array_key_exists($key, $this->_requestArray)) ? 1 : 0;
	} 

	public function setIndex($index){
		$this->_responseArray[] = $index;
		return true;
	}

}