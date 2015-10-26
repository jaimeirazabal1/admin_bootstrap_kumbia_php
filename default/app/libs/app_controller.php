<?php
/**
 * @see Controller nuevo controller
 */
require_once CORE_PATH . 'kumbia/controller.php';

/**
 * Controlador principal que heredan los controladores
 *
 * Todas las controladores heredan de esta clase en un nivel superior
 * por lo tanto los metodos aqui definidos estan disponibles para
 * cualquier controlador.
 *
 * @category Kumbia
 * @package Controller
 */
class AppController extends Controller
{
	public $acl; //variable objeto ACL
	public $userRol = ""; //variable con el rol del usuario autenticado en la aplicación

	final protected function initialize()
	{
		$this->kumbia_title = "Arrocera";
		if(Auth::is_valid()) $this->userRol = Auth::get("rol");

		$this->acl = new Acl();
	
		//Se agregan los roles
		$this->acl->add_role(new AclRole("")); // Visitantes
		$this->acl->add_role(new AclRole("A")); // Administradores
		$this->acl->add_role(new AclRole("U")); // Usuarios

		//Se agregan los recursos
		$this->acl->add_resource(new AclResource("index"), "index");
		$this->acl->add_resource(new AclResource("test"), "index");

		//Se crean los permisos
		 // Inicio
		$this->acl->allow("", "index", array("index"));
		$this->acl->allow("U", "index", array("index"));
		 // Test
		$this->acl->allow("U", "test", array("index"));
	}

	final protected function finalize()
	{

	}

}
