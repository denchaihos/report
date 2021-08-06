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

            $this->SetMargins(20, 15, 20);
            $this->AddFont('THSarabun', '', 'THSarabunNew.php');
            $this->AddFont('THSarabun', 'B', 'THSarabunNewBold.php');
            $this->AddFont('THSarabun', 'I', 'THSarabunNewItalic.php');
            $this->AddFont('THSarabun', 'BI', 'THSarabunNewBoldItalic.php');
            $this->SetFont('THSarabun', '', 16);

            $this->AddPage();

            $this->Text(20, 30, iconv('UTF-8', 'cp874', 'ที่ อบ. ๐๐๓๒.๐๐๙.๒๖/.......'));
            $this->Image('images/krut.jpg', 90, 10, 20, 0, '', '');
            $this->Text(140, 30, iconv('UTF-8', 'cp874', 'โรงพยาบาลทุ่งศรีอุดม อ.ทุ่งศรีอุดม'));
            $this->Text(140, 40, iconv('UTF-8', 'cp874', 'จ. อุบลราชธานี  ๓๔๑๖๐'));
            //$this->Text(80, 50, iconv('UTF-8', 'cp874', $endDate));
            $this->Text(20, 60, iconv('UTF-8', 'cp874', 'เรื่อง  ขอส่งแบบสรุปการให้บริการนอกเครือข่ายภายในจังหวัด ที่เรียกเก็บตาม นค. ๑ (แบบ UC ๑)'));
            $this->Text(20, 70, iconv('UTF-8', 'cp874', 'เรียน   นายแพทย์สาธารณสุขจังหวัดอุบลราชธานี'));
            $this->Text(20, 80, iconv('UTF-8', 'cp874', 'สิ่งที่ส่งมาด้วย  ๑. แบบสรุปการให้บริการนอกเครือข่ายภายในจังหวัดที่เรียกเก็บตาม นค. ๑ จำนวน ๑ ชุด'));
            $this->Ln(70);

        $this->Text(40, 90, iconv('UTF-8', 'cp874', 'ตามที่งานประกันสุขภาพ สำนักงานสาธารณสุขจังหวัดอุบลราชธานี ได้ให้สถานบริการส่งแบบรายการ'));
        $this->Text(20, 100, iconv('UTF-8', 'cp874', 'ค่ารักษาพยาบาลผู้ป่วยนอก (นค. ๑) ให้แต่ละสถานบริการได้ตรวจสอบค่ารักษาพยาบาลของผู้มารับบริการ'));
        $this->Text(20, 110, iconv('UTF-8', 'cp874', 'ต่างสถานบริการ นั้น'));

        $this->Text(40, 120, iconv('UTF-8', 'cp874', 'ในการนี้โรงพยาบาลทุ่งศรีอุดมขอส่งแบบสรุปการให้บริการนอกเครือข่ายภายในจังหวัด'));
        $this->Text(20, 130, iconv('UTF-8', 'cp874', 'ที่เรียกเก็บตาม นค. ๑ ประจำเดือน '.DateThai($endDate).''));


        $this->Ln(70);



            $this->Text(42, 140, iconv('UTF-8', 'cp874', 'จึงเรียนมาเพื่อโปรดทราบ และพิจารณาดำเนินการต่อไปด้วย '));
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
            $this->Cell(200, 7, 'E-Mail : Seanghiran2009@windowslive.com', 0, 1, 'L');
            $this->Cell(200, 7, iconv('UTF-8', 'cp874', 'นายอนุชา  แสงหิรัญ  ๐๘๙๖๒๘๘๒๐๙'), 0, 1, 'L');

            $this->Cell(180, 10, iconv('UTF-8', 'cp874', '“นครแห่งธรรม  นครแห่งเทียน  นครแห่งการพัฒนา  นครแห่งความฮักแพง”'), 0, 1, 'C');
            $this->AddPage();

        $this->Cell(200, 10, iconv('UTF-8', 'cp874', 'สรุปผลการให้บริการนอกเครื่อข่ายภายในจังหวัดที่เรียกเก็บตาม นค. ๑'), 0, 1, 'C');
        $this->Cell(200, 10, iconv('UTF-8', 'cp874', 'หน่วยบริการที่ให้การรักษา  โรงพยาบาลทุ่งศรีอุดม'), 0, 1, 'C');
        $this->Cell(200, 10, iconv('UTF-8', 'cp874', 'ครั้งที่ ...../......... ประจำเดือน  ดือน '.DateThai($endDate)), 0, 1, 'C');
        $this->Cell(200, 10, iconv('UTF-8', 'cp874',''), 0, 1, 'C');
        $i=1;
        $this->Cell(15,10, iconv('UTF-8', 'cp874', 'ลำดับ'), 'LTR', 0, 'C', false);
        $this->Cell(70,10, iconv('UTF-8', 'cp874', 'CUP. ที่ขึ้นทะเบียน'), 'LTR', 0, 'C', false);
        $this->Cell(70,10, iconv('UTF-8', 'cp874', 'จำนวนเรียกเก็บ (๒๐๐/ครั้ง)'), 'LTBR', 0, 'C', false);
        $this->Cell(20,10, iconv('UTF-8', 'cp874', 'หมายเหตุ'), 'LTR', 1, 'C', false);

        $this->Cell(15,10, iconv('UTF-8', 'cp874', ''), 'LBR', 0, 'C', false);
        $this->Cell(70,10, iconv('UTF-8', 'cp874', ''), 'LBR', 0, 'C', false);
        $this->Cell(20,10, iconv('UTF-8', 'cp874', 'ราย'), 'LBR', 0, 'C', false);
        $this->Cell(25,10, iconv('UTF-8', 'cp874', 'ค่าใช้จ่ายจริง'), 'LBR', 0, 'C', false);
        $this->Cell(25,10, iconv('UTF-8', 'cp874', 'เรียกเก็บ'), 'LBR', 0, 'C', false);
        $this->Cell(20,10, iconv('UTF-8', 'cp874', ''), 'LBR', 1, 'C', false);

        $numColumn = count($resultData[0])/2;
        $sumPt = 0;
        $sumCost = 0;
        $sumCharge = 0;
        $widthColumn =[70,20,25,25];
        $alignColumn =['L','C','R','R'];
        foreach ($resultData as $row) {
            $this->Cell(15,8, iconv('UTF-8', 'cp874', $i), 'LR', 0, 'C', false);
            for($j=0;$j<$numColumn;$j++){
                $this->Cell($widthColumn[$j],8, iconv('UTF-8', 'cp874', $row[$j]), 'LR', 0, $alignColumn[$j], false);
            }
            $this->Cell(20,8, iconv('UTF-8', 'cp874', ' '), 'LR', 1, 'L', false);
            $i++;
            $sumPt += $row[1];
            $sumCost += $row['cost'];
            $sumCharge += intval($row['charge']);

        }
        $this->Cell(15,10, iconv('UTF-8', 'cp874', ''), 'LBTR', 0, 'C', false);
        $this->Cell(70,10, iconv('UTF-8', 'cp874', 'รวม'), 'LBTR', 0, 'C', false);
        $this->Cell(20,10, iconv('UTF-8', 'cp874', $sumPt), 'LBTR', 0, 'C', false);
        $this->Cell(25,10, iconv('UTF-8', 'cp874',  number_format($sumCost, 2, '.', '')), 'LBTR', 0, 'R', false);
        $this->Cell(25,10, iconv('UTF-8', 'cp874',  number_format($sumCharge, 2, '.', '')), 'LBTR', 0, 'R', false);
        $this->Cell(20,10, iconv('UTF-8', 'cp874', ''), 'LBTR', 1, 'C', false);
        $this->Ln(20);
        $this->Cell(200, 10, iconv('UTF-8', 'cp874', 'ลงชื่อ..................................ผู้ส่ง'), 0, 1, 'C');
        $this->Cell(200, 10, iconv('UTF-8', 'cp874', '(นายอนุชา  แสงหิรัญ)'), 0, 1, 'C');
        $this->Cell(200, 10, iconv('UTF-8', 'cp874', 'นักวิชาการสาธารณสุขปฏิบัติการ'), 0, 1, 'C');


    }

}


$reportId = $_GET['reportId'];
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];
/*
$reportId = 50;
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

print_r($resultData);


//************************//


$fpdf = new PDF('P', 'mm', 'A4');
$fpdf->FancyTable($resultData,$endDate);

$fpdf->Output("F", "MyPDF/MyPDF.pdf");

exit(0);
?>
PDF Created Click <a href="MyPDF/MyPDF.pdf">here</a> to Download
</body>
</html>