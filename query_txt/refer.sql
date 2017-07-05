DELETE FROM tsu_temp_report WHERE reportname='ReferByIcd10TotalByMonth' ;
set @startdate = '2015-10-01';
set @enddate = '2016-09-30';
set @start_icd10 = 'I20';
set @end_icd10 = 'I52';
INSERT INTO tsu_temp_report(id,reportname,s1,s2,date1,date2,n1,n2,n3,n4,n5,n6,n7,n8,n9,n10,n11,n12,n13)
SELECT  
	1,
	'ReferByIcd10TotalByMonth',
	'‚√§À—«„®',
	CONCAT(@start_icd10 ,'-', @end_icd10),
	@startdate,@enddate,
	
         -- outer query labels rollup row 
  sums.10, sums.11, sums.12,   sums.01, sums.02, sums.03,   sums.04, sums.05, sums.06,   sums.07, sums.08, sums.09 ,     -- and calculates horizontal sums 
  sums.10 + sums.11 + sums.12 + sums.01+ sums.02+ sums.03+   sums.04+ sums.05+ sums.06+   sums.07+ sums.08+ sums.09 AS Sums 
FROM (                                   -- inner query groups by employee 
  SELECT                                 -- with an expression for each column 
    icd10, 
    COUNT(IF(MONTH(vstdate)=10,vn,NULL)) As '10', 
    COUNT(IF(MONTH(vstdate)=11,vn,NULL)) As '11', 
    COUNT(IF(MONTH(vstdate)=12,vn,NULL)) As '12',
	  COUNT(IF(MONTH(vstdate)=1,vn,NULL)) As '01', 
    COUNT(IF(MONTH(vstdate)=2,vn,NULL)) As '02', 
    COUNT(IF(MONTH(vstdate)=3,vn,NULL)) As '03',
	  COUNT(IF(MONTH(vstdate)=4,vn,NULL)) As '04', 
    COUNT(IF(MONTH(vstdate)=5,vn,NULL)) As '05', 
    COUNT(IF(MONTH(vstdate)=6,vn,NULL)) As '06',
	  COUNT(IF(MONTH(vstdate)=7,vn,NULL)) As '07', 
    COUNT(IF(MONTH(vstdate)=8,vn,NULL)) As '08', 
    COUNT(IF(MONTH(vstdate)=9,vn,NULL)) As '09'
  FROM orfro 
  WHERE vstdate BETWEEN @startdate and @enddate AND icd10 BETWEEN @start_icd10 AND  @end_icd10 and icd10<>'I213'
  #GROUP BY icd10 WITH ROLLUP 
) AS sums ; 
set @start_icd10 = 'I213';
set @end_icd10 = 'I213';
INSERT INTO tsu_temp_report(id,reportname,s1,s2,date1,date2,n1,n2,n3,n4,n5,n6,n7,n8,n9,n10,n11,n12,n13)
SELECT  
	2,
	'ReferByIcd10TotalByMonth',
	'STEMI',
	CONCAT(@start_icd10 ,'-', @end_icd10),
  @startdate,@enddate,       -- outer query labels rollup row 
  sums.10, sums.11, sums.12,   sums.01, sums.02, sums.03,   sums.04, sums.05, sums.06,   sums.07, sums.08, sums.09 ,     -- and calculates horizontal sums 
  sums.10 + sums.11 + sums.12 + sums.01+ sums.02+ sums.03+   sums.04+ sums.05+ sums.06+   sums.07+ sums.08+ sums.09 AS Sums 
FROM (                                   -- inner query groups by employee 
  SELECT                                 -- with an expression for each column 
    icd10, 
    COUNT(IF(MONTH(vstdate)=10,vn,NULL)) As '10', 
    COUNT(IF(MONTH(vstdate)=11,vn,NULL)) As '11', 
    COUNT(IF(MONTH(vstdate)=12,vn,NULL)) As '12',
	  COUNT(IF(MONTH(vstdate)=1,vn,NULL)) As '01', 
    COUNT(IF(MONTH(vstdate)=2,vn,NULL)) As '02', 
    COUNT(IF(MONTH(vstdate)=3,vn,NULL)) As '03',
	  COUNT(IF(MONTH(vstdate)=4,vn,NULL)) As '04', 
    COUNT(IF(MONTH(vstdate)=5,vn,NULL)) As '05', 
    COUNT(IF(MONTH(vstdate)=6,vn,NULL)) As '06',
	  COUNT(IF(MONTH(vstdate)=7,vn,NULL)) As '07', 
    COUNT(IF(MONTH(vstdate)=8,vn,NULL)) As '08', 
    COUNT(IF(MONTH(vstdate)=9,vn,NULL)) As '09'
  FROM orfro 
  WHERE vstdate BETWEEN @startdate and @enddate AND icd10 BETWEEN @start_icd10 AND  @end_icd10 
  #GROUP BY icd10 WITH ROLLUP 
) AS sums ; 
set @start_icd10 = 'C00';
set @end_icd10 = 'C99';
INSERT INTO tsu_temp_report(id,reportname,s1,s2,date1,date2,n1,n2,n3,n4,n5,n6,n7,n8,n9,n10,n11,n12,n13)
SELECT  
	3,
	'ReferByIcd10TotalByMonth',
	'¡–‡√Áß',
	CONCAT(@start_icd10 ,'-', @end_icd10),
  @startdate,@enddate,       -- outer query labels rollup row 
  sums.10, sums.11, sums.12,   sums.01, sums.02, sums.03,   sums.04, sums.05, sums.06,   sums.07, sums.08, sums.09 ,     -- and calculates horizontal sums 
  sums.10 + sums.11 + sums.12 + sums.01+ sums.02+ sums.03+   sums.04+ sums.05+ sums.06+   sums.07+ sums.08+ sums.09 AS Sums 
FROM (                                   -- inner query groups by employee 
  SELECT                                 -- with an expression for each column 
    icd10, 
    COUNT(IF(MONTH(vstdate)=10,vn,NULL)) As '10', 
    COUNT(IF(MONTH(vstdate)=11,vn,NULL)) As '11', 
    COUNT(IF(MONTH(vstdate)=12,vn,NULL)) As '12',
	  COUNT(IF(MONTH(vstdate)=1,vn,NULL)) As '01', 
    COUNT(IF(MONTH(vstdate)=2,vn,NULL)) As '02', 
    COUNT(IF(MONTH(vstdate)=3,vn,NULL)) As '03',
	  COUNT(IF(MONTH(vstdate)=4,vn,NULL)) As '04', 
    COUNT(IF(MONTH(vstdate)=5,vn,NULL)) As '05', 
    COUNT(IF(MONTH(vstdate)=6,vn,NULL)) As '06',
	  COUNT(IF(MONTH(vstdate)=7,vn,NULL)) As '07', 
    COUNT(IF(MONTH(vstdate)=8,vn,NULL)) As '08', 
    COUNT(IF(MONTH(vstdate)=9,vn,NULL)) As '09'
  FROM orfro 
  WHERE vstdate BETWEEN @startdate and @enddate AND icd10 BETWEEN @start_icd10 AND  @end_icd10 
  #GROUP BY icd10 WITH ROLLUP 
) AS sums ; 
set @start_icd10 = 'Z380';
set @end_icd10 = 'Z388';
INSERT INTO tsu_temp_report(id,reportname,s1,s2,date1,date2,n1,n2,n3,n4,n5,n6,n7,n8,n9,n10,n11,n12,n13)
SELECT  
	4,
	'ReferByIcd10TotalByMonth',
	'∑“√°·√°‡°‘¥',
	CONCAT(@start_icd10 ,'-', @end_icd10),
  @startdate,@enddate,     -- outer query labels rollup row 
  sums.10, sums.11, sums.12,   sums.01, sums.02, sums.03,   sums.04, sums.05, sums.06,   sums.07, sums.08, sums.09 ,     -- and calculates horizontal sums 
  sums.10 + sums.11 + sums.12 + sums.01+ sums.02+ sums.03+   sums.04+ sums.05+ sums.06+   sums.07+ sums.08+ sums.09 AS Sums 
FROM (                                   -- inner query groups by employee 
  SELECT                                 -- with an expression for each column 
    icd10, 
    COUNT(IF(MONTH(vstdate)=10,vn,NULL)) As '10', 
    COUNT(IF(MONTH(vstdate)=11,vn,NULL)) As '11', 
    COUNT(IF(MONTH(vstdate)=12,vn,NULL)) As '12',
	  COUNT(IF(MONTH(vstdate)=1,vn,NULL)) As '01', 
    COUNT(IF(MONTH(vstdate)=2,vn,NULL)) As '02', 
    COUNT(IF(MONTH(vstdate)=3,vn,NULL)) As '03',
	  COUNT(IF(MONTH(vstdate)=4,vn,NULL)) As '04', 
    COUNT(IF(MONTH(vstdate)=5,vn,NULL)) As '05', 
    COUNT(IF(MONTH(vstdate)=6,vn,NULL)) As '06',
	  COUNT(IF(MONTH(vstdate)=7,vn,NULL)) As '07', 
    COUNT(IF(MONTH(vstdate)=8,vn,NULL)) As '08', 
    COUNT(IF(MONTH(vstdate)=9,vn,NULL)) As '09'
  FROM orfro 
  WHERE vstdate BETWEEN @startdate and @enddate AND icd10 BETWEEN @start_icd10 AND  @end_icd10 
  #GROUP BY icd10 WITH ROLLUP 
) AS sums ; 
set @start_icd10 = 'I64';
set @end_icd10 = 'I64';
INSERT INTO tsu_temp_report(id,reportname,s1,s2,date1,date2,n1,n2,n3,n4,n5,n6,n7,n8,n9,n10,n11,n12,n13)
SELECT  
	5,
	'ReferByIcd10TotalByMonth',
	'STROKE',
	CONCAT(@start_icd10 ,'-', @end_icd10),
  @startdate,@enddate,       -- outer query labels rollup row 
  sums.10, sums.11, sums.12,   sums.01, sums.02, sums.03,   sums.04, sums.05, sums.06,   sums.07, sums.08, sums.09 ,     -- and calculates horizontal sums 
  sums.10 + sums.11 + sums.12 + sums.01+ sums.02+ sums.03+   sums.04+ sums.05+ sums.06+   sums.07+ sums.08+ sums.09 AS Sums 
FROM (                                   -- inner query groups by employee 
  SELECT                                 -- with an expression for each column 
    icd10, 
    COUNT(IF(MONTH(vstdate)=10,vn,NULL)) As '10', 
    COUNT(IF(MONTH(vstdate)=11,vn,NULL)) As '11', 
    COUNT(IF(MONTH(vstdate)=12,vn,NULL)) As '12',
	  COUNT(IF(MONTH(vstdate)=1,vn,NULL)) As '01', 
    COUNT(IF(MONTH(vstdate)=2,vn,NULL)) As '02', 
    COUNT(IF(MONTH(vstdate)=3,vn,NULL)) As '03',
	  COUNT(IF(MONTH(vstdate)=4,vn,NULL)) As '04', 
    COUNT(IF(MONTH(vstdate)=5,vn,NULL)) As '05', 
    COUNT(IF(MONTH(vstdate)=6,vn,NULL)) As '06',
	  COUNT(IF(MONTH(vstdate)=7,vn,NULL)) As '07', 
    COUNT(IF(MONTH(vstdate)=8,vn,NULL)) As '08', 
    COUNT(IF(MONTH(vstdate)=9,vn,NULL)) As '09'
  FROM orfro 
  WHERE vstdate BETWEEN @startdate and @enddate AND icd10 BETWEEN @start_icd10 AND  @end_icd10 
  #GROUP BY icd10 WITH ROLLUP 
) AS sums ; 
set @start_icd10 = 'Z380';
set @end_icd10 = 'Z388';
INSERT INTO tsu_temp_report(id,reportname,s1,s2,date1,date2,n1,n2,n3,n4,n5,n6,n7,n8,n9,n10,n11,n12,n13)
SELECT  
	6,
	'ReferByIcd10TotalByMonth',
	'Accident by Transfer',
	'V00 - V299',
  @startdate,@enddate,       -- outer query labels rollup row 
  sums.10, sums.11, sums.12,   sums.01, sums.02, sums.03,   sums.04, sums.05, sums.06,   sums.07, sums.08, sums.09 ,     -- and calculates horizontal sums 
  sums.10 + sums.11 + sums.12 + sums.01+ sums.02+ sums.03+   sums.04+ sums.05+ sums.06+   sums.07+ sums.08+ sums.09 AS Sums 
FROM (                                   -- inner query groups by employee 
  SELECT                                 -- with an expression for each column 
    o.icd10, 
    COUNT(IF(MONTH(vstdate)=10,o.vn,NULL)) As '10', 
    COUNT(IF(MONTH(vstdate)=11,o.vn,NULL)) As '11', 
    COUNT(IF(MONTH(vstdate)=12,o.vn,NULL)) As '12',
	  COUNT(IF(MONTH(vstdate)=1,o.vn,NULL)) As '01', 
    COUNT(IF(MONTH(vstdate)=2,o.vn,NULL)) As '02', 
    COUNT(IF(MONTH(vstdate)=3,o.vn,NULL)) As '03',
	  COUNT(IF(MONTH(vstdate)=4,o.vn,NULL)) As '04', 
    COUNT(IF(MONTH(vstdate)=5,o.vn,NULL)) As '05', 
    COUNT(IF(MONTH(vstdate)=6,o.vn,NULL)) As '06',
	  COUNT(IF(MONTH(vstdate)=7,o.vn,NULL)) As '07', 
    COUNT(IF(MONTH(vstdate)=8,o.vn,NULL)) As '08', 
    COUNT(IF(MONTH(vstdate)=9,o.vn,NULL)) As '09'
  FROM orfro  o join emergency e  on o.vn=e.vn
  WHERE o.vstdate BETWEEN @startdate and @enddate AND e.aetype_ae='01'
  #GROUP BY icd10 WITH ROLLUP 
) AS sums ; 
set @start_icd10 = 'A40';
set @end_icd10 = 'A42';
INSERT INTO tsu_temp_report(id,reportname,s1,s2,date1,date2,n1,n2,n3,n4,n5,n6,n7,n8,n9,n10,n11,n12,n13)
SELECT  
	5,
	'ReferByIcd10TotalByMonth',
	'Sepsis',
	CONCAT(@start_icd10 ,'-', @end_icd10),
  @startdate,@enddate,       -- outer query labels rollup row 
  sums.10, sums.11, sums.12,   sums.01, sums.02, sums.03,   sums.04, sums.05, sums.06,   sums.07, sums.08, sums.09 ,     -- and calculates horizontal sums 
  sums.10 + sums.11 + sums.12 + sums.01+ sums.02+ sums.03+   sums.04+ sums.05+ sums.06+   sums.07+ sums.08+ sums.09 AS Sums 
FROM (                                   -- inner query groups by employee 
  SELECT                                 -- with an expression for each column 
    icd10, 
    COUNT(IF(MONTH(vstdate)=10,vn,NULL)) As '10', 
    COUNT(IF(MONTH(vstdate)=11,vn,NULL)) As '11', 
    COUNT(IF(MONTH(vstdate)=12,vn,NULL)) As '12',
	  COUNT(IF(MONTH(vstdate)=1,vn,NULL)) As '01', 
    COUNT(IF(MONTH(vstdate)=2,vn,NULL)) As '02', 
    COUNT(IF(MONTH(vstdate)=3,vn,NULL)) As '03',
	  COUNT(IF(MONTH(vstdate)=4,vn,NULL)) As '04', 
    COUNT(IF(MONTH(vstdate)=5,vn,NULL)) As '05', 
    COUNT(IF(MONTH(vstdate)=6,vn,NULL)) As '06',
	  COUNT(IF(MONTH(vstdate)=7,vn,NULL)) As '07', 
    COUNT(IF(MONTH(vstdate)=8,vn,NULL)) As '08', 
    COUNT(IF(MONTH(vstdate)=9,vn,NULL)) As '09'
  FROM orfro 
  WHERE vstdate BETWEEN @startdate and @enddate AND icd10 BETWEEN @start_icd10 AND  @end_icd10 
  #GROUP BY icd10 WITH ROLLUP 
) AS sums ; 
set @start_icd10 = 'J960';
set @end_icd10 = 'J960';
INSERT INTO tsu_temp_report(id,reportname,s1,s2,date1,date2,n1,n2,n3,n4,n5,n6,n7,n8,n9,n10,n11,n12,n13)
SELECT  
	6,
	'ReferByIcd10TotalByMonth',
	'Respiratory Failur',
	CONCAT(@start_icd10 ,'-', @end_icd10),
  @startdate,@enddate,       -- outer query labels rollup row 
  sums.10, sums.11, sums.12,   sums.01, sums.02, sums.03,   sums.04, sums.05, sums.06,   sums.07, sums.08, sums.09 ,     -- and calculates horizontal sums 
  sums.10 + sums.11 + sums.12 + sums.01+ sums.02+ sums.03+   sums.04+ sums.05+ sums.06+   sums.07+ sums.08+ sums.09 AS Sums 
FROM (                                   -- inner query groups by employee 
  SELECT                                 -- with an expression for each column 
    icd10, 
    COUNT(IF(MONTH(vstdate)=10,vn,NULL)) As '10', 
    COUNT(IF(MONTH(vstdate)=11,vn,NULL)) As '11', 
    COUNT(IF(MONTH(vstdate)=12,vn,NULL)) As '12',
	  COUNT(IF(MONTH(vstdate)=1,vn,NULL)) As '01', 
    COUNT(IF(MONTH(vstdate)=2,vn,NULL)) As '02', 
    COUNT(IF(MONTH(vstdate)=3,vn,NULL)) As '03',
	  COUNT(IF(MONTH(vstdate)=4,vn,NULL)) As '04', 
    COUNT(IF(MONTH(vstdate)=5,vn,NULL)) As '05', 
    COUNT(IF(MONTH(vstdate)=6,vn,NULL)) As '06',
	  COUNT(IF(MONTH(vstdate)=7,vn,NULL)) As '07', 
    COUNT(IF(MONTH(vstdate)=8,vn,NULL)) As '08', 
    COUNT(IF(MONTH(vstdate)=9,vn,NULL)) As '09'
  FROM orfro 
  WHERE vstdate BETWEEN @startdate and @enddate AND icd10 BETWEEN @start_icd10 AND  @end_icd10 
  #GROUP BY icd10 WITH ROLLUP 
) AS sums ; 

