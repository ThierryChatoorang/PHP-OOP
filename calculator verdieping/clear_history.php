<?php
require_once 'functions.php';

if (clearHistory()) {
    $message = "Geschiedenis succesvol gewist!";
} else {
    $message = "Fout bij wissen van geschiedenis.";
}

header("Location: index.php?message=" . urlencode($message));
exit;
?>