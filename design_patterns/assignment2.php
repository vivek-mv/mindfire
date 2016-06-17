<?php 
	//A Class that manages car orders for Nexa
	Class NexaOrder {
		private $car;
		public $manufacturedCars = array();
		public $manufacturedModels = array();
		public function viewModel() {
			return array( "model1","model2","model3" );
		}
		public function placeOrder($model) {
			$this->manufacture($model);
			array_push($this->manufacturedModels, $model);
			array_push($this->manufacturedCars, $this->car);
		}

		private function manufacture($carModel) {
			$this->car = new ManufactureCar($carModel);
		}
	} 

	//A class that manufactures the car
	Class ManufactureCar {
		private $model = '';
		private $order_date;
		function __construct($carModel) {
			$this->model = $carModel;
			$this->order_date = date( 'Y/m/d' );

			echo "A car of model : ".$this->model." is manufactured successfully on ".$this->order_date." :) ";
		}
	}

	$car1 = new NexaOrder(); 
	$models = $car1->viewModel();
	$car1->placeOrder($models[1]);

	$car2 = new NexaOrder();
	$car2->placeOrder($models[0]);

?>