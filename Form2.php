<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Style.css" type="text/css">
    <title>Biological Functions</title>
    <?php include 'bio.php' ?>
</head>

<body>
    <?php
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "usbw");
    define("DB_DATABASE", "Gene_DB");
    $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    $GC = 0;
    $N = 0;
    $B = [0, 0, 0, 0];
    $C = '';
    $R = '';
    $TR = '';
    $TE = '';
    $F = '';
    if(!empty($_POST['mainT'])&&!empty($_POST['namee']))
 {
        $seq=$_POST['mainT'];
        $name=$_POST['namee'];
     if(isset($_POST['BC']))
    {
         
         $B = base_content($seq);
    }
   if (isset($_POST['GC'])) 

    {
      
	   $GC = GC_content($seq);
     }
     if(isset($_POST['NC']))
    {
         
         $N = N_content($seq);
    }
    if(isset($_POST['RComp']))
    {
         
         $R =reverse_complement($seq);
    }
    if(isset($_POST['Comp']))
    {
         
         $C =Complement($seq);
    }
    if(isset($_POST['TR']))
    {
         
         $TE = translate($seq);
    }
    if(isset($_POST['TS']))
    {
         
         $TR = transcribe($seq);
    }
     if(isset($_POST['NF']))
    {
         
         $F =Filter($seq);
    }
     $Bc= base_content($seq);
      $Nc = N_content($seq);
      $Gc = GC_content($seq);
     $Filter =Filter($seq);
      $TRanscribtion= transcribe($seq);
      $Translate = translate($seq);
      $Complement =Complement($seq);
     $Reverse =reverse_complement($seq);
     $uname='';
     $check="SELECT  `Name`  FROM `user_sequance` WHERE `Name`='$name'";
     $out=mysqli_query($connect, $check);
        $mainArr = array();
       while ($row = mysqli_fetch_array($out)) {
        array_push($mainArr, $row['Name']);}
        if(empty($mainArr))
        {
        
         $sqlinsert="INSERT INTO `user_seq_data`( `Name`, `Transcribed Seq`, `Translated Seq`, `Complemented Seq`, `Reverse Complemented Seq`, `GC Content`, `A_content`, `C_content`, `G_content`, `T_content`, `N Bases`, `N Filtered Seq`) VALUES ('$name','$TRanscribtion','$Translate','$Complement','$Reverse','$Gc','$Bc[0]','$Bc[1]','$Bc[2]','$Bc[3]','$Nc','$Filter')";
         mysqli_query($connect, $sqlinsert);
        $sqlinsert2="INSERT INTO `user_sequance`( `Name`, `User Sequence`) VALUES ('$name','$seq')";
         mysqli_query($connect, $sqlinsert2);
        }
        else
        {
         echo "<script>alert('please Enter Valid the Sequence name');</script>";
        }
     mysqli_close($connect);
      
  }         

    ?>
    <div id="out1">
        <form action="Form2.php" target="_self" method="post" Name="form2">
         <fieldset>
         <legend> <b>GC content</b></legend>
        <label for="mainT"> Enter the desired Sequance </label>
         <br />
          <textarea id="mainT" type="text" id="mainT" name="mainT" placeholder="Ex: ACGT" required maxlength="1000"></textarea>
           <br />
           <label for="namee"> Enter the Sequance Name </label>
           <br />
           <input type="text" id="namee" name="namee" value="">
            <br>
            <label> GC_content:</label>
            <input type="text" value="<?php echo $GC ?>" ><br>

            <input type="submit" id="GC" name="GC" value="View Percentage" onclick="JSvalidate()" />
            </fieldset>
            </legend>
        </form>
        <hr>
        <form action="Form2.php" target="_self" method="post">
            <fieldset>
         <legend> <b>Base content</b></legend>
        <label for="mainT"> Enter the desired Sequance </label>
         <br />
          <textarea id="mainT" type="text" id="mainT" name="mainT" placeholder="Ex: ACGT" required maxlength="1000"></textarea>
           <br />
           <label for="namee"> Enter the Sequance Name </label>
           <br />
           <input type="text" id="namee" name="namee" value="">
            <br>      
             <label> A_content:</label> <input type="text" value="<?php echo $B[0] ?>"><br>
            <label> G_content:</label> <input type="text" value="<?php echo $B[1] ?>"><br>
             <label> C_content:</label><input type="text" value="<?php echo $B[2] ?>"><br>
             <label> T_content:</label><input type="text" value="<?php echo $B[3] ?>">
            <br>
            <input type="submit" id="BC" name="BC" value="View Percentage"onclick="JSvalidate()"  />
            </fieldset>
        </form>
        <hr>
        <form action="Form2.php" target="_self" method="post">
         <fieldset>
         <legend> <b>N content</b></legend>
        <label for="mainT"> Enter the desired Sequance </label>
          <textarea id="mainT" type="text" id="mainT" name="mainT" placeholder="Ex: ACGT" required maxlength="1000"></textarea>
           <br />
           <label for="namee"> Enter the Sequance Name </label>
           <br />
           <input type="text" id="namee" name="namee" value="">
            <br>
            <label> N_content:</label>
            <input type="text" value="<?php echo $N ?>" /><br>
            <input type="submit" id="NC" name="NC" value="View Percentage" onclick="JSvalidate()"  />
            </fieldset>
        </form>
    </div>
    <div id="out2">
        <form action="Form2.php" target="_self" method="post">
         <fieldset>
         <legend> <b>Complement </b></legend>
        <label for="mainT"> Enter the desired Sequance </label>
         <br />
          <textarea id="mainT" type="text" id="mainT" name="mainT" placeholder="Ex: ACGT" required maxlength="1000"></textarea>
           <br />
           <label for="namee"> Enter the Sequance Name </label>
           <br />
           <input type="text" id="namee" name="namee" value="">
            <br>      
              <label> Complemented seq </label>
            <input type="text"  value="<?php echo $C ?>"  id="out"/>
            <input type="submit" id="Comp" name="Comp" value="View  Sequence" onclick="JSvalidate()" />
            <br /><br>
            </fieldset>
            </legend>
            </form>
            <hr>
           <form action="Form2.php" target="_self" method="post">
          <fieldset>
                <legend> <b>Reverse Complement </b></legend>
           <label for="mainT"> Enter the desired Sequance </label>
          <br />
          <textarea id="mainT" type="text" id="mainT" name="mainT" placeholder="Ex: ACGT" required maxlength="1000"></textarea>
           <br />
           <label for="namee"> Enter the Sequance Name </label>
           <br />
           <input type="text" id="namee" name="namee" value="">
           <br>
            <label>  Reverse_Complemented seq </label>
            <input type="text"  value="<?php echo $R ?>"  id="out"/>
            <input type="submit" id="RComp" name="RComp" value="View  Sequence" onclick="JSvalidate()" />
            </fieldset>
            </legend>
        </form>
    </div>
    <center>
        <div id="out3">
            <form action="Form2.php" target="_self" method="post">
          <fieldset>
                <legend> <b>N Filter</b></legend>
           <label for="mainT"> Enter the desired Sequance </label>
          <br />
          <textarea id="mainT" type="text" id="mainT" name="mainT" placeholder="Ex: ACGT" required maxlength="1000"></textarea>
           <br />
           <label for="namee"> Enter the Sequance Name </label>
           <br />
           <input type="text" id="namee" name="namee" value="">
                <br />
               <label> Fitered Seq:</label> <input type="text"  value="<?php echo $F ?>" id="out" /><br>
                <input type="submit"  id="NF" name="NF" value="View Sequence" onclick="JSvalidate()"  />
                 </fieldset>
           </form>
                <hr>
          <form action="Form2.php" target=" _self" method="post">
          <fieldset>
                <legend> <b>Transcribtion</b></legend>
           <label for="mainT"> Enter the desired Sequance </label>
          <br />
          <textarea id="mainT" type="text" id="mainT" name="mainT" placeholder="Ex: ACGT" required maxlength="1000"></textarea>
           <br />
           <label for="namee"> Enter the Sequance Name </label>
           <br />
           <input type="text" id="namee" name="namee" value="">
                <br />
              
               <label> Transcripted Seq::</label> <input type="text"  value="<?php echo $TR ?>"  id="out"/><br>
               <input type="submit" id="TS" name="TS" value="View  Sequence"  id="out" onclick="JSvalidate()" />
                <br /><br>
                 </fieldset>
           </form>
                <hr>
                    <form action="Form2.php" target=" _self" method="post">
          <fieldset>
                <legend> <b>Translation</b></legend>
           <label for="mainT"> Enter the desired Sequance </label>
          <br />
          <textarea id="mainT" type="text" id="mainT" name="mainT" placeholder="Ex: ACGT" required maxlength="1000"></textarea>
           <br />
           <label for="namee"> Enter the Sequance Name </label>
           <br />
           <input type="text" id="namee" name="namee" value="">
                <br />
               <label> Translated_Seq::</label> <input type="text"   value="<?php echo $TE ?>"  id="out"/><br>
               <input type="submit" id="TR" name="TR" value="View  Sequence" onclick="JSvalidate()"  />
                
                 </fieldset>  
            </form>
        </div>
    </center>
    <form action="Form1.php" target="_self" method="post">    
         <button type="submit" value="previous"style="color: darkblue; width: 20%;height: 50px; float: right; font-size:large">previous</button>
        </form>
     <form action="Form3.php" target="_self" method="post">    
         <button type="submit" style="color:white; width: 20%;height: 50px; float: right; font-size:large;background-color:darkblue;" >Next</button>
        </form>
    
    <script>
            function JSvalidate() 
            {
             
                var name = document.forms["form2"]["namee"].value;
               
                if (name==" ")
                {
                   alert("please Enter the Sequence name");
                    return false;
                }
                
                   
               
            }

    </script>
</body>

</html>