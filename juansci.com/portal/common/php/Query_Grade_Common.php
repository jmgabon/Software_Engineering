<?php
    require "../../../php/ConnectToDB.php";
    
    $query = "";
    $func = $_POST['func'];
    
	try{
        if ($func === 'SearchTransfereeStudent') {
            $query .= "SELECT LRNNum, LastName, ExtendedName, FirstName, MiddleName, Birthday, Gender ";
            $query .= "FROM main_student ";
            $query .= "WHERE Type = 'Transferee' ";

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

        if ($func === 'selectGrLvl') {
            $query .= "SELECT GradeLevel ";
            $query .= "FROM main_student ";
            $query .= "WHERE LRNNum = " . $_POST['LRNNum'] . " ";
        }

        if ($func === 'SearchSubjectCode') {
            $query .= "SELECT SubjectCode, SubjectDescription ";
            $query .= "FROM main_subjectcode ";
            $query .= "WHERE GradeLevel = " . $_POST['gradeLevel'] . " ";
            $query .= "AND SubjectCode NOT LIKE 'HOMEROOM%' ";
        }

        if ($func === 'saveTrGrade') {
            $query .= "INSERT INTO grade_subject ";
            $query .= "(GradeID, LRNNum, GradeLevel, SubjectCode, Quarter, GradeRating, Status) ";
            $query .= "VALUES ('" . $_POST['GradeID'] . "', '";
            $query .= $_POST['LRNNum'] . "', '";
            $query .= $_POST['GradeLevel'] . "', '";
            $query .= $_POST['SubjectCode'] . "', '";
            $query .= $_POST['Quarter'] . "', '";
            $query .= $_POST['GradeRating'] . "', '";
            $query .= "APPROVED') ";
            $query .= "ON DUPLICATE KEY UPDATE GradeRating = " . $_POST['GradeRating'] . " ";
        }

        if ($func === 'setGrade') {
            $query .= "SELECT LRNNum, GradeLevel, SubjectCode, ";
            $query .= "COALESCE(SUM(CASE WHEN Quarter = 1 THEN GradeRating END), null) AS Q1, ";
            $query .= "COALESCE(SUM(CASE WHEN Quarter = 2 THEN GradeRating END), null) AS Q2, ";
            $query .= "COALESCE(SUM(CASE WHEN Quarter = 3 THEN GradeRating END), null) AS Q3, ";
            $query .= "COALESCE(SUM(CASE WHEN Quarter = 4 THEN GradeRating END), null) AS Q4, ";
            $query .= "COALESCE(SUM(CASE WHEN Quarter = 1 THEN GradeID END), null) AS IDQ1, ";
            $query .= "COALESCE(SUM(CASE WHEN Quarter = 2 THEN GradeID END), null) AS IDQ2, ";
            $query .= "COALESCE(SUM(CASE WHEN Quarter = 3 THEN GradeID END), null) AS IDQ3, ";
            $query .= "COALESCE(SUM(CASE WHEN Quarter = 4 THEN grade_subject.GradeID END), null) AS IDQ4 ";
            $query .= "FROM grade_subject ";
            $query .= "WHERE LRNNum = " . $_POST['LRNNum'] . " ";
            $query .= "AND SubjectCode = '" . $_POST['SubjectCode'] . "' ";
        }

        if ($func === 'SearchStudent') {
            $query .= "SELECT main_student.LRNNum, LastName, ExtendedName, FirstName, MiddleName, Birthday, Gender ";
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

        if ($func === 'setQuarterDB') {
            $query .= "SELECT SettingValue ";
            $query .= "FROM setting ";
            $query .= "WHERE SettingName = 'quarter_enabled'";
        }

        // Grade_View; Grade_Setting;
        if ($func === 'setSubjectListDB') {
            // $query .= "SELECT main_subjectcode.SubjectCode, main_subjectcode.SubjectDescription ";
            // $query .= "FROM main_subjectcode ";
            // $query .= "LEFT JOIN grade_sortable ON main_subjectcode.SubjectCode = grade_sortable.SubjectCode ";
            // $query .= "WHERE main_subjectcode.GradeLevel IN (" . $_POST['grLvl'] . ") ";
            // $query .= "AND main_subjectcode.SubjectCode NOT LIKE 'HOMEROOM%' ";
            // $query .= "ORDER BY grade_sortable.OrderNumber ASC ";


            $query .= "SELECT SubjCodeList.SubjectCode, main_subjectcode.SubjectDescription ";
            $query .= "FROM ( ";
            $query .= "    SELECT SubjectCode ";
            $query .= "    FROM grade_subject ";
            $query .= "    WHERE LRNNum = " . $_POST['LRNNum'] . " ";
            $query .= "    AND GradeLevel = " . $_POST['grLvl'] . " ";
            $query .= "    AND SubjectCode NOT LIKE 'MUSIC%' ";
            $query .= "    AND SubjectCode NOT LIKE 'ARTS%' ";
            $query .= "    AND SubjectCode NOT LIKE 'PE%' ";
            $query .= "    AND SubjectCode NOT LIKE 'HEALTH%' ";
            $query .= "    AND SubjectCode NOT LIKE 'HOMEROOM%' ";
            $query .= "    GROUP BY SubjectCode ";

            $query .= "    UNION ALL ";
            $query .= "    SELECT IF(SubjectCode LIKE 'MUSIC%', CONCAT('MAPEH', SUBSTRING(SubjectCode, 6)), '') ";
            $query .= "    FROM grade_subject ";
            $query .= "    WHERE LRNNum = " . $_POST['LRNNum'] . " ";
            $query .= "    AND GradeLevel = " . $_POST['grLvl'] . " ";
            $query .= "    AND SubjectCode LIKE 'MUSIC%' ";
            $query .= "    GROUP BY SubjectCode ";
            $query .= ") AS SubjCodeList ";
            $query .= "LEFT JOIN main_subjectcode ";
            $query .= "    ON SubjCodeList.SubjectCode = main_subjectcode.SubjectCode ";
            $query .= "LEFT JOIN grade_sortable ";
            $query .= "    ON main_subjectcode.SubjectCode = grade_sortable.SubjectCode ";
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

            if ($_POST['accessType'] === 'teacher') {
                $query .= "FROM main_section ";
                $query .= "LEFT JOIN main_teacher ON main_section.Adviser = main_teacher.TeacherNum ";
                $query .= "WHERE main_section.Adviser = " . $_POST['teacherNum'] . " ";
            } else if ($_POST['accessType'] === 'student') {
                $query .= "FROM main_student_section ";
                $query .= "LEFT JOIN main_section ";
                $query .= "ON main_student_section.SectionNum = main_section.SectionNum ";
                $query .= "LEFT JOIN main_teacher ";
                $query .= "ON main_section.Adviser = main_teacher.TeacherNum ";
                $query .= "WHERE main_student_section.LRNNum = " . $_POST['LRNNum'] . " ";
                $query .= "ORDER BY main_student_section.GradeLevel DESC ";
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
            } else if ($_POST['accessType'] === 'principal' ||
            $_POST['accessType'] === 'coordinator' ||
            $_POST['accessType'] === 'teacher') {
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

        // Grade_Subject
        if ($func === 'setAdviserName') {
            $query .= "SELECT IF(MiddleName IS NULL, CONCAT(LastName, IF(ExtendedName is NULL, '', CONCAT(' ', ExtendedName)), ', ' , FirstName, '' , ''), ";
            $query .= "CONCAT(LastName, IF(ExtendedName is NULL, '', CONCAT(' ', ExtendedName)), ', ' , FirstName, ' ' , LEFT(MiddleName, 1), '.')) AS Adviser ";
            $query .= "FROM main_section ";
            $query .= "LEFT JOIN main_teacher ON main_section.Adviser = main_teacher.TeacherNum ";
            $query .= "WHERE SectionNum = " . $_POST['SectionNum'] . " ";
        }

        if ($func === 'setStudentListDB') {
            $query .= "SELECT main_student.LRNNum, main_student.LastName, main_student.ExtendedName, main_student.FirstName, main_student.MiddleName ";
            $query .= "FROM main_student ";
            $query .= "LEFT JOIN main_student_section ON main_student.LRNNum = main_student_section.LRNNum ";
            $query .= "WHERE main_student_section.SectionNum = " . $_POST['SectionNum'] . " ";
        }

        if ($func === 'setGradeDB') {
            $query .= "SELECT main_student.LRNNum, grade_subject.GradeLevel, grade_subject.SubjectCode, ";
            $query .= "COALESCE(SUM(CASE WHEN grade_subject.Quarter = 1 THEN grade_subject.GradeRating END), null) AS Q1, ";
            $query .= "COALESCE(SUM(CASE WHEN grade_subject.Quarter = 2 THEN grade_subject.GradeRating END), null) AS Q2, ";
            $query .= "COALESCE(SUM(CASE WHEN grade_subject.Quarter = 3 THEN grade_subject.GradeRating END), null) AS Q3, ";
            $query .= "COALESCE(SUM(CASE WHEN grade_subject.Quarter = 4 THEN grade_subject.GradeRating END), null) AS Q4, ";
            $query .= "COALESCE(SUM(CASE WHEN grade_subject.Quarter = 1 THEN grade_subject.GradeID END), null) AS IDQ1, ";
            $query .= "COALESCE(SUM(CASE WHEN grade_subject.Quarter = 2 THEN grade_subject.GradeID END), null) AS IDQ2, ";
            $query .= "COALESCE(SUM(CASE WHEN grade_subject.Quarter = 3 THEN grade_subject.GradeID END), null) AS IDQ3, ";
            $query .= "COALESCE(SUM(CASE WHEN grade_subject.Quarter = 4 THEN grade_subject.GradeID END), null) AS IDQ4 ";
            $query .= "FROM main_student ";
            $query .= "LEFT JOIN grade_subject ON main_student.LRNNum = grade_subject.LRNNum ";
            $query .= "INNER JOIN main_student_section ON main_student.LRNNum = main_student_section.LRNNum ";
            $query .= "WHERE main_student_section.SectionNum = " . $_POST['SectionNum'] . " ";
            $query .= "AND grade_subject.SubjectCode = '" . $_POST['SubjectCode'] . "' ";
            $query .= "GROUP BY main_student.LRNNum ";
        }

        if ($func === 'saveGrade') {
            $query .= "INSERT INTO grade_subject ";
            $query .= "(GradeID, LRNNum, GradeLevel, SubjectCode, Quarter, GradeRating) ";
            $query .= "VALUES ('" . $_POST['GradeID'] . "', '";
            $query .= $_POST['LRNNum'] . "', '";
            $query .= $_POST['GradeLevel'] . "', '";
            $query .= $_POST['SubjectCode'] . "', '";
            $query .= $_POST['Quarter'] . "', '";
            $query .= $_POST['GradeRating'] . "') ";
            $query .= "ON DUPLICATE KEY UPDATE GradeRating = " . $_POST['GradeRating'] . " ";
        }

        if ($func === 'setCaseStatus') {
            $query .= "SELECT CaseValue ";
            $query .= "FROM grade_case ";
            $query .= "WHERE SubjectID = '" . $_POST['SubjectID'] . "' ";
        }

        if ($func === 'updateCaseStatus') {
            $query .= "UPDATE grade_case ";
            $query .= "SET CaseValue = " . $_POST['CaseValue'] . " ";
            $query .= "WHERE SubjectID = '" . $_POST['SubjectID'] . "' ";
        }

        if ($func === 'principalApproved') {
            $query .= "UPDATE grade_subject ";
            $query .= "SET Status = 'APPROVED' ";
            $query .= "WHERE LRNNum = " . $_POST['LRNNum'] . " ";
            $query .= "AND GradeLevel = " . $_POST['GradeLevel'] . " ";
            $query .= "AND SubjectCode = '" . $_POST['SubjectCode'] . "' ";
            $query .= "AND Quarter = " . $_POST['Quarter'] . " ";
        }

        if ($func === 'SearchSubject') {
            $query .= "SELECT * FROM ( ";
            $query .= "SELECT SubjectCode, SectionName, GradeLevel, Teacher, Status, SubjectID, SectionNum, TeacherNum FROM ( ";
            $query .= "SELECT * FROM ( ";

            $query .= "SELECT main_subject.SubjectCode, main_section.SectionName, main_section.GradeLevel, ";
            $query .= "IF(MiddleName IS NULL, CONCAT(LastName, IF(ExtendedName is NULL, '', CONCAT(' ', ExtendedName)), ', ' , FirstName, '' , ''), ";
            $query .= "CONCAT(LastName, IF(ExtendedName is NULL, '', CONCAT(' ', ExtendedName)), ', ' , FirstName, ' ' , LEFT(MiddleName, 1), '.')) AS Teacher, ";
            $query .= "main_subject.SubjectID, main_section.SectionNum, main_subject.TeacherNum ";
            $query .= "FROM main_subject ";
            $query .= "INNER JOIN main_section ";
            $query .= "ON main_subject.SectionNum = main_section.SectionNum ";
            $query .= "JOIN main_teacher ";
            $query .= "ON main_subject.TeacherNum = main_teacher.TeacherNum ";
            $query .= "WHERE main_subject.SubjectCode NOT LIKE 'MAPEH%' ";

            if ($_POST['accessType'] === 'teacher') {
                $query .= "AND main_subject.TeacherNum = " . $_POST['TeacherNum'] . " ";
            }

            if ($_POST['accessType'] === 'teacher') {
                $caseVal = 4;
            } else if ($_POST['accessType'] === 'coordinator') {
                $caseVal = 5;
            } else if ($_POST['accessType'] === 'principal') {
                $caseVal = 6;
            }

            $query .= ") AS SubjectInfo, ( ";
            $query .= "SELECT SubjectID AS ID2, CaseValue, IF(CaseValue >= $caseVal, 'ENCODED', 'NOT ENCODED') AS Status ";
            $query .= "FROM grade_case ";
            $query .= ") AS GradeCase ";
            $query .= "WHERE SubjectInfo.SubjectID = GradeCase.ID2 ";
            $query .= ") AS MAIN ";

            $query .= "UNION ALL ";
            $query .= "SELECT main_subject.SubjectCode, main_section.SectionName, main_section.GradeLevel, ";
            $query .= "IF(MiddleName IS NULL, CONCAT(LastName, IF(ExtendedName is NULL, '', CONCAT(' ', ExtendedName)), ', ' , FirstName, '' , ''), ";
            $query .= "CONCAT(LastName, IF(ExtendedName is NULL, '', CONCAT(' ', ExtendedName)), ', ' , FirstName, ' ' , LEFT(MiddleName, 1), '.')) AS Teacher, ";
            $query .= "'MORE INFO' AS Status, ";
            $query .= "main_subject.SubjectID, main_section.SectionNum, main_subject.TeacherNum ";
            $query .= "FROM main_subject ";
            $query .= "INNER JOIN main_section ";
            $query .= "ON main_subject.SectionNum = main_section.SectionNum ";
            $query .= "JOIN main_teacher ";
            $query .= "ON main_subject.TeacherNum = main_teacher.TeacherNum ";
            $query .= "WHERE main_subject.SubjectCode LIKE 'MAPEH%' ";

            if ($_POST['accessType'] === 'teacher') {
                $query .= "AND main_subject.TeacherNum = " . $_POST['TeacherNum'] . " ";
            }

            $query .= ") AS MAIN2 ";

            if ($_POST['queryValue'] !== '') {

                // if ($_POST['queryIndex'] === 'Teacher') {
                //     $queryHaving = "HAVING ";
                // } else {
                //     $queryHaving = "AND ";
                // }

                $query .= "WHERE " . $_POST['queryIndex'] . " LIKE '" . $_POST['queryValue'] . "%' ";

                if ($_POST['accessType'] === 'coordinator' || $_POST['accessType'] === 'principal') {
                    $query .= "ORDER BY Teacher ASC ";
                }
            }
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