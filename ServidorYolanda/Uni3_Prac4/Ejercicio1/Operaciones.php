<?php

class Operaciones{

    public $num1;
    public $num2;
    

    public function __construct($num1,$num2)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }
    

    

    /**
     * Get the value of num1
     */ 
    public function getNum1()
    {
        return $this->num1;
    }

    /**
     * Set the value of num1
     *
     * @return  self
     */ 
    public function setNum1($num1)
    {
        $this->num1 = $num1;

        return $this;
    }

    /**
     * Get the value of num2
     */ 
    public function getNum2()
    {
        return $this->num2;
    }

    /**
     * Set the value of num2
     *
     * @return  self
     */ 
    public function setNum2($num2)
    {
        $this->num2 = $num2;

        return $this;
    }
    public function suma(){
        $suma= $this->num1+$this->num2;
        return $suma;
    }
    public function resta(){
        $resta= $this->num1-$this->num2;
        return $resta;
    }
    public function mult(){
        $mult= $this->num1*$this->num2;
        return $mult;
    }
    public function div(){
        $div= $this->num1/$this->num2;
        return $div;
    }
    public function __toString(){
        return  ("num 1: $this->num1, num 2: $this->num2");

    }
}
?>