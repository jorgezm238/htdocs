<?php
final class Cuatro_ruedas extends Vehiculo{
    public $numero_puertas;
    public $repintar;
    

    public function __construct($numero_puertas,$repintar)
    {
        $this->numero_puertas = $numero_puertas;
        $this->repintar = $repintar;
    }
    

    /**
     * Get the value of repintar
     */ 
    public function getRepintar()
    {
        return $this->repintar;
    }

    /**
     * Set the value of repintar
     *
     * @return  self
     */ 
    public function setRepintar($repintar)
    {
        $this->repintar = $repintar;

        return $this;
    }

    /**
     * Get the value of numero_puertas
     */ 
    public function getNumero_puertas()
    {
        return $this->numero_puertas;
    }

    /**
     * Set the value of numero_puertas
     *
     * @return  self
     */ 
    public function setNumero_puertas($numero_puertas)
    {
        $this->numero_puertas = $numero_puertas;

        return $this;
    
}



}



?>