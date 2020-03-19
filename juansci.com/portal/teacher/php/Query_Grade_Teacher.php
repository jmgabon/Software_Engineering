<?php
    require "../../../php/ConnectToDB.php";
    
    $query = "";
    $func = $_POST['func'];
    
	try{
        if ($func === 'setSectionInfo') {
            $query .= "SELECT SectionNum, SectionName, GradeLevel ";
            $query .= "FROM main_section ";
            $query .= "WHERE Adviser = " . $_POST['TeacherNum'] . " ";
        }

        if ($func === 'setQuarterDB') {
            $query .= "SELECT SettingValue ";
            $query .= "FROM setting ";
            $query .= "WHERE SettingName = 'quarter_now'";
        }

        if ($func === 'setGradesValDB') {
            $query .= "SELECT GradeID, BehaviorCode, Quarter, GradeRating ";
            $query .= "FROM grade_values ";
            $query .= "WHERE LRNNum = " . $_POST['LRNNum'] . " ";
            $query .= "AND GradeLevel = " . $_POST['GradeLevel'] . " ";
        }

        if ($func === 'updateGradeDB') {
            $query .= "INSERT INTO grade_values ";
            $query .= "(GradeID, LRNNum, TeacherNum, GradeLevel, BehaviorCode, Quarter, GradeRating, Status) ";
            $query .= "VALUES ('" . $_POST['GradeID'] . "', '";
            $query .= $_POST['LRNNum'] . "', '";
            $query .= $_POST['TeacherNum'] . "', '";
            $query .= $_POST['GradeLevel'] . "', '";
            $query .= $_POST['BehaviorCode'] . "', '";
            $query .= $_POST['Quarter'] . "', '";
            $query .= $_POST['GradeRating'] . "', '";
            $query .= "PENDING') ";
            $query .= "ON DUPLICATE KEY UPDATE GradeRating = '" . $_POST['GradeRating'] . "', ";
            $query .= "TeacherNum = " . $_POST['TeacherNum'] . " ";
        }

        if ($func === 'SearchStudent') {
            $query .= "SELECT main_student.LRNNum, LastName, ExtendedName, FirstName, MiddleName ";
            $query .= "FROM main_student ";
            $query .= "LEFT JOIN main_student_section ON main_student.LRNNum = main_student_section.LRNNum ";
            $query .= "WHERE main_student_section.SectionNum = " . $_POST['SectionNum'] . " ";

            if ($_POST['queryValue'] !== '') {
                if ($_POST['queryIndex'] === 'LRNNum') {
                    $queryAnd = "AND main_student.";
                } else {
                    $queryAnd = "AND ";
                }

                if ($_POST['queryValue'] === ' ') {
                    $queryNull = " IS NULL";
                } else {
                    $queryNull = " LIKE '" . $_POST['queryValue'] . "%'";
                }

                $query .= $queryAnd . $_POST['queryIndex'] . $queryNull;
            }
        }

        if ($func === 'RetrieveTeacherSchedule') {
			$query .= "SELECT main_subject.SubjectID, SubjectTime, SubjectDay, main_section.SectionName, main_subjectcode.SubjectDescription ";
			$query .= "FROM main_subject LEFT JOIN main_sched ON main_subject.SubjectID = main_sched.SubjectID ";
			$query .= "LEFT JOIN main_section ON main_subject.SectionNum = main_section.SectionNum ";
			$query .= "LEFT JOIN main_subjectcode ON main_subjectcode.SubjectCode = main_subject.SubjectCode ";
			$query .= "WHERE main_subject.TeacherNum = " . $_POST['TeacherNum'] . " ";
        }

        
        
		$stmt = $db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll();
        echo json_encode($row);
        $stmt->closeCursor();
	} catch(Exception $e){
		echo $query;
	}
?>