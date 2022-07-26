<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>

<?php
function GC_content($seq)
{
  $seq=strtoupper($seq);
  $countg=substr_count($seq,"G");
  $countc=substr_count($seq,"C");
  $length=strlen($seq);
  $count=(($countg+ $countc)/$length)*100;
  return $count."%";
}

function N_content($seq)
{
$seq=strtoupper($seq);
  $countN=substr_count($seq,"N");
  return $countN;
}

function base_content($seq)
{
$seq=strtoupper($seq);
  $countG=substr_count($seq,"G");
  $countC=substr_count($seq,"C");
  $countA=substr_count($seq,"A");
  $countT=substr_count($seq,"T");
  $length=strlen($seq);
 $countG=(($countG)/$length)*100;
 $countC=(($countC)/$length)*100;
 $countA=(($countA)/$length)*100;
 $countT=(($countT)/$length)*100;
 return array($countG, $countC,$countA,$countT);
 
}

function transcribe($seq)
{
$seq=strtoupper($seq);
  $newseq=str_replace("T","U",$seq); 
  return $newseq;
}

function Filter($seq)
{
$seq=strtoupper($seq);
  $filterseq=str_replace("N","",$seq); 
  return $filterseq;
  
}

function complement($seq)
{
$seq=strtoupper($seq);
 $newseq='';
 $complement_dict = array(
    "A" => "T",
    "T" => "A",
    "G" => "C",
    "C" => "G",
    "N" => "N",
);
$space='';
$nucleotides =str_split($seq,1);
 foreach($nucleotides as $i)
 {
    $newseq=$newseq.$complement_dict[$i];
    
 }
 return $newseq;
}

function translate($seq)
{
$seq=strtoupper($seq);
$protein='';
$seq=str_replace("N","",$seq);
$length=strlen($seq);
if ($length%3==0){$seq=$seq;}
else 
{
	$modes=$length%3;
    $s=$length-$modes;
    $seq =substr ($seq, 0 , $s);

}

$genetic_code = array(
   'ATA'=>'I', 'ATC'=>'I', 'ATT'=>'I', 'ATG'=>'M',
        'ACA'=>'T', 'ACC'=>'T', 'ACG'=>'T', 'ACT'=>'T',
        'AAC'=>'N', 'AAT'=>'N', 'AAA'=>'K', 'AAG'=>'K',
        'AGC'=>'S', 'AGT'=>'S', 'AGA'=>'R', 'AGG'=>'R',                
        'CTA'=>'L', 'CTC'=>'L', 'CTG'=>'L', 'CTT'=>'L',
        'CCA'=>'P', 'CCC'=>'P', 'CCG'=>'P', 'CCT'=>'P',
        'CAC'=>'H', 'CAT'=>'H', 'CAA'=>'Q', 'CAG'=>'Q',
        'CGA'=>'R', 'CGC'=>'R', 'CGG'=>'R', 'CGT'=>'R',
        'GTA'=>'V', 'GTC'=>'V', 'GTG'=>'V', 'GTT'=>'V',
        'GCA'=>'A', 'GCC'=>'A', 'GCG'=>'A', 'GCT'=>'A',
        'GAC'=>'D', 'GAT'=>'D', 'GAA'=>'E', 'GAG'=>'E',
        'GGA'=>'G', 'GGC'=>'G', 'GGG'=>'G', 'GGT'=>'G',
        'TCA'=>'S', 'TCC'=>'S', 'TCG'=>'S', 'TCT'=>'S',
        'TTC'=>'F', 'TTT'=>'F', 'TTA'=>'L', 'TTG'=>'L',
        'TAC'=>'Y', 'TAT'=>'Y', 'TAA'=>'stop', 'TAG'=>'stop',
        'TGC'=>'C', 'TGT'=>'C', 'TGA'=>'stop', 'TGG'=>'W',
);
$codons = str_split($seq,3);
foreach($codons as $i)
 {
   if($genetic_code[$i] == "Stop")
    {break;}
    else {
	$protein=$protein.$genetic_code[$i];}
 }
 return  $protein;
}

function reverse_complement($seq)
{
$seq=strtoupper($seq);
 $reverse_seq='';
 $reverse_complement="";
 $length=strlen($seq)-1;

 for($i=$length;$i>=0;$i--)
 {
 $reverse_seq=$reverse_seq.$seq[$i];

 }
 $reverse_complement=complement($reverse_seq);
 return $reverse_complement;
  
}
?>
</body>
</html>