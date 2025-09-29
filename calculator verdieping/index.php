<?php
session_start();
require_once 'Calculator.php';
require_once 'functions.php';

$calculator = new Calculator();
$result = '';
$error = '';

// Afrondingsprecisie instellen
if (isset($_POST['precision'])) {
    $_SESSION['precision'] = $_POST['precision'];
}
$precision = $_SESSION['precision'] ?? 2;
$calculator->setPrecision($precision);

// Berekeningen uitvoeren
if ($_POST) {
    try {
        if (isset($_POST['operation'])) {
            $num1 = floatval($_POST['num1']);
            $num2 = floatval($_POST['num2']);
            
            switch ($_POST['operation']) {
                case 'add':
                    $result = $calculator->add($num1, $num2);
                    $expression = "$num1 + $num2";
                    break;
                case 'subtract':
                    $result = $calculator->subtract($num1, $num2);
                    $expression = "$num1 - $num2";
                    break;
                case 'multiply':
                    $result = $calculator->multiply($num1, $num2);
                    $expression = "$num1 * $num2";
                    break;
                case 'divide':
                    $result = $calculator->divide($num1, $num2);
                    $expression = "$num1 / $num2";
                    break;
                case 'power':
                    $result = $calculator->power($num1, $num2);
                    $expression = "$num1 ^ $num2";
                    break;
                case 'modulo':
                    $result = $calculator->modulo($num1, $num2);
                    $expression = "$num1 % $num2";
                    break;
            }
        } elseif (isset($_POST['single_operation'])) {
            $num = floatval($_POST['single_num']);
            
            switch ($_POST['single_operation']) {
                case 'sqrt':
                    $result = $calculator->sqrt($num);
                    $expression = "sqrt($num)";
                    break;
                case 'square':
                    $result = $calculator->square($num);
                    $expression = "$num^2";
                    break;
            }
        } elseif (isset($_POST['expression'])) {
            $expr = $_POST['expression'];
            $result = $calculator->evaluate($expr);
            $expression = $expr;
        }
        
        // Opslaan in database
        if ($result !== '' && isset($expression)) {
            saveCalculation($expression, $result);
        }
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// Geschiedenis ophalen
$history = getHistory();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Uitgebreide Rekenmachine</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 20px; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h1 { 
            text-align: center; 
            color: #333; 
            margin-bottom: 30px;
        }
        .section { 
            margin: 20px 0; 
            padding: 20px; 
            border: 1px solid #ddd; 
            border-radius: 8px;
            background: #f9f9f9;
        }
        .section h3 {
            margin-top: 0;
            color: #555;
        }
        input, select, button { 
            margin: 5px; 
            padding: 10px; 
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        button { 
            background: #667eea; 
            color: white; 
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover { 
            background: #5a6fd8; 
        }
        .result { 
            background: #d4edda; 
            color: #155724;
            padding: 15px; 
            margin: 15px 0; 
            border-radius: 5px;
            border: 1px solid #c3e6cb;
            font-size: 18px;
            font-weight: bold;
        }
        .error { 
            background: #f8d7da; 
            color: #721c24; 
            padding: 15px; 
            margin: 15px 0; 
            border-radius: 5px;
            border: 1px solid #f5c6cb;
        }
        table { 
            border-collapse: collapse; 
            width: 100%; 
            background: white;
            border-radius: 5px;
            overflow: hidden;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: left; 
        }
        th { 
            background: #667eea; 
            color: white; 
        }
        tr:nth-child(even) { 
            background: #f2f2f2; 
        }
    </style>
</head>
<body>
    <div class="container">
    <h1>🧮 Uitgebreide Rekenmachine</h1>
    
    <!-- Afrondingsinstellingen -->
    <div class="section">
        <h3>Instellingen</h3>
        <form method="post">
            <label>Afrondingsprecisie:</label>
            <select name="precision" onchange="this.form.submit()">
                <?php for($i = 0; $i <= 10; $i++): ?>
                    <option value="<?= $i ?>" <?= $precision == $i ? 'selected' : '' ?>><?= $i ?> decimalen</option>
                <?php endfor; ?>
            </select>
        </form>
    </div>
    
    <!-- Basisfuncties -->
    <div class="section">
        <h3>Basisfuncties</h3>
        <form method="post">
            <input type="number" step="any" name="num1" placeholder="Eerste getal" required>
            <select name="operation">
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">*</option>
                <option value="divide">/</option>
                <option value="power">^</option>
                <option value="modulo">%</option>
            </select>
            <input type="number" step="any" name="num2" placeholder="Tweede getal" required>
            <button type="submit">Bereken</button>
        </form>
    </div>
    
    <!-- Geavanceerde functies -->
    <div class="section">
        <h3>Geavanceerde Functies</h3>
        <form method="post">
            <input type="number" step="any" name="single_num" placeholder="Getal" required>
            <select name="single_operation">
                <option value="sqrt">Wortel</option>
                <option value="square">Kwadraat</option>
            </select>
            <button type="submit">Bereken</button>
        </form>
    </div>
    
    <!-- Vrije expressie -->
    <div class="section">
        <h3>Vrije Berekening</h3>
        <form method="post">
            <input type="text" name="expression" placeholder="Bijv: 3 + 4 * 2 - 1" style="width: 300px;">
            <button type="submit">Bereken</button>
        </form>
        <p><small>Gebruik: +, -, *, /, ** (macht), sqrt(), etc.</small></p>
    </div>
    
    <!-- Resultaat -->
    <?php if ($result !== ''): ?>
        <div class="result">
            <strong>Resultaat: <?= $result ?></strong>
        </div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div class="error">
            <strong>Fout: <?= $error ?></strong>
        </div>
    <?php endif; ?>
    
    <!-- Geschiedenis -->
    <div class="section">
        <h3>Geschiedenis</h3>
        <form method="get">
            <input type="text" name="search" placeholder="Zoek in geschiedenis" value="<?= $_GET['search'] ?? '' ?>">
            <button type="submit">Zoek</button>
            <a href="clear_history.php"><button type="button">Wis Geschiedenis</button></a>
        </form>
        
        <?php 
        $searchHistory = isset($_GET['search']) ? searchHistory($_GET['search']) : $history;
        if ($searchHistory): ?>
            <table>
                <tr>
                    <th>Expressie</th>
                    <th>Resultaat</th>
                    <th>Datum</th>
                </tr>
                <?php foreach ($searchHistory as $calc): ?>
                <tr>
                    <td><?= htmlspecialchars($calc['expression']) ?></td>
                    <td><?= htmlspecialchars($calc['result']) ?></td>
                    <td><?= $calc['created_at'] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Geen geschiedenis gevonden.</p>
        <?php endif; ?>
    </div>
    </div>
</body>
</html>