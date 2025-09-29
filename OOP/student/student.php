<<?php
include 'Student_class.php';

include 'Persona.php';
//object aanmaken met constructor
//Main
//aanmaken object namelijk een student
$student1 = new Student();
$student1->name = "Thierry";
$student1->dateOfBirth = "01-01-2000";
$student1->setPassword("password123");

echo $student1->getPassword(); // private method dus kan deze niet worden opgeroepen
$student1->printName();
$student1->printDateOfBirth();



$student2 = new student();
$student2->name = "Sosa";
$student2->dateOfBirth = "02-02-2001";
$student2->setPassword("mypassword");
//echo "Mijn naam is " . $student2->name . "<br>";
$student2->printName();
$student2->printDateOfBirth();
//var_dump($student2);



$student3 = new student();
$student3->name = "Kyle";
$student3->dateOfBirth = "03-03-2002";
$student3->setPassword("securepass");
//echo "Mijn naam is " . $student3->name . "<br>";
$student3->printName();
$student3->printDateOfBirth();
//var_dump($student3);






?>