<html>
<head>
    <title>PDF</title>
</head>
<body>

<?php
define('FPDF_FONTPATH', 'font/');
require('../jquery/fpdf/fpdf.php');
require('thaiBaht.php');


class PDF extends FPDF
{

    protected $_title = NULL;
    protected $_footer = NULL;

    //Override คำสั่ง (เมธอด) Header
    public function Header()
    {
        //title
       /* for ($i = 0; $i < count($this->_getTitle()); $i++) {
            $this->Cell(0, 5, iconv('UTF-8', 'cp874', $this->_getTitle()[$i]), 0, 1, 'C');
        }*/
    }

    public function setTitle($title)
    {
        $this->_title = $title;
    }
    protected function _getTitle()
    {
        return $this->_title;
    }
    function genHeader($title){
        for ($i = 0; $i < count($title); $i++) {
            $this->Cell(0, 5, iconv('UTF-8', 'cp874', $title[$i]), 0, 1, 'C');
        }
    }
    function  genApprove($approve, $director)
    {
        //$this->Ln();
        $this->SetY(160);
        for ($i = 0; $i < count($approve); $i++) {
            $this->Cell(100, 5, iconv('UTF-8', 'cp874', $approve[$i]), 0, 0, 'C');
            $this->Cell(200, 5, iconv('UTF-8', 'cp874', $director[$i]), 0, 1, 'C');
            // $this->Ln();
        }
    }
    public function setFooter($footer)
    {
        $this->_footer = $footer;
    }
    protected function _getFooter()
    {
        return $this->_footer;
    }
    function  genHeadTable($header,$width)
    {
        $countHeader = count($header);
        $columnHide = 2;
        $columnShow = $countHeader - $columnHide;
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        for ($k = 0; $k < count($header); $k++) {
            if ($k == 0) {
                // เพิ่มคอลัม ลำดับ
                $this->Cell(8, 6.5, iconv('UTF-8', 'cp874', 'ลำดับ'), 1, 0, 'C', true);
            }
            if($k >= ($columnShow) ){
                // ถ้าเพิ่มหัวคอลัมจนถึง ที่กำหนดแล้วให้  เพิ่ม คอลัมน์ กว้าง 0 เพื่อไม่แสดง ข้อมูล

                //$this->Cell(0, 6.5, '', 0, 0, 'C', false);
                //$this->Cell(0, 6.5, '', 0, 0, 'C', false);
                ;
            }else{
                // วนสร้างหัวตาราง
                $this->Cell($width[$k], 6.5, iconv('UTF-8', 'cp874', $header[$k]), 1, 0, 'C', true);
            }
        }
        $this->Cell(12, 6.5, iconv('UTF-8', 'cp874', 'เรียกเก็บ'), 1, 0, 'C', true);
        $this->Ln();
    }
    function genTotal($width,$count,$sum){
        $count = $count-1;
        $cost =number_format($count * 200, 2, '.', '');
        $sum=number_format($sum, 2, '.', '');
        $this->Cell(8, 10, iconv('UTF-8', 'cp874', ' '), 'LTB', 0, 'L', true);
        $this->Cell((array_sum($width) / 100) * 20, 10, iconv('UTF-8', 'cp874', 'จำนวน ' . $count . ' คน'), 'LTB', 0, 'L', true);
        $this->Cell((array_sum($width) / 100) * 20, 10, iconv('UTF-8', 'cp874', 'รวมเป็นเงินทั้งสิ้น'), 'TB', 0, 'R', true);
        $this->Cell((array_sum($width) / 100) * 50, 10, iconv('UTF-8', 'cp874', '( ' . convert($sum) . ' )'), 'TB', 0, 'C', true);
        $this->Cell((array_sum($width) / 100) * 10, 10,  $sum , 'TBR', 0, 'R', true);
        $this->Cell(12, 10,  $cost , 1, 0, 'R', true);

    }


//Colored table
    function FancyTable($header, $data, $width, $align, $approve, $director,$title)
    {
        $countHeader = count($header);
        $columnHide = 2;
        $columnShow = $countHeader - $columnHide;
        $hosmain = $data[0][$countHeader-$columnHide];
        $namehosp = $data[0][$countHeader-1];
        $this->genHeader($title);
        $this->Cell(30, 7, iconv('UTF-8', 'cp874', $hosmain.':'.$namehosp), 0, 1, 'L', false);

        $this->genHeadTable($header,$width);
        //Data
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        $fill = false;
        $sum = 0;
        $count = 1;
        $l = 0;
        $per_page = 1;
        foreach ($data as $row) {
            if($hosmain <> $row[$columnShow] ){
                $this->genTotal($width,$count,$sum);
                //$sum += $row[$countHeader - 2];
                $sum = 0;
                $this->genApprove($approve, $director);
                $this->AddPage();
                $per_page = 1;
                $count = 1;
                $hosmain = $row[$columnShow];
                $namehosp = $row[$columnShow +1];
                $this->genHeader($title);
                $this->Cell(30, 6, iconv('UTF-8', 'cp874',$hosmain.':'.$namehosp), 0, 1, 'L', false);
                $this->genHeadTable($header,$width);
                $this->SetFillColor(224, 235, 255);
                $this->SetTextColor(0);
                $this->SetFont('');
                $fill = false;
            }
                $this->Cell(8,  6.5,  $count, 'LR', 0, 'C', $fill);
            for ($i = 0; $i < $countHeader; $i++) {
                if($i >= ($columnShow) ){
                    //$this->Cell(12, 6.5, iconv('UTF-8', 'cp874', '200.00'), 'LR', 0, 'R', $fill);
                   // $this->Cell(0, 6.5 '', 0, 0, 'C', false);
                   // $this->Cell(0, 6.5, '', 0, 0, 'C', false);

                    $hosmain = $row[$i-1];
                    $namehosp = $row[$i];

                }else{
                    $this->Cell($width[$i], 6.5, iconv('UTF-8', 'cp874', $row[$i]), 'LR', 0, $align[$i], $fill);


                }

            }
            $this->Cell(12, 6.5, iconv('UTF-8', 'cp874', '200.00'), 'LR', 0, 'R', $fill);
            $this->Ln();
            $count++;
            $l++;
            $per_page++;

            if ($per_page == 21 && $l < count($data) ) {
                $allWidth = array_sum($width)+8;
                $this->Cell($allWidth, 6, iconv('UTF-8', 'cp874', 'หน้าถัดไป-->'), 'T', 1, 'C', $fill);
                $per_page = 1;

                $this->AddPage();

                $this->genHeadTable($header,$width);
                $this->SetFillColor(224, 235, 255);
                $this->SetTextColor(0);
                $this->SetFont('');
                $fill = false;
                //$sum += $data[$count][count($header) - 1];
            }elseif($l == count($data)){
                $sum += $row[$countHeader - 3];
                $this->genTotal($width,$count,$sum);
                $this->genApprove($approve, $director);
            }elseif($per_page == 21 && $l == count($data)){
                $sum += $row[$countHeader - 3];
                $this->genTotal($width,$count,$sum);
                $this->genApprove($approve, $director);
            }

            $fill = !$fill;
            $sum += $row[$countHeader - 3];
        }

    }
}


$reportId = $_GET['reportId'];
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];
/*
$reportId = 48;
$startDate = '2017-03-01';
$endDate = '2017-03-30';
*/
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


for ($counter = 0; $counter < $total_column; $counter++) {
    $meta = $ps->getColumnMeta($counter);
    $header[] = $meta['name'];
}
//*** Load MySQL Data ***//
$resultData = array();
while ($row = $ps->fetch()) {
    array_push($resultData, $row);
}
print_r($resultData);
//************************//


$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetMargins( 5,5,5 );
$pdf->AddFont('angsana', '', 'angsa.php');
$pdf->AddFont('angsana', 'B', 'angsab.php');
$pdf->AddFont('angsana', 'I', 'angsai.php');
$pdf->AddFont('angsana', 'BI', 'angsaz.php');
$pdf->SetFont('angsana', '', 12);

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
    '(นายอนุชา  แสงหิรัญ)',
    'นักวิชาการสาธารณสุขปฏิบัติการ',
    'ผู้ตรวจสอบการให้การรักษา');
$director = array(
    'อนุมัติ',
    'ลงชื่อ.............................',
    '(นางจีระนันท์  นาคำ)',
    'นักจัดการงานทั่วไปชำนาญการ ปฏิบัติราชการแทน',
    'ผู้อำนวยการโรงพยาบาลทุ่งศรีอุดม');
$width = array(15, 12, 12, 30, 10, 10, 20, 20, 11, 11, 11, 11, 11, 11, 11, 11, 11, 11, 11, 15,0);
$align = array('C', 'C', 'R', 'L', 'C', 'C', 'L', 'C', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R','R');

$pdf->setTitle($title);


$pdf->Header();
$pdf->FancyTable($header, $resultData, $width, $align, $approve, $director,$title);
//$pdf->genApprove($approve,$director);
//$pdf->setFooter($footer);


$pdf->Output("F", "MyPDF/MyPDF.pdf");
//header( "location: MyPDF/MyPDF.pdf" );
exit(0);
?>
PDF Created Click <a href="MyPDF/MyPDF.pdf">here</a> to Download
</body>
</html>