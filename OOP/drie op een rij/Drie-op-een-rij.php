<?php

namespace Vormen;

abstract class Figuur
{
    private string $kleur;
    private int $x;
    private int $y;

    public function __construct(string $kleur, int $x, int $y)
    {
        $this->kleur = $kleur;
        $this->x = $x;
        $this->y = $y;
    }

    public function getKleur(): string
    {
        return $this->kleur;
    }

    public function setKleur(string $kleur): void
    {
        $this->kleur = $kleur;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): void
    {
        $this->x = $x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): void
    {
        $this->y = $y;
    }

    protected function kleurNaarCss(string $kleur): string
    {
        return array_key_exists($kleur, [
            'rood' => 'red',
            'groen' => 'green',
            'blauw' => 'blue',
            'geel' => 'yellow',
            'oranje' => 'orange',
            'paars' => 'purple'
        ]) ? array_search($kleur, [
            'rood' => 'red',
            'groen' => 'green',
            'blauw' => 'blue',
            'geel' => 'yellow',
            'oranje' => 'orange',
            'paars' => 'purple'
        ]) : $kleur;
    }

    abstract public function teken(): string;
}

class Vierkant extends Figuur
{
    private int $zijde;

    public function __construct(string $kleur, int $x, int $y, int $zijde)
    {
        parent::__construct($kleur, $x, $y);
        $this->zijde = $zijde;
    }

    public function getZijde(): int
    {
        return $this->zijde;
    }

    public function setZijde(int $zijde): void
    {
        $this->zijde = $zijde;
    }

    public function teken(): string
    {
        $x = $this->getX();
        $y = $this->getY();
        $w = $this->zijde;
        $kleur = $this->kleurNaarCss($this->getKleur());
        return "<rect x=\"$x\" y=\"$y\" width=\"$w\" height=\"$w\" fill=\"$kleur\" />";
    }
}

class Rechthoek extends Figuur
{
    private int $breedte;
    private int $hoogte;

    public function __construct(string $kleur, int $x, int $y, int $breedte, int $hoogte)
    {
        parent::__construct($kleur, $x, $y);
        $this->breedte = $breedte;
        $this->hoogte = $hoogte;
    }

    public function getBreedte(): int
    {
        return $this->breedte;
    }

    public function setBreedte(int $breedte): void
    {
        $this->breedte = $breedte;
    }

    public function getHoogte(): int
    {
        return $this->hoogte;
    }

    public function setHoogte(int $hoogte): void
    {
        $this->hoogte = $hoogte;
    }

    public function teken(): string
    {
        $x = $this->getX();
        $y = $this->getY();
        $w = $this->breedte;
        $h = $this->hoogte;
        $kleur = $this->kleurNaarCss($this->getKleur());
        return "<rect x=\"$x\" y=\"$y\" width=\"$w\" height=\"$h\" fill=\"$kleur\" />";
    }
}

class Cirkel extends Figuur
{
    private int $straal;

    public function __construct(string $kleur, int $cx, int $cy, int $straal)
    {
        parent::__construct($kleur, $cx, $cy);
        $this->straal = $straal;
    }

    public function getStraal(): int
    {
        return $this->straal;
    }

    public function setStraal(int $straal): void
    {
        $this->straal = $straal;
    }

    public function teken(): string
    {
        $cx = $this->getX();
        $cy = $this->getY();
        $r = $this->straal;
        $kleur = $this->kleurNaarCss($this->getKleur());
        return "<circle cx=\"$cx\" cy=\"$cy\" r=\"$r\" fill=\"$kleur\" />";
    }
}

class Driehoek extends Figuur
{
    private array $punten;

    public function __construct(string $kleur, int $offsetX, int $offsetY, array $punten)
    {
        parent::__construct($kleur, $offsetX, $offsetY);
        $this->punten = $punten;
    }

    public function getPunten(): array
    {
        return $this->punten;
    }

    public function setPunten(array $punten): void
    {
        $this->punten = $punten;
    }

    public function teken(): string
    {
        $offsetX = $this->getX();
        $offsetY = $this->getY();
        $lijst = [];
        foreach ($this->punten as $p) {
            $lijst[] = ($p[0] + $offsetX) . "," . ($p[1] + $offsetY);
        }
        $puntenTekst = implode(' ', $lijst);
        $kleur = $this->kleurNaarCss($this->getKleur());
        return "<polygon points=\"$puntenTekst\" fill=\"$kleur\" />";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Drie op een rij - Figuren</title>
</head>
<body>
    <svg width="600" height="400" viewBox="0 0 600 400" xmlns="http://www.w3.org/2000/svg">
        <?php
        use Vormen\Vierkant;
        use Vormen\Rechthoek;
        use Vormen\Cirkel;
        use Vormen\Driehoek;

        $vierkanten = [
            new Vierkant('rood', 20, 20, 80),
            new Vierkant('paars', 20, 140, 60)
        ];
        $vierkant = new Vierkant('rood', 20, 20, 80);
        echo $vierkant->teken();

        $rechthoeken = [
            new Rechthoek('groen', 120, 20, 120, 80),
            new Rechthoek('oranje', 100, 140, 140, 60)
        ];
        $rechthoek = new Rechthoek('groen', 120, 20, 120, 80);
        echo $rechthoek->teken();

        $cirkels = [
            new Cirkel('blauw', 320, 60, 40),
            new Cirkel('paars', 320, 170, 30)
        ];
        $cirkel = new Cirkel('blauw', 320, 60, 40);
        echo $cirkel->teken();

        $driehoeken = [
            new Driehoek('geel', 420, 20, [[0,80],[40,0],[80,80]]),
            new Driehoek('rood', 420, 140, [[0,60],[30,0],[60,60]])
        ];
        $driehoek = new Driehoek('geel', 420, 20, [[0,80],[40,0],[80,80]]);
        echo $driehoek->teken();

        foreach ($vierkanten as $vierkant) {
            echo $vierkant->teken();
        }
        $vierkant2 = new Vierkant('paars', 20, 140, 60);
        echo $vierkant2->teken();

        foreach ($rechthoeken as $rechthoek) {
            echo $rechthoek->teken();
        }
        $rechthoek2 = new Rechthoek('oranje', 100, 140, 140, 60);
        echo $rechthoek2->teken();

        foreach ($cirkels as $cirkel) {
            echo $cirkel->teken();
        }
        $cirkel2 = new Cirkel('paars', 320, 170, 30);
        echo $cirkel2->teken();

        foreach ($driehoeken as $driehoek) {
            echo $driehoek->teken();
        }
        $driehoek2 = new Driehoek('rood', 420, 140, [[0,60],[30,0],[60,60]]);
        echo $driehoek2->teken();
        ?>
    </svg>
</body>
</html>

