<?php
define('FPDF_FONTPATH',"fpdf/font/");
require('fpdf/fpdf.php');

//create a FPDF object
$pdf=new FPDF();


$link = mysqli_connect('localhost', 'root', '', 'cgk')
or die('Не удалось соединиться: ' . mysql_error());
//echo 'Соединение успешно установлено';

// Выполняем SQL-запрос
$query = 'SELECT questionid FROM whower WHERE teamid = 0 ORDER BY id DESC LIMIT 1';
$result = mysqli_query($link,$query) or die('Запрос не удался: ' . mysqli_error($link));


$query = mysqli_query($link,"SELECT * FROM whower WHERE teamid = 0 ORDER BY id DESC LIMIT 1");
$result = mysqli_fetch_assoc($query);

$gameid = $result['gameid'];
$questionid = $result['questionid'];

$query = mysqli_query($link,"SELECT * FROM whower WHERE  gameid = '$gameid' ORDER BY id");

//set document properties
$pdf->SetAuthor('ddma');
$pdf->SetTitle('gameid:');
//set font for the entire document
$pdf->AddFont('Arial','','arial.php'); 
$pdf->SetFont('Arial','',20);
$pdf->SetTextColor(50,60,100);
//set up a page
$pdf->AddPage('P');
$pdf->SetDisplayMode(real,'default');
//insert an image and make it a link
//display the title with a border around it
$pdf->SetXY(50,20);
$pdf->SetDrawColor(50,60,100);
$y = 30;
$gameiddisplay = false;
if ($result = $query) {
 
    while ($row = mysqli_fetch_assoc($result)) {
        if (!$gameiddisplay) {
                $pdf->Cell(100,10,iconv('utf-8', 'windows-1251', 'Номер игры: '.$row["gameid"]),1,0,'C',0); 
                
                $pdf->SetFontSize(10);
                $gameiddisplay = true;
        }

        if ($row["teamid"] == '0') {
            $y = $y + 5;
            $pdf->SetXY(10,$y);
            $pdf->Cell(50,10,iconv('utf-8', 'windows-1251','Вопрос №'.$row["questionid"]),1,0,'C',0);
            $pdf->Cell(100,10,iconv('utf-8', 'windows-1251',$row["question"]),1,0,'C',0);

            $pdf->SetXY (10,$y);

            $y = $y + 10;
            
        }else{
            $pdf->SetXY(10,$y);
            $pdf->Cell(50,5,iconv('utf-8', 'windows-1251',$row["team"]),1,0,'C',0); 
            $pdf->Cell(100,5,iconv('utf-8', 'windows-1251',$row["answer"]),1,0,'C',0); 
            if ($row["correct"] == '2') {
                $pdf->Cell(10,5,iconv('utf-8', 'windows-1251','~'),1,0,'C',0);

            }elseif ($row["correct"] == '1') {
                $pdf->Cell(10,5,iconv('utf-8', 'windows-1251','+'),1,0,'C',0);

            }elseif ($row["correct"] == '0') {
                $pdf->Cell(10,5,iconv('utf-8', 'windows-1251','-'),1,0,'C',0);


            }else{
                $pdf->Cell(10,5,iconv('utf-8', 'windows-1251','Ошибка!!'),1,0,'C',0);

            }
            $y = $y + 5;

        }

        
    }
   
     
    mysqli_free_result($result);
}

mysqli_close($link);
//Output the document
$pdf->Output('example1.pdf','I');
?>