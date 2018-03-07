<?php

class Encuesta extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    protected $descripcion;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $creador;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $fecha_fin;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $fecha_creacion;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field descripcion
     *
     * @param string $descripcion
     * @return $this
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Method to set the value of field creador
     *
     * @param integer $creador
     * @return $this
     */
    public function setCreador($creador)
    {
        $this->creador = $creador;

        return $this;
    }

    /**
     * Method to set the value of field fecha_fin
     *
     * @param string $fecha_fin
     * @return $this
     */
    public function setFechaFin($fecha_fin)
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    /**
     * Method to set the value of field fecha_creacion
     *
     * @param string $fecha_creacion
     * @return $this
     */
    public function setFechaCreacion($fecha_creacion)
    {
        $this->fecha_creacion = $fecha_creacion;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Returns the value of field creador
     *
     * @return integer
     */
    public function getCreador()
    {
        return $this->creador;
    }

    /**
     * Returns the value of field fecha_fin
     *
     * @return string
     */
    public function getFechaFin()
    {
        return $this->fecha_fin;
    }

    /**
     * Returns the value of field fecha_creacion
     *
     * @return string
     */
    public function getFechaCreacion()
    {
        return $this->fecha_creacion;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("poll");
        /*
        $this->belongsTo('creador','Usuario','id',
            ['alias' => 'Usuario',
             ' foreignKey' =>[
                 'allowNull' => true, //solo si se permite encuestas sin creador
                 'message' => "El usuario asociado a la encuesta no existe"
             ]


            ]);
        */

        $this->belongsTo('creador', 'Usuario', 'id',
            array(
                'alias' => 'Usuario',
                'foreignKey' => [
                    'allowNulls' => true,
                    'message' => "Lo siento, pero el usuario asociado a la encuesta no existe"
                ]
            ));

        $this->hasMany('id', 'Opcion', 'encuesta',
            [   'alias' => 'Opciones',
                'foreingKey' => [
                    'action'=> Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                ]
            ]);

        $this->skipAttributes(array('fechaCreacion'));
        /*
        $this->skipAttributes(
            [
                'fechaCreacion'
            ]
        );*/



    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'encuesta';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Encuesta[]|Encuesta
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Encuesta
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
