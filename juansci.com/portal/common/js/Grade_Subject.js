// 'use strict';


// WILL APPLY MODULE PATTERN LATER

const wrapperGradeSubject = (function() {

})();



const wrapperGradeViewMain = (function(wrapSubj) {

})(wrapperGradeSubject);
//


let parent_id;
let jsonStudent;
let jsonQuarter;
let jsonGrade;
let quarterSelected;

let Quarter;
let GradeLevel;
let SectionNum;
let SubjectCode;
let SubjectID;

let newCase;
let currCase;


const txt_Adviser = document.querySelector('#txt_Adviser');
const txt_Section = document.querySelector('#txt_Section');
const txt_GradeLevel = document.querySelector('#txt_GradeLevel');
const txt_SubjectCode = document.querySelector('#txt_SubjectCode');
const input_SubjectCode = document.querySelector('#input_SubjectCode');

const modal_button = document.querySelector('.modal-button');
const modal_body = document.querySelector('#modal-body');

const labelMAPEH = document.querySelector('#labelMAPEH');
const selectMAPEH = document.querySelector('#selectMAPEH');

const btn_approve = document.querySelector('#btn_approve');
const btn_disapprove = document.querySelector('#btn_disapprove');

const tbody = document.querySelector('table tbody');
const colNum = (document.querySelector('table thead tr').childElementCount + 3);



let modalSubject = function() {
    modal_button.addEventListener('click', function() {
        let theadID = 'SubjectCode@SectionName@GradeLevel@Adviser@Status';
        let theadHTML = 'Subject Code@Section Name@Grade Level@Adviser@Status';
        CreateSearchBox(theadID, theadHTML, '@', 'SearchSubject', 'search', modal_body);

        let cat = document.querySelector('#modal-body select');
        let hiddenCol = 'SubjectID@SectionNum@TeacherNum';
        const searchSubject = document.querySelector('#SearchSubject');
        theadID += '@' + hiddenCol;
        theadHTML += '@' + hiddenCol;
        CreateTable('SearchSubjectTable', theadID, theadHTML, '@', modal_body, 0, hiddenCol);

        document.querySelector('thead').className = 'dark';
        openModal('Select Subject', 'Subject');

        let Search = function() {
            // let query = '';

            // query += 'SELECT main_subject.SubjectCode, main_section.SectionName, main_section.GradeLevel, ';
            // query += 'IF(MiddleName IS NULL, CONCAT(LastName, IF(ExtendedName is NULL, "", CONCAT(" ", ExtendedName)), ", " , FirstName, "" , ""), ';
            // query += 'CONCAT(LastName, IF(ExtendedName is NULL, "", CONCAT(" ", ExtendedName)), ", " , FirstName, " " , LEFT(MiddleName, 1), ".")) AS Adviser, ';
            // query += 'main_section.SectionNum, main_subject.TeacherNum ';
            // query += 'FROM main_subject ';
            // query += 'INNER JOIN main_section ';
            // query += 'ON main_subject.SectionNum = main_section.SectionNum ';
            // query += 'JOIN main_teacher ';
            // query += 'ON main_subject.TeacherNum = main_teacher.TeacherNum ';

            // if (accessType === 'teacher') {
            //     query += 'WHERE main_subject.TeacherNum = ' + teacherNum + ' ';
            // }

            // if (queryValue !== '') {
            //     let queryHaving;

            //     if (queryIndex === 'Adviser') {
            //         queryHaving = 'HAVING ';
            //     } else {
            //         queryHaving = 'AND ';
            //     }

            //     query += queryHaving + queryIndex + ' LIKE "' + queryValue + '%" ';
            //     if (accessType === 'coordinator' || accessType === 'principal') {
            //         query += 'ORDER BY Adviser ASC ';
            //     }
            // }

            // SimplifiedQuery('SELECT', query, searchSubject, getSubject);


            let val = '';
            let queryValue = searchSubject.value;
            let queryIndex = cat.options[cat.selectedIndex].value;

            val += '&accessType=' + accessType;
            val += '&TeacherNum=' + teacherNum;
            val += '&queryValue=' + queryValue;
            val += '&queryIndex=' + queryIndex;

            misQuery('SearchSubject', val, getSubject);
        }
        Search();

        searchSubject.addEventListener('change', Search);
        cat.addEventListener('change', () => {
            searchSubject.value = '';
            Search();
        });
    });
}


let getSubject = function(xhttp) {
    let jsonSubjectInfo = JSON.parse(xhttp.responseText);

    console.log(jsonSubjectInfo);
    CreateTBody(xhttp, getSubject);
    const tbody_tr = document.querySelectorAll('#SearchSubjectTable tbody tr');

    for (let i = 0; i < tbody_tr.length; i++) {
        tbody_tr[i].addEventListener('click', function() {
            document.querySelector('#SearchSubject').value = '';
            closeModal(modal_body);

            SectionNum = jsonSubjectInfo[i]['SectionNum'];
            teacherNum = jsonSubjectInfo[i]['TeacherNum'];
            SubjectCode = jsonSubjectInfo[i]['SubjectCode'];
            txt_Section.innerHTML = jsonSubjectInfo[i]['SectionName'];
            txt_GradeLevel.innerHTML = jsonSubjectInfo[i]['GradeLevel'];
            GradeLevel = jsonSubjectInfo[i]['GradeLevel'];
            SubjectID = jsonSubjectInfo[i]['SubjectID'];

            input_SubjectCode.value = SubjectCode;
            txt_SubjectCode.innerHTML = SubjectCode;

            displayAfterModal();

            console.log(txt_Section.innerHTML + ' ' + SubjectCode + ' selected.');
        });

        tbody_tr[i].addEventListener('mouseover', function() {
            this.style.backgroundColor = 'maroon';
            this.style.color = 'white';
        });

        tbody_tr[i].addEventListener('mouseout', function() {
            this.style.backgroundColor = '';
            this.style.color = '';
        });
    }
}


let displayAfterModal = function() {
    btn_approve.style.display = 'none';
    btn_disapprove.style.display = 'none';

    if (input_SubjectCode.value === 'MAPEH 7' ||
        input_SubjectCode.value === 'MAPEH 8' ||
        input_SubjectCode.value === 'MAPEH 9' ||
        input_SubjectCode.value === 'MAPEH 10') {
        labelMAPEH.style.display = 'block';
        selectMAPEH.value = selectMAPEH.options[0].value;

        RemoveChildNodes(tbody);
        textCaseStatus('cls');
        setAdviserName();
        setQuarterDB();

    } else {
        labelMAPEH.style.display = 'none';

        RemoveChildNodes(tbody);
        setCaseStatus();
        setAdviserName();
        setQuarterDB();
        setStudentListDB();
    }
}


let setSubMAPEH = function() {
    SubjectCode = selectMAPEH.value + ' ' + GradeLevel;
    txt_SubjectCode.innerHTML = input_SubjectCode.value + '/' + SubjectCode;

    RemoveChildNodes(tbody);
    setCaseStatus();
    setStudentListDB();

    console.log(txt_Section.innerHTML + ' ' + SubjectCode + ' selected.');
}


let setAdviserName = function() {
    // let query = '';
    // txt_Adviser.innerHTML = '';

    // query += 'SELECT IF(MiddleName IS NULL, CONCAT(LastName, IF(ExtendedName is NULL, "", CONCAT(" ", ExtendedName)), ", " , FirstName, "" , ""), ';
    // query += 'CONCAT(LastName, IF(ExtendedName is NULL, "", CONCAT(" ", ExtendedName)), ", " , FirstName, " " , LEFT(MiddleName, 1), ".")) AS Adviser ';
    // query += 'FROM main_section ';
    // query += 'LEFT JOIN main_teacher ON main_section.Adviser = main_teacher.TeacherNum ';
    // query += 'WHERE SectionNum IN (' + SectionNum + ') ';

    // SimplifiedQuery('SELECT', query, '', getAdviserName);


    let val = '';

    val += '&SectionNum=' + SectionNum;

    misQuery('setAdviserName', val, getAdviserName);
}


let getAdviserName = function(xhttp) {
    try {
        txt_Adviser.innerHTML = JSON.parse(xhttp.responseText)[0][0];

    } catch (err) {
        alert('Section ' + txt_Section.innerHTML + ' does not have an adviser yet.');
        console.log(xhttp.responseText);
        console.log('Section ' + txt_Section.innerHTML + ' does not have an adviser yet.');
    }
}


let setQuarterDB = function() {
    // let query = '';

    // query += 'SELECT SettingValue ';
    // query += 'FROM setting ';
    // query += 'WHERE SettingName = "quarter_enabled" ';

    // SimplifiedQuery('SELECT', query, '', getQuarter);

    let val = '';

    misQuery('setQuarterDB', val, getQuarter);
};


let getQuarter = function(xhttp) {
    try {
        jsonQuarter = JSON.parse(xhttp.responseText);
        quarterSelected = jsonQuarter[0]['SettingValue'];

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


let enablerQuarter = function(q, currCase) {
    if (q == quarterSelected &&
        (currCase == 1 || currCase == 2 || currCase == 3)) {
        return false
    }

    return true
}


let setStudentListDB = function() {
    // let query = '';

    // query += 'SELECT main_student.LRNNum, main_student.LastName, main_student.ExtendedName, main_student.FirstName, main_student.MiddleName ';
    // query += 'FROM main_student ';
    // query += 'LEFT JOIN main_student_section ON main_student.LRNNum = main_student_section.LRNNum ';
    // query += 'WHERE main_student_section.SectionNum IN (' + SectionNum + ') ';

    // SimplifiedQuery('SELECT', query, '', tBodyGrade);


    let val = '';

    val += '&SectionNum=' + SectionNum;

    misQuery('setStudentListDB', val, tBodyGrade);
}


let tBodyGrade = function(xhttp) {
    try {
        let tr, td, input_quarter, button_save;

        jsonStudent = JSON.parse(xhttp.responseText);
        console.log('Student List: ' + jsonStudent.length);
        console.log(jsonStudent);

        if (jsonStudent != 0) {
            for (let i = 0; i < jsonStudent.length + 1; i++) {
                tr = document.createElement('tr');
                for (let j = 0; j < colNum; j++) {
                    td = document.createElement('td');


                    let setInputGrade = function(i) {
                        input_quarter = document.createElement('input');
                        input_quarter.setAttribute('type', 'input');
                        input_quarter.setAttribute('style', 'width:3em');
                        input_quarter.setAttribute('maxlength', '3');
                        input_quarter.disabled = enablerQuarter(i, currCase);

                        switch (i) {
                            case 1:
                                input_quarter.setAttribute('id', 'q1');
                                break;
                            case 2:
                                input_quarter.setAttribute('id', 'q2');
                                break;
                            case 3:
                                input_quarter.setAttribute('id', 'q3');
                                break;
                            case 4:
                                input_quarter.setAttribute('id', 'q4');
                                break;
                        }
                        td.appendChild(input_quarter);
                    }

                    let setSaveButton = function(i) {
                        if (accessType === 'teacher') {
                            button_save = document.createElement('button');
                            button_save.disabled = enablerQuarter(i, currCase);

                            switch (i) {
                                case 1:
                                    button_save.setAttribute('id', 'save1');
                                    break;
                                case 2:
                                    button_save.setAttribute('id', 'save2');
                                    break;
                                case 3:
                                    button_save.setAttribute('id', 'save3');
                                    break;
                                case 4:
                                    button_save.setAttribute('id', 'save4');
                                    break;
                            }

                            button_save.innerHTML = 'SAVE';
                            td.appendChild(button_save);
                        }

                    }

                    if (j == 0) {
                        if (i != jsonStudent.length)
                            td.innerHTML = i + 1;
                    } else if (j == 1) {
                        if (i != jsonStudent.length) {
                            let extName = jsonStudent[i]['ExtendedName'];


                            if (jsonStudent[i]['MiddleName'] === null) {
                                jsonStudent[i]['MiddleName'] = '';
                            }
                            if (extName === null) {
                                extName = '';
                            } else {
                                extName = ' ' + extName;
                            }

                            td.innerHTML = jsonStudent[i]['LastName'] + extName + ', ' +
                                jsonStudent[i]['FirstName'] + ' ' + jsonStudent[i]['MiddleName'];
                        }
                    } else if (j == 2) {
                        if (i != jsonStudent.length)
                            setInputGrade(1);
                        else
                            setSaveButton(1);

                    } else if (j == 3) {
                        if (i != jsonStudent.length)
                            setInputGrade(2);
                        else
                            setSaveButton(2);

                    } else if (j == 4) {
                        if (i != jsonStudent.length)
                            setInputGrade(3);
                        else
                            setSaveButton(3);

                    } else if (j == 5) {
                        if (i != jsonStudent.length)
                            setInputGrade(4);
                        else
                            setSaveButton(4);
                    }
                    tr.appendChild(td);
                }
                tbody.appendChild(tr);
            }

            setGradeDB();

            if (accessType === 'teacher') {
                const save1 = document.querySelector('#save1');
                const save2 = document.querySelector('#save2');
                const save3 = document.querySelector('#save3');
                const save4 = document.querySelector('#save4');

                save1.addEventListener('click', function() {
                    Quarter = 1;
                    saveGrade();
                });

                save2.addEventListener('click', function() {
                    Quarter = 2;
                    saveGrade();
                });

                save3.addEventListener('click', function() {
                    Quarter = 3;
                    saveGrade();
                });

                save4.addEventListener('click', function() {
                    Quarter = 4;
                    saveGrade();
                });
            }

        } else {
            alert('No enrolled students yet.');
            console.log('No enrolled students yet.');
        }

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


let setGradeDB = function() {
    // let query = '';

    // query += 'SELECT main_student.LRNNum, grade_subject.GradeLevel, grade_subject.SubjectCode, ';
    // query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 1 THEN grade_subject.GradeRating END), null) AS Q1, ';
    // query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 2 THEN grade_subject.GradeRating END), null) AS Q2, ';
    // query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 3 THEN grade_subject.GradeRating END), null) AS Q3, ';
    // query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 4 THEN grade_subject.GradeRating END), null) AS Q4, ';
    // query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 1 THEN grade_subject.GradeID END), null) AS IDQ1, ';
    // query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 2 THEN grade_subject.GradeID END), null) AS IDQ2, ';
    // query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 3 THEN grade_subject.GradeID END), null) AS IDQ3, ';
    // query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 4 THEN grade_subject.GradeID END), null) AS IDQ4 ';
    // query += 'FROM main_student ';
    // query += 'LEFT JOIN grade_subject ON main_student.LRNNum = grade_subject.LRNNum ';
    // query += 'INNER JOIN main_student_section ON main_student.LRNNum = main_student_section.LRNNum ';
    // query += 'WHERE main_student_section.SectionNum IN (' + SectionNum + ') ';
    // query += 'AND grade_subject.SubjectCode IN ("' + SubjectCode + '") ';
    // query += 'GROUP BY main_student.LRNNum ';

    // SimplifiedQuery('SELECT', query, '', getGradeDB);


    let val = '';

    val += '&SectionNum=' + SectionNum;
    val += '&SubjectCode=' + SubjectCode;

    misQuery('setGradeDB', val, getGradeDB);
}


let getGradeDB = function(xhttp) {
    try {
        jsonGrade = JSON.parse(xhttp.responseText);
        console.log('Student(s) with Grade: ' + jsonGrade.length);
        console.log(jsonGrade);
        insertGrade();

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


let insertGrade = function() {
    const q1 = document.querySelectorAll('#q1');
    const q2 = document.querySelectorAll('#q2');
    const q3 = document.querySelectorAll('#q3');
    const q4 = document.querySelectorAll('#q4');

    for (let i = 0; i < jsonStudent.length; i++) {
        for (let j = 0; j < jsonGrade.length; j++) {
            for (let k = 0; k < colNum; k++) {
                if (jsonStudent[i][0] == jsonGrade[j][0]) {
                    if (k == 2) {
                        q1[i].value = jsonGrade[j][3];
                    } else if (k == 3) {
                        q2[i].value = jsonGrade[j][4];
                    } else if (k == 4) {
                        q3[i].value = jsonGrade[j][5];
                    } else if (k == 5) {
                        q4[i].value = jsonGrade[j][6];
                    }
                }
            }
        }
    }

    computeFinalAndRemark();
}


let checkValidInput = function() {
    for (let i = 0; i < jsonStudent.length; i++) {
        let GradeRating = document.querySelectorAll('#q' + Quarter)[i].value;

        if (GradeRating === '0') {
            return false;
        }

        GradeRating = Number(GradeRating);
        if (!Number.isInteger(GradeRating)) {
            return false;
        } else if (GradeRating === '') {
            return false;
        } else if (!(GradeRating >= 65 && GradeRating <= 100)) {
            return false;
        }
    }
    return true;
}


let saveGrade = function() {
    if (checkValidInput()) {
        let GradeID;
        let found;

        for (let i = 0; i < jsonStudent.length; i++) {
            const GradeRating = document.querySelectorAll('#q' + Quarter)[i].value
            found = false;

            while (!found) {
                for (let j = 0; j < jsonGrade.length; j++) {
                    if (jsonStudent[i][0] == jsonGrade[j][0]) {
                        if (Quarter == 1) {
                            GradeID = jsonGrade[j][7];
                        } else if (Quarter == 2) {
                            GradeID = jsonGrade[j][8];
                        } else if (Quarter == 3) {
                            GradeID = jsonGrade[j][9];
                        } else if (Quarter == 4) {
                            GradeID = jsonGrade[j][10];
                        }

                        found = true;
                    }
                }
                if (!found) {
                    GradeID = 0;
                    found = true;
                }
            }

            if (GradeRating != '') {
                // let query = '';

                // query += 'INSERT INTO grade_subject ';
                // query += '(GradeID, LRNNum, GradeLevel, SubjectCode, Quarter, GradeRating) ';
                // query += 'VALUES ("' + GradeID + '", "';
                // query += jsonStudent[i][0] + '", "';
                // query += GradeLevel + '", "';
                // query += SubjectCode + '", "';
                // query += Quarter + '", "';
                // query += GradeRating + '") ';
                // query += 'ON DUPLICATE KEY UPDATE GradeRating = ' + GradeRating;

                // SimplifiedQuery('INSERT', query, '', () => null);


                let val = '';

                val += '&GradeID=' + GradeID;
                val += '&LRNNum=' + jsonStudent[i][0];
                val += '&GradeLevel=' + GradeLevel;
                val += '&SubjectCode=' + SubjectCode;
                val += '&Quarter=' + Quarter;
                val += '&GradeRating=' + GradeRating;

                misQuery('saveGrade', val, () => null);
            }
            // else {
            //     let query = 'DELETE FROM grade_subject WHERE grade_subject.GradeID = ' + GradeID;
            //     SimplifiedQuery('DELETE', query, '', () => null);
            // }
        }

        alert('QUARTER ' + Quarter + ' GRADES SAVED');
        console.log('QUARTER ' + Quarter + ' GRADES SAVED');

        // setGradeDB();
        if (currCase === 1 || currCase === 2) {
            updateCaseStatus(4);
        } else if (currCase === 3) {
            updateCaseStatus(5);
        }

        RemoveChildNodes(tbody);
        setStudentListDB();
    } else {
        alert('Invalid input! Check all grades.');
    }
}


let computeFinalAndRemark = function() {
    let finalRating;
    const CreateGradeTable = document.querySelector('#CreateGradeTable');

    for (let i = 0; i < jsonStudent.length; i++) {
        CreateGradeTable.rows[i + 2].cells[6].innerHTML = '';
        CreateGradeTable.rows[i + 2].cells[7].innerHTML = '';

        let completeGrade = function() {
            CreateGradeTable.rows[i + 2].cells[6].innerHTML = finalRating.toFixed(0);

            if (finalRating >= 75)
                CreateGradeTable.rows[i + 2].cells[7].innerHTML = 'PASSED';
            else
                CreateGradeTable.rows[i + 2].cells[7].innerHTML = 'FAILED';
        }

        if (jsonStudent.length > 1) {
            if (q1[i].value != '' && q2[i].value != '' && q3[i].value != '' && q4[i].value != '') {
                finalRating = (Number(q1[i].value) + Number(q2[i].value) +
                    Number(q3[i].value) + Number(q4[i].value)) / 4;

                completeGrade();
            }
        } else {
            if (q1.value != '' && q2.value != '' && q3.value != '' && q4.value != '') {
                finalRating = (Number(q1.value) + Number(q2.value) +
                    Number(q3.value) + Number(q4.value)) / 4;

                completeGrade();
            }
        }
    }
}


let setCaseStatus = function() {
    // let query = '';

    // query += 'SELECT CaseValue ';
    // query += 'FROM grade_case ';
    // query += 'WHERE TeacherNum = ' + teacherNum + ' ';
    // query += 'AND SubjectCode = "' + SubjectCode + '" ';

    // SimplifiedQuery('SELECT', query, '', getCaseStatus);


    let val = '';

    val += '&SubjectID=' + SubjectID;

    misQuery('setCaseStatus', val, getCaseStatus);
};


let getCaseStatus = function(xhttp) {
    try {
        jsonGradeCase = JSON.parse(xhttp.responseText);
        currCase = jsonGradeCase[0]['CaseValue'];

        textCaseStatus(currCase);
        if (accessType === 'principal' || accessType === 'coordinator') {
            approvalChange();
        }
    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


let textCaseStatus = function(val) {
    let txt_gradeCaseStatus = document.querySelector('#txt_gradeCaseStatus');

    switch (val) {
        case 'cls':
            txt_gradeCaseStatus.textContent = '';
            break;
        case 0:
            txt_gradeCaseStatus.textContent = 'CODE0: ENCODING OF GRADES NOT STARTED YET.';
            break;
        case 1:
            txt_gradeCaseStatus.textContent = 'CODE1: SUBJECT TEACHERS ARE GRADING FOR THE FIRST TIME.';
            break;
        case 2:
            txt_gradeCaseStatus.textContent = 'CODE2: ALREADY EVALUATED BY THE COORDINATOR, BUT NEEDS CORRECTION.';
            break;
        case 3:
            txt_gradeCaseStatus.textContent = 'CODE3: ALREADY EVALUATED BY THE PRINCIPAL, BUT NEEDS CORRECTION.';
            break;
        case 4:
            txt_gradeCaseStatus.textContent = 'CODE4: COORDINATOR IS EVALUATING.';
            break;
        case 5:
            txt_gradeCaseStatus.textContent = 'CODE5: PRINCIPAL IS EVALUATING.';
            break;
        case 6:
            txt_gradeCaseStatus.textContent = 'CODE6: COORDINATOR AND PRINCIPAL APPROVED. WAITING FOR THE END OF QUARTER.';
            break;
    }
}


let updateCaseStatus = function(newCase) {
    // switch (currCase) {
    //     case 1:
    //         newCase = 4;
    //         break;
    //     case 2:
    //         newCase = 4;
    //         break;
    //     case 3:
    //         newCase = 5;
    //         break;
    // }

    // let query = '';

    // query += 'UPDATE grade_case ';
    // query += 'SET CaseValue = ' + newCase + ' ';
    // query += 'WHERE TeacherNum = ' + teacherNum + ' ';
    // query += 'AND SubjectCode = "' + SubjectCode + '" ';

    // SimplifiedQuery('UPDATE', query, '', () => null);


    let val = '';

    val += '&CaseValue=' + newCase;
    val += '&SubjectID=' + SubjectID;

    misQuery('updateCaseStatus', val, () => null);

    currCase = newCase;
    textCaseStatus(newCase);
}


let approvalListeners = function() {
    btn_approve.addEventListener('click', () => {
        let principalApproved = function() {
            for (let i = 0; i < jsonStudent.length; i++) {
                // let query = '';

                // query += 'UPDATE grade_subject ';
                // query += 'SET Status = "APPROVED" ';
                // query += 'WHERE LRNNum = "' + jsonStudent[i][0] + '" ';
                // query += 'AND GradeLevel = "' + GradeLevel + '" ';
                // query += 'AND SubjectCode = "' + SubjectCode + '" ';
                // query += 'AND Quarter = "' + quarterSelected + '" ';

                // SimplifiedQuery('UPDATE', query, '', () => null);


                let val = '';

                val += '&LRNNum=' + jsonStudent[i][0];
                val += '&GradeLevel=' + GradeLevel;
                val += '&SubjectCode=' + SubjectCode;
                val += '&Quarter=' + quarterSelected;

                misQuery('principalApproved', val, () => null);
            }
        }

        let isConfirmed = function(newCase) {
            updateCaseStatus(newCase);

            btn_approve.disabled = true;
            btn_disapprove.disabled = true;
        }


        if (accessType === 'coordinator') {
            if (confirm("Do you want to approve?")) {
                isConfirmed(5);
                alert('Grades can now be evaluated by the principal!');
            } else {
                alert('Cancelled.');
            }
        } else if (accessType === 'principal') {
            if (confirm("Do you want to approve?")) {
                principalApproved();
                isConfirmed(6);
                alert('Grades can now be viewed by the adviser!');
            } else {
                alert('Cancelled.');
            }
        }
    });


    btn_disapprove.addEventListener('click', () => {
        let isConfirmed = function(newCase) {
            updateCaseStatus(newCase);
            btn_approve.disabled = true;
            btn_disapprove.disabled = true;
            alert('Subject teachers can now be allowed to fix grades.');
        }

        if (confirm("Do you want to disapprove?")) {
            if (accessType === 'coordinator') {
                isConfirmed(2);
            } else if (accessType === 'principal') {
                isConfirmed(3);
            }
        } else {
            alert('Cancelled.');
        }
    });
}


let approvalChange = function() {
    // 0	DISABLED T. ENCODING OF GRADES NOT STARTED YET.
    // 1	ENABLED T. SUBJECT TEACHERS GRADING FOR THE FIRST TIME. IF SAVED, DISABLE. GOTO 4.
    // 2	ENABLED T. ALREADY VIEWED BY C, BUT NEEDS CORRECTION. IF SAVED, DISABLE. GOTO 4.
    // 3	ENABLED T. ALREADY VIEWED BY P, BUT NEEDS CORRECTION. IF SAVED, DISABLE. GOTO 5.
    // 4	DISABLED C. C IS EVALUATING. IF NEEDS CORRECTION, GOTO 2. ELSE, GOTO 5.
    // 5	DISABLED P. P IS EVALUATING. IF NEEDS CORRECTION, GOTO 3. ELSE, GOTO 6.
    // 6	DISABLED T. GRADES ARE NOW ACCESSIBLE. PENDING -> APPROVED (`grade_subject`/`Status`).

    btn_approve.style.display = 'block';
    btn_disapprove.style.display = 'block';


    if (accessType === 'coordinator') {
        if (currCase === 4) {
            btn_approve.disabled = false;
            btn_disapprove.disabled = false;
        } else {
            btn_approve.disabled = true;
            btn_disapprove.disabled = true;
        }
    } else if (accessType === 'principal') {
        if (currCase === 5) {
            btn_approve.disabled = false;
            btn_disapprove.disabled = false;
        } else {
            btn_approve.disabled = true;
            btn_disapprove.disabled = true;
        }
    }
}



let init = (function() {
    modalSubject();
    approvalListeners();
})();