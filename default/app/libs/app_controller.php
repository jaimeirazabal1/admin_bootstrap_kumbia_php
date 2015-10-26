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

		/*--------------------------------------------------*/
		
		$controlador_actual = Router::get("controller");
		$accion_actual = Router::get("action");
		$ruta_actual = $controlador_actual."/".$accion_actual;

		$rutas = array(
			"default" => "index/login"
		);

		/*aqui se configurar los controladores y las vistas que ven los usuarios*/
		$roles_permisos = array(
			"C"=>array(
				"index" => array("index","logout","login","flot"),
				"test" => array()
			),
			"U"=>array(
				"index" => array()
			),
			"A" => array(
				"*"
			)

		);

		/*--------------------------------------------------------------------*/

		if(Auth::is_valid()){
			$role = Auth::get("rol");
			if (isset($roles_permisos[$role])) {
				$controladores = $roles_permisos[$role];
				if (isset($controladores[$controlador_actual])) {
					$acciones = $controladores[$controlador_actual];
					if (in_array($accion_actual, $acciones)) {
						/*aqui pasa con permiso*/
					}else{
						Flash::error("Permiso Denegado!...");
						Router::redirect($rutas['default']);						
					}
				}else{
					Flash::error("Permiso Denegado!....");
					Router::redirect($rutas['default']);						
				}
			}else{
				Flash::warning("Permiso denegado, el rol no se encuentra registrado");
				Router::redirect($rutas['default']);
			}
		}else{
			$vistas = $roles_permisos["C"];
			if (isset($vistas[$controlador_actual])) {
				$acciones = $vistas[$controlador_actual];
				if (in_array($accion_actual, $acciones)) {
					/*aqui pasa con permiso*/
				}else{
					Flash::error("Permiso Denegado!.");
					Router::redirect($rutas['default']);
				}
			}else{
				Flash::error("Permiso Denegado!..");
				Router::redirect($rutas['default']);				
			}
		}

		/*----------------------------------------------------*/

	}

	final protected function finalize()
	{

	}
	

}
