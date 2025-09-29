<?php

class student {
    //properties
    public $name;
    public $dateOfBirth;
    private $pwd;
    
    //constructor
    public function __construct($name = null, $dateOfBirth = null, $pwd = null) {
        echo "Nieuwe student aangemaakt<br>";
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->setPassword($pwd);
    }
    
    //methods bewerkingen die je kan doen met een class kan doen (class=object)
    public function printName() {
        echo "<br>Mijn naam is " . $this->name . "<br>"; //this is verwijzing naar de class zelf
    }
    
    public function printDateOfBirth() {
        echo "<br>Mijn geboortedatum is " . $this->dateOfBirth . "<br>"; //this is verwijzing naar de class zelf
    }
    
    public function setPassword($pwd) {
        $this->pwd = $pwd; //SET en GET methodes zijn altijd private met get kan je die private property ophalen
    }
    
    public function getPassword() {
        return $this->pwd;
    }
    
public function calculateAge() {
    return date('Y') - substr($this->dateOfBirth, -4);
}
}
?>