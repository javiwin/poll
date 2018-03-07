<?php

class UsuariosController extends ControllerBase
{

    //Lo primero será crear el evento beforeExecuteRoute() para controlar que si no se ha iniciado sesión,
    //se le redirija al controlador index, acción index.

    public function beforeExecuteRoute(){
        if(!$this->session->has('usuario')){
            $this->dispatcher->forward(
                [
                    'controller'=> 'index',
                    'action' => 'index'
                ]
            );
        }

    }

    public function initialize(){
        $this->tag->setTitle("Usuarios");
    }

    public function indexAction()
    {
        $this->dispatcher->forward(
            [
                'action' => 'perfil'

            ]
        );

    }

    public function perfilAction(){
        //Formulario para modificar el perfil (por ahora vacío)
        //$this->view->disable();
        //echo "estoy en acción pefirl del controlador usuarios";

        $this->tag->prependTitle("perfil |");

        $this->view->setVars(
            [
                'nombre' => $this->session->get('usuario')->getNombre(),
                'correo' => $this->session->get('usuario')->getCorreo(),
            ]);


    }

    public function updatePerfilAction(){
        //Recibirá por POST los valores del formulario para modificar el perfil, que por ahora no existe.
        //Por ahora, redirigirá a la acción perfil.

        /*********otra forma
        $di = new \Phalcon\Di();

        $dispatcher = new \Phalcon\Mvc\Dispatcher();

        $dispatcher->setDI($di);

        $dispatcher->setControllerName("posts");
        $dispatcher->setActionName("index");
        $dispatcher->setParams([]);

        $controller = $dispatcher->dispatch();
         * ******************************************/
        //esta forma la apaño así
        $this->dispatcher->setControllerName("usuarios");
        $this->dispatcher->setActionName("perfil");
        $this->dispatcher->setParams([]);

        $controller =  $this->dispatcher->dispatch();


    }

}

