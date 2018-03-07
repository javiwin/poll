<?php

class Opcion extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $encuesta;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $orden;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    protected $texto;

    /**
     * Method to set the value of field encuesta
     *
     * @param integer $encuesta
     * @return $this
     */
    public function setEncuesta($encuesta)
    {
        $this->encuesta = $encuesta;

        return $this;
    }

    /**
     * Method to set the value of field orden
     *
     * @param integer $orden
     * @return $this
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Method to set the value of field texto
     *
     * @param string $texto
     * @return $this
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Returns the value of field encuesta
     *
     * @return integer
     */
    public function getEncuesta()
    {
        return $this->encuesta;
    }

    /**
     * Returns the value of field orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Returns the value of field texto
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("poll");

        $this->belongsTo('encuestas', 'Encuesta', 'id',
            [
                'alias' => 'EncuestaAsociada',
                'foreign' => [
                    'allowNulls' => true, //sólo si se adminten opciones sin ecuesta asociada
                    'message' => 'La encuesta asociada no existe'
                ]
            ]);

        $this->hasMany(['encuesta','order'], 'Voto', ['encuesta','opcion'],
            [
                'alias' => 'Voto',
                'foreignKey'=> [
                    'action' => Phalcon\Mvc\Model\Relation::ACTION_CASCADE
                ]
            ]
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'opcion';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Opcion[]|Opcion
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Opcion
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
