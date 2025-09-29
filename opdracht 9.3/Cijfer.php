<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=cijfer;charset=utf8mb4", "root", "");
    $query = $db->prepare("SELECT * FROM cijfers");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error!: " . $e->getMessage());
}
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Leerling</th>
        <th>Cijfer</th>
    </tr>
    <?php foreach($result as $data): ?>
    <tr>
        <td><?= $data['id'] ?></td>
        <td><?= $data['leerling'] ?></td>
        <td><?= $data['cijfer'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>
