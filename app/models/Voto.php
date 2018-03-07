<?php

class Voto extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $usuario;

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
    protected $opcion;

    /**
     * Method to set the value of field usuario
     *
     * @param integer $usuario
     * @return $this
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

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
     * Method to set the value of field opcion
     *
     * @param integer $opcion
     * @return $this
     */
    public function setOpcion($opcion)
    {
        $this->opcion = $opcion;

        return $this;
    }

    /**
     * Returns the value of field usuario
     *
     * @return integer
     */
    public function getUsuario()
    {
        return $this->usuario;
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
     * Returns the value of field opcion
     *
     * @return integer
     */
    public function getOpcion()
    {
        return $this->opcion;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("poll");

        $this->belongsTo(['encuesta','opcion'], 'Opcion', ['encuesta','orden'],
            [
                'alias' => 'OpcionVotada',
                'foreign' => [
                    'allowNulls' => true,
                    'message' => 'La opción a la que se vota no existe'
                ]
            ]
        );

        $this->belongsTo('usuario', 'Usuario', 'id',
                [
                    'alias' => 'UsuarioVotado',
                    'foreignKey' => true,
                    'message' => 'Ojo, el usuario que vota no existe' //o está en blanco

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
        return 'voto';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Voto[]|Voto
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Voto
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
