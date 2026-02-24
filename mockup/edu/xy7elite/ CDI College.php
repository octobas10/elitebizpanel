<?php
$host = 'localhost';
if($_SERVER['REMOTE_ADDR'] == '::1'){
	$user = 'root';
	$pass = '12345678';
}else{
	$user = 'axiom';
	$pass = '7anAZewE';
}
$db = 'eliteedu';
ini_set('memory_limit','1000M');
ini_set("max_execution_time", "30000");

$link=@mysqli_connect($host,$user,$pass,$db) or die("Can not connect.".mysqli_error());
// ====> AB North
//1022-Accounting And Payroll Administration
//41417-Addictions And Community Services Worker	
//1026-Business Administrative Professional	
//41460-Business And Digital Marketing Management	
//39140-Child And Youth Services Worker	
//38140-Computer Support Technician	
//41261-Cybersecurity Specialist	
//38376-Dental Assisting	
//41457-Education Assistant	
//41238-Graphic Design Technology	
//41173-Human Resources Administration	
//41286-Human Resources And Payroll Coordinator	
//41299-Immigration Assistant	
//41182-Logistics & Supply Chain Management	
//1010-Medical Office Administration	
//41437-Network Systems Administrator	
//38952-Network Systems Management	
//37499-Paralegal
//37885-Pharmacy Assistant	
//41186-Social Media And Web Marketing	
//41252-Web And Mobile Applications Development	
// ====>AB SOUTH
//1022-Accounting And Payroll Administration	
//41417-Addictions And Community Services Worker	
//1026-Business Administrative Professional	
//41460-Business And Digital Marketing Management	
//39140-Child And Youth Services Worker	
//38140-Computer Support Technician	
//41261-Cybersecurity Specialist	
//38376-Dental Assisting	
//41457-Hospitality Business Management	
//38953-Hospitality Business Management	
//41173-Human Resources Administration	
//41286-Human Resources And Payroll Coordinator	
//41182-Logistics & Supply Chain Management	
//41246-Massage Therapist – 2400	
//1010-Medical Office Administration	
//41437-Network Systems Administrator	
//38952-Network Systems Management	
//1028-Oil & Gas Administration	
//37499-ParalegalParalegal
//37885-Pharmacy Assistant	
//41186-Social Media And Web Marketing	
//1005-Travel And Tourism	
//41166-Veterinary Health Care Assistant	
//41252-Web And Mobile Applications Development	
//======>BC
//41567-Business Technology Management	
//41529-Cybersecurity Technician Year 2	
//41436-Dental Assisting	
//41530-Dental Assisting Year 2	
//1017-Early Childhood Education	
//41531-Early Childhood Education Diploma Year 2	
//41542-Early Childhood Education: Infant/Toddler Educator Diploma Year 2	
//41532-Early Childhood Education: Special Needs Educator Diploma Year 2	
//41178-Education Assistant	
//38844-Hospitality Management	
//41533-Human Resources And Payroll Coordinator Year 2	
//996-Legal Administrative Assistant	
//998-Medical Laboratory Assistant	
//41424-Paralegal
//41536-Paralegal Year 2	
//41428-Pharmacy Assistant	
//37253-Practical Nursing	
//41537-Practical Nursing Year 2	
//40245-Registered Massage Therapy	
//41543-Registered Massage Therapy Year 2	
//41079-Social Services Worker Professional	
//41540-Social Services Worker Professional Year 2	
//41571-Sustainable Business Management	
//41359-User Interface (UI) And User Experience (UX) Design	
//41455-Veterinary Health Care Assistant	
//41541-Web And Mobile Applications Development Year 2	
//======>Central
//41447-Accounting And Payroll Administrator	
//37884-Accounting Assistant / Bookkeeper	
//41177-Addictions Recovery Support For Youth And Families	
//41398-Business Administration	
//41449-Child And Youth Services Worker	
//999-Computer Business Applications Specialist	
//41480-Cybersecurity Specialist	
//41528-Dental Assisting	
//41458-Education Assistant	
//38021-Graphic Design	
//41471-Graphic Design Technology	
//41422-Health Care Aide	
//41442-Hospitality Management	
//41488-Immigration Assistant	
//1060-Medical Office Administrator	
//41385-NACC Personal Support Worker DE 2022	
//1042-Network And Database Administrator	
//41433-Network Systems Engineer	
//1041-Office Assistant	
//41498-Office Assistant	
//41425-Paralegal
//39770-Preventative Dentistry Scaling	
//41404-Rehabilitation Therapy Assistant	
//41468-Social Media And Web Marketing	
//41165-Supply Chain Management	
//41490-Warehouse And Distribution Management	
//41478-Web And Mobile Applications Development	
// Online
//1022-Accounting And Payroll Administration	
//41417-Addictions And Community Services Worker	
//41460-Business And Digital Marketing Management	
//39140-Child And Youth Services Worker	
//41261-Cybersecurity Specialist	
//41457-Education Assistant	
//38021-Graphic Design	
//41238-Graphic Design Technology	
//38844-Hospitality Management	
//996-Legal Administrative Assistant	
//41433-Network Systems Engineer	
//1028-Oil & Gas Administration	
//41424-Paralegal
//41429-Pharmacy Assistant	
//41359-User Interface (UI) And User Experience (UX) Design	
//41455-Veterinary Health Care Assistant	
//41478-Web And Mobile Applications Development	
//Quebec
//41366-3D Modeling Animation Art And Design – NTL.0Z	
//41361-Artificial Intelligence Specialist – LEA.E3	
//37464-Assistance À La Personne En Établissement De Santé - 5316	
//41267-Assistance À La Personne En Établissement Et À Domicile (5358)	
//37465-Assistance Dentaire - 5144	
//41363-Computer Network Management – LEA.AE	
//41377-Conception, Modélisation Et Animation 3D - NTL.0Z	
//41307-Cybersecurity Specialist – LEA.DV	
//41367-Dental Assistance – 5644	
//41277-Design Graphique - NTA.1U	
//41376-Design Web - LCA.C0	
//41368-Early Childhood Education – JEE.13	
//41369-Financial Management – LEA.AC	
//41274-Gestion De L’Approvisionnement (LCA.FL)	
//38782-Gestion De Réseaux - LEA.AE	
//41275-Gestion Des Medias Sociaux (NWY.1W)	
//38778-Gestion Financière Informatisée (LEA.AC)	
//41370-Graphic Design – NTA.1U	
//41268-Institutional And Home Care Assistance – 5858	
//41371-Paralegal Technology – JCA.1F	
//1043-Programmer Analyst – LEA.9C	
//38783-Programmeur-Analyste – LEA.9C	
//37463-Santé, Assistance Et Soins Infirmiers (5325)	
//41279-Social Media Management – NWY.1W	
//41278-Special Care Counselling – JNC.1U	
//41373-Specialist In Applied Information Technology, Medical / Legal Adm. Option – LCE.3V	
//41305-Spécialiste En Cybersécurité - LEA.DV	
//41364-Spécialiste En Intelligence Artificielle - LEA.E3	
//38787-Spécialiste En Technologies Appliquées À La Bureautique, Option Adm. Médical/Juridique – LCE.3V	
//41280-Supply Chain Management – LCA.FL	
//41276-Techniques D’Éducation Specialisee (JNC.1U)	
//38786-Techniques D'éducation À L'enfance (JEE.13)	
//39638-Techniques Juridiques - JCA.1F	
//41372-Web Design - LCA.C0
//390548
$zipcodes = ['K1A 0A1'];
$lender_id='29';
$campus_code='EDMONTONCITYCENTRE';
$brand_id = 381;
$sql_programs = "SELECT GROUP_CONCAT(`ecw_program_code`) as ecw_programs FROM `program_of_interest_xy7elite` WHERE find_in_set(".$brand_id.",`brand_id`)";
$resultp = mysqli_query($link,$sql_programs);
$rowp = mysqli_fetch_assoc($resultp);
$programs = explode(',', $rowp['ecw_programs']);
foreach ($zipcodes as $zipcode){
	$sql_city_state = "SELECT `city`, `state_code` as state,`lat`,`lng` FROM `canada_zipcodes` WHERE `zipcode`='".$zipcode."'";
	$result = mysqli_query($link,$sql_city_state);
	$row = mysqli_fetch_array($result);
	$city = $row['city'];$state = $row['state'];$lat = $row['lat'];$lng = $row['lng'];
	foreach ($programs as $program){
		$sql="INSERT INTO edu_zipcodes (zipcode,lender_id,city,state,program_of_interest_code,campus_code,lng,lat,status) values ('$zipcode','$lender_id','$city','$state','$program','$campus_code','$lat','$lng',1);";
		echo $sql;
		//echo '<br>';exit;
		$values=mysqli_query($link,$sql);
	}
}

//$values=mysql_query($sql);