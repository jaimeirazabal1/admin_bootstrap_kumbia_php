<?php 
class Contratos extends ActiveRecord{
	public function get_contratos(){
		return $this->find();
	}
}

 ?>