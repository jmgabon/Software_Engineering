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
let tempSubjectID;

let newCase;
let currCase;

let encodingEnabled;


const txt_Adviser = document.querySelector('#txt_Adviser');
const txt_SubjTeacher = document.querySelector('#txt_SubjTeacher');
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

const txt_encoding = document.querySelector('#txt_encoding');
const txt_quarter = document.querySelector('#txt_quarter');


let modalSubject = function() {
    modal_button.addEventListener('click', function() {
        let theadID = 'SubjectCode@SectionName@GradeLevel@Teacher@Status';
        let theadHTML = 'Subject Code@Section Name@Grade Level@Teacher@Status';
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

            SubjectCode = this.childNodes[0].textContent;
            txt_Section.innerHTML = this.childNodes[1].textContent;
            GradeLevel = this.childNodes[2].textContent;
            txt_SubjTeacher.innerHTML = this.childNodes[3].textContent;

            SubjectID = this.childNodes[5].textContent;
            SectionNum = this.childNodes[6].textContent;
            teacherNum = this.childNodes[7].textContent;

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
        tempSubjectID = SubjectID;

        RemoveChildNodes(tbody);
        textCaseStatus('cls');
        setAdviserName();


    } else {
        labelMAPEH.style.display = 'none';

        RemoveChildNodes(tbody);
        setCaseStatus();
        setAdviserName();
        setStudentListDB();
    }
}


let setSubMAPEH = function() {
    SubjectCode = selectMAPEH.value + ' ' + GradeLevel;
    txt_SubjectCode.innerHTML = input_SubjectCode.value + '/' + SubjectCode;

    SubjectID = selectMAPEH.value + tempSubjectID.slice(5);

    RemoveChildNodes(tbody);
    setCaseStatus();
    setStudentListDB();

    console.log(txt_Section.innerHTML + ' ' + SubjectCode + ' selected.');
}


let setAdviserName = function() {
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


let setEncodingEnabledDB = function() {
    let val = '';

    misQuery('setEncodingEnabledDB', val, getEncodingEnabledDB);
};


let getEncodingEnabledDB = function(xhttp) {
    try {
        jsonQuarter = JSON.parse(xhttp.responseText);
        encodingEnabled = jsonQuarter[0]['SettingValue'];

        console.log(encodingEnabled);
        encodingEnabled = (encodingEnabled === '1') ? true : false;

        txt_encoding.textContent = (encodingEnabled === true) ? 'True' : 'False';

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


let setQuarterDB = function() {
    let val = '';

    misQuery('setQuarterDB', val, getQuarter);
};


let getQuarter = function(xhttp) {
    try {
        jsonQuarter = JSON.parse(xhttp.responseText);
        quarterSelected = jsonQuarter[0]['SettingValue'];

        txt_quarter.textContent = `Quarter now is ${quarterSelected}`;

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


let enablerQuarter = function(q, currCase) {
    if (encodingEnabled === true && q == quarterSelected &&
        (currCase == 1 || currCase == 2 || currCase == 3)) {
        return false
    }

    return true
}


let setStudentListDB = function() {
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
    setEncodingEnabledDB();
    setQuarterDB();
})();