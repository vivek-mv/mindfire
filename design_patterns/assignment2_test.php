<?php 
	Class NexaOrder {
		$models = array( "model1", "model2", "model3", "model4");
		public function placeOrder() {
			$this->manufacture($model);
			return $models;
		}

		private function manufacture($carModel) {
			$this->car = new ManufactureCar($carModel);
		}
	}
?>