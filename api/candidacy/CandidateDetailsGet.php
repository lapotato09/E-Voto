<?php
	session_start();
	include '../../includes/Conn.inc';

	$retArray = array();
	$array_data = array();

	$schoolidno = '';
	$stName = '';

	$stSchoolidno = '';
	$stLastname = '';
	$stFirstname = '';
	$stMiddlename = '';
	$stNameex = '';
	$stCourse = '';
	$stYear = '';
	$stMajor = '';
	$stDateenrolled = '';
	$stEntrytype = '';
	$stStatus = '';
	$nAge = '';
	$stGender = '';
	$stHeight = '';
	$stWeight = '';
	$stCivilstatus = '';
	$stReligion = '';
	$stContact = '';
	$stEmail = '';
	$stAddress = '';
	$stBirthdate= '';


	$userdata = json_decode($_REQUEST['data'], true);

	if (!empty($userdata['idno']) ) {
		$schoolidno = $userdata['idno'];
	}

	if (!empty($userdata['name']) ) {
		$stName = $userdata['name'];
	}

	$stSql = "" ;
	$stSql .= " SELECT DISTINCT p0.person00id, ";
	$stSql .= "		COALESCE(schoolidno, '') AS schoolidno, ";
	$stSql .= "		COALESCE(lastname, '') AS lastname, ";
	$stSql .= "		COALESCE(firstname, '') AS firstname, ";
	$stSql .= "		COALESCE(middlename, '') AS middlename, ";
	$stSql .= "		COALESCE(nameex, '') AS nameex, ";
	$stSql .= "		COALESCE(COURSE, '') AS COURSE, ";
	$stSql .= "		COALESCE(YEAR, '') AS YEAR, ";
	$stSql .= "		COALESCE(MAJOR, '') AS MAJOR, ";
	$stSql .= "		COALESCE(DATEENROLLED, '') AS DATEENROLLED, ";
	$stSql .= "		COALESCE(ENTRYTYPE, '') AS ENTRYTYPE, ";
	$stSql .= "		COALESCE(STATUS, '') AS STATUS, ";
	$stSql .= "		COALESCE(AGE, '') AS AGE, ";
	$stSql .= "		COALESCE(GENDER, '') AS GENDER, ";
	$stSql .= "		COALESCE(HEIGHT, '') AS HEIGHT, ";
	$stSql .= "		COALESCE(WEIGHT, '') AS WEIGHT, ";
	$stSql .= "		COALESCE(CIVILSTATUS, '') AS CIVILSTATUS, ";
	$stSql .= "		COALESCE(RELIGION, '') AS RELIGION, ";
	$stSql .= "		COALESCE(CONTACT, '') AS CONTACT, ";
	$stSql .= "		COALESCE(EMAIL, '') AS EMAIL, ";
	$stSql .= "		COALESCE(ADDRESS, '') AS ADDRESS, ";
	$stSql .= "		COALESCE(BIRTHDATE, '') AS BIRTHDATE ";
	$stSql .= "		FROM masterlist00 p0  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS COURSE FROM person02 WHERE fieldcode = 'COURSE') tb1  ";
	$stSql .= "		ON tb1.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS YEAR FROM person02 WHERE fieldcode = 'YEAR') tb2  ";
	$stSql .= "		ON tb2.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS MAJOR FROM person02 WHERE fieldcode = 'MAJOR') tb3  ";
	$stSql .= "		ON tb3.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS DATEENROLLED FROM person02 WHERE fieldcode = 'DATEENROLLED') tb4  ";
	$stSql .= "		ON tb4.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS ENTRYTYPE FROM person02 WHERE fieldcode = 'ENTRYTYPE') tb5  ";
	$stSql .= "		ON tb5.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS STATUS FROM person02 WHERE fieldcode = 'STATUS') tb6  ";
	$stSql .= "		ON tb6.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS AGE FROM person01 WHERE fieldcode = 'AGE') tb7  ";
	$stSql .= "		ON tb7.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS GENDER FROM person01 WHERE fieldcode = 'GENDER') tb8  ";
	$stSql .= "		ON tb8.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS HEIGHT FROM person01 WHERE fieldcode = 'HEIGHT') tb9  ";
	$stSql .= "		ON tb9.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS WEIGHT FROM person01 WHERE fieldcode = 'WEIGHT') tb10  ";
	$stSql .= "		ON tb10.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS CIVILSTATUS FROM person01 WHERE fieldcode = 'CIVILSTATUS') tb11  ";
	$stSql .= "		ON tb11.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS RELIGION FROM person01 WHERE fieldcode = 'RELIGION') tb12  ";
	$stSql .= "		ON tb12.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS CONTACT FROM person01 WHERE fieldcode = 'CONTACT') tb13  ";
	$stSql .= "		ON tb13.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS EMAIL FROM person01 WHERE fieldcode = 'EMAIL') tb14  ";
	$stSql .= "		ON tb14.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS ADDRESS FROM person01 WHERE fieldcode = 'ADDRESS') tb15  ";
	$stSql .= "		ON tb15.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id, fieldvalue AS BIRTHDATE FROM person01 WHERE fieldcode = 'BIRTHDATE') tb16  ";
	$stSql .= "		ON tb16.person00id = p0.person00id  ";
	$stSql .= "	LEFT JOIN (SELECT person00id,lastname,firstname,middlename,nameex FROM person00) tb17  ";
	$stSql .= "		ON tb17.person00id = p0.person00id  ";

	if ($stName != '' && $schoolidno != '') {
		$stSql .= " WHERE schoolidno = '". $schoolidno ."' AND lastname = '". $stName ."' ";
	}
	elseif ($stName != '') {
		$stSql .= " WHERE lastname = '". $stName ."' ";
	}
	elseif ($schoolidno != '') {
		$stSql .= " WHERE schoolidno = '". $schoolidno ."' ";
	}

	try {
		$result = mysqli_query($conn, $stSql);
		if (mysqli_num_rows($result) > 0) {
			while ($res = mysqli_fetch_array($result)) {
				# code...
				$stSchoolidno = $res['schoolidno'];
				$stLastname = $res['lastname'];
				$stFirstname = $res['firstname'];
				$stMiddlename = $res['middlename'];
				$stNameex = $res['nameex'];
				$stCourse = $res['COURSE'];
				$stYear = $res['YEAR'];
				$stMajor = $res['MAJOR'];
				$stDateenrolled = $res['DATEENROLLED'];
				$stEntrytype = $res['ENTRYTYPE'];
				$stStatus = $res['STATUS'];
				$nAge = $res['AGE'];
				$stGender = $res['GENDER'];
				$stHeight = $res['HEIGHT'];
				$stWeight = $res['WEIGHT'];
				$stCivilstatus = $res['CIVILSTATUS'];
				$stReligion = $res['RELIGION'];
				$stContact = $res['CONTACT'];
				$stEmail = $res['EMAIL'];
				$stAddress = $res['ADDRESS'];
				$stBirthdate= $res['BIRTHDATE'];

				// store to array

				$array_data = array(
					"schoolidno" => $stSchoolidno,
					"lastname" => $stLastname,
					"firstname" => $stFirstname,
					"middlename" => $stMiddlename,
					"nameex" => $stNameex,
					"course" => $stCourse,
					"year" => $stYear,
					"major" => $stMajor,
					"dateenrolled" => $stDateenrolled,
					"entrytype" => $stEntrytype,
					"status" => $stStatus,
					"age" => $nAge,
					"gender" => $stGender,
					"height" => $stHeight,
					"weight" => $stWeight,
					"civilstatus" => $stCivilstatus,
					"religion" => $stReligion,
					"contact" => $stContact,
					"email" => $stEmail,
					"address" => $stAddress,
					"birthdate" => $stBirthdate
				);

			}
			# code...
		}
	} catch (Exception $e) {
		$retArray = array(
			"data" => null,
			"message" => "Caught Exception: ". $e->getMessage(),
			"status" => "error"
		);

		print json_encode($retArray);
		exit();
		
	}

	$retArray = array(
		"data" => $array_data,
		"status" => "success"
	);

	print json_encode($retArray);


?>