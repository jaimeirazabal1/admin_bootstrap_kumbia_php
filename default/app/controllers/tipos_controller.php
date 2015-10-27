<?php 
Load::models("tipos");
class TiposController extends AppController{
	public function index(){
		$tipos = new Tipos();
		$this->tipos = $tipos->find();
	}
	public function new_(){

        if (Input::post("tipos")) {
            $post_tipos = Input::post("tipos");
           
            $new_tipo_doc = new Tipos(Input::post("tipos"));
        
       
            if ($new_tipo_doc->save()) {
                Flash::valid("Tipo de Documento Creado!");
  
            }else{
                Flash::error("No se Creó el Tipo de Documento");
 

            }
        }
	}
	public function edit($id){
        if (Input::post("tipos")) {
        	// echo "<pre>";
        	// var_dump(Input::post('tipos'));
        	// echo "</pre>";

            $post_tipos = Input::post("tipos");
          
            $new_tipo_doc = new Tipos(Input::post("tipos"));
       
            if ($new_tipo_doc->save()) {
                Flash::valid("Tipo de Documento Editado!");
  
            }else{
                Flash::error("No se Editar el Tipo de Documento");
 

            }
        }
		$tipos = new Tipos();
        $this->tipos = $tipos->find($id);
	}
	public function del($id){
		$tipos = new Tipos();
        $tipo = $tipos->find($id);
        if ($tipo) {
        	if ($tipo->delete()) {
        		Flash::valid("Tipo de Documento Borrado");
        	}else{
        		Flash::error("El Tipo de Documento no se pudo borrar");
        	}
        }else{
        	Flash::error("El Tipo de Documento no existe");
        }		
        Router::redirect("tipos/");
	}
	
}
 ?>