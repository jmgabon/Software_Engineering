'use strict';


// WILL APPLY MODULE PATTERN LATER

const wrapperGradeViewSubject = (function() {

})();



const wrapperGradeViewValues = (function() {

})();



const wrapperGradeViewMain = (function(wrapSubj, wrapVal) {

})(wrapperGradeViewSubject, wrapperGradeViewValues);
//



let schoolYear;
let studentName;
let studentAge;
let studentSex;
let gradeLevel;
let sectionNum;
let sectionName;
let principalName;
let adviserName;
let numFailed;

let parent_id;
let trTableGrade;
let arrSubjCode = [];

const modal_body = document.querySelector('#modal-body');
const modal_button = document.querySelector('.modal-button');
const objMAPEH = [
    // Subject Code : Subject Description
    {
        'MUSIC 7': 'Music 7',
        'ARTS 7': 'Arts 7',
        'PE 7': 'PE 7',
        'HEALTH 7': 'Health 7',
    },

    {
        'MUSIC 8': 'Music 8',
        'ARTS 8': 'Arts 8',
        'PE 8': 'PE 8',
        'HEALTH 8': 'Health 8',
    },

    {
        'MUSIC 9': 'Music 9',
        'ARTS 9': 'Arts 9',
        'PE 9': 'PE 9',
        'HEALTH 9': 'Health 9',
    },
    {
        'MUSIC 10': 'Music 10',
        'ARTS 10': 'Arts 10',
        'PE 10': 'PE 10',
        'HEALTH 10': 'Health 10',
    }
];



if (accessRole === 'teacher') {
    modal_button.addEventListener('click', function() {
        let theadID = 'LRNNum@LastName@Extension@FirstName@MiddleName';
        let theadHTML = 'LRN@Last Name@Extension@First Name@Middle Name';
        CreateSearchBox(theadID, theadHTML, '@', 'SearchStudent', 'search', modal_body);

        let cat = document.querySelector('#modal-body select');
        let hiddenCol = '';
        const searchStudent = document.querySelector('#SearchStudent');
        theadID += '@' + hiddenCol;
        theadHTML += '@' + hiddenCol;
        CreateTable('SearchStudentTable', theadID, theadHTML, '@', modal_body, 0, hiddenCol);

        document.querySelector('thead').className = 'dark';
        openModal('Select Student', 'Student');


        let Search = function() {
            let query = '';

            query += 'SELECT student.LRNNum, LastName, Extension, FirstName, MiddleName, Age, Gender ';
            query += 'FROM student ';
            query += 'LEFT JOIN student_section ON student.LRNNum = student_section.LRNNum ';
            query += 'WHERE student_section.SectionNum IN (' + sectionNum + ')';

            if (searchStudent.value !== '') {
                let queryAnd;
                let queryNull;

                if (cat.options[cat.selectedIndex].value === 'LRNNum') {
                    queryAnd = 'AND student.';
                } else {
                    queryAnd = 'AND '
                }

                if (searchStudent.value === ' ') {
                    queryNull = ' IS NULL';
                } else {
                    queryNull = ' LIKE "' + searchStudent.value + '%"';
                }

                query += queryAnd + cat.options[cat.selectedIndex].value + queryNull;
            }

            SimplifiedQuery('SELECT', query, searchStudent, PickStudent);
        }
        Search();

        cat.addEventListener('change', () => {
            searchStudent.value = '';
            Search();
        });
        searchStudent.addEventListener('change', Search);
    });
}


function PickStudent(xhttp) {
    console.log(JSON.parse(xhttp.responseText));
    CreateTBody(xhttp, PickStudent);
    const tbody_tr = document.querySelectorAll('#SearchStudentTable tbody tr');

    for (let i = 0; i < tbody_tr.length; i++) {
        tbody_tr[i].addEventListener('click', function() {
            const txt_StudentModal = document.querySelector('#txt_StudentModal');
            document.querySelector('#SearchStudent').value = '';
            closeModal(modal_body);

            let extName = this.childNodes[2].innerHTML;

            if (extName !== '') {
                extName = ' ' + extName;
            }

            LRNNum = this.childNodes[0].textContent;
            txt_StudentName.textContent = this.childNodes[1].textContent;
            txt_StudentName.textContent += extName + ', ';
            txt_StudentName.textContent += this.childNodes[3].textContent + ' ';
            txt_StudentName.textContent += this.childNodes[4].textContent;
            txt_StudentModal.value = txt_StudentName.textContent;
            studentName = txt_StudentName.textContent

            studentAge = this.childNodes[4].textContent;
            studentSex = this.childNodes[5].textContent;

            setGradeSubjDB();
            setGradeValDB();
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


function AddPostData() {
    const formData = document.forms['postData'];

    formData.elements["LRNNum"].value = LRNNum;
    formData.elements["schoolYear"].value = schoolYear;
    formData.elements["studentName"].value = studentName;
    formData.elements["studentAge"].value = studentAge;
    formData.elements["studentSex"].value = studentSex;
    formData.elements["gradeLevel"].value = gradeLevel;
    formData.elements["sectionName"].value = sectionName;
    formData.elements["principalName"].value = principalName;
    formData.elements["adviserName"].value = adviserName;
}

function indexGrLvl(grLvl) {
    switch (grLvl) {
        case 7:
            return 0;
        case 8:
            return 1;
        case 9:
            return 2;
        case 10:
            return 3;
    }
}


let createTBodySubj = function(subj) {
    let tr, td;
    let columnLen = 7;
    const tbodySubject = document.querySelector('#tbodySubject');


    for (let i = 0; i < subj.length + 1; i++) {
        tr = document.createElement('tr');
        for (let j = 0; j < columnLen; j++) {
            td = document.createElement('td');

            if (i < subj.length) {
                if (subj[i]['SubjectDescription'] !== null) {
                    td.innerHTML = (j == 0) ? subj[i]['SubjectDescription'] : '';
                } else {
                    td.innerHTML = (j == 0) ? (subj[i]['SubjectCode'] + ': NULL') : '';
                }
            } else {
                td.textContent = (j == 0) ? 'AVERAGE' : '';
                tr.setAttribute('style', 'font-weight:bold');
            }

            tr.appendChild(td);
        }
        tbodySubject.appendChild(tr);


        if (i < subj.length) {
            arrSubjCode.push(subj[i]['SubjectCode']);

            // finds MAPEH, gets children
            if (subj[i]['SubjectCode'] === 'MAPEH 7' ||
                subj[i]['SubjectCode'] === 'MAPEH 8' ||
                subj[i]['SubjectCode'] === 'MAPEH 9' ||
                subj[i]['SubjectCode'] === 'MAPEH 10') {
                Object.keys(objMAPEH[indexGrLvl(gradeLevel)]).forEach((key) => {
                    tr = document.createElement('tr');

                    for (let j = 0; j < columnLen; j++) {
                        td = document.createElement('td');
                        td.innerHTML = (j == 0) ? '&nbsp &nbsp' + objMAPEH[indexGrLvl(gradeLevel)][key] : '';
                        tr.appendChild(td);
                    }

                    tbodySubject.appendChild(tr);

                    arrSubjCode.push(key);
                })
            }
        }
    }

    console.log(subj);
    console.log(arrSubjCode);
}


let setSubjectListDB = function(grLvl) {
    let query = '';

    query += 'SELECT subjectcode.SubjectCode, subjectcode.SubjectDescription ';
    query += 'FROM subjectcode ';
    query += 'LEFT JOIN grade_sortable ON subjectcode.SubjectCode = grade_sortable.SubjectCode ';
    query += 'WHERE subjectcode.GradeLevel IN (' + grLvl + ') ';
    query += 'AND subjectcode.SubjectCode NOT LIKE "HOMEROOM%" ';
    query += 'ORDER BY grade_sortable.OrderNumber ASC ';

    SimplifiedQuery('SELECT', query, '', getSubjectListDB);
}


let getSubjectListDB = function(xhttp) {
    let jsonSubject;

    try {
        jsonSubject = JSON.parse(xhttp.responseText);
        createTBodySubj(jsonSubject);

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}

let setStudentInfo = function() {
    let query = '';

    query += 'SELECT LastName, Extension, FirstName, MiddleName, Age, Gender, GradeLevel ';
    query += 'FROM student ';
    query += 'WHERE LRNNum IN ("' + LRNNum + '") ';

    SimplifiedQuery('SELECT', query, '', getStudentInfo);
}

let getStudentInfo = function(xhttp) {
    let jsonStudentInfo = JSON.parse(xhttp.responseText);
    console.log(jsonStudentInfo)

    try {
        let extName = jsonStudentInfo[0]['Extension'];
        let midName = jsonStudentInfo[0]['MiddleName'];

        if (midName === null) {
            midName = '';
        }

        if (extName === null) {
            extName = '';
        } else {
            extName = ' ' + extName;
        }


        txt_StudentName.textContent = jsonStudentInfo[0]['LastName'];
        txt_StudentName.textContent += extName + ', ';
        txt_StudentName.textContent += jsonStudentInfo[0]['FirstName'] + ' ';
        txt_StudentName.textContent += midName;
        studentName = txt_StudentName.textContent;

        studentAge = jsonStudentInfo[0]['Age'];
        studentSex = jsonStudentInfo[0]['Gender'];

        gradeLevel = jsonStudentInfo[0]['GradeLevel'];
        txt_GradeLevel.textContent = gradeLevel;

        setSubjectListDB(gradeLevel);
        setIfSectionAssigned();

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


let setIfSectionAssigned = function() {
    let query = '';

    query += 'SELECT SectionNum ';
    query += 'FROM student_section ';
    query += 'WHERE LRNNum IN ("' + LRNNum + '") ';
    query += 'AND GradeLevel IN ("' + gradeLevel + '") ';

    SimplifiedQuery('SELECT', query, '', getIfSectionAssigned);
}


let getIfSectionAssigned = function(xhttp) {
    let jsonSection = JSON.parse(xhttp.responseText);
    console.log(jsonSection);

    try {
        if (jsonSection.length === 0) {
            alert('Student does not have section yet. Please contact administrator.');
        } else {
            setSectionInfo();
            setGradeSubjDB();
            setGradeValDB();
        }

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


function setSectionInfo() {
    let query = '';

    if (accessRole === 'teacher') {
        query += 'SELECT section.SectionNum, section.SectionName, section.GradeLevel, ';
        query += 'IF(MiddleName IS NULL, CONCAT(LastName, IF(Extension is NULL, "", CONCAT(" ", Extension)), ", " , FirstName, "" , ""), ';
        query += 'CONCAT(LastName, IF(Extension is NULL, "", CONCAT(" ", Extension)), ", " , FirstName, " " , LEFT(MiddleName, 1), ".")) AS Adviser ';
        query += 'FROM section ';
        query += 'LEFT JOIN employee ON section.EmployeeNum = employee.EmployeeNum ';
        query += 'WHERE section.EmployeeNum IN (' + employeeNum + ') ';
    } else if (accessRole === 'student') {
        query += 'SELECT section.SectionNum, section.SectionName, section.GradeLevel, ';
        query += 'IF(MiddleName IS NULL, CONCAT(LastName, IF(Extension is NULL, "", CONCAT(" ", Extension)), ", " , FirstName, "" , ""), ';
        query += 'CONCAT(LastName, IF(Extension is NULL, "", CONCAT(" ", Extension)), ", " , FirstName, " " , LEFT(MiddleName, 1), ".")) AS Adviser ';
        query += 'FROM section ';
        query += 'LEFT JOIN student_section ';
        query += 'ON section.SectionNum = student_section.SectionNum ';
        query += 'JOIN employee ';
        query += 'ON section.EmployeeNum = employee.EmployeeNum ';
        query += 'WHERE student_section.LRNNum IN (' + LRNNum + ') ';
        query += 'ORDER BY student_section.DateCreated DESC ';
        query += 'LIMIT 1 ';
    }

    SimplifiedQuery('SELECT', query, '', getSectionInfo);
}


function getSectionInfo(xhttp) {
    try {
        let jsonSecInfo = JSON.parse(xhttp.responseText);
        const txt_AdviserName = document.querySelector('#txt_AdviserName');
        const txt_SectionName = document.querySelector('#txt_SectionName');
        const txt_GradeLevel = document.querySelector('#txt_GradeLevel');

        console.log(jsonSecInfo);

        sectionNum = jsonSecInfo[0]['SectionNum'];
        adviserName = jsonSecInfo[0]['Adviser'];
        sectionName = jsonSecInfo[0]['SectionName'];

        if (accessRole === 'teacher') {
            gradeLevel = jsonSecInfo[0]['GradeLevel'];
            setSubjectListDB(gradeLevel);
        }

        txt_AdviserName.textContent = adviserName;
        txt_SectionName.textContent = sectionName;
        txt_GradeLevel.textContent = gradeLevel;



    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


function clearTBodySubj() {
    for (let i = 0; i < trTableGrade.length; i++) {
        for (let j = 1; j <= 6; j++) {
            trTableGrade[i].cells[j].textContent = '';
        }
    }
}


function setGradeSubjDB() {
    let query = '';

    query += 'SELECT SubjectCode, Quarter, GradeRating ';
    query += 'FROM grade_subject ';
    query += 'WHERE LRNNum IN (' + LRNNum + ') ';
    query += 'AND GradeLevel IN (' + gradeLevel + ') ';

    SimplifiedQuery('SELECT', query, '', getGradeSubjDB);
}


function getGradeSubjDB(xhttp) {
    let jsonGradeSubj;
    trTableGrade = document.querySelectorAll('#tableSubject tbody tr');

    jsonGradeSubj = JSON.parse(xhttp.responseText);
    console.log(jsonGradeSubj);

    clearTBodySubj();

    try {
        for (let i = 0; i < jsonGradeSubj.length; i++) {

            for (let j = 0; j < trTableGrade.length; j++) {
                if (jsonGradeSubj[i]['SubjectCode'] == arrSubjCode[j]) {
                    trTableGrade[j].cells[jsonGradeSubj[i]['Quarter']].textContent = jsonGradeSubj[i]['GradeRating'];
                }
            }
        }

        getAveMAPEH();
        calculateFinalWithRemark();
        calculateAverage();
    } catch (err) {
        console.log(err);
    }
}


function getAveMAPEH() {
    for (let i = 0; i < trTableGrade.length; i++) {

        if (trTableGrade[i].textContent === 'MAPEH 7' ||
            trTableGrade[i].textContent === 'MAPEH 8' ||
            trTableGrade[i].textContent === 'MAPEH 9' ||
            trTableGrade[i].textContent === 'MAPEH 10') {
            for (let j = 1; j <= 4; j++) {
                let aveMAPEH = 0;
                let isMAPEHGradeCompleted = true;

                Object.keys(objMAPEH[indexGrLvl(gradeLevel)]).forEach((key) => {
                    let childMAPEH = trTableGrade[arrSubjCode.indexOf(key)].cells[j].textContent;

                    if (childMAPEH == '') {
                        isMAPEHGradeCompleted = false;
                    } else {
                        aveMAPEH += Number(childMAPEH);
                    }
                })

                if (isMAPEHGradeCompleted) {
                    trTableGrade[i].cells[j].textContent = (aveMAPEH / 4).toFixed(0);
                }
            }
        }
    }
}


function calculateFinalWithRemark() {
    numFailed = 0;

    for (let i = 0; i < trTableGrade.length - 1; i++) {
        let isRowGradeCompleted = true;

        for (let j = 1; j <= 4; j++) {
            if (trTableGrade[i].cells[j].textContent == '') {
                isRowGradeCompleted = false
            }
        }

        if (isRowGradeCompleted) {
            let finalRating = 0;

            for (let j = 1; j <= 4; j++) {
                finalRating += Number(trTableGrade[i].cells[j].textContent);
            }

            finalRating /= 4;
            finalRating = finalRating.toFixed(0);
            trTableGrade[i].cells[5].textContent = finalRating;

            if (finalRating >= 75) {
                trTableGrade[i].cells[6].textContent = 'PASSED';
            } else {
                trTableGrade[i].cells[6].textContent = 'FAILED';
                numFailed++;
            }
        }
    }
}

function calculateAverage() {
    let GWA = '';
    let remarksGWA;

    for (let i = 1; i <= 5; i++) {
        let isColGradeCompleted = true;

        for (let j = 0; j < trTableGrade.length - 1; j++) {
            if (trTableGrade[j].cells[i].textContent == '') {
                isColGradeCompleted = false;
            }
        }

        if (isColGradeCompleted) {
            let lenChild = 0;
            let colAverage = 0;

            for (let j = 0; j < trTableGrade.length - 1; j++) {
                // skip compute of average if child (MAPEH)
                if (Object.keys(objMAPEH[indexGrLvl(gradeLevel)]).includes(arrSubjCode[j])) {
                    lenChild++;
                    continue;
                } else {
                    colAverage += Number(trTableGrade[j].cells[i].textContent);
                }
            }

            colAverage /= ((trTableGrade.length - 1) - lenChild);
            colAverage = colAverage.toFixed(0);
            trTableGrade[trTableGrade.length - 1].cells[i].textContent = colAverage;
        }
    }


    GWA = Number(trTableGrade[trTableGrade.length - 1].cells[5].textContent);

    if (GWA == '') {
        remarksGWA = '';
    } else if (GWA >= 75) {
        if (numFailed === 0) {
            remarksGWA = 'PROMOTED';
        } else if ((numFailed === 1) || (numFailed === 2)) {
            remarksGWA = 'PROMOTED (CONDITIONAL)';
        } else {
            remarksGWA = 'RETAINED';
        }
    } else {
        remarksGWA = 'RETAINED';
    }

    trTableGrade[trTableGrade.length - 1].cells[6].textContent = remarksGWA;
}


function setGradeValDB() {
    let query = '';

    query += 'SELECT BehaviorID, Quarter, GradeValRating ';
    query += 'FROM grade_values ';
    query += 'WHERE LRNNum IN (' + LRNNum + ') ';
    query += 'AND GradeValLevel IN (' + gradeLevel + ') ';

    SimplifiedQuery('SELECT', query, '', getGradesValDB);
}


function getGradesValDB(xhttp) {
    let jsonGradeVal = JSON.parse(xhttp.responseText);
    console.log(jsonGradeVal);

    for (let i = 1; i <= 4; i++) {
        for (let j = 0; j <= 6; j++) {
            document.querySelectorAll('.grValQ' + i)[j].textContent = '';
        }
    }


    try {
        for (let i = 0; i < jsonGradeVal.length; i++) {
            document.querySelectorAll('.grValQ' + jsonGradeVal[i]['Quarter'])[getParentCol(jsonGradeVal[i]['BehaviorID'])].textContent = jsonGradeVal[i]['GradeValRating'];
        }

    } catch (err) {
        console.log(err);
    }
}


function getParentCol(child) {
    if (child.includes('1a')) return 0;
    else if (child.includes('1b')) return 1;
    else if (child.includes('2a')) return 2;
    else if (child.includes('2b')) return 3;
    else if (child.includes('3a')) return 4;
    else if (child.includes('3b')) return 5;
    else if (child.includes('4a')) return 6;
}


function printInnerReportCard() {
    window.print();
}



let init = (function() {
    if (accessRole === 'teacher') {
        setSectionInfo();
    } else if (accessRole === 'student') {
        setStudentInfo();
    }
})();