<?php 
	Class NexaOrder {
		public $models = array();
		public $car;
		public function placeOrder() {

			$this->manufacture($model);
			$this->car = new manufactureCar();
			array_push($this->models,$model);
			return $models;
		}
	}
?>