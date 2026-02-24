From Excel : Program Zip Restrictions sheet
Take COLUMNS
Program Code (H COLUMN)
Postal Code (I COLUMN)
Campus Code (D COLUMN)
Now Save file with all 3 columns with name campus.txt
------ IN ORDER TO CREATE LAST COLUMN "ECW_Program_code" Do the following steps 
=========== BERKELEY CAMPUS ==========
mysql --local-infile=1 -u root -p12345678
mysql> SET GLOBAL local_infile=1;
mysql> quit

mysql --local-infile=1 -u root -p12345678

 mysql>use eliteedu;

load data local infile '/Users/vipulbhandari/Downloads/campus.txt' into table berkeley_active_zipcode_campus fields terminated by '\t' enclosed by '"' escaped by '\\' lines terminated by '\n' ignore 1 rows;

-------------------------
UPDATE `berkeley_active_zipcode_campus` AS A,program_of_interest_quinstreet AS B SET A.`ECW_Program_code` = B.code WHERE B.QMP_program_code = A.program_code;
----------------------
UPDATE berkeley_active_zipcode_campus set campus_code= TRIM(Replace(Replace(Replace(`campus_code`,'\t',''),'\n',''),'\r',''));
----------------------
UPDATE `edu_zipcodes` SET `status`=0 where `lender_id`=24 and campus_code <> 'ONL';
----------------------
UPDATE edu_zipcodes AS B JOIN berkeley_active_zipcode_campus AS A ON A.ECW_Program_code = B.program_of_interest_code SET B.status=1 WHERE B.lender_id=24 AND A.postal_code=B.zipcode AND A.campus_code=B.campus_code;
======================BERKELEY CAMPUS=============================

send sushil these zipcodes/program/campus from berkeley
SELECT `zipcode`, `program_of_interest_code`, `campus_code` FROM `edu_zipcodes` WHERE `lender_id`=24 and `status`=1 and `campus_code`!='ONL';

