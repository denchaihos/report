<html>
<head>
    <title>PDF</title>
</head>
<body>

<?php
define('FPDF_FONTPATH', 'font/');
//require('../jquery/fpdf/fpdf.php');
require('../jquery/fpdf/fpdf.php');
function DateThai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม.","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม.","มิถุนายน.","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return " $strMonthThai $strYear";
}

class PDF extends FPDF
{
    function FancyTable($resultData,$endDate)
    {
        foreach ($resultData as $row) {
            $this->SetMargins(20, 15, 20);
            $this->AddFont('THSarabun', '', 'THSarabunNew.php');
            $this->AddFont('THSarabun', 'B', 'THSarabunNewBold.php');
            $this->AddFont('THSarabun', 'I', 'THSarabunNewItalic.php');
            $this->AddFont('THSarabun', 'BI', 'THSarabunNewBoldItalic.php');
            $this->SetFont('THSarabun', '', 16);

            $this->AddPage();

            $this->Text(20, 30, iconv('UTF-8', 'cp874', 'ที่ อบ. ๐๐๓๒.๐๐๙.๒๖/.......'));
            $this->Image('images/krut.jpg', 90, 10, 20, 0, '', 'http://www.select2web.com');
            $this->Text(140, 30, iconv('UTF-8', 'cp874', 'โรงพยาบาลทุ่งศรีอุดม อ.ทุ่งศรีอุดม'));
            $this->Text(140, 40, iconv('UTF-8', 'cp874', 'จ. อุบลราชธานี  ๓๔๑๖๐'));
            //$this->Text(80, 50, iconv('UTF-8', 'cp874', $endDate));
            $this->Text(20, 60, iconv('UTF-8', 'cp874', 'เรื่อง  ขอส่งแบบรายการค่ารักษาพยาบาลผู้ป่วยนอก ( นค.๑)'));
            $this->Text(20, 70, iconv('UTF-8', 'cp874', 'เรียน   ผู้อำนวยการ'. $row[1]));
            $this->Text(20, 80, iconv('UTF-8', 'cp874', 'สิ่งที่ส่งมาด้วย  ๑. แบบรายการค่ารักษาพยาบาลผู้ป่วยนอก (นค. ๑)   จำนวน  ๑  ชุด'));
            $this->Ln(70);
            $this->Write(8, iconv('UTF-8', 'cp874', '                ตามที่งานประกันสุขภาพ สำนักงานสาธารณสุขจังหวัดอุบลราชธานี ได้ให้สถานบริการส่ง
แบบรายการค่ารักษาพยาบาลผู้ป่วยนอก (นค. ๑) ให้แต่ละสถานบริการได้ตรวจสอบค่ารักษาพยาบาลของ
ผู้มารับบริการต่างสถานบริการ นั้น
'));
            $this->Write(8, iconv('UTF-8', 'cp874', '                ในการนี้โรงพยาบาลทุ่งศรีอุดมขอส่งรายงานค่ารักษาพยาบาลผู้ป่วยนอกประจำเดือน '.DateThai($endDate).' ดังรายละเอียดที่ส่งมาด้วย หลังจากท่านตรวจสอบข้อมูลเรียบร้อยแล้วกรุณา โอนเงินค่ารักษาพยาบาลเข้าบัญชีธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร สาขาทุ่งศรีอุดม
ชื่อบัญชี “โรงพยาบาลทุ่งศรีอุดม” เลขที่บัญชี ๐๑๗๗๗๘๕๔๙๖๐๒ พร้อมส่งสำเนาการโอนให้กับ กลุ่มงานประกันสุขภาพ ยุทธศาสตร์และสารสนเทศทางการแพทย์ โรงพยาบาลทุ่งศรีอุดม
'));
            $this->Text(42, 158, iconv('UTF-8', 'cp874', 'จึงเรียนมาเพื่อโปรดทราบ และพิจารณาดำเนินการต่อไปด้วย จักเป็นพระคุณยิ่ง'));
            $this->Ln();
            $this->Ln();
            $this->Ln();
            $this->Cell(200, 10, iconv('UTF-8', 'cp874', 'ขอแสดงความนับถือ'), 0, 1, 'C');
            $this->Ln();
            $this->Cell(200, 10, iconv('UTF-8', 'cp874', '(นายคงทัช      สิงขรานันต์)'), 0, 1, 'C');
            $this->Cell(200, 8, iconv('UTF-8', 'cp874', 'นายแพทย์ชำนาญการ รักษาการในตำแหน่ง'), 0, 1, 'C');
            $this->Cell(200, 8, iconv('UTF-8', 'cp874', 'ผู้อำนวยการโรงพยาบาลทุ่งศรีอุดม'), 0, 1, 'C');
            $this->Ln();

            $this->Cell(200, 7, iconv('UTF-8', 'cp874', 'กลุ่มงานประกันสุขภาพ ยุทธศาสตร์และสารสนเทศทางการแพทย์'), 0, 1, 'L');
            $this->Cell(200, 7, iconv('UTF-8', 'cp874', 'โทร. (๐๔๕) ๓๐๗๐๓๓ ต่อ ๑๐๓'), 0, 1, 'L');
            $this->Cell(200, 7, iconv('UTF-8', 'cp874', 'โทรสาร (๐๔๕) ๓๐๗๐๓๒'), 0, 1, 'L');
            $this->Cell(200, 7, 'E-Mail : winoppo@gmail.com', 0, 1, 'L');
            $this->Cell(200, 7, iconv('UTF-8', 'cp874', 'นายศิระ พลเตชา  ๐๙๓๕๑๙๐๒๔๗'), 0, 1, 'L');

            $this->Cell(180, 10, iconv('UTF-8', 'cp874', '“นครแห่งธรรม  นครแห่งเทียน  นครแห่งการพัฒนา  นครแห่งความฮักแพง”'), 0, 1, 'C');


        }
    }

}


$reportId = $_GET['reportId'];
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];
/*

$reportId = 49;
$startDate = '2017-12-01';
$endDate = '2017-12-30';
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
$resultData = array();
while ($row = $ps->fetch()) {
    array_push($resultData, $row);
}

//************************//


$fpdf = new PDF('P', 'mm', 'A4');
$fpdf->FancyTable($resultData,$endDate);

$fpdf->Output("F", "MyPDF/MyPDF.pdf");

exit(0);
?>
PDF Created Click <a href="MyPDF/MyPDF.pdf">here</a> to Download
</body>
</html>