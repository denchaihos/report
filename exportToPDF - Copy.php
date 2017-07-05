<html>
<head>
    <title>ThaiCreate.Com PHP PDF</title>
</head>
<body>

<?php
require('function/fpdf/fpdf.php');

class PDF extends FPDF
{
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

//Simple table
    function BasicTable($header,$data)
    {
        //Header
        $w=array(30,30,55,25,20,20);
        //Header
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
        $this->Ln();
        //Data
        foreach ($data as $eachResult)
        {
            $this->Cell(30,6,$eachResult["CustomerID"],1);
            $this->Cell(30,6,$eachResult["Name"],1);
            $this->Cell(55,6,$eachResult["Email"],1);
            $this->Cell(25,6,$eachResult["CountryCode"],1,0,'C');
            $this->Cell(20,6,$eachResult["Budget"],1);
            $this->Cell(20,6,$eachResult["Budget"],1);
            $this->Ln();
        }
    }

//Better table
    function ImprovedTable($header,$data)
    {
        //Column widths
        $w=array(20,30,55,25,25,25);
        //Header
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
        $this->Ln();
        //Data

        foreach ($data as $eachResult)
        {
            $this->Cell(20,6,$eachResult["CustomerID"],1);
            $this->Cell(30,6,$eachResult["Name"],1);
            $this->Cell(55,6,$eachResult["Email"],1);
            $this->Cell(25,6,$eachResult["CountryCode"],1,0,'C');
            $this->Cell(25,6,number_format($eachResult["Budget"],2),1,0,'R');
            $this->Cell(25,6,number_format($eachResult["Budget"],2),1,0,'R');
            $this->Ln();
        }





        //Closure line
        $this->Cell(array_sum($w),0,'','T');
    }

//Colored table
    function FancyTable($header,$data)
    {
        //Colors, line width and bold font
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        //Header
        $w=array(20,30,55,25,25,25);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        //Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        //Data
        $fill=false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
            $this->Cell($w[3],6,$row[3],'LR',0,'C',$fill);
            $this->Cell($w[4],6,number_format($row[4]),'LR',0,'R',$fill);
            $this->Cell($w[5],6,number_format($row[5]),'LR',0,'R',$fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w),0,'','T');
    }
}

$pdf=new PDF();
//Column titles
$header=array('CustomerID','Name','Email','Country Code','Budget','Used');
//Data loading

//*** Load MySQL Data ***//
try {
    include "connect_pdo.php";
    $db = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $reportId = $_GET['reportId'];
    $startDate = $_GET['startdate'];
    $endDate = $_GET['enddate'];

    // ดึงเอาคำสั่ง SQL  ออกมาก่อน
    $report_query = "SELECT * FROM tsureport WHERE id=$reportId";
    $sql = $db->prepare($report_query);
    $sql->execute();
    $sql = $sql->fetch();
    $reportName = $sql['namereport'];
    $sql_text = $sql['r_query'];
    //  column  head
    $ps = $db->prepare($sql_text);
    $start_date = $startDate;
    $end_date = $endDate;
    $ps->bindParam(1, $start_date, PDO::PARAM_STR);
    $ps->bindParam(2, $end_date, PDO::PARAM_STR);
    $ps->execute();
    $total_column = $ps->columnCount();

    $resultData = array();

    for ($counter = 0; $counter < $total_column; $counter++) {
        $meta = $ps->getColumnMeta($counter);
        $column[] = $meta['name'];
        array_push($resultData,$column[]);
    }

    $STMrecords = $ps->fetchAll();
    foreach($STMrecords as $row){
        $result = mysql_fetch_array($row);
        array_push($resultData,$result);
    }



} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
///////////
/*$objQuery = mysql_query($strSQL);
$resultData = array();
for ($i=0;$i<mysql_num_rows($objQuery);$i++) {
    $result = mysql_fetch_array($objQuery);
    array_push($resultData,$result);
}*/
//************************//



$pdf->SetFont('Arial','',10);

//*** Table 1 ***//
$pdf->AddPage();
$pdf->Image('logo.png',80,8,33);
$pdf->Ln(35);
$pdf->BasicTable($header,$resultData);

//*** Table 2 ***//
$pdf->AddPage();
$pdf->Image('logo.png',80,8,33);
$pdf->Ln(35);
$pdf->ImprovedTable($header,$resultData);

//*** Table 3 ***//
$pdf->AddPage();
$pdf->Image('logo.png',80,8,33);
$pdf->Ln(35);
$pdf->FancyTable($header,$resultData);

$pdf->Output("MyPDF/MyPDF.pdf","F");
?>

PDF Created Click <a href="MyPDF/MyPDF.pdf">here</a> to Download
</body>
</html>