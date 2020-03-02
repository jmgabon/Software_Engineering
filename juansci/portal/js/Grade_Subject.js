// 'use strict';


// WILL APPLY MODULE PATTERN LATER

const wrapperGradeSubject = (function() {

})();



const wrapperGradeViewMain = (function(wrapSubj) {

})(wrapperGradeSubject);
//


let quarterSelected;
let teacherEmployeeNum;
let jsonQuarter;
let gradeCaseValue;

let newGradeCaseValue;

let SectionNum;
let Quarter;
let jsonStudent;
let jsonGrade;
let SubjectCode;
let parent_id;
let selectMAPEH = document.querySelector('#selectMAPEH');
let colNum = document.querySelector('table thead tr').childElementCount + 3;

const tbody = document.querySelector('table tbody');
const txt_Section = document.querySelector('#txt_Section');
const input_SubjectCode = document.querySelector('#input_SubjectCode');
const txt_GradeLevel = document.querySelector('#txt_GradeLevel');
const txt_SubjectCode = document.querySelector('#txt_SubjectCode');
const txt_Adviser = document.querySelector('#txt_Adviser');
const modal_body = document.querySelector('#modal-body');
const button = document.querySelectorAll('button');
const labelMAPEH = document.querySelector('#labelMAPEH');

const btn_approve = document.querySelector('#btn_approve');
const btn_disapprove = document.querySelector('#btn_disapprove');

console.log('accessRole: ' + accessRole);

function setAdviserNameDB() {
    let query = '';
    txt_Adviser.innerHTML = '';

    query += 'SELECT IF(MiddleName IS NULL, CONCAT(LastName, IF(Extension is NULL, "", CONCAT(" ", Extension)), ", " , FirstName, "" , ""), ';
    query += 'CONCAT(LastName, IF(Extension is NULL, "", CONCAT(" ", Extension)), ", " , FirstName, " " , LEFT(MiddleName, 1), ".")) AS Adviser ';
    query += 'FROM section ';
    query += 'LEFT JOIN employee ON section.EmployeeNum = employee.EmployeeNum ';
    query += 'WHERE SectionNum IN (' + SectionNum + ') ';

    SimplifiedQuery('SELECT', query, '', function(xhttp) {
        try {
            txt_Adviser.innerHTML = JSON.parse(xhttp.responseText)[0][0];

        } catch (err) {
            alert('Section ' + txt_Section.innerHTML + ' does not have an adviser yet.');
            console.log(xhttp.responseText);
            console.log('Section ' + txt_Section.innerHTML + ' does not have an adviser yet.');
        }
    });
}


openSubjectModal = button[0];
openSubjectModal.addEventListener('click', function() {
    let theadID = 'SubjectCode@SectionName@GradeLevel@Adviser';
    let theadHTML = 'Subject Code@Section Name@Grade Level@Adviser';
    CreateSearchBox(theadID, theadHTML, '@', 'SearchSubject', 'search', modal_body);

    let cat = document.querySelector('#modal-body select');
    let hiddenCol = 'SectionNum@EmployeeNum';
    const searchSubject = document.querySelector('#SearchSubject');
    theadID += '@' + hiddenCol;
    theadHTML += '@' + hiddenCol;
    CreateTable('SearchSubjectTable', theadID, theadHTML, '@', modal_body, 0, hiddenCol);

    document.querySelector('thead').className = 'dark';
    openModal('Select Subject', 'Subject');

    let Search = function() {
        let query = '';

        query += 'SELECT subject.SubjectCode, section.SectionName, section.GradeLevel, ';
        query += 'IF(MiddleName IS NULL, CONCAT(LastName, IF(Extension is NULL, "", CONCAT(" ", Extension)), ", " , FirstName, "" , ""), ';
        query += 'CONCAT(LastName, IF(Extension is NULL, "", CONCAT(" ", Extension)), ", " , FirstName, " " , LEFT(MiddleName, 1), ".")) AS Adviser, ';
        query += 'section.SectionNum, subject.EmployeeNum ';
        query += 'FROM subject ';
        query += 'INNER JOIN section ';
        query += 'ON subject.SectionNum = section.SectionNum ';
        query += 'JOIN employee ';
        query += 'ON subject.EmployeeNum = employee.EmployeeNum ';

        if (accessRole === 'teacher') {
            query += 'WHERE subject.EmployeeNum = ' + EmployeeNum + ' ';
        } else {
            query += 'ORDER BY Adviser ASC';
        }

        if (searchSubject.value !== '') {
            let queryHaving;

            if (cat.options[cat.selectedIndex].value === 'Adviser') {
                queryHaving = 'HAVING ';
            } else {
                queryHaving = 'AND ';
            }

            query += queryHaving + cat.options[cat.selectedIndex].value + ' LIKE "' + searchSubject.value + '%"';
        }

        SimplifiedQuery('SELECT', query, searchSubject, getSubject);
    }
    Search();

    searchSubject.addEventListener('change', Search);
    cat.addEventListener('change', () => {
        searchSubject.value = '';
        Search();
    });
});


let displayAfterClickModal = function() {
    setGradeCase();

    if (input_SubjectCode.value === 'MAPEH 7' ||
        input_SubjectCode.value === 'MAPEH 8' ||
        input_SubjectCode.value === 'MAPEH 9' ||
        input_SubjectCode.value === 'MAPEH 10') {
        labelMAPEH.style.display = 'block';
        selectMAPEH.value = selectMAPEH.options[0].value;
        RemoveChildNodes(tbody);
        setQuarterDB();
        setAdviserNameDB();

    } else {
        labelMAPEH.style.display = 'none';
        RemoveChildNodes(tbody);
        setQuarterDB();
        setAdviserNameDB();
        setStudentListDB();
    }
}


function getSubject(xhttp) {
    console.log(JSON.parse(xhttp.responseText));
    CreateTBody(xhttp, getSubject);
    const tbody_tr = document.querySelectorAll('#SearchSubjectTable tbody tr');

    for (let i = 0; i < tbody_tr.length; i++) {
        tbody_tr[i].addEventListener('click', function() {
            document.querySelector('#SearchSubject').value = '';
            closeModal(modal_body);

            SectionNum = this.childNodes[4].innerHTML;
            teacherEmployeeNum = this.childNodes[5].innerHTML;
            console.log('teacherEmployeeNum: ' + teacherEmployeeNum)
            SubjectCode = this.childNodes[0].innerHTML;
            txt_Section.innerHTML = this.childNodes[1].innerHTML;
            txt_GradeLevel.innerHTML = this.childNodes[2].innerHTML;

            input_SubjectCode.value = SubjectCode;
            txt_SubjectCode.innerHTML = SubjectCode;

            displayAfterClickModal();

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


function setStudentListDB() {
    let query = '';

    query += 'SELECT student.LRNNum, student.LastName, student.Extension, student.FirstName, student.MiddleName ';
    query += 'FROM student ';
    query += 'LEFT JOIN student_section ON student.LRNNum = student_section.LRNNum ';
    query += 'WHERE student_section.SectionNum IN (' + SectionNum + ') ';

    SimplifiedQuery('SELECT', query, '', tBodyGrade);
}


function setQuarterDB() {
    let query = '';

    query += 'SELECT SettingValue ';
    query += 'FROM setting ';
    query += 'WHERE SettingName = "quarter_enabled" ';

    SimplifiedQuery('SELECT', query, '', getQuarter);
};


function getQuarter(xhttp) {
    try {
        jsonQuarter = JSON.parse(xhttp.responseText);
        quarterSelected = jsonQuarter[0]['SettingValue'];

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


function setSubMAPEH() {
    SubjectCode = selectMAPEH.value + ' ' + txt_GradeLevel.innerHTML;
    txt_SubjectCode.innerHTML = input_SubjectCode.value + '/' + SubjectCode;

    RemoveChildNodes(tbody);
    setStudentListDB();

    console.log(txt_Section.innerHTML + ' ' + SubjectCode + ' selected.');
}


function enablerQuarter(q) {
    if (accessRole === 'principal' || accessRole === 'coordinator') {
        return true
    }

    if (q == quarterSelected &&
        (gradeCaseValue == 1 || gradeCaseValue == 2 || gradeCaseValue == 3)) {
        return false
    }
    return true
}


function tBodyGrade(xhttp) {

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


                    function setInputGrade(i) {
                        input_quarter = document.createElement('input');
                        input_quarter.setAttribute('type', 'input');
                        input_quarter.setAttribute('style', 'width:3em');
                        input_quarter.setAttribute('maxlength', '3');
                        input_quarter.disabled = enablerQuarter(i);

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

                    function setSaveButton(i) {
                        if (accessRole === 'teacher') {
                            button_save = document.createElement('button');
                            button_save.disabled = enablerQuarter(i);

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
                            let extName = jsonStudent[i]['Extension'];


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

            if (accessRole === 'teacher') {
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


function setGradeDB() {
    let query = '';

    query += 'SELECT student.LRNNum, grade_subject.GradeLevel, grade_subject.SubjectCode, ';
    query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 1 THEN grade_subject.GradeRating END), null) AS Q1, ';
    query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 2 THEN grade_subject.GradeRating END), null) AS Q2, ';
    query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 3 THEN grade_subject.GradeRating END), null) AS Q3, ';
    query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 4 THEN grade_subject.GradeRating END), null) AS Q4, ';
    query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 1 THEN grade_subject.GradeID END), null) AS IDQ1, ';
    query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 2 THEN grade_subject.GradeID END), null) AS IDQ2, ';
    query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 3 THEN grade_subject.GradeID END), null) AS IDQ3, ';
    query += 'COALESCE(SUM(CASE WHEN grade_subject.Quarter = 4 THEN grade_subject.GradeID END), null) AS IDQ4 ';
    query += 'FROM student ';
    query += 'LEFT JOIN grade_subject ON student.LRNNum = grade_subject.LRNNum ';
    query += 'INNER JOIN student_section ON student.LRNNum = student_section.LRNNum ';
    query += 'WHERE student_section.SectionNum IN (' + SectionNum + ') ';
    query += 'AND grade_subject.SubjectCode IN ("' + SubjectCode + '") ';
    query += 'GROUP BY student.LRNNum ';

    SimplifiedQuery('SELECT', query, '', getGradeDB);
}


function getGradeDB(xhttp) {
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


function insertGrade() {
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

    getFinalAndRemark();
}


function checkValidInput() {
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


function saveGrade() {
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
                let query = '';

                query += 'INSERT INTO grade_subject ';
                query += '(GradeID, LRNNum, GradeLevel, SubjectCode, Quarter, GradeRating) ';
                query += 'VALUES ("' + GradeID + '", "';
                query += jsonStudent[i][0] + '", "';
                query += txt_GradeLevel.innerHTML + '", "';
                query += SubjectCode + '", "';
                query += Quarter + '", "';
                query += GradeRating + '") ';
                query += 'ON DUPLICATE KEY UPDATE GradeRating = ' + GradeRating;

                SimplifiedQuery('INSERT', query, '', () => null);
            } else {
                let query = 'DELETE FROM grade_subject WHERE grade_subject.GradeID = ' + GradeID;
                SimplifiedQuery('DELETE', query, '', () => null);
            }
        }

        alert('QUARTER ' + Quarter + ' GRADES SAVED');
        console.log('QUARTER ' + Quarter + ' GRADES SAVED');
        setGradeDB();

        //
        changeGradeCase();
        textCaseStatus(newGradeCaseValue);

        save1.disabled = true;
        save2.disabled = true;
        save3.disabled = true;
        save4.disabled = true;
        //
    } else {
        alert('Invalid input! Check all grades.');
    }
}


let changeGradeCase = function() {
    switch (gradeCaseValue) {
        case 0:
            break;
        case 1:
            newGradeCaseValue = 4;
            break;
        case 2:
            newGradeCaseValue = 4;
            break;
        case 3:
            newGradeCaseValue = 5;
            break;
        case 4:
            break;
        case 5:
            break;
    }

    let query = '';

    query += 'UPDATE grade_case ';
    query += 'SET CaseValue = ' + newGradeCaseValue + ' ';
    if (accessRole === 'teacher') {
        query += 'WHERE EmployeeNum = ' + EmployeeNum + ' ';
        query += 'AND SubjectCode = "' + SubjectCode + '" ';
    } else if (accessRole === 'principal' || accessRole === 'coordinator') {
        query += 'WHERE EmployeeNum = ' + teacherEmployeeNum + ' ';
        query += 'AND SubjectCode = "' + SubjectCode + '" ';
    }

    console.log(query);

    SimplifiedQuery('UPDATE', query, '', () => null);
}


function getFinalAndRemark() {
    let finalRating;
    const CreateGradeTable = document.querySelector('#CreateGradeTable');

    for (let i = 0; i < jsonStudent.length; i++) {
        CreateGradeTable.rows[i + 2].cells[6].innerHTML = '';
        CreateGradeTable.rows[i + 2].cells[7].innerHTML = '';

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

        function completeGrade() {
            CreateGradeTable.rows[i + 2].cells[6].innerHTML = finalRating.toFixed(0);

            if (finalRating >= 75)
                CreateGradeTable.rows[i + 2].cells[7].innerHTML = 'PASSED';
            else
                CreateGradeTable.rows[i + 2].cells[7].innerHTML = 'FAILED';
        }
    }
}


let textCaseStatus = function(val) {
    let txt_gradeCaseStatus = document.querySelector('#txt_gradeCaseStatus');

    switch (val) {
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


let setGradeCase = function() {
    let query = '';

    query += 'SELECT CaseValue ';
    query += 'FROM grade_case ';
    if (accessRole === 'teacher') {
        query += 'WHERE EmployeeNum = ' + EmployeeNum + ' ';
        query += 'AND SubjectCode = "' + SubjectCode + '" ';
    } else if (accessRole === 'principal' || accessRole === 'coordinator') {
        query += 'WHERE EmployeeNum = ' + teacherEmployeeNum + ' ';
        query += 'AND SubjectCode = "' + SubjectCode + '" ';
    }

    SimplifiedQuery('SELECT', query, '', getGradeCase);
};


let getGradeCase = function(xhttp) {
    try {
        jsonGradeCase = JSON.parse(xhttp.responseText);
        gradeCaseValue = jsonGradeCase[0]['CaseValue'];

        if (accessRole === 'coordinator') {
            if (gradeCaseValue === 4) {
                btn_approve.disabled = false;
                btn_disapprove.disabled = false;
            } else {
                btn_approve.disabled = true;
                btn_disapprove.disabled = true;
            }
        } else if (accessRole === 'principal') {
            if (gradeCaseValue === 5) {
                btn_approve.disabled = false;
                btn_disapprove.disabled = false;
            } else {
                btn_approve.disabled = true;
                btn_disapprove.disabled = true;
            }
        }

        textCaseStatus(gradeCaseValue);
    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}



let init = (function() {
    // 0	DISABLED T. ENCODING OF GRADES NOT STARTED YET.
    // 1	ENABLED T. SUBJECT TEACHERS GRADING FOR THE FIRST TIME. IF SAVED, DISABLE. GOTO 4.
    // 2	ENABLED T. ALREADY VIEWED BY AC, BUT NEEDS CORRECTION. IF SAVED, DISABLE. GOTO 4.
    // 3	ENABLED T. ALREADY VIEWED BY P, BUT NEEDS CORRECTION. IF SAVED, DISABLE. GOTO 5.
    // 4	DISABLED AC. AC IS EVALUATING. IF NEEDS CORRECTION, GOTO 2. ELSE, GOTO 5.
    // 5	DISABLED P. P IS EVALUATING. IF NEEDS CORRECTION, GOTO 3. ELSE, GOTO 6.
    // 6	DISABLED T. GRADES ARE NOW ACCESSIBLE. PENDING -> APPROVED (`grade_subject`/`Status`).

    if (accessRole === 'principal' || accessRole === 'coordinator') {
        btn_approve.style.display = 'block';
        btn_disapprove.style.display = 'block';


        btn_approve.addEventListener('click', () => {
            if (accessRole === 'principal') {
                newGradeCaseValue = 6;
            } else if (accessRole === 'coordinator') {
                newGradeCaseValue = 5;
            }

            changeGradeCase();
            alert('Approved!');

            textCaseStatus(newGradeCaseValue);
            btn_approve.disabled = true;
            btn_disapprove.disabled = true;
        });

        btn_disapprove.addEventListener('click', () => {
            if (accessRole === 'principal') {
                newGradeCaseValue = 3;
            } else if (accessRole === 'coordinator') {
                newGradeCaseValue = 2;
            }

            changeGradeCase();
            alert('Needs Correction!');

            textCaseStatus(newGradeCaseValue);
            btn_approve.disabled = true;
            btn_disapprove.disabled = true;
        });

    }
})();