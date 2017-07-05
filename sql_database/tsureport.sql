/*
Navicat MySQL Data Transfer

Source Server         : hiserver5
Source Server Version : 50163
Source Host           : 192.168.11.5:3306
Source Database       : hi

Target Server Type    : MYSQL
Target Server Version : 50163
File Encoding         : 65001

Date: 2017-01-30 10:24:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tsureport`
-- ----------------------------
DROP TABLE IF EXISTS `tsureport`;
CREATE TABLE `tsureport` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `namereport` varchar(255) NOT NULL,
  `r_query` longtext,
  `e_query` longtext,
  `file_ex` varchar(250) DEFAULT NULL,
  `dep` varchar(2) NOT NULL,
  `request_by` varchar(200) NOT NULL,
  `note` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tsureport
-- ----------------------------
INSERT INTO `tsureport` VALUES ('1', 'icd10', 'select * from icd10 limit 100', null, null, '99', 'admin', 'admin');
INSERT INTO `tsureport` VALUES ('2', 'ค้นหาผู้ป่วยจากช่วงเวลาที่เลือก', 'select p.hn,p.fname,p.lname,m.namemale,o.vstdttm from ovst o join pt p on p.hn=o.hn join male m on m.male=p.male  WHERE date(o.vstdttm) BETWEEN ? AND ?', null, null, '02', 'admin', null);
INSERT INTO `tsureport` VALUES ('3', 'ปริมาณการสั่่ง LAB', 'select p.hn,p.fname,p.lname,m.namemale,o.vstdttm from ovst o join pt p on p.hn=o.hn join male m on m.male=p.male  WHERE date(o.vstdttm) BETWEEN ? AND ?', null, null, '05', 'สุทธิยา', null);
INSERT INTO `tsureport` VALUES ('4', 'จำนวนข้อมูลการส่งต่อตามโรคที่กำหนด', 'SELECT id,s1 as \'ชื่อโรค\',s2 as \'icd10\',n1 as \'ต.ค.\',n2 as \'พ.ย.\',n3 as \'ธ.ค.\',n4 as \'ม.ค.\',n5 as \'ก.พ.\',n6 as \'มี.ค.\',n7 as \'เม.ย.\',n8 as \'พ.ค.\',n9 as \'มิ.ย.\',n10 as \'ก.ค.\',n11 as \'ส.ค.\',n12 as \'ก.ย.\',n13  as \'รวม\'  from tsu_temp_report WHERE reportname=\'ReferByIcd10TotalByMonth\';', null, null, '10', 'Refer center', '');
INSERT INTO `tsureport` VALUES ('5', 'ผู้รับบริการทันตกรรมที่ไม่รอตรวจ', 'select o.hn,d.dn,CONCAT(p.fname,\'  \',p.lname) as ptname,d.vstdttm FROM dt d JOIN ovst o on o.vn=d.vn left OUTER JOIN dtdx dx on dx.dn=d.dn LEFT OUTER JOIN hi.symptm s on s.vn=d.vn LEFT OUTER JOIN dentist dnt on dnt.codedtt= d.dnt LEFT OUTER JOIN pt p on p.hn=o.hn where date(d.vstdttm) BETWEEN ? AND ?  and dx.dn is null  and s.vn is null', 'INSERT INTO dtdx(dn,dtxtime,area,icdda,dttx,charge,rcptno) select d.dn,DATE_FORMAT(d.vstdttm,\'%H%i\') as timmm,\'\',\'Z532\',\'\',0,0 FROM dt d JOIN ovst o on o.vn=d.vn left OUTER JOIN dtdx dx on dx.dn=d.dn LEFT OUTER JOIN hi.symptm s on s.vn=d.vn LEFT OUTER JOIN dentist dnt on dnt.codedtt= d.dnt  where date(d.vstdttm) BETWEEN :startdate and :enddate and dx.dn is null and s.vn is null ', null, '99', 'admin', null);
INSERT INTO `tsureport` VALUES ('6', 'ผู้รับบริการขอใบรับรองแพทย์', 'select o.hn,CONCAT(p.fname,\'  \',p.lname) as ptname,o.vstdttm,s.symptom from ovst o left outer join hi.cln c on o.cln = c.cln LEFT OUTER JOIN hi.symptm s on s.vn=o.vn LEFT OUTER JOIN hi.ovstdx x on x.vn=o.vn LEFT OUTER JOIN hi.dt d on d.vn=o.vn LEFT OUTER JOIN pt p on p.hn=o.hn where date(o.vstdttm)  BETWEEN ? and ? and s.symptom LIKE \'%รับรอง%\' and x.vn is null and d.vn is null  ', 'INSERT INTO hi.ovstdx (vn,icd10,icd10name,cnt) SELECT o.vn,\'Z026\',\'\',1  from ovst o left outer join hi.cln c on o.cln = c.cln  LEFT OUTER JOIN hi.symptm s on s.vn=o.vn LEFT OUTER JOIN hi.ovstdx x on x.vn=o.vn LEFT OUTER JOIN hi.dt d on d.vn=o.vn where date(o.vstdttm)  BETWEEN :startdate and :enddate  and s.symptom LIKE \'%รับรอง%\' and x.vn is null and d.vn is null ', null, '99', 'admin', '');
INSERT INTO `tsureport` VALUES ('7', 'ผู้รับบริการตรวจชัณสูตรอย่างเดียวไม่มีวินิฉัย', 'SELECT o.hn,CONCAT(p.fname,\'  \',p.lname) AS ptname,o.vstdttm,lb.labname FROM ovst o  JOIN hi.lbbk l ON l.vn=o.vn JOIN hi.lab lb ON lb.labcode=l.labcode JOIN hi.pt p on p.hn=o.hn LEFT OUTER JOIN hi.cln c ON o.cln = c.cln  LEFT OUTER JOIN hi.ovstdx x ON x.vn=o.vn LEFT OUTER JOIN hi.dt d ON d.vn=o.vn WHERE date(o.vstdttm)  BETWEEN ? AND ? AND x.vn IS NULL AND d.vn IS NULL GROUP BY o.vn  ', 'INSERT INTO hi.ovstdx (vn,icd10,icd10name,cnt) SELECT o.vn,\'Z017\',\'\',1 FROM ovst o  JOIN hi.lbbk l ON l.vn=o.vn JOIN hi.lab lb ON lb.labcode=l.labcode JOIN hi.pt p on p.hn=o.hn LEFT OUTER JOIN hi.cln c ON o.cln = c.cln  LEFT OUTER JOIN hi.ovstdx x ON x.vn=o.vn LEFT OUTER JOIN hi.dt d ON d.vn=o.vn WHERE date(o.vstdttm)  BETWEEN :startdate and :enddate AND x.vn IS NULL AND d.vn IS NULL GROUP BY o.vn  ', null, '99', 'admin', null);
INSERT INTO `tsureport` VALUES ('8', 'ผู้รับบริการที่ไม่รอตรวจ', 'SELECT o.hn,CONCAT(p.fname,\'   \',p.lname) AS ptname,o.vstdttm FROM ovst o JOIN hi.pt p ON p.hn=o.hn LEFT OUTER JOIN hi.cln c on o.cln = c.cln LEFT OUTER JOIN hi.symptm s on s.vn=o.vn LEFT OUTER JOIN hi.lbbk l on l.vn=o.vn LEFT OUTER JOIN hi.ovstdx x on x.vn=o.vn LEFT OUTER JOIN hi.dt d on d.vn=o.vn WHERE date(o.vstdttm)  BETWEEN ? AND ? AND s.vn IS NULL AND l.vn IS NULL  AND x.vn IS NULL AND d.vn IS NULL GROUP BY o.vn', null, null, '99', 'admin', null);
INSERT INTO `tsureport` VALUES ('9', 'ผู้รับบริการที่มี CC แต่ไม่มีวินิฉัย', 'SELECT o.hn,CONCAT(p.fname,\'   \',p.lname) AS ptname,o.vstdttm FROM ovst o JOIN hi.pt p ON p.hn=o.hn LEFT OUTER JOIN hi.cln c on o.cln = c.cln  JOIN hi.symptm s on s.vn=o.vn  LEFT OUTER JOIN hi.ovstdx x on x.vn=o.vn LEFT OUTER JOIN hi.dt d on d.vn=o.vn WHERE date(o.vstdttm)  BETWEEN ? AND ? AND  x.vn IS NULL AND d.vn IS NULL GROUP BY o.vn', 'INSERT INTO hi.ovstdx (vn,icd10,icd10name,cnt) SELECT o.vn,\'Z008\',\'\',1 FROM ovst o JOIN hi.pt p ON p.hn=o.hn LEFT OUTER JOIN hi.cln c on o.cln = c.cln  JOIN hi.symptm s on s.vn=o.vn  LEFT OUTER JOIN hi.ovstdx x on x.vn=o.vn LEFT OUTER JOIN hi.dt d on d.vn=o.vn WHERE date(o.vstdttm)  BETWEEN :startdate and :enddate AND  x.vn IS NULL AND d.vn IS NULL GROUP BY o.vn', null, '99', 'admin', null);
INSERT INTO `tsureport` VALUES ('10', 'จำนวนการสั่งชัณสุูตร', 'SELECT lb.labcode,la.labname,count(*) from lbbk lb JOIN lab la on la.labcode=lb.labcode  where date(vstdttm)  BETWEEN ? AND ? GROUP BY labcode  ORDER BY la.labname', null, null, '05', 'พี่ยา', '');
INSERT INTO `tsureport` VALUES ('11', 'ยอดค่าใช้จ่ายผู้ป่วยในแยกตาม AN', 'SELECT i.an,i.hn,CONCAT(p.fname,\'  \',p.lname) as ptname,i.rgtdate,i.dchdate,sum(ict.rcptamt) as cost from ipt i JOIN incoth ict on ict.an=i.an JOIN pt p on p.hn=i.hn where i.dchdate BETWEEN ? AND ?  GROUP BY i.an ', null, null, '03', 'ไก่', '');
INSERT INTO `tsureport` VALUES ('12', 'Z11Chronic', 'SELECT id,s1 as \'ชื่อโรค\',s2 as \'icd10\',n1 as sums from tsu_temp_report WHERE reportname=\'TB_Z11\'', null, 'z11.txt', '14', 'มะยม', '');
INSERT INTO `tsureport` VALUES ('14', 'สุ่มเวชระเบียนที่ไม่ได้ตรวจโดยแพทย์ (ER) วันปกติ', 'SELECT o.hn,CONCAT(p.fname,\'  \',p.lname) as ptname,o.vstdttm,o.dct,n.dname,CASE WHEN DAYOFWEEK(o.vstdttm) IN (1,7) THEN \'holiday\' ELSE \'normalday\' END DayType  from ovst o JOIN pt p on p.hn=o.hn LEFT JOIN dct d on d.lcno=o.dct LEFT JOIN (SELECT CONCAT(fname,\'  \',lname) as dname,dct from dct where lcno =\'\') as n on n.dct = left(o.dct,2)  where date(o.vstdttm)  BETWEEN ? AND ?   and TIME(vstdttm) NOT BETWEEN \'08:00:00\' and \'16:00:00\'  and o.cln=\'20100\' and o.dct is not null  and d.fname is null and DAYOFWEEK(o.vstdttm) NOT IN (1,7) ORDER BY RAND() limit 20', null, null, '04', 'กฤษดา', 'กฤษดา');
INSERT INTO `tsureport` VALUES ('15', 'สุ่มเวชระเบียนที่ไม่ได้ตรวจโดยแพทย์ (ER) วันเสาร์-อาทิตย์ นักขัตฤกษ์', 'SELECT o.hn,CONCAT(p.fname,\"  \",p.lname) as ptname,o.vstdttm,o.dct,n.dname,DAYNAME(o.vstdttm) as daynamee from ovst o JOIN pt p on p.hn=o.hn LEFT JOIN dct d on d.lcno=o.dct LEFT JOIN (SELECT CONCAT(fname,\"  \",lname) as dname,dct from dct where lcno =\"\") as n on n.dct = left(o.dct,2) where date(o.vstdttm) BETWEEN ? and ? and o.cln=\"20100\" and o.dct is not null  and d.fname is null and DAYOFWEEK(o.vstdttm)  IN (1,7) ORDER BY RAND() limit 20 ', null, '36.pdf', '04', 'กฤษดา', 'สุ่มเวชระเบียนที่ไม่ได้ตรวจโดยแพทย์ (ER) วันเสาร์-อาทิตย์ นักขัตฤกษ์');
INSERT INTO `tsureport` VALUES ('23', 'จำนวนครั้งผู้ป่วย TB', 'SELECT \'TB Visit\',count(*) as num from ovstdx ox JOIN ovst o ON o.vn=ox.vn  WHERE date(o.vstdttm) BETWEEN ? AND ? AND ox.icd10 BETWEEN \"A150\" AND \"A160\"', null, null, '14', 'ยม', null);
INSERT INTO `tsureport` VALUES ('24', 'จำนวนครํ้งบริการ ANC', 'SELECT \'ANC Visit\',count(*) as num from ovstdx ox JOIN ovst o ON o.vn=ox.vn  WHERE date(o.vstdttm) BETWEEN ? AND ? AND ox.icd10 BETWEEN \"Z34\" AND \"Z35\"', null, null, '14', 'ยม', null);
INSERT INTO `tsureport` VALUES ('25', 'จำนวนครั้งบริการคุมกำเนิด FP', 'SELECT \'FP Visit\',count(*) as num from ovstdx ox JOIN ovst o ON o.vn=ox.vn  WHERE date(o.vstdttm) BETWEEN ? AND ? AND ox.icd10 BETWEEN \"Z304\" AND \"Z304\"', null, null, '14', 'มะยม', null);
INSERT INTO `tsureport` VALUES ('26', 'จำนวนครั้งบริการตรวจหลังคลอด', 'select reportname,s1 as \'namecare\',n1 from tsu_temp_report where reportname =\"post care\"', null, 'pp.txt', '14', 'มะยม', null);
INSERT INTO `tsureport` VALUES ('27', 'จำนวนครั้งบริการฉีดวัคซีน (EPI) หรือเปล่า', 'SELECT \'EPI Visit\',count(*) as num from ovstdx ox JOIN ovst o ON o.vn=ox.vn  WHERE date(o.vstdttm) BETWEEN ? AND ? AND ox.icd10 IN(\"Z240\",\"Z241\",\"Z271\",\"Z274\",\"Z246\")', '', '', '14', 'yom', '');
INSERT INTO `tsureport` VALUES ('29', 'ยอดค่าใช้จ่ายและจำนวนบริการคลินิกทันตกรรม', 'select s1 as \"ServiceType\", n1 as \"Visit\",n2 as \"Cost\"  from tsu_temp_report WHERE reportname=\"dentalCost\";', 'NULL', 'dentalCost_Visit.txt', '08', 'วิสันต์', 'NULL');
