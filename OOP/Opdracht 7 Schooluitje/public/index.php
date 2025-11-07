<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Models\Student;
use App\Models\Teacher;
use App\SchooltripList;

$list = new SchooltripList();

$students = [
    new Student('Ava Janssen', 'SD4A'),
    new Student('Noah de Vries', 'SD4A'),
    new Student('Liam Visser', 'SD4A'),
    new Student('Emma Bakker', 'SD4A'),
    new Student('Olivia Smit', 'SD4A'),
    new Student('Milan Mulder', 'SD4B'),
    new Student('Sofia Meijer', 'SD4B'),
    new Student('Lucas Brouwer', 'SD4B'),
    new Student('Sara de Jong', 'SD4B'),
    new Student('Daan Peters', 'SD4B'),
    new Student('Julia van Dijk', 'SD4C'),
    new Student('Finn van Leeuwen', 'SD4C')
];

$students[0]->setSignedUp(true);  $students[0]->setPaid(true);
$students[1]->setSignedUp(true);  $students[1]->setPaid(true);
$students[2]->setSignedUp(true);  $students[2]->setPaid(false);
$students[3]->setSignedUp(true);  $students[3]->setPaid(true);
$students[4]->setSignedUp(false); $students[4]->setPaid(false);

$students[5]->setSignedUp(true);  $students[5]->setPaid(true);
$students[6]->setSignedUp(true);  $students[6]->setPaid(true);
$students[7]->setSignedUp(true);  $students[7]->setPaid(true);
$students[8]->setSignedUp(true);  $students[8]->setPaid(false);
$students[9]->setSignedUp(true);  $students[9]->setPaid(true);

$students[10]->setSignedUp(true); $students[10]->setPaid(true);
$students[11]->setSignedUp(false);$students[11]->setPaid(false);

foreach ($students as $s) {
    $list->addStudent($s);
}

$teachers = [
    new Teacher('Mevr. J. Wigmans'),
    new Teacher('Dhr. R. Helden'),
    new Teacher('Mevr. K. Vermeer')
];

foreach ($teachers as $t) {
    $list->addTeacher($t);
}

$groupSize = 5;
$groups = $list->makeGroups($groupSize);
$classStats = $list->getClassStats();
$byClassTotals = $list->getTotalCollectedByClass();
$totalCollected = $list->getTotalCollected();
$eligibleTeachers = $list->getEligibleTeacherCount();
$assignedTeachers = $list->getAssignedTeachers();

echo "<h1>Schooltrip List</h1>";

echo "<h2>Groepsindeling (per {$groupSize} betalende leerlingen 1 docent)</h2>";
if (count($groups) === 0) {
    echo "<p>Geen groepen beschikbaar.</p>";
} else {
    $i = 1;
    foreach ($groups as $g) {
        echo "<h3>Groep {$i}</h3>";
        if ($g['teacher']) {
            echo "<p>Docent: " . htmlspecialchars($g['teacher']->getName()) . "</p>";
        } else {
            echo "<p>Docent: n.v.t.</p>";
        }
        echo "<ul>";
        foreach ($g['students'] as $st) {
            $paid = $st->getPaid() ? 'Betaald' : 'Niet betaald';
            echo "<li>" . htmlspecialchars($st->getName()) . " (" . htmlspecialchars($st->getClassName()) . ") - " . $paid . "</li>";
        }
        echo "</ul>";
        $i++;
    }
}

echo "<h2>Statistieken per klas</h2>";
echo "<table border='1' cellpadding='6' cellspacing='0'>";
echo "<tr><th>Klas</th><th>Totaal</th><th>Aangemeld</th><th>Betaald</th><th>% Aangemeld</th><th>% Betaald</th><th>Ingezameld (€)</th></tr>";
foreach ($classStats as $class => $stats) {
    $sum = $byClassTotals[$class] ?? 0;
    echo "<tr>";
    echo "<td>" . htmlspecialchars($class) . "</td>";
    echo "<td>" . $stats['total'] . "</td>";
    echo "<td>" . $stats['signed'] . "</td>";
    echo "<td>" . $stats['paid'] . "</td>";
    echo "<td>" . number_format($stats['percentSigned'], 1) . "%</td>";
    echo "<td>" . number_format($stats['percentPaid'], 1) . "%</td>";
    echo "<td>" . $sum . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h2>Totaaloverzicht</h2>";
echo "<p>Betaalde leerlingen: " . count($list->getPayingStudents()) . "</p>";
echo "<p>Docenten toegestaan: " . $eligibleTeachers . "</p>";
echo "<p>Docenten ingepland: " . count($assignedTeachers) . "</p>";
echo "<p>Totaal ingezameld: €" . $totalCollected . "</p>";
