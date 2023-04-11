<?php
require_once 'dbconnect.php';

$query = "SELECT * FROM films";
$res = mysqli_query($mysqli, $query);
if (!$res) die (mysqli_error($mysqli));

while ($row = mysqli_fetch_assoc($res)) {
    ?>
    <p>
    <h2><?= $row['name']; ?></h2>
    <?= $row['id']; ?><br>
    Date: <?= $row['release_date']; ?><br>
    Price: <?= $row['price']; ?><br>
    </p>
    <?php
}