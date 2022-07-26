<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css" type="text/css">
    <title>Database Insert</title>
</head>

<body>
    <?php
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "usbw");
    define("DB_DATABASE", "Gene_DB");
    $connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    if (isset($_POST['Insert']))
    {
    if (isset($_POST['mainT']) && isset($_POST['namee']) && isset($_POST['ncbi']) && isset($_POST['org']) && isset($_POST['gsym']) && isset($_POST['refseq'])) {
        $seq = $_POST['mainT'];
        $name = $_POST['namee'];
        $ncbi = $_POST['ncbi'];
        $org = $_POST['org'];
        $gsym = $_POST['gsym'];
        $refseq = $_POST['refseq'];
        $len = strlen($seq);
        $sql1 = "INSERT INTO `Sequence_Data`(`ID`, `Organism`, `Gene Symbol`, `RefSeq status`, `Length`) VALUES ('$ncbi','$org','$gsym','$refseq','$len')";
        $out1 = mysqli_query($connect, $sql1);
        $sql2 = "INSERT INTO `Sequence` (`Name`, `Sequence`, `NCBI_ID`) VALUES ('$name','$seq','$ncbi')";
        $out2 = mysqli_query($connect, $sql2);
       
    }
    }
    if (isset($_POST['Delete']))
    {
    if ( isset($_POST['ncbi'])) {
        $ncbi = $_POST['ncbi'];
        $sql2 = "DELETE FROM `gene_db`.`sequence_data` WHERE `sequence_data`.`ID` = $ncbi";
        $out2 = mysqli_query($connect, $sql2);
       
    }
    }
    if (isset($_POST['UPdate'])&&isset($_POST['ncbi']))
    {
       if (isset($_POST['mainT'])) 
    {
        $seq = $_POST['mainT'];
        $ncbi = $_POST['ncbi'];
       mysqli_query($connect, "UPDATE `sequence` SET `Sequence`='$seq' WHERE `NCBI_ID`=$ncbi") or die('query failed');
    }

    }
     mysqli_close($connect);
    ?>
    <br>
    <center>
        <div id="inputForm">
            <form method="post">
                <fieldset>
                    <legend>Insert into DataBase</legend>

                    <label for="mainT"> Enter the desired Sequance </label>
                    <br />
                    <textarea type="text" id="mainT" name="mainT" placeholder="Ex: ACGT" required maxlength="5000"></textarea>
                    <br />
                    <label for="namee"> Enter the Sequance Name </label>
                    <br />
                    <input type="text" id="namee" name="namee"><br>
                    <br />
                    <label for="ncbi"> Enter NCBI ID </label>
                    <br />
                    <input type="text" id="ncbi" name="ncbi"><br>
                    <br />
                    <label for="org"> Enter the Organism </label>
                    <br />
                    <input type="text" id="org" name="org"><br>
                    <br />
                    <label for="gsym"> Enter the Gene Symbol </label>
                    <br />
                    <input type="text" id="gsym" name="gsym"><br>
                    <br />
                    <label for="refseq"> Enter the RefSeq </label>
                    <br />
                    <input type="text" id="refseq" name="refseq"><br>
                    <br />
                    <input type="reset" value="reset" />
                    <input type="submit" value="Insert" name="Insert" />

            </form>
        </div>
    </center>
    <br><br><br>
    <center>
        <div id="inputForm">
            <form method="post">
                <fieldset>
                    <legend>Delete from DataBase</legend>
                    <label for="ncbi"> Enter NCBI ID </label>
                    <br />
                    <input type="text" id="ncbi" name="ncbi"><br>
                    <br />
                    <input type="reset" value="reset" />
                    <input type="submit" value="Delete" name="Delete" />
            </form>
        </div>
    </center>
    <br><br><br>
    <center>
        <div id="inputForm">
            <form method="post">
                <fieldset>
                    <legend>Update into DataBase</legend>
                    <label for="ncbi"> Enter NCBI ID </label>
                    <br />
                    <input type="text" id="ncbi" name="ncbi"><br>
                    <br />
                    <label for="mainT"> Enter the Updated Sequance </label>
                    <br />
                    <textarea type="text" id="mainT" name="mainT" placeholder="Ex: ACGT"  maxlength="5000"></textarea>
                    <br>
                    <input type="reset" value="reset" />
                    <input type="submit" value="UPdate" name="UPdate" />

            </form>
        </div>
    </center>
    <br><br>
</body>

</html>