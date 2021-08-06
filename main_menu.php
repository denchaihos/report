<nav class="navbar navbar-default navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button><br>
                <span id="project_name" style="color: #FFFFFF">
                    <a href="index.php" target="_self">
                    <img src="images/chart_up.png" width="30" height="30">
                        </a>
                </span>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
<!--                <li class="dropdown">
                    <a href="index.php" class="dropdown-toggle" >หน้าหลัก <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="simple-jquery-dropdown-table-filter/memberFilterDropdown.php" target="_blank">ทะเบียนแบบกรองได้</a></li>
                    </ul>
                </li>
-->


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">รายงานมาตรฐานทั่วไป <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php
try {
    $db = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD);
    $report_query = "SELECT *,IF(e_query is null,'N','Y') as eq,custom_report FROM tsureport WHERE dep in('00')";
    $sql = $db->prepare($report_query);
    $sql->execute();
    while ($row = $sql->fetch()) {
        echo "<li><a href='index.php?reportId=" . $row['id'] . "&reportName=" . $row['namereport'] . "&eq=" . $row['eq'] . "&custom_report=" . $row['custom_report'] . "'>";
        echo $row['namereport'];
        echo "</a></li>";
    }
} catch (PDOException $e) {
    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

}
?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" data-toggle="dropdown">รายงานแยกตามแผนก <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
try {
    $db = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD);
    $report_query = "SELECT * FROM tsureport_department WHERE dep_id between '01' and '95'";
    $sql = $db->prepare($report_query);
    $sql->execute();
    while ($row = $sql->fetch()) {
        echo "<li><a href='#'>" . $row['dep_name'] . " <span class='glyphicon glyphicon-chevron-right glyphicon-alignRight' aria-hidden='true'></span></a>";
        ?>
                                    <ul class="dropdown-menu sub-menu">
                                            <?php
try {
            $db2 = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD);
            $report_query2 = "SELECT *,IF(e_query is null,'N','Y') as eq,IF(file_ex is null,'N','Y') as fex,custom_report,mysqli FROM tsureport WHERE dep = '" . $row['dep_id'] . "'";
            $sql2 = $db2->prepare($report_query2);
            $sql2->execute();
            while ($row2 = $sql2->fetch()) {
                //$url = $row2['url']==
                echo "<li><a href='index.php?reportId=" . $row2['id'] . "&reportName=" . $row2['namereport'] . "&eq=" . $row2['eq'] . "&fex=" . $row2['file_ex'] . "&custom_report=" . $row2['custom_report'] . "&mysqli=" . $row2['mysqli'] . "'>";
                echo $row2['namereport'];
                echo "</a></li>";
            }
        } catch (PDOException $e) {
            echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

        }
        ?>
                                    </ul>
                                    <?
        echo "</a></li>";

    }
} catch (PDOException $e) {
    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

}
?>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">รายงานอื่น ๆ <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Hospital Profile</a></li>
                    <li><a href="mekproject/ipdFood.php" target="_blank">บัตรอาหาร</a></li>




                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">เครื่องมือ <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" onclick="setConfig();">Database Setting</a></li>
                        <li><a href="index.php?createReport">ตัวช่วยสร้างรายงาน</a></li>
                        <li><a href="manageReport/index.php">Manage</a></li>

                        <li role="separator" class="divider"></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">ผู้ดูแลระบบ <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="#">Visit ที่ไม่มีวินิฉัย <span class="glyphicon glyphicon-chevron-right glyphicon-alignRight" aria-hidden="true"></span></a>
                            <ul class="dropdown-menu sub-menu">
                                <?php
try {
    $db = new PDO('mysql:host=' . $HOST_NAME . ';dbname=' . $DB_NAME . ';' . $CHAR_SET, $USERNAME, $PASSWORD);
    $report_query = "SELECT *,IF(e_query is null,'N','Y') as eq,custom_report FROM tsureport WHERE dep = '99'";
    $sql = $db->prepare($report_query);
    $sql->execute();
    while ($row = $sql->fetch()) {
        echo "<li><a href='index.php?reportId=" . $row['id'] . "&reportName=" . $row['namereport'] . "&eq=" . $row['eq'] . "&custom_report=" . $row['custom_report'] . "'>";
        echo $row['namereport'];
        echo "</a></li>";
    }
} catch (PDOException $e) {
    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : " . $e->getMessage();

}
?>
                            </ul>
                        </li>

                    </ul>
                </li>



            </ul>


        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>