<?php 
  include_once("config.php");
?>
<?php
$db=dbConnect();
if($db->connect_errno==0){
  if(isset($_POST["TblLogin"])){
    $username=$db->escape_string($_POST["id_account"]);
    $username=$db->escape_string($_POST["username"]);
    $password=$db->escape_string($_POST["password"]);
    $nama=$db->escape_string($_POST["nama"]);
    $sql="SELECT username,password,type,nama,id_account FROM account WHERE username='$username' and password=md5('$password')";
    $res=$db->query($sql);
    if($res){
      if($res->num_rows==1){
        $data=$res->fetch_assoc();
        session_start();
        $_SESSION["status"]="login";
        $_SESSION["id_account"]=$data["id_account"];
        $_SESSION["username"]=$data["username"];
        $_SESSION["password"]=$data["password"];
        $_SESSION["nama"]=$data["nama"];
        $_SESSION["type"]=$data["type"];
        if (isset($_SESSION['status'])){
          if($_SESSION['status']=="login"){
            if ($_SESSION['type'] == 'admin') {
              header('location:admin/index.php?page=admin');
            }
            elseif ($_SESSION['type'] == 'user') {
              header('location:user/index.php?page=user');
            }
          }
        }
      }
      else
        header("Location: ../index.php?error=1");
    }
  }
  else
    header("Location: ../index.php?error=2");
}
else
  header("Location: ../index.php?error=3");
?>
