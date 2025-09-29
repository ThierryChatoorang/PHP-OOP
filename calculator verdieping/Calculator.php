<?php
class Calculator {
    private $precision = 2;
    
    public function setPrecision($precision) {
        $this->precision = max(0, min(10, $precision));
    }
    
    // Basis functies
    public function add($a, $b) {
        return round($a + $b, $this->precision);
    }
    
    public function subtract($a, $b) {
        return round($a - $b, $this->precision);
    }
    
    public function multiply($a, $b) {
        return round($a * $b, $this->precision);
    }
    
    public function divide($a, $b) {
        if ($b == 0) {
            throw new Exception("Kan niet door 0 delen");
        }
        return round($a / $b, $this->precision);
    }
    
    // Geavanceerde functies
    public function power($base, $exponent) {
        return round(pow($base, $exponent), $this->precision);
    }
    
    public function modulo($a, $b) {
        if ($b == 0) {
            throw new Exception("Kan geen modulo van 0 doen");
        }
        return $a % $b;
    }
    
    public function sqrt($number) {
        if ($number < 0) {
            throw new Exception("Kan geen wortel van negatief getal trekken");
        }
        return round(sqrt($number), $this->precision);
    }
    
    public function square($number) {
        return round($number * $number, $this->precision);
    }
    
    // Evalueer complete expressie
    public function evaluate($expression) {
        // Vervang functies
        $expression = str_replace('sqrt(', 'sqrt(', $expression);
        $expression = str_replace('^', '**', $expression);
        
        // Veilige evaluatie (let op: in productie gebruik een betere parser)
        try {
            $result = eval("return $expression;");
            return round($result, $this->precision);
        } catch (Exception $e) {
            throw new Exception("Ongeldige expressie");
        }
    }
}
?>