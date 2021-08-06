<html>
<head>
    <title>ThaiCreate.Com PHP PDF</title>
</head>
<body>

<?php
define('FPDF_FONTPATH','font/');
require('../jquery/fpdf/fpdf.php');
require('thaiBaht.php');


class PDF extends FPDF
{
    protected $_title = NULL;
    protected $_footer = NULL;
    //Override คำสั่ง (เมธอด) Header
    public  function Header(){
        for($i=0;$i<count($this->_getTitle());$i++)
        {
            $this->Cell( 0  , 5 , iconv( 'UTF-8','cp874' , $this->_getTitle()[$i] ) , 0 , 1 , 'C' );
        }
    }
    public function setTitle($title) {
        $this->_title = $title;
    }

    protected function _getTitle() {
        return $this->_title;
    }
    function  genApprove($approve,$dirctor){
        $this->Ln();
        $this->SetY(-65);


        for($i=0;$i<count($approve);$i++)
        {
            $this->Cell( 100  , 5 , iconv( 'UTF-8','cp874' , $approve[$i] ) , 0 , 0 , 'C' );
            $this->Cell( 200  , 5 , iconv( 'UTF-8','cp874' , $dirctor[$i] ) , 0 , 1 , 'C' );
           // $this->Ln();
        }

    }
    // Page footer
   /* function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        for($i=0;$i<count($this->_getFooter());$i++)
        {
            $this->Cell( 0  , 1 , iconv( 'UTF-8','cp874' , $this->_getFooter()[$i] ) , 0 , 1 , 'C' );
            $this->Ln();
        }
        // Page number

        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }*/
    public function setFooter($footer) {
        $this->_title = $footer;
    }
    protected function _getFooter() {
        return $this->_footer;
    }

//Load data
    function LoadData($file)
    {
        //Read file lines
        $lines=file($file);
        $data=array();
        foreach($lines as $line)
            $data[]=explode(';',chop($line));
        return $data;
    }

//Colored table
    function FancyTable($header,$data,$width,$align)
    {
        //Colors, line width and bold font
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        //Header

        for($i=0;$i<count($header);$i++)
           // $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
            $this->Cell($width[$i],7,iconv( 'UTF-8','cp874' ,$header[$i]),1,0,'C',true);
            $this->Ln();
            //Color and font restoration
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            //$this->SetFont('');
        //Data
            $fill=false;
        $sum = 0;
        $j=0;
        foreach($data as $row)
        {
            for($i=0;$i<count($header);$i++){
                $this->Cell($width[$i],6, iconv( 'UTF-8','cp874' ,$row[$i]),'LR',0,$align[$i],$fill);
            }
                $this->Ln();
                $fill=!$fill;
                $sum += $data[$j][count($header)-1];
        }
        $this->Cell((array_sum($width) / 100)*20,6,iconv( 'UTF-8','cp874','จำนวน '.count($data).' คน'),'LTB',0,'L',$fill);
        $this->Cell((array_sum($width) / 100)*20,6,iconv( 'UTF-8','cp874','รวมเป็นเงินทั้งสิ้น'),'TB',0,'R',$fill);
        $this->Cell((array_sum($width) / 100)*50,6,iconv( 'UTF-8','cp874',' '.convert($sum).' '),'TB',0,'C',$fill);
        $this->Cell((array_sum($width) / 100)*10,6,iconv( 'UTF-8','cp874',' '.$sum.' '),'TBR',0,'R',$fill);
       // $this->Cell(0,6,count($data),'T');

    }
}

$pdf=new PDF( 'L' , 'mm' , 'A4' );

//$pdf=new PDF();
$reportId = $_GET['reportId'];
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

include "../connect_pdo.php";

$report_query = "SELECT * FROM tsureport WHERE id=$reportId";
$sql = $db->prepare($report_query);
$sql->execute();
$sql = $sql->fetch();
$reportName = $sql['namereport'];
$sql_text = $sql['r_query'];


$ps = $db->prepare($sql_text);
$start_date = $startDate;
$end_date = $endDate;
$ps->bindParam(1, $start_date, PDO::PARAM_STR);
$ps->bindParam(2, $end_date, PDO::PARAM_STR);
$ps->execute();
$total_column = $ps->columnCount();

/*
$ps = $db->prepare($sql);
$ps->execute();
$total_column = $ps->columnCount();*/
//Column titles
//$header=array('CustomerID','Name','Email','Country Code','Budget','Used');
for ($counter = 0; $counter < $total_column; $counter++) {
    $meta = $ps->getColumnMeta($counter);
    $header[] = $meta['name'];
}
//*** Load MySQL Data ***//
$resultData = array();
while ($row = $ps->fetch()) {
    array_push($resultData,$row);
}
//************************//
$pdf->AddFont('angsana','','angsa.php');
$pdf->AddFont('angsana','B','angsab.php');
$pdf->AddFont('angsana','I','angsai.php');
$pdf->AddFont('angsana','BI','angsaz.php');
$pdf->SetFont('angsana','',12);

$pdf->AddPage();
//$pdf->Image('logo.png',80,8,33);
$pdf->Ln(5);
$title = array(
    'แบบรายงานค่ารักษาพยาบาลผู้ป่วยนอก',
    'ชื่อหน่วยบริการ   โรงพยาบาลทุ่งศรีอุดม',
    'อำเภอทุ่งศรีอุดม  จังหวัดอุบลราชธานี  เลขที่บัญชี  ธกส. 017778549602  สาขาทุ่งศรีอุดม',
    '-----------------------');
$approve = array(
    'ขอรับรองว่าค่าบริการทางการแพทย์ดังกล่าวถูกต้องตามที่เรียกเก็บ',
    'ลงชื่อ.............................',
    '(นายวิสันต์  จรลี',
    'เจ้าพนักงานเวชสถิติ ปฏิบัติงาน',
    'ผู้ตรวจสอบการให้การรักษา');
$dirctor = array(
    'อนุมัติ',
    'ลงชื่อ.............................',
    '(นายคงทัช  สงขรานันต์)',
    'นายแพทย์ ชำนาญการ รักษาการในตำแหน่ง',
    'ผู้อำนวยการโรงพยาบาลทุ่งศรีอุดม');
$width=array(15,15,15,30,10,10,20,20,11,11,11,11,11,11,11,11,11,11,11,15);
$align = array('C','C','R','L','C','C','L','C','R','R','R','R','R','R','R','R','R','R','R','R');

$pdf->setTitle($title);
$pdf->Header();
$pdf->FancyTable($header,$resultData,$width,$align);
$pdf->genApprove($approve,$dirctor);
//$pdf->setFooter($footer);
//$pdf->Footer();
//$pdf->Output("I","MyPDF/MyPDF.pdf");
//header( "location: MyPDF/MyPDF.pdf" );
exit(0);
?>
PDF Created Click <a href="MyPDF/MyPDF.pdf">here</a> to Download
</body>
</html>