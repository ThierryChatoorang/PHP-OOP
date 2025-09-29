<?php
 class Persona {
     public int $bsnr;
    public string $name;

    public string $dateOfBirth;

    public string $Address;

    public function __construct(int $bsnr, string $Name, string $DateOfBirth, string $Address) {
     //   $this->bsnr = $bsnr;
     //   $this->Name = $Name;
      //  $this->DateOfBirth = $DateOfBirth;
       // $this->Address = $Address;
       echo "Nieuwe object aangemaakt<br>";
    }

    public function printName() {
        echo "Mijn naam is " . $this->name . "<br>";
    }

    public function printDateOfBirth() {
        echo "Mijn geboortedatum is " . $this->dateOfBirth . "<br>";
    }

 }
 ?>