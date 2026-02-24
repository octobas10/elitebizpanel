=========ECPI =======================Take Campus Code,Zip,State Code=========ECPI =======================

mysql --local-infile=1 -u root -p12345678
mysql> SET GLOBAL local_infile=1;
mysql> quit

mysql --local-infile=1 -u root -p12345678

 mysql>use eliteedu;


load data local infile '/Users/vipulbhandari/Downloads/ecpi.txt' into table ecpi_active_zipcode_campus fields terminated by '\t' enclosed by '"' escaped by '\\' lines terminated by '\n' ignore 1 rows;

UPDATE `ecpi_active_zipcode_campus` AS A,campuses AS B SET A.`campus_code` = B.campus_code WHERE B.campus_id = A.campus_id;------------------
UPDATE ecpi_active_zipcode_campus set `campus_id`= TRIM(Replace(Replace(Replace(`campus_id`,'\t',''),'\n',''),'\r',''));
UPDATE ecpi_active_zipcode_campus set `campus_code`= TRIM(Replace(Replace(Replace(`campus_code`,'\t',''),'\n',''),'\r',''));

--- GET ALL PROGRAMS FROM ccmp.cloudcontrol.media column F (Program Code) in IN() clause ------
select DISTINCT code from program_of_interest_quinstreet_ecpi where QMP_program_code IN ('BSN','CLOUDCOM','CYBNETSY','EET','EETBS','HCADMIN','MECHASSO','MECHATRO','MEDASSDP','MEDASST','MOBDEV','PRACNURS','RN','SOFTDEVE','ACCOUNT','BSBA','CJCIA','CRJBS','DMS','ESET','ESETMEC','HOMELAND','DENTAL','MEDRAD','SURTECH','ACLBSN','PHYTHER','MET','META','PAMEDIC');
---------- above step is not needed as our and ecpi programs code are same
----NOW DOWNLOAD code FROM DATABASE TO EXCEL AND PUSH IT IN BELOW QUERY
UPDATE `edu_zipcodes` SET `status`=0 where `lender_id`=26;
----------------------
UPDATE edu_zipcodes AS B JOIN ecpi_active_zipcode_campus AS A SET B.status=1 WHERE A.campus_code=B.campus_code and lender_id=26 AND A.zipcode=B.zipcode AND B.program_of_interest_code IN('BSN','CLOUDCOM','CYBNSBS','EET','EETBS','MECHASSO','MECHATRO','MEDASSDP','MEDASST','MOBDEV','PRACNURS','RN','SOFTDEVE','HCADMIN','ACCOUNT','BSBA','CJCIA','CRJBS','ESET','ESETMEC','HOMELAND','DENTAL','MEDRAD','SURTECH','PHYTHER','MET','META','DMS','PAMEDIC','CYBNETSY','ACLBSN')

SELECT `zipcode`,`program_of_interest_code`,`campus_code` FROM `edu_zipcodes` WHERE status=1 and `lender_id`=26;