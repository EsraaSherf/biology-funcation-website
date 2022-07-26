<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="Style.css" type="text/css">
    <title>login</title>
</head>
<body>
 <?php
  if (isset($_POST['pass']))
  {
     $name=$_POST['pass'];
     if ($name=='admin')
     {
          
           header("Location:Form4.php");
           exit();
     }
     else{
           echo "<script>alert('please Enter Valid Paaword');</script>";
     }
     }
    ?>
    <br><br><br><br>
    <center>
        <div id="out3"  style=" width:30%;">
            <form action="Form1.php" target="_self" method="post">
                <fieldset>
                    <legend> <b>USer</b></legend>
                    <label for="mainT"> LOgIN </label>
                    <br />
                    <button type="submit" style="color:white; width: 20%;height: 50px; float: right; font-size:large;background-color:darkblue;">Confirm</button>
                </fieldset>
            </form>
        </div>
    </center>
     <br><br><br>
    <hr>
    <br><br><br>
    <center>
        <div id="out3">
            <form action="login.php" target="_self" method="post"  name="form">
                <fieldset>
                    <legend> <b>Admin</b></legend>
                    <br />
                    <label for="mainT"> LOgIN </label>
                    <input type="password" name="pass" id="pass"/>
                  <button type="submit" style="color:white; width: 20%;height: 50px; float: right; font-size:large;background-color:darkblue;">Confirm</button>
                </fieldset>
            </form>
        </div>
    </center>
   
</body>
</html>