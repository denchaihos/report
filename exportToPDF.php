<?php
include ('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
    function Header()
    {
        //Title
        $this->SetFont('Arial','',18);
        $this->Cell(0,6,'World populations',0,1,'C');
        $this->Ln(10);
        //Ensure table header is output
        parent::Header();
    }
}

include "connect.php";
/*
$reportId = $_GET['reportId'];
$startDate = $_GET['startdate'];
$endDate = $_GET['enddate'];
*/
$reportId = 11;
$startDate = '2016-01-05';
$endDate = '2016-01-05';

$sql = "select * from tsureport where id=$reportId";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$sql_text = $row['r_query'];



$pdf=new PDF();
//$pdf=new FPDF( 'P' , 'mm' , 'A4' );
$pdf->AddFont('angsana','','angsa.php');
$pdf->SetFont('angsana','',10);
//$pdf->AddFont('tahoma','','tahoma.php');
//$pdf->SetFont('tahoma','',20);
$pdf->AddPage();


//First table: put all columns automatically
$pdf->Table('select hn,fname,lname from pt  limit 10');
$pdf->AddPage();


//Second table: specify 3 columns
/*$pdf->AddCol('hn',20,'','C');
$pdf->AddCol('fname',40,'Country');
$pdf->AddCol('lname',40,'Pop (2001)','R');
$prop=array('HeaderColor'=>array(255,150,100),
    'color1'=>array(210,245,255),
    'color2'=>array(255,255,210),
    'padding'=>2);
$pdf->Table('select hn,fname,lname from pt  limit 10',$prop);*/
$pdf->Output();
?>