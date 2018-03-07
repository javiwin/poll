<?php

class EncuestasController extends ControllerBase
{
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
        $this->tag->setTitle("Encuestas");
    }

    public function indexAction()
    {
        $this->tag->prependTitle("Todas las encuestas |");

        $ahora = date('Y-m-d G:i:s');

        //encuestas que aún no han acabado, ordenadas por la fecha de finalización
        //(la que antes acabe primero)

        $encuestasNoAcabadas=Encuesta::find(
            [
                'fecha_fin > ?0',
                'bind' => [$ahora],
                'order' => 'fecha_fin ASC'
            ]
        );

        //encuestas que ya hAN acabado ordenadas por fecha (primero la que acabó más recientemente).

        $encuestasAcabadas = Encuesta::find(
            [
                'fecha_fin < ?0',
                'bind' => [$ahora],
                'order' => 'fecha_fin DESC'
            ]
        );

        //PASO LAS VARIABLES A LA VISTA
        $this->view->SetVars(
            [
                'inacabadas' => $encuestasNoAcabadas,
                'acabadas'   => $encuestasAcabadas
            ]
        );
    }

    public function addAction(){
        $this->tag->prependTitle("Añadir encuesta |");

    }

    public function submitAction(){
        $datoscorrectos=true;

        if($this->request->isPost()) {


            //compruebo que al menos se han introducido dos opciones///////////////////////////////////
            $contador = 0;
            for ($i = 0; $i < sizeof($this->request->getPost('opciones')); $i++) {
                if (!empty($this->request->getPost('opciones')[$i])) $contador++;// aquí guardo el numero de opciones
            }

            if ($contador < 2) {

                $this->view->setVar("error", "Has de introducir al menos dos opciones.");
                $datoscorrectos = false;
            } else {   //supongo todo ok e inserto datos

                $encuesta = new Encuesta();
                $encuesta->setDescripcion($this->request->getPost('titulo'));
                //la fecha en el formato de la base de datos
                $encuesta->setFechaCreacion(date('Y-m-d G:i:s'));
                $encuesta->setFechaFin($this->dateUtils->DateUser2BD($this->request->getPost('fecha')));

                $encuesta->setCreador($this->session->get('usuario')->getId());

                //preparo el array de opciones para guardarlo todo de un solo paso

                $opciones = array();
                $indiceDeOpciones = 0;//si se escribe en la opcion 1 y la 8, yo la guardo com la primera y la segunda

                for ($i = 0; $i < 8; $i++) {
                    if (!empty($this->request->getPost('opciones')[$i])) {
                        $opciones[$indiceDeOpciones] = new Opcion();
                        $opciones[$indiceDeOpciones]->setOrden($indiceDeOpciones+1);
                        $opciones[$indiceDeOpciones]->setTexto($this->request->getPost('opciones')[$i]);
                        $indiceDeOpciones++;
                    }

                }

                $encuesta->Opciones = $opciones;

                //aqui grabo todo, encuesta y opciones en una única transacción
                if (!$encuesta->create()) {
                    $this->view->setVar('error', "Ha habido un problema. Intentelo de nuevo");
                    $datoscorrectos = false;

                }
            }
        }

            if($datoscorrectos){
                $this->view->setVar('exito', "La encuestas se ha creado correctamente.");
                $this->dispatcher->forward(
                    [
                        'action' => 'index'
                    ]
                );
             }
            else{
                    $this->dispatcher->forward(
                        [
                            'action' => 'add'
                        ]
                    );
            }

    }

    public function showAction($idEncuesta){
        $this->tag->prependTitle("Mostrar encuesta |");

        //hay enviar a la vista los datos de la encuesta, votos que tiene cada opción, etc.
        //$encuesta = Encuesta::findById($idEncuesta);
        //$this->view->setVar('encuesta', $encuesta[0]);

         $encuesta=Encuesta::findFirst('id = ' . $idEncuesta);
         $this->view->setVar('encuesta', $encuesta);

        //LO DE ARRIBA FUNCIONA UNO U OTRO, YA QUE FINDFIRST DEVUELVE UN BOJETO DEL MODELO, Y FIND Y FINDBY UN RESULSET,
        //Y LO TRATO COMO UN ARRAY

        //ahora a por las opciones, puede ser desde 1 hasta 8
        $opciones = Opcion::find('encuesta =' . $idEncuesta );
        $opciones->setHydrateMode(Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);
        $this->view->setVar('opciones',$opciones);

        //compruebo si la encuesta ya no está abierta, o el usuario ya ha votado, para 'avisar' a la vista

        $user=$this->session->get('usuario'); //me guardo el usuario conectado

        $buscandovotos=Voto::findFirst(//si uso find, no funcionaria en el if de abajo
            [
                'usuario =?0 and encuesta=?1',
                'bind' => [$user->getId(), $idEncuesta]
            ]
        );

        if( $encuesta->getFechaFin()<date('Y-m-g G:i:s') || $buscandovotos){//si ya ha votado o ya se ha cerrado
                $this->view->setVar('noPuedeVotar','no');

            //ahora voy a ver los votos de la encuesta para enviarlo a la vista si tiene que mostar los resultados
            //$idEncuesta tengo el id d ela encuesta

            $votaciones = Voto::count(array(
                "encuesta = ?0",
                "bind" => [$idEncuesta],
                "group" => 'opcion',
                "order" => "rowcount"
            ));
            $votaciones->setHydrateMode(Phalcon\Mvc\Model\Resultset::HYDRATE_ARRAYS);

            $this->view->setVar('votaciones', $votaciones);

            //voto mas alto
            if(sizeof($votaciones)>0) { //por si no ha votado nadie
                $votoMasAlto = $votaciones[0]['rowcount'];//será el primero ya que he ordenado la busqueda
                 $this->view->setVar('votoMasAlto' , $votoMasAlto);
            }
            //}else $votoMasAlto=0;
            //$this->view->setVar('votoMasAlto' , $votoMasAlto);


        }
        else{


        }

    }

    public function votarAction($idEncuesta=""){
        //votar: Recibirá por POST la opción que vota el usuario actual en una encuesta
        //(cuya id recibe por parámetro). Redirigirá a la acción show.
        $this->dispatcher->forward(
            [
                'action' => 'show',
                'params' => array($idEncuesta)
            ]
        );

    }
}

