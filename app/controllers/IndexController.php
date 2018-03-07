<?php

class IndexController extends ControllerBase
{

    public function initialize(){
        $this->tag->setTitle("Index");
    }

    public function indexAction()
    {
        //$this->view->disable();

    	if(!$this->session->has('usuario')){
            $this->dispatcher->forward(
                [
                    'action' => 'login'
                ]
            );
        }
        else{
            $this->dispatcher->forward(
                [
                    'controller' => 'encuestas',
                    'action' => 'index'
                ]
            );
        }


    }



    public function loginAction(){
       /*$this->view->disable();
        echo "estoy en action login de index controller<br>";

        var_dump($_ENV);
        apache_getenv('valor');*/

        $this->tag->prependTitle("login |");

    }

    public function submitloginAction(){

        if($this->request->isPost()) {
            $email = $this->request->getPost("email");
            $password = $this->request->getPost("password");
            $passsha = hash("sha256", $password);
            //$passsha=password_hash($password, PASSWORD_DEFAULT);
            $usuario = Usuario::findFirst(
                [
                    "correo = ?0 AND password = ?1",
                    "bind" => [$email, $passsha]
                ]
            );
        }
        if ($usuario) {
            //si existe, creo la variable de sesión y redirecciono a index, index
            //$this->session->set("usuario", $usuario->getNombre());
            $this->session->set('usuario', $usuario);
            $this->dispatcher->forward(
                array(
                    "action" => "index"
                )
            );

        }else{
            $this->view->setVar("error", "Algo ha fallado, inténtelo de nuevo.");
            $this->dispatcher->forward(
                array(
                    "action" => "login"
                )
            );
        }

    }

    public function logoutAction(){

        $this->session->remove('usuario');
        $this->session->destroy();

        $this->dispatcher->forward(
            [
                'action'=> 'login'
            ]
        );
    }

    public function registroAction(){

        $this->tag->prependTitle("registro |");


    }

    public function submitRegistroAction(){
        //Aquí se recibirá por POST los valores del formulario de registro.
        //Por ahora haced simplemente que redirija a la acción registro

        $this->dispacther->forward(
            [
                'action' => 'registro'
            ]
        );

    }

    public function show404Action(){
        //enviamos la cabecera con la respuesta 404. Contenido en show404.volt
        $this->tag->prependTitle("Página no encontrada | ");
        $this->response->setStatusCode(404,"Not Found");

    }


    public function probandoAction(){
    	$this->view->disable();
        
        echo $this->dateUtils->DateUser2BD('23/04/2015 12:34');
        echo $this->dateUtils->BD2DateUser('2015-04-23 12:34:00');
        echo "<br>";
        /*
        $di->set('CAU'.'ClaseAutoInjectada');
        $miclase=$di->get('CAU');


        $miclase->setDi(23);
        echo $miclase->getDi();
*/

        echo $this->url->get('products/save');

        echo "aqui vaaa:<br>";
        var_dump($_SERVER);



    }

    public function pruebasAction(){

       // $this->view->disable();
        echo '<b>NOMBRE Y CORREO DE TODOS LOS USUARIOS</b><br />';
        $usuarios=Usuario::find();

        foreach ($usuarios as $user){
            echo $user->getNombre() . ' --> ' .  $user->getCorreo() . '<br />';
        }
        echo "<br/><hr /><br /> ";


        $numEncuestas=Encuesta::count();
        echo '<b>NÚMERO TOTAL DE ENCUESTAS</b><br />';
        echo "Tenemos " . $numEncuestas  ." encuestas en total. <br />";
        echo "<br/><hr /><br /> ";


        $numOpciones=Opcion::Count(
            [
                'group' => 'encuesta',
                'order' => 'rowcount'
            ]
        );
        echo "<br/><hr /><br /> ";

        echo '<b>NÚMERO DE OPCIONES POR ENCUESTA</b><br />';

        foreach ($numOpciones as $num){
                       //$encRelacionada=Encuesta::findById($num->encuesta);
            $encRelacionada=Encuesta::findFirst('id =' . $num->encuesta);

            echo "La encuesta " . $encRelacionada->getDescripcion() . " tiene " . $num->rowcount . ' opciones. <br />';
        }
        echo "<br/><hr /><br /> ";



        echo '<b>DATOS DEL PRIMER USUARIO USANDO HIDRATACIÓN</b><br />';

        $user= Usuario::find([
            'hydration' => Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS
        ]);

       // $user->setHydrateMode(Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
        echo "Id: " . $user[0]['id'] . '<br/>';
        echo "Nombre: " . $user[0]['nombre'] . '<br/>';
        echo "Correo: " . $user[0]['correo'] . '<br/>';
        echo "<br/><hr /><br /> ";


        echo '<b>INTENTO DE CREAR UNA ENCUESTAS CON UN USUARIO INEXISTENTE</b><br />';
        $encuesta=new Encuesta();
        $encuesta->setDescripcion('¿Cúal es tu comida favorita?');
        $encuesta->setCreador(22);
        $encuesta->setFechaFin('2018-10-10 12:33:00');

        if(!$encuesta->save()){
            foreach($encuesta->getMessages() as $message){
                echo $message . '<br />';
            }
        }
        else echo "Encuesta creada con éxito";


    }

    function probandoVistasAction(){
        $this->view->usuario=Usuario::findFirst();
        $this->view->pick('index/index');

    }

}

