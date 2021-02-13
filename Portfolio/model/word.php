<!DOCTYPE html>
<html lang="en">
<?php

	class Word{

		private $id;
		private $engword;
		private $korword;

		function __construct($id, $engword, $korword) {
			$this->setId($id);
			$this->setEngword($engword);
			$this->setKorword($korword);
		}
		
		public function getId() {
			return $this->id;
		}
		 
		public function setId($id) {
			$this->id = $id;
		}		
		  
		public function getEngword() {
			return $this->engword;
		}
		 
		public function setEngword($engword) {
			$this->engword = $engword;
		}
		 
		public function getKorword() {
			return $this->korword;
		}
		 
		public function setKorword($korword) {
			$this->korword = $korword;
		}
	 
	} // end of class

?>
</html>