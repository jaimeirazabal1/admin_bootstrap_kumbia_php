<?php 
Load::models("documentos","contratos");
class ContratosController extends AppController{
	public function index(){
		$this->contratos = Load::model("contratos")->get_contratos();
	}
	public function new_(){
		if (Input::hasPost('oculto')) {  //para saber si se envió el form
            $_FILES['archivo']['name']=date("Y_m_d_H_i_s_").$_FILES['archivo']['name'];
            $archivo = Upload::factory('archivo');//llamamos a la libreria y le pasamos el nombre del campo file del formulario
            $archivo->setExtensions(array('pdf')); //le asignamos las extensiones a permitir
            $url = '/files/upload/';
            $archivo->setPath(getcwd().$url);
            if ($archivo->isUploaded()) { 
                if ($archivo->save()) {
                    Flash::valid('Archivo subido correctamente!!!');
                	$nuevo_contrato = new Contratos(Input::post("contratos"));
           			if ($nuevo_contrato->save()) {
           				Flash::valid("Contrato guardado");
           				$nuevo_documento = new Documentos();
           				$nuevo_documento->contratos_id = Load::model("contratos")->last_id();
           				$nuevo_documento->subido_por = Auth::get("id");
           				$nuevo_documento->tipo_documento = 1;
           				$nuevo_documento->url = $url.$_FILES['archivo']['name'];
           				$email_empresa = Load::model("usuarios")->find($nuevo_documento->pertenece_a);
           				if ($nuevo_documento->save()) {
           				 	?>
           				 	<script type="text/javascript">
           				 		alert("Aqui se envia un email a la empresa con email:"+ <?php echo $email_empresa->email ?>);
           				 	</script>
           				 	<?php
           					Flash::valid("Documento Guardado");
           				}else{
           					Flash::error("No se pudo guardar el documento");
           				}
           			}else{
           				Flash::error("No se pudo guardar el contrato");
           			}
                }
            }else{
                    Flash::warning('No se ha Podido Subir el Archivo...!!!');
            }
        }
	}
	public function ver($documento_id){
		$this->documento = Load::model("documentos")->find($documento_id);
	}
}

 ?>