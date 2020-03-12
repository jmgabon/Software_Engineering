<?php
    require "../../../php/ConnectToDB.php";
    
    $query = "";
    $func = $_POST['func'];

    
	try{
        if ($func === 'setQuarter') {
            $query .= "SELECT SettingValue ";
            $query .= "FROM setting ";
            $query .= "WHERE SettingName = 'quarter_enabled' ";
        }

        if ($func === 'setGradeCaseValues') {
            $query .= "SELECT * FROM ";
            $query .= "(SELECT COUNT(*) AS TotalApproved FROM grade_case WHERE `CaseValue` IN (6)) AS SUB, ";
            $query .= "(SELECT COUNT(*) AS Overall FROM grade_case) AS SUB2 ";
        }

        if ($func === 'changeGradeCaseValue0') {
            $query .= "UPDATE grade_case ";
            $query .= "SET CaseValue = 0 ";
        }

        if ($func === 'setSubjectListDB') {
            $query .= "SELECT main_subjectcode.SubjectCode ";
            $query .= "FROM main_subjectcode ";
            $query .= "LEFT JOIN grade_sortable ON main_subjectcode.SubjectCode = grade_sortable.SubjectCode ";
            $query .= "WHERE main_subjectcode.GradeLevel IN (" . $_POST['grLvl'] . ") ";
            $query .= "AND main_subjectcode.SubjectCode NOT LIKE 'HOMEROOM%' ";
            $query .= "ORDER BY grade_sortable.OrderNumber ASC ";
        }

        if ($func === 'setSaveSubjListDB') {
            $query .= "INSERT INTO grade_sortable ";
            $query .= "(SubjectCode, OrderNumber) ";
            $query .= "VALUES ('" . $_POST['subj'] . "', " . $_POST['num'] . ") ";
            $query .= "ON DUPLICATE KEY UPDATE OrderNumber = '" . $_POST['num'] . "' ";
        }

        if ($func === 'changeGradeCaseValue1') {
            $query .= "UPDATE grade_case ";
            $query .= "SET CaseValue = 1 ";
        }

        if ($func === 'saveQuarter') {
            $query .= "UPDATE setting ";
            $query .= "SET SettingValue = " . $_POST['q'] . " ";
            $query .= "WHERE SettingName = 'quarter_enabled' ";
        }

        if ($func === 'setupGradeCase') {
            /*
            INSERT all `main_subject`.`SubjectID` to `grade_case`,
            but with adjustment IF `SubjectID` LIKE 'MAPEH%' OR 'HOMEROOM%'

            if (SubjectID LIKE 'HOMEROOM%') {
                don't INSERT (because HOMEROOM don't have grades, only schedules)
            } else if (SubjectID LIKE 'MAPEH%') {
                INSERT 'MUSIC`GradeLevel-`SectionNum`'
                INSERT 'ARTS`GradeLevel-`SectionNum`'
                INSERT 'PE`GradeLevel-`SectionNum`'
                INSERT 'HEALTH`GradeLevel-`SectionNum`'
            } else {
                INSERT `SubjectID`
            }
            */

            // $query .= "TRUNCATE mis.grade_case; ";

            $query .= "INSERT INTO grade_case (SubjectID) ";
            $query .= "    SELECT SUB.SubjectID ";
            $query .= "    FROM ( ";
            $query .= "        SELECT SubjectID ";
            $query .= "        FROM main_subject ";
            $query .= "        WHERE SubjectID NOT LIKE 'HOMEROOM%' ";
            $query .= "        AND SubjectID NOT LIKE 'MAPEH%' ";
            $query .= "    ) AS SUB ";

            $subMAPEH = array('MUSIC', 'ARTS', 'PE', 'HEALTH');
            foreach ($subMAPEH as $sub) {
                $query .= "    UNION ALL ";
                $query .= "    SELECT IF(SUB.SubjectID LIKE 'MAPEH%', CONCAT('$sub', ";
                $query .= "    SUBSTRING(SUB.SubjectID, 6)), ";
                $query .= "    SUB.SubjectID) ";
                $query .= "    FROM ( ";
                $query .= "        SELECT SubjectID ";
                $query .= "        FROM main_subject ";
                $query .= "        WHERE SubjectID NOT LIKE 'HOMEROOM%' ";
                $query .= "        AND SubjectID LIKE 'MAPEH%' ";
                $query .= "    ) AS SUB ";
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