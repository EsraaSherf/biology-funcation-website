<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css" type="text/css">
    <title>Document</title>
</head>

<body>
    <?php
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "usbw");
    define("DB_DATABASE", "Gene_DB");
    $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    $seq = '';
    $ncbi = 0;
    $org = '';
    $gsym = '';
    $refseq = '';
    $length = '';
    $uSeq = '';
    $translation = '';
    $transcribtion = '';
    $complement = '';
    $rComplement = '';
    $gcContent = '';
    $nContent = '';
    $AContent = 0;
    $GContent = 0;
    $CContent = 0;
    $TContent = 0;
    $nFilter = '';
    if (isset($_POST['sname'])) {
        $name = $_POST['sname'];
        $sqlSelect = "SELECT `Sequence`,`NCBI_ID` FROM `Sequence` WHERE `Name` = '$name' ";
        $outSelect = mysqli_query($connect, $sqlSelect);
        while ($row = mysqli_fetch_array($outSelect)) {
            $ncbi = $row['NCBI_ID'];
            $seq = $row['Sequence'];
        }
        $sqlSelect = "SELECT `Organism`, `Gene Symbol`, `RefSeq status`, `Length` FROM `Sequence_Data` WHERE `ID`= $ncbi ";
        $outSelect = mysqli_query($connect, $sqlSelect);
        while ($row = mysqli_fetch_array($outSelect)) {
            $org = $row['Organism'];
            $gsym = $row['Gene Symbol'];
            $refseq = $row['RefSeq status'];
            $length = $row['Length'];
        }
    }
    if (isset($_POST['usname'])) {
        $name = $_POST['usname'];
        $sqlSelect = "SELECT `User Sequence` FROM `User_Sequance` WHERE `Name` = '$name' ";
        $outSelect = mysqli_query($connect, $sqlSelect);
        while ($row = mysqli_fetch_array($outSelect)) {
            $uSeq = $row['User Sequence'];
        }
        $sqlSelect = "SELECT `Transcribed Seq`, `Translated Seq`, `Complemented Seq`, `Reverse Complemented Seq`, `GC Content`,`A_content`, `C_content`, `G_content`, `T_content`, `N Bases`, `N Filtered Seq` FROM `User_Seq_Data` WHERE `Name`=  '$name' ";
        $outSelect = mysqli_query($connect, $sqlSelect);
        while ($row = mysqli_fetch_array($outSelect)) {
            $transcribtion = $row['Transcribed Seq'];
            $translation = $row['Translated Seq'];
            $complement = $row['Complemented Seq'];
            $rComplement = $row['Reverse Complemented Seq'];
            $gcContent = $row['GC Content'];
            $nContent = $row['N Bases'];
            $AContent = $row['A_content'];
             $CContent = $row['C_content'];
              $GContent = $row['G_content'];
               $TContent = $row['T_content'];
            $nFilter = $row['N Filtered Seq'];
        }
    }

    $sql = "SELECT `Name` FROM `Sequence` WHERE 1";
    $out = mysqli_query($connect, $sql);
    $mainArr = array();
    while ($row = mysqli_fetch_array($out)) {
        array_push($mainArr, $row['Name']);
    }
    $sql = "SELECT `Name` FROM `User_Sequance` WHERE 1";
    $out = mysqli_query($connect, $sql);
    $userArr = array();
    while ($row = mysqli_fetch_array($out)) {
        array_push($userArr, $row['Name']);
    }
    ?>
    <br>
    <center>
        <div id="inputForm">
            <form method="post">
                <fieldset>
                    <legend>Main Sequances</legend>

                    <label for="sname"> Choose Sequance Name</label>
                    <br />
                    <select id="sname" name="sname">
                        <?php
                        foreach ($mainArr as $i) {
                            echo "<option>" . $i . "</option>";
                        }
                        ?>
                    </select>
                    <br />
                    
                    <input type="submit" value="Submit" />

            </form>
        </div>
    </center>
    <br><br><br>
    <center>
        <div id="inputForm">
            <form method="post">
                <fieldset>
                    <legend>Output</legend>

                    <label for="mainT"> Sequance </label>
                    <br />
                    <?php
                    echo "<textarea type='text' id='mainT' disable>" . $seq . "</textarea>"
                    ?>
                    <br />
                    <label> NCBI ID </label>
                    <br />
                    <?php
                    echo "<input type='text' value= ' " . $ncbi . "' disable >"
                    ?>
                    <br />
                    <label> Organism </label>
                    <br />
                    <?php
                    echo "<input type='text' value= ' " . $org . "' disable >"
                    ?>
                    <br />
                    <label> Gene Symbol </label>
                    <br />
                    <?php
                    echo "<input type='text' value= ' " . $gsym . "' disable >"
                    ?>
                    <br />
                    <label for="namee"> RefSeq </label>
                    <br />
                    <?php
                    echo "<input type='text' value= ' " . $refseq . "' disable >"
                    ?>
                    <br />
                    <label for="namee"> Gene Length </label>
                    <br />
                    <?php
                    echo "<input type='text' value= ' " . $length . "' disable >"
                    ?>
                    <br />

                   

            </form>
        </div>
    </center>
    <br><br><br>
    <center>
        <div id="inputForm">
            <form method="post">
                <fieldset>
                    <legend>Previous Users Input</legend>

                    <label for="usname"> Choose Sequance Name </label>
                    <br />
                    <select id="usname" name="usname">
                        <?php
                        foreach ($userArr as $i) {
                            echo "<option>" . $i . "</option>";
                        }
                        ?>
                    </select>
                    <br />
                    
                    <input type="submit" value="Submit" />

            </form>
        </div>
    </center>
    <br><br><br>
    <center>
        <div id="inputForm">
            <form method="post">
                <fieldset>
                    <legend>Output</legend>
                    <label for="mainT"> Sequance </label>
                    <br />
                    <?php
                    echo "<textarea type='text' id='mainT' disable>" . $uSeq . "</textarea>"
                    ?>
                    <br />
                    <label for="namee"> Base Content </label>
                    <br />
                    <label> A_content:</label>
                    <?php
                    echo "<input type='text' value= ' " . $AContent . "' disable >"
                    ?>
                     <br />
                     <label for="namee"> C_content:</label>
                     <?php
                    echo "<input type='text' value= ' " . $CContent . "' disable >"
                    ?>
                     <br />
                    <label for="namee"> G_content:</label>
                     <?php
                    echo "<input type='text' value= ' " . $GContent . "' disable >"
                    ?>
                     <br />
                     <label for="namee"> T_content:</label>
                     <?php
                    echo "<input type='text' value= ' " . $TContent . "' disable >"
                    ?>
                    <br />
                    <label for="namee"> GC Content </label>
                    <br />
                    <?php
                    echo "<input type='text' value= ' " . $gcContent . "' disable >"
                    ?>
                    <br />
                    <label for="namee"> N Content </label>
                    <br />
                    <?php
                    echo "<input type='text' value= ' " . $nContent . "' disable >"
                    ?>
                    <br />  
                    <label for="mainT"> Translation </label>
                    <br />
                    <?php
                    echo "<textarea type='text' id='mainT' disable>" . $translation . "</textarea>"
                    ?>
                    <br />
                    <label for="mainT"> Transcribtion </label>
                    <br />
                    <?php
                    echo "<textarea type='text' id='mainT' disable>" . $transcribtion . "</textarea>"
                    ?>
                    <br />
                    <label for="mainT"> Complement </label>
                    <br />
                    <?php
                    echo "<textarea type='text' id='mainT' disable>" . $complement . "</textarea>"
                    ?>
                    <br />
                    <label for="mainT"> Reverse Complement </label>
                    <br />
                    <?php
                    echo "<textarea type='text' id='mainT' disable>" . $rComplement . "</textarea>"
                    ?>
                    <br />
                    <label for="mainT"> N Filter </label>
                    <br />
                    <?php
                    echo "<textarea type='text' id='mainT' disable>" . $nFilter . "</textarea>"
                    ?>
                    <br />

            </form>
        </div>
    </center>
    <form action="Form2.php" target="_self" method="post">    
         <button type="submit" value="previous"style="color: darkblue; width: 20%;height: 50px; float: right; font-size:large">previous</button>
        </form>
    <form action="Form1.php" target="_self" method="post">    
         <button type="submit" value="Finish" style="color:white; width: 20%;height: 50px; float: right; font-size:large; background-color:darkblue;" >Finish</button>
        </form>
     
   
</body>

</html>