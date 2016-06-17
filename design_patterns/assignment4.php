<?php 
	Class Cart {
		private $amount = 0;

		public function setAmount($amount) {
			$this->amount = $amount;
		}

		public function displayGateway() {
			if ( $this->amount < 1000 ) {
				new PayPal();
			}else {
				new CreditCard();
			}
		}
	}

	Class PayPal {
		function __construct() {
			echo "Palpal gateway displayed ";
		}
	}

	Class CreditCard {
		function __construct() {
			echo "CreditCard gateway displayed";
		}
	}	

	$mycart = new Cart();
	$mycart->setAmount(12000);
	$mycart->displayGateway();
?>