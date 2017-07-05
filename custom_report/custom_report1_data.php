<?php

//if (isset($_GET['vn']) ) {
    include "../connect_pdo.php";

    $vn = $_GET['vn'];

    try {


        $data = "<p></p><p><center><h3>ใบแสดงรายละเอียดค่ารักษาพยาบาลสำหรับผู้ป่วยนอก</h3></center></p>";
        $data .= "<p><center><h4>โรงพยาบาลทุ่งศรีอุดม   อ.ทุ่งศรีอุดม  จ.อุบลราชธานี  โทร. 045-307033-4</h4></center></p>";
        $data .= "<p><center><hr></center></p>";
        $sql_inform = "select o.hn,concat(p.fname,'  ',p.lname) as ptname,year(o.vstdttm) - year(p.brthdate) as age ,o.vstdttm,pty.namepttype, concat(ox.icd10,'-',i.icd10name) as icdname
         from ovst o join pt p on p.hn=o.hn JOIN pttype pty on pty.pttype=o.pttype
         JOIN ovstdx ox on ox.vn=o.vn and ox.cnt=1
         JOIN icd101 i on i.icd10=ox.icd10
         where o.vn=$vn group by o.hn";
        $ps_inform = $db->prepare($sql_inform);
        $ps_inform->execute();
        $row_inform = $ps_inform->fetch();
        $data .= "<span class='floating-box'>ชื่อ: ".$row_inform['ptname']."&nbsp&nbsp&nbsp&nbsp</span>";
        $data .= "<span class='floating-box'>อายุ ".$row_inform['age']."  ปี</span>&nbsp&nbsp&nbsp&nbsp";
        $data .= "<span class='floating-box'>เลขที่ รพ. ".$row_inform['hn']." </span>&nbsp&nbsp&nbsp&nbsp";
        $data .= "<span class='floating-box'>วันที่เข้ารับบริการ ".$row_inform['vstdttm']."  </span>&nbsp&nbsp&nbsp&nbsp";
        $data .= "<span class='floating-box'>สิทธิ์การรักษา ".$row_inform['namepttype']." &nbsp </span>";
        $data .= "<span class='floating-box'>การวินิจฉัย ".$row_inform['icdname']." &nbsp </span>";

        $data .= "<p><center><hr></center></p>";


        $sql_text = "SELECT i.income,ic.namecost,i.rcptamt,i.cgd from incoth i JOIN income ic on ic.costcenter=i.income WHERE i.vn=$vn group by i.income"  ;
        $ps = $db->prepare($sql_text);
        $ps->execute();
        $values_income = array('01','04','08','09','11');
        $total = 0;
        $data .= "<table class='table table-strip table-hover' id='detail'  >
                    <thead>
                        <tr><th><b>รายการค่ารักษาพยาบาล</b></th><th><b>ราคา</b></th><th><b>รหัส cgd</b></th>";

        $data .= "</tr>
                    </thead>
                    <tbody>";

        while ($row = $ps->fetch()) {
            $data .= "<tr class='cost'>";

                $data .= "<td class='hg' style='padding-left: 10px;'><div style='padding-left: 10px;'>".
                    $row['namecost']
                    ."</div></td>";
            if(in_array($row['income'], $values_income))  {
                $data .= "<td class='hg'><div></div></td>";
                $data .= "<td class='hg'><div></div></td>";

            }else{
                $data .= "<td id='price' class='hg'><div style='text-align: center;'>".
                    $row['rcptamt']
                    ."</div></td>";
                $total += $row['rcptamt'];
                $data .= "<td class='hg'><div style='text-align: center;'>".
                    $row['cgd']
                    ."</div></td>";
            }


            $data .= "</tr>";

            if($row['income']=='01'){
                $sql_lab = "SELECT lb.labname,i.rcptamt,i.cgd from incoth i  JOIN lbbk l ON l.ln=i.codecheck  JOIN lab lb on lb.labcode=l.labcode where i.vn=$vn "  ;
                $ps_lab = $db->prepare($sql_lab);
                $ps_lab->execute();
                while ($row_lab = $ps_lab->fetch()) {
                    $data .= "<tr class='cost'>";
                    $data .= "<td class='sub_detail hg'><div>&nbsp&nbsp&nbsp&nbsp&nbsp- ".
                        $row_lab['labname']
                        ."</div></td>";
                    $data .= "<td id='price' class='hg'><div style='text-align: center;'>".
                        $row_lab['rcptamt']
                        ."</div></td>";
                    $total += $row_lab['rcptamt'];
                    $data .= "<td class='hg'><div style='text-align: center;'>".
                        $row_lab['cgd']
                        ."</div></td>";

                    $data .= "</tr>";
                }
            }
            elseif($row['income']=='04'){
                $sql_drugIn = "SELECT p.fullname as nameprscdt,p.cgd,o.charge from oprt o JOIN prcd p on p.codeprcd=o.icd9cm and p.priceprcd=o.charge  where o.vn =$vn  "  ;
                $ps_drugIn = $db->prepare($sql_drugIn);
                $ps_drugIn->execute();
                while ($row_drugIn = $ps_drugIn->fetch()) {
                    $data .= "<tr class='cost'>";
                    $data .= "<td class='sub_detail hg'><div>&nbsp&nbsp&nbsp&nbsp&nbsp- ".
                        $row_drugIn['nameprscdt']
                        ."</div></td>";
                    $data .= "<td id='price' class='hg'><div style='text-align: center;'>".
                        $row_drugIn['charge']
                        ."</div></td>";
                    $total += $row_drugIn['charge'];
                    $data .= "<td class='hg'><div style='text-align: center;'>".
                        $row_drugIn['cgd']
                        ."</div></td>";

                    $data .= "</tr>";
                }
            }
            elseif($row['income']=='08'){
                $sql_drugIn = "SELECT pd.nameprscdt,pd.charge,'' as cgd from incoth i join prsc p on p.vn=i.vn JOIN prscdt pd on pd.prscno=p.prscno
                 JOIN meditem m on m.meditem=pd.meditem where i.vn=$vn and i.income='08' and m.type=1 and m.ed=1 "  ;
                $ps_drugIn = $db->prepare($sql_drugIn);
                $ps_drugIn->execute();
                while ($row_drugIn = $ps_drugIn->fetch()) {
                    $data .= "<tr class='cost'>";
                    $data .= "<td class='sub_detail hg'><div>&nbsp&nbsp&nbsp&nbsp&nbsp- ".
                        $row_drugIn['nameprscdt']
                        ."</div></td>";
                    $data .= "<td id='price' class='hg'><div style='text-align: center;'>".
                        $row_drugIn['charge']
                        ."</div></td>";
                    $total += $row_drugIn['charge'];
                    $data .= "<td class='hg'><div style='text-align: center;'>".
                        $row_drugIn['cgd']
                        ."</div></td>";

                    $data .= "</tr>";
                }
            }
            elseif($row['income']=='09'){
                $sql_drugOut = "SELECT pd.nameprscdt,pd.charge,'' as cgd from incoth i join prsc p on p.vn=i.vn JOIN prscdt pd on pd.prscno=p.prscno
                 JOIN meditem m on m.meditem=pd.meditem where i.vn=$vn and i.income='09' and m.type=1 and m.ed<>1  "  ;
                $ps_drugOut = $db->prepare($sql_drugOut);
                $ps_drugOut->execute();
                while ($row_drugOut = $ps_drugOut->fetch()) {
                    $data .= "<tr class='cost'>";
                    $data .= "<td class='sub_detail hg'><div>&nbsp&nbsp&nbsp&nbsp&nbsp- ".
                        $row_drugOut['nameprscdt']
                        ."</div></td>";
                    $data .= "<td id='price' class='hg'><div style='text-align: center;'>".
                        $row_drugOut['charge']
                        ."</div></td>";
                    $total += $row_drugOut['charge'];
                    $data .= "<td class='hg'><div style='text-align: center;'>".
                        $row_drugOut['cgd']
                        ."</div></td>";

                    $data .= "</tr>";
                }
            }
            elseif($row['income']=='11'){
                $sql_drugOut = "SELECT pd.nameprscdt,pd.charge,'' as cgd from incoth i join prsc p on p.vn=i.vn JOIN prscdt pd on pd.prscno=p.prscno
                 JOIN meditem m on m.meditem=pd.meditem where i.vn=$vn and i.income='11' and m.type<>1  "  ;
                $ps_drugOut = $db->prepare($sql_drugOut);
                $ps_drugOut->execute();
                while ($row_drugOut = $ps_drugOut->fetch()) {
                    $data .= "<tr class='cost'>";
                    $data .= "<td class='sub_detail hg'><div>&nbsp&nbsp&nbsp&nbsp&nbsp- ".
                        $row_drugOut['nameprscdt']
                        ."</div></td>";
                    $data .= "<td id='price' class='hg'><div style='text-align: center;'>".
                        $row_drugOut['charge']
                        ."</div></td>";
                    $total += $row_drugOut['charge'];
                    $data .= "<td class='hg'><div style='text-align: center;'>".
                        $row_drugOut['cgd']
                        ."</div></td>";

                    $data .= "</tr>";
                }
            }
        }
        $data .= "<tr><td><b>รวม</b></td><td><div style='text-align: center;'><b>". number_format( $total , 2 )."</b></div></td><td></td> ";

        $data .= "</tr>
                    </tbody>
                    </table>";


        echo $data;




    } catch (PDOException $e) {

        echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

    }
//}
?>