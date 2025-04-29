<!DOCTYPE html>
<?php
$host="localhost";
$user="root";
$pass="";
$db="bengt";

$conn= mysqli_connect($host, $user, $pass, $db) or die("Mordin!");

if(isset($_POST['btnSubmit'])){
    $name = $_POST['name'];
    $haircolor = $_POST['haircolor'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $asikt = $_POST['asikt'];
    $sql="INSERT INTO `personer`(`realname`, `haircolor`, `weight`, `length`, `specific_asikt`) VALUES ('$name', '$haircolor', '$weight', '$height', '$asikt')";
    $result=mysqli_query($conn, $sql);
}

$sql="SELECT * FROM personer";
$result=mysqli_query($conn, $sql);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Åsiktsregistrering</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Åsiktsregistrerade</h1>
    <form action="asiktsregistrering.php" method="post">
        <input type="text" name="name" id="name" placeholder="Ditt namn" required>
        <input type="text" name="haircolor" id="haircolor" placeholder="Ange hårfärg" required>
        <input type="text" name="weight" id="weight" placeholder="Ange vikt" required>
        <input type="text" name="height" id="height" placeholder="Ange längd" required>
        <input type="text" name="asikt" id="asikt" placeholder="Ange åsikt" required>
        <button type="submit" name="btnSubmit">Registrera person</button>
    </form>
    <?php
while($rad=mysqli_fetch_assoc($result)){ ?>
    <p><?=$rad['realname']?> (Vikt: <?=$rad['weight']?> Längd:<?=$rad['length']?>)<br>
Har åsikten:<?=$rad['specific_asikt']?>
</p>

<?php }

?>
</body>
</html>