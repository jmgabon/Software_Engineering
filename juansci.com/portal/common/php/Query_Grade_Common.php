<?php
    require "../../../php/ConnectToDB.php";
    
    $query = "";
    $func = $_POST['func'];
    
	try{
        // Grade_View
        if ($func === 'SearchStudent') {
            $query .= "SELECT main_student.LRNNum, LastName, ExtendedName, FirstName, MiddleName, Birthday, Gender ";
            $query .= "FROM main_student ";
            $query .= "LEFT JOIN main_student_section ON main_student.LRNNum = main_student_section.LRNNum ";
            $query .= "WHERE main_student_section.SectionNum = " . $_POST['sectionNum'] . " ";

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

        if ($func === 'setQuarterDB') {
            $query .= "SELECT SettingValue ";
            $query .= "FROM setting ";
            $query .= "WHERE SettingName = 'quarter_enabled'";
        }

        if ($func === 'setSubjectListDB') {
            $query .= "SELECT main_subjectcode.SubjectCode, main_subjectcode.SubjectDescription ";
            $query .= "FROM main_subjectcode ";
            $query .= "LEFT JOIN grade_sortable ON main_subjectcode.SubjectCode = grade_sortable.SubjectCode ";
            $query .= "WHERE main_subjectcode.GradeLevel IN (" . $_POST['grLvl'] . ") ";
            $query .= "AND main_subjectcode.SubjectCode NOT LIKE 'HOMEROOM%' ";
            $query .= "ORDER BY grade_sortable.OrderNumber ASC ";
        }

        if ($func === 'setStudentInfo') {
            $query .= "SELECT LastName, ExtendedName, FirstName, MiddleName, Birthday, Gender, GradeLevel ";
            $query .= "FROM main_student ";
            $query .= "WHERE LRNNum IN ('" . $_POST['LRNNum'] . "') ";
        }

        if ($func === 'setIfSectionAssigned') {
            $query .= "SELECT SectionNum ";
            $query .= "FROM main_student_section ";
            $query .= "WHERE LRNNum IN ('" . $_POST['LRNNum'] . "') ";
            $query .= "AND GradeLevel IN ('" . $_POST['gradeLevel'] . "') ";
        }

        if ($func === 'setSectionInfo') {
            $query .= "SELECT main_section.SectionNum, main_section.SectionName, main_section.GradeLevel, ";
            $query .= "IF(MiddleName IS NULL, CONCAT(LastName, IF(ExtendedName is NULL, '', CONCAT(' ', ExtendedName)), ', ' , FirstName, '' , ''), ";
            $query .= "CONCAT(LastName, IF(ExtendedName is NULL, '', CONCAT(' ', ExtendedName)), ', ' , FirstName, ' ' , LEFT(MiddleName, 1), '.')) AS Adviser ";
            $query .= "FROM main_section ";

            if ($_POST['accessType'] === 'teacher') {
                $query .= "LEFT JOIN main_teacher ON main_section.Adviser = main_teacher.TeacherNum ";
                $query .= "WHERE main_section.Adviser = " . $_POST['teacherNum'] . " ";
            } else if ($_POST['accessType'] === 'student') {
                $query .= "LEFT JOIN main_student_section ";
                $query .= "ON main_section.SectionNum = main_student_section.SectionNum ";
                $query .= "JOIN main_teacher ";
                $query .= "ON main_section.Adviser = main_teacher.TeacherNum ";
                $query .= "WHERE main_student_section.LRNNum = " . $_POST['LRNNum'] . " ";
                $query .= "ORDER BY main_student_section.DateCreated DESC ";
                $query .= "LIMIT 1 ";
            }
        }

        if ($func === 'setGradeSubjDB') {
            $query .= "SELECT SubjectCode, Quarter, GradeRating ";
            $query .= "FROM grade_subject ";
            $query .= "WHERE LRNNum = " . $_POST['LRNNum'] . " ";
            $query .= "AND GradeLevel = " . $_POST['gradeLevel'] . " ";

            if ($_POST['accessType'] === 'student') {
                $query .= "AND Status = 'ENCODED' ";
            } else if ($_POST['accessType'] === 'teacher') {
                $query .= "AND (Status = 'APPROVED' ";
                $query .= "OR Status = 'ENCODED') ";
            }
        }

        if ($func === 'setGradeValDB') {
            $query .= "SELECT BehaviorID, Quarter, GradeValRating ";
            $query .= "FROM grade_values ";
            $query .= "WHERE LRNNum = " . $_POST['LRNNum'] . " ";
            $query .= "AND GradeValLevel = " . $_POST['gradeLevel'] . " ";
        }

        if ($func === 'btn_encode') {
            $query .= "UPDATE grade_subject ";
            $query .= "SET Status = 'ENCODED' ";
            $query .= "WHERE LRNNum = " . $_POST['LRNNum'] . " ";
            $query .= "AND GradeLevel = " . $_POST['gradeLevel'] . " ";
            $query .= "AND Quarter = " . $_POST['quarterSelected'] . " ";
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