<?php

class Interval
{
	public $b;
	public $e;
	public function __construct($b,$e){
		$this->b=$b; $this->e=$e;
	}
}

class Main
{

	public function __construct(){
		$this->init();
	}



	/**
	 * Undocumented function
	 *
	 * 						5====6
	 * 			2=======4
	 * 			2===3
	 * 		1=======3
	 * 0	1	2	3	4	5	6 
	 * 
	 * @return void
	 */
	private function init():void
	{
		$a = [
			new Interval(2,3),new Interval(1,3) , new Interval(2,4), new Interval(5,6)
		];
	
		$output = $this->mergeInterval($a);

		foreach($output as $intvl){
			print_r($intvl);
		}
	}

	private function mergeInterval(Array $a):SplStack
	{
		$stack = new SplStack();
		usort($a,[$this,'compare']);
		foreach($a as $curr){
			if($stack->isEmpty() || ($stack->top()->e < $curr->b)){ // when Non-overlapping block
				$stack->push($curr);
			}

			if ($stack->top()->e < $curr->e){ // when overlapping. merge
				$stack->top()->e = $curr->e;
			}
		}


		return $stack;
	}

	private function compare(Interval $i1, Interval $i2){
		if($i1->b === $i2->b){
			return 0;
		}else if($i1->b > $i2->b){
			return 1;
		}else{
			return -1;
		}
	}
}

new Main();