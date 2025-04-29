<!DOCTYPE html>
<?php


$user="root";
$pass="";
$host="localhost";
$db="go_adm";
$conn = mysqli_connect($host, $user, $pass, $db);


if(isset($_POST['btnNew'])){
    $realname = $_POST['realname'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $userlevel = intval($_POST['userlevel']);

    $sql = "INSERT INTO users (realname, username, password, userlevel) VALUES ('$realname', '$username', '$password', $userlevel)";
    $result = mysqli_query($conn, $sql);
}

if(isset($_GET['del'])){
    $id = intval($_GET['del']);
    $sql = "DELETE FROM users WHERE id=$id";
    $result = mysqli_query($conn, $sql);
}
if(isset($_POST['btnEdit'])){
    $id = intval($_POST['id']);
    $realname = $_POST['realname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userlevel = intval($_POST['userlevel']);

    $sql = "UPDATE users SET realname='$realname', username='$username', password='$password', userlevel=$userlevel WHERE id=$id";
    $result = mysqli_query($conn, $sql);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1>Welcome to the User Management System</h1>
<?php
if(isset($_GET['edit'])){
    $id = intval($_GET['edit']);
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result); ?>
    <h2>Edit User</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="text" name="realname" value="<?php echo $row['realname']; ?>" required>
        <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
        <input type="password" name="password" value="<?php echo $row['password']; ?>" required>
        <input type="number" name="userlevel" value="<?php echo $row['userlevel']; ?>" required>
        <input type="submit" name="btnEdit" value="Update User">
    </form>
<?php
}else{
?>
    <h2>Add New User</h2>
    <form action="index.php" method="post">
        <input type="text" name="realname" placeholder="Enter your name" required>
        <input type="text" name="username" placeholder="Enter your username" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <input type="number" name="userlevel" placeholder="Enter your user level" required>
        <input type="submit" name="btnNew" value="Add User">
    </form>
<?php
}
$sql= "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) { ?>
    <div style="border: 1px solid black; margin: 10px; padding: 10px;">
        <p>Real Name: <?php echo $row['realname']; ?></p>
        <p>Username: <?php echo $row['username']; ?></p>
        <p>Password: <?php echo $row['password']; ?></p>
        <p>User Level: <?php echo $row['userlevel']; ?></p>
        <a href="index.php?del=<?=$row['id']?>">Delete</a>&nbsp;&nbsp;
        <a href="index.php?edit=<?=$row['id']?>">Edit</a>
    </div>

<?php
}

?>
</body>
</html>