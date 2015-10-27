<?php 
Load::models("documentos");
class DocumentosController extends AppController{
	public function subir($contrato_id){
		$this->contrato = $contrato_id;
		if (Input::hasPost('oculto')) {  //para saber si se envió el form
            $_FILES['archivo']['name']=date("Y_m_d_H_i_s_").$_FILES['archivo']['name'];
            $archivo = Upload::factory('archivo');//llamamos a la libreria y le pasamos el nombre del campo file del formulario
            $archivo->setExtensions(array('pdf')); //le asignamos las extensiones a permitir
            $url = '/files/upload/';
            $archivo->setPath(getcwd().$url);
            if ($archivo->isUploaded()) { 
                if ($archivo->save()) {
                    Flash::valid('Archivo subido correctamente!!!');                	
       				$nuevo_documento = new Documentos(Input::post("documentos"));
       				// $nuevo_documento->contratos_id = $contrato_id;
       				// $nuevo_documento->subido_por = Auth::get("id");
       				// $nuevo_documento->tipo_documento = ;
       				$nuevo_documento->url = $url.$_FILES['archivo']['name'];
       				if ($nuevo_documento->save()) {
       					Flash::valid("Documento Guardado");
       				}else{
       					Flash::error("No se pudo guardar el documento");
       				}
                }
            }else{
                    Flash::warning('No se ha Podido Subir el Archivo...!!!');
            }
        }
	}
}

 ?>