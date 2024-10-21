<?php
final class Dos_ruedas extends Vehiculos{
    public $cilindrada;
    public $poner_gasolina;
    

    public function __construct($cilindrada,$poner_gasolina)
    {
        $this->cilindrada = $cilindrada;
        $this->poner_gasolina = $poner_gasolina;
    }


    
    

    /**
     * Get the value of poner_gasolina
     */ 
    public function getPoner_gasolina()
    {
        return $this->poner_gasolina;
    }

    /**
     * Set the value of poner_gasolina
     *
     * @return  self
     */ 
    public function setPoner_gasolina($poner_gasolina)
    {
        $this->poner_gasolina = $poner_gasolina;

        return $this;
    }

    /**
     * Get the value of cilindrada
     */ 
    public function getCilindrada()
    {
        return $this->cilindrada;
    }

    /**
     * Set the value of cilindrada
     *
     * @return  self
     */ 
    public function setCilindrada($cilindrada)
    {
        $this->cilindrada = $cilindrada;

        return $this;
    }




}


?>