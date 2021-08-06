<link rel="stylesheet" href="../jquery/bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../jquery/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css"/>

<script type="text/javascript" src="../jquery/jquery/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../jquery/jquery-migrate-1.0.0.js"></script>
<script type="text/javascript" src="../jquery/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../jquery/blockUI/jquery-blockUI.js"></script>
<script src="../jquery/moment.js" type="text/javascript"></script>
<script src="../jquery/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<div class="panel-body" id="panel">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <span class="panel-title">รายงานผู้ป่วยนัดคลินิกเบาหวาน</span>
            <div id="export" style="text-align: right;float: right;margin-top: -5px">
                <div class="dropdown">
                   
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1"
                        style="background-color:rgba(0, 0, 0, 0);margin-right: 8px;text-align: center;">
                        <li>
                            <h5>File Type</h5>
                        <li role="separator" class="divider"></li>
                        <button class="btn btn-success btn-xs" onclick="exportXLS()">EXECEL <i
                                class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i></button></li>

                             

                        <button class="btn btn-danger btn-xs" onclick="openPdf()">PDF <i class="fa fa-file-pdf-o fa-2x"
                                aria-hidden="true"></i></button>
                        <!--<button  class="btn btn-danger btn-xs" onclick="exportCSV()">PDF <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></button>-->

                        <button class="btn btn-primary btn-xs" onclick="exportCSV()">CSV <i class="fa fa-file-o fa-2x"
                                aria-hidden="true"></i></button></li>
                        <button class="btn btn-warning btn-xs" onclick="exportCSV()">Printer <i
                                class="fa fa-print fa-2x" aria-hidden="true"></i></button></li>


                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-body" id="panel">
            <form name="myform" id="myform" class="form-inline" role="form" action="?" method="get">
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker_start'>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default strick_subject">วันที่เริ่มต้น</button>
                        </span>
                        <input type='text' class="form-control" id='date_start' name="startDate"
                            value="<? echo $_GET['startDate'] ?>">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker_end'>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default strick_subject">วันที่สิ้นสุด</button>
                        </span>
                        <input type='text' class="form-control" id='date_end' name="endDate"
                            value="<? echo $_GET['endDate']; ?>">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <input type="submit" name="show" id="show_data" class="btn btn-success" value="แสดงรายงาน">
                <input type="button" name="exportexcel" id="btnExport" class="btn btn-primary" value="export Excel">
                <!-- <a href="?act=excel" class="btn btn-primary"> Export->Excel </a> -->
            </form>
            <?php
            function get_numeric($val) {
                if (is_numeric($val)) {
                  return $val + 0;
                }
                return 0;
              }
            if($_GET['startDate']){            
                $startDate= $_GET['startDate'];
                $endDate= $_GET['endDate'];
                include "../connect_pdo.php";

                try {

                    $sql_text = "SELECT o.*,
                    ( CASE p.male WHEN 1 THEN IF( p.mrtlst < 6, 
                    IF( DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( p.brthdate, '%Y' ) - ( DATE_FORMAT( NOW( ) , '00-%m-%d' ) < DATE_FORMAT( p.brthdate, '00-%m-%d' ) ) < 15, 'ด.ช.', 'นาย' ),
                    IF( DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( p.brthdate, '%Y' ) - ( DATE_FORMAT( NOW( ) , '00-%m-%d' ) < DATE_FORMAT( p.brthdate, '00-%m-%d' ) ) < 20, 'ส.ณ.', 'พระ' )) 
                    WHEN 2 THEN IF( p.mrtlst = 1,
                    IF( DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( p.brthdate, '%Y' ) - ( DATE_FORMAT( NOW( ) , '00-%m-%d' ) < DATE_FORMAT( p.brthdate, '00-%m-%d' ) ) < 15, 'ด.ญ.', 'น.ส.' ),
                    IF( p.mrtlst < 6, 'นาง', 'แม่ชี' )) END) AS prename,
                    concat(p.fname,'  ',p.lname) as ptname,p.pop_id,YEAR(NOW())-year(p.brthdate) as age,
                    p.addrpart,mb.namemoob,p.moopart,t.nametumb,a.nameampur,c.namechw
                    from oapp o join pt p on p.hn=o.hn 
                    JOIN tumbon t on t.chwpart=p.chwpart and t.amppart=p.amppart and t.tmbpart=p.tmbpart
                    JOIN ampur a on a.chwpart=p.chwpart and a.amppart=p.amppart 
                    JOIN mooban mb on mb.chwpart=p.chwpart and mb.amppart=p.amppart and mb.tmbpart=p.tmbpart and mb.moopart=p.moopart
                    JOIN changwat c on c.chwpart=p.chwpart
                    where fudate between '$startDate' and '$endDate' and o.cln='d0100' ";
                    $ps = $db->prepare($sql_text);
                    $ps->execute();

                    $total = 0;
                    echo "<div class='divclass'><table class='table table-strip table-hover' id='detail' border='1'  >
                                    <thead>
                                        <tr><th><b>ลำดับ</b></th>
                                        <th><b>hn</b></th>
                                        <th><b>คำนำหน้า</b></th>
                                        <th><b>ชื่อ</b></th>
                                        <th><b>เลข 13 หลัก</b></th>
                                        <th><b>อายุ</b></th>
                                        <th><b>เลขที่</b></th>
                                        <th><b>หมู่บ้าน</b></th>
                                        <th><b>หมู่</b></th>
                                        <th><b>ตำบล</b></th>
                                        <th><b>อำเภอ</b></th>
                                        <th><b>จังหวัด</b></th>
                                
                                        <th><b>วันที่รับบริการล่าสุด</b></th>
                                        <th><b>วันนัด</b></th>
                                        <th><b>FBS ล่าสุด</b></th>";

                    echo "</tr> </thead>   <tbody>";
                    $i = 1;
                    while ($row = $ps->fetch()) {
                        echo "<tr class='cost'>";
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . $row['hn'] . "</td>";
                        echo "<td>" . $row['prename'] . "</td>";
                        echo "<td>" . $row['ptname'] . "</td>";
                        echo "<td>" . get_numeric($row['pop_id']) . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['addrpart'] . "</td>";
                        echo "<td>" . $row['namemoob'] . "</td>";
                        echo "<td>" . $row['moopart'] . "</td>";
                        echo "<td>" . $row['nametumb'] . "</td>";
                        echo "<td>" . $row['nameampur'] . "</td>";
                        echo "<td>" . $row['namechw'] . "</td>";
                        echo "<td>" . $row['vstdttm'] . "</td>";
                        echo "<td>" . $row['fudate'] . "</td>";

                        $sql_lab = "SELECT ln,labresult
                        FROM labresult
                        WHERE ln  IN (
                        SELECT MAX(lar.ln) from lbbk l join labresult lar on lar.ln=l.ln  where l.hn=".$row['hn']." and l.vstdttm < '". $row['fudate']."' 
                        and lar.labcode in('028') and lar.labresult<>'' GROUP BY lar.labcode
                        )
                        ";
                
                        $ps_lab = $db->prepare($sql_lab);
                        $ps_lab->execute();
                        // $row_lab = $ps_lab->fetch();
                        while ($row_lab = $ps_lab->fetch()) {
                        echo "<td>".$row_lab['labresult']."</td>";
                        }
                    
                        echo "</tr>";
                        $i++;


                    }
                    $pageNum = $i - 1;
                    echo "<tr><td><b>รวม</b></td><td><div style='text-align: center;'><b>".$pageNum."</b></div></td><td></td> ";

                    echo "</tr>   </tbody>    </table></div>";

                } catch (PDOException $e) {

                    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

                }
            }
?> 




        </div>
    </div>
</div>




<script type="text/javascript">
                        var oldDate = $('#date_start').val();
                        var d = new Date();
                        var month = d.getMonth()+1;
                        var day = d.getDate();
                        var curentdate = d.getFullYear() + '-' +
                            (month<10 ? '0' : '') + month + '-' +
                            (day<10 ? '0' : '') + day;
                        var previous_year = (d.getFullYear() -1) + '/' +
                            (month<10 ? '0' : '') + month + '/' +
                            (day<10 ? '0' : '') + day;
                        // alert(setDate);

                        $(function () {

                            $('#datetimepicker_start').datetimepicker({
                                format: 'YYYY-MM-DD'
                            });
                            $('#datetimepicker_end').datetimepicker({
                                useCurrent: false, //Important! See issue #1075
                                format: 'YYYY-MM-DD'
                            });
                            $("#datetimepicker_start").on("dp.change", function (e) {
                                $('#datetimepicker_end').data("DateTimePicker").minDate(e.date);
                            });
                            $("#datetimepicker_end").on("dp.change", function (e) {
                                $('#datetimepicker_start').data("DateTimePicker").maxDate(e.date);
                            });

                            1

$("#btnExport").click(function(e) {
  let file = new Blob([$('.divclass').html()], {type:"application/vnd.ms-excel"});
let url = URL.createObjectURL(file);
let a = $("<a />", {
  href: url,
  download: "filename.xls"}).appendTo("body").get(0).click();
  e.preventDefault();
});


                        });

                    </script>