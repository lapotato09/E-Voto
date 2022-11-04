<?php

	session_start();
	include '../../../includes/Conn.inc';

	$looper = array();
	$collection = array();
	$responseCollection = array();

	$nPerson00id = 0;
	$stSchoolIdNo = "";
	$stLastName = "";
	$stFirstName = "";
	$stMiddleName = "";
	$stNameEx = "";
	$stCourse = "";
	$stMajor = "";
	$stEntrytype = "";
	$stDateenrolled = "";
	$stStatus = "";

	$stSql = "";
	$stSql .= " SELECT ";
	$stSql .= "		masterlist00id, ";
	$stSql .= "		masterlist00.person00id, ";
	$stSql .= "		masterlist00.active, ";
	$stSql .= "		schoolidno, ";
	$stSql .= "		lastname, ";
	$stSql .= "		firstname, ";
	$stSql .= "		middlename, ";
	$stSql .= "		nameex, ";
	$stSql .= "		COALESCE(course.fieldvalue, '') AS course , ";
	$stSql .= "		COALESCE(major.fieldvalue, '') AS major , ";
	$stSql .= "		COALESCE(entrytype.fieldvalue, '') AS entrytype , ";
	$stSql .= "		COALESCE(dateenrolled.fieldvalue, '') AS dateenrolled , ";
	$stSql .= "		COALESCE(status.fieldvalue, '') AS status ";
	$stSql .= "	FROM masterlist00 ";
	$stSql .= " LEFT JOIN person00 " ;
	$stSql .= " ON person00.person00id = masterlist00.person00id " ;
	$stSql .= " LEFT JOIN ( ";
	$stSql .= " 	SELECT person00id, fieldcode, fieldvalue FROM person02 ";
	$stSql .= " 	WHERE fieldcode = 'COURSE' ";
	$stSql .= " 	) course ";
	$stSql .= " 	ON course.person00id = masterlist00.person00id ";
	$stSql .= " LEFT JOIN ( ";
	$stSql .= " 	SELECT person00id, fieldcode, fieldvalue FROM person02 ";
	$stSql .= " 	WHERE fieldcode = 'MAJOR' ";
	$stSql .= " 	) major ";
	$stSql .= " 	ON major.person00id = masterlist00.person00id ";
	$stSql .= " LEFT JOIN ( ";
	$stSql .= " 	SELECT person00id, fieldcode, fieldvalue FROM person02 ";
	$stSql .= " 	WHERE fieldcode = 'ENTRYTYPE' ";
	$stSql .= " 	) entrytype ";
	$stSql .= " 	ON entrytype.person00id = masterlist00.person00id ";
	$stSql .= " LEFT JOIN ( ";
	$stSql .= " 	SELECT person00id, fieldcode, fieldvalue FROM person02 ";
	$stSql .= " 	WHERE fieldcode = 'DATEENROLLED' ";
	$stSql .= " 	) dateenrolled ";
	$stSql .= " 	ON dateenrolled.person00id = masterlist00.person00id ";
	$stSql .= " LEFT JOIN ( ";
	$stSql .= " 	SELECT person00id, fieldcode, fieldvalue FROM person02 ";
	$stSql .= " 	WHERE fieldcode = 'STATUS' ";
	$stSql .= " 	) status ";
	$stSql .= " 	ON status.person00id = masterlist00.person00id ";
	$stSql .= " WHERE masterlist00.active = 1 " ;
	$stSql .= " AND masterlist00.person00id <> 0 " ;

	try {
		$retval = mysqli_query($conn, $stSql);
		if (mysqli_num_rows($retval) > 0 ) {
			while ($res = mysqli_fetch_array($retval)) {
				$nPerson00id	= $res['person00id'];
				$stSchoolIdNo = $res['schoolidno'];
				$stLastName		= $res['lastname'];
				$stFirstName	= $res['firstname'];
				$stMiddleName	= $res['middlename'];
				$stNameEx			= $res['nameex'];
				$stCourse 		= $res['course'];
				$stMajor			= $res['major'];
				$stEntrytype 	= $res['entrytype'];
				$stDateenrolled = $res['dateenrolled'];
				$stStatus			= $res['status'];

				if ($stStatus == 'REG') {
					$stStatus = "Regular";
				}

				$looper = array(
					'person00id' => $nPerson00id,
					'schoolidno' => $stSchoolIdNo,
					'lastname' => $stLastName,
					'firstname' => $stFirstName,
					'middlename' => $stMiddleName,
					'nameex' => $stNameEx,
					'course' => $stCourse,
					'major' => $stMajor,
					'entrytype' => $stEntrytype,
					'dateenrolled' => $stDateenrolled,
					'status' => $stStatus
				);

				array_push($collection, $looper);

			}
		}
	} catch (Exception $e) {
		$responseCollection = array(
			"data" => null,
			"status" => "error"
		);

		print json_encode($responseCollection);
		exit();
	}

	$responseCollection = array(
		"data" => $collection,
		"status" => "success"
	);

	print json_encode($responseCollection);

?>