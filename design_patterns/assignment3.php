<?php 
	Class MailingList {
		private $emailList = array("email1", "email2", "email3");
		private $subscriberList = array("sub1", "sub2", "sub3", "sub4");
		private $watcher;

		function __construct() {
			$this->watcher = new Watcher();
		}

		public function sendMessage($message) {
			echo "Message sent to all the subscribers";
		}

		public function addSubscriber($subscriber) {
			echo "New Subscriber added ";
		}

		public function removeSubscriber($subscriber) {
			echo "Subscriber removed"
		}
	}

	Class Watcher {

		function __construct() {
			echo "a new email sent";
		}
	}
?>