<?php 
class Tipos extends ActiveRecord{
	public function get_tipo_by_id($id){
		return $this->find($id)->tipo;
	}
}

 ?>