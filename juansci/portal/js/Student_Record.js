'use strict';


let parent_id;
let numFailed;
let trTableGrade;
let arrSubjCode = [];

const modal_body = document.querySelector('#modal-body');
const modal_button = document.querySelector('.modal-button');

const txt_LastName = document.querySelector('#txt_LastName');
const txt_FirstName = document.querySelector('#txt_FirstName');
const txt_ExtName = document.querySelector('#txt_ExtName');
const txt_MiddleName = document.querySelector('#txt_MiddleName');
const txt_StudentName = document.querySelector('#txt_StudentName');
const txt_LRN = document.querySelectorAll('#txt_LRN');
const txt_Birthdate = document.querySelector('#txt_Birthdate');
const txt_Sex = document.querySelector('#txt_Sex');

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



function setScholasticRecordInfo(tblLen, gradeLevel) {
    function getScholasticRecordInfo(xhttp) {
        try {
            let jsonSchoInfo = JSON.parse(xhttp.responseText);
            console.log(jsonSchoInfo);

            if (jsonSchoInfo.length !== 0) {
                let firstSY = Number(jsonSchoInfo[0]['DateCreated'].slice(0, 4));


                document.querySelectorAll('#txt_school')[tblLen].textContent = 'San Juan City Science High School';
                document.querySelectorAll('#txt_schoolID')[tblLen].textContent = '305607';
                document.querySelectorAll('#txt_district')[tblLen].textContent = '1';
                document.querySelectorAll('#txt_division')[tblLen].textContent = 'Division of San Juan City';
                document.querySelectorAll('#txt_region')[tblLen].textContent = 'National Capital Region';
                document.querySelectorAll('#txt_gradeLevel')[tblLen].textContent = gradeLevel;
                document.querySelectorAll('#txt_schoolYear')[tblLen].textContent = firstSY + '-' + (firstSY + 1);
                document.querySelectorAll('#txt_Adviser')[tblLen].textContent = jsonSchoInfo[0]['Adviser'];
            }

        } catch (err) {
            alert('CANNOT FIND');
            console.log(xhttp.responseText);
            console.log(err);
        }
    }


    let query = '';

    query += 'SELECT IF(MiddleName IS NULL, CONCAT(LastName, IF(Extension is NULL, "", CONCAT(" ", Extension)), ", " , FirstName, "" , ""), ';
    query += 'CONCAT(LastName, IF(Extension is NULL, "", CONCAT(" ", Extension)), ", " , FirstName, " " , LEFT(MiddleName, 1), ".")) AS Adviser, ';
    query += 'student_section_backup.DateCreated ';
    query += 'FROM section_backup ';
    query += 'JOIN student_section_backup ';
    query += 'ON section_backup.SectionNum = student_section_backup.SectionNum ';
    query += 'JOIN employee_backup ';
    query += 'ON section_backup.EmployeeNum = employee_backup.EmployeeNum ';
    query += 'WHERE student_section_backup.LRNNum IN (' + txt_LRN.textContent + ') ';
    query += 'AND student_section_backup.GradeLevel IN (' + gradeLevel + ') ';
    query += 'ORDER BY student_section_backup.DateCreated DESC ';
    query += 'LIMIT 1 ';

    SimplifiedQuery('SELECT', query, '', getScholasticRecordInfo);
}


modal_button.addEventListener('click', function() {
    let theadID = 'LRNNum@LastName@Extension@FirstName@MiddleName';
    let theadHTML = 'LRN@Last Name@Extension@First Name@Middle Name';
    CreateSearchBox(theadID, theadHTML, '@', 'SearchStudent', 'search', modal_body);

    let cat = document.querySelector('#modal-body select');
    let hiddenCol = 'Birthday@Gender';
    const searchStudent = document.querySelector('#SearchStudent');
    theadID += '@' + hiddenCol;
    theadHTML += '@' + hiddenCol;
    CreateTable('SearchStudentTable', theadID, theadHTML, '@', modal_body, 0, hiddenCol);

    document.querySelector('thead').className = 'dark';
    openModal('Select Student', 'Student');


    let Search = function() {
        let query = '';

        query += 'SELECT * ';
        query += 'FROM ( ';
        query += 'SELECT student_backup.LRNNum, LastName, Extension, FirstName, MiddleName, Birthday, Gender, student_backup.DateCreated ';
        query += 'FROM student_backup  ';
        query += 'LEFT JOIN student_section_backup ON student_backup.LRNNum = student_section_backup.LRNNum ';
        query += 'ORDER BY student_backup.DateCreated DESC ';
        query += 'LIMIT 18446744073709551615 '; // https://stackoverflow.com/questions/255517/mysql-offset-infinite-rows
        query += ') AS sub ';
        query += 'GROUP BY sub.LRNNum ';
        if (searchStudent.value !== '') {
            let queryNull;

            if (searchStudent.value === ' ') {
                queryNull = ' IS NULL';
            } else {
                queryNull = ' LIKE "' + searchStudent.value + '%"';
            }

            query += 'HAVING ' + cat.options[cat.selectedIndex].value + queryNull
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


function clearStudentData() {
    const studentData = document.querySelectorAll('#scholasticRecord p span');
    for (let i = 0; i < studentData.length; i++) {
        studentData[i].textContent = '';
    }
}


function PickStudent(xhttp) {
    CreateTBody(xhttp);
    let jsonStudentInfo = JSON.parse(xhttp.responseText)
    let tbody_tr = document.querySelectorAll('#SearchStudentTable tbody tr');

    for (let i = 0; i < tbody_tr.length; i++) {
        tbody_tr[i].addEventListener('click', function() {
            const txt_StudentModal = document.querySelector('#txt_StudentModal');
            document.querySelector('#SearchStudent').value = '';
            closeModal(modal_body);

            txt_LRN.textContent = this.childNodes[0].textContent;
            txt_LRN[0].textContent = txt_LRN.textContent
            txt_LRN[1].textContent = txt_LRN.textContent

            txt_LastName.textContent = this.childNodes[1].textContent;
            txt_FirstName.textContent = this.childNodes[3].textContent;
            txt_ExtName.textContent = this.childNodes[2].textContent;

            if (this.childNodes[2].textContent !== '') {
                txt_ExtName.textContent = this.childNodes[2].textContent;
            } else {
                txt_ExtName.textContent = 'N/A';
            }

            if (this.childNodes[4].textContent !== '') {
                txt_MiddleName.textContent = this.childNodes[4].textContent;
            } else {
                txt_MiddleName.textContent = 'N/A';
            }

            txt_StudentName.textContent = txt_FirstName.textContent + ' ';
            txt_StudentName.textContent += txt_MiddleName.textContent + ' ';
            txt_StudentName.textContent += txt_LastName.textContent;
            txt_StudentModal.textContent = txt_StudentName.textContent;

            txt_Birthdate.textContent = this.childNodes[5].textContent;
            txt_Sex.textContent = this.childNodes[6].textContent;

            clearStudentData();

            let gradeLevels = [7, 8, 9, 10];
            for (let i = 0; i < gradeLevels.length; i++) {
                setScholasticRecordInfo(i, gradeLevels[i])
                setGradeSubjDB(i, i, gradeLevels[i]);
            }
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


function indexgradeLevel(gradeLevel) {
    switch (gradeLevel) {
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


let setSubjectListDB = function(tblLen, iArrSubjCode, gradeLevel) {
    let createTBodySubj = function(tblLen, subj, gradeLevel) {
        let tr, td;
        let columnLen = 7;

        const tbodySubject = document.querySelectorAll('#tbodySubject')[tblLen];
        arrSubjCode[iArrSubjCode] = [];

        for (let i = 0; i < subj.length + 1; i++) {
            tr = document.createElement('tr');
            for (let j = 0; j < columnLen; j++) {
                td = document.createElement('td');

                if (i < subj.length) {
                    td.innerHTML = (j == 0) ? subj[i]['SubjectDescription'] : '';
                } else {
                    td.textContent = (j == 0) ? 'AVERAGE' : '';
                    tr.setAttribute('style', 'font-weight:bold');
                }

                tr.appendChild(td);
            }
            tbodySubject.appendChild(tr);


            if (i < subj.length) {
                arrSubjCode[iArrSubjCode].push(subj[i]['SubjectCode']);

                // finds MAPEH, gets children
                if (subj[i]['SubjectCode'] === 'MAPEH 7' ||
                    subj[i]['SubjectCode'] === 'MAPEH 8' ||
                    subj[i]['SubjectCode'] === 'MAPEH 9' ||
                    subj[i]['SubjectCode'] === 'MAPEH 10') {
                    Object.keys(objMAPEH[indexgradeLevel(gradeLevel)]).forEach((key) => {
                        tr = document.createElement('tr');

                        for (let j = 0; j < columnLen; j++) {
                            td = document.createElement('td');
                            td.innerHTML = (j == 0) ? '&nbsp &nbsp' + objMAPEH[indexgradeLevel(gradeLevel)][key] : '';
                            tr.appendChild(td);
                        }

                        tbodySubject.appendChild(tr);

                        arrSubjCode[iArrSubjCode].push(key);
                    })
                }
            }
        }

        console.log(subj);
        console.log(arrSubjCode[iArrSubjCode]);
    }


    let getSubjectListDB = function(xhttp) {
        let jsonSubject;

        try {
            jsonSubject = JSON.parse(xhttp.responseText);
            createTBodySubj(tblLen, jsonSubject, gradeLevel);

        } catch (err) {
            alert('CANNOT FIND');
            console.log(xhttp.responseText);
            console.log(err);
        }
    }


    let query = '';

    query += 'SELECT subjectcode.SubjectCode, subjectcode.SubjectDescription ';
    query += 'FROM subjectcode ';
    query += 'LEFT JOIN grade_sortable ON subjectcode.SubjectCode = grade_sortable.SubjectCode ';
    query += 'WHERE subjectcode.GradeLevel IN (' + gradeLevel + ') ';
    query += 'AND subjectcode.SubjectCode NOT LIKE "HOMEROOM%" ';
    query += 'ORDER BY grade_sortable.OrderNumber ASC ';

    SimplifiedQuery('SELECT', query, '', getSubjectListDB);
}


function setGradeSubjDB(tblLen, iArrSubjCode, gradeLevel) {
    function getGradeSubjDB(xhttp) {
        let jsonGradeSubj;

        trTableGrade = document.querySelectorAll('#tableSubject tbody')[tblLen].childNodes;
        jsonGradeSubj = JSON.parse(xhttp.responseText);
        console.log(jsonGradeSubj);

        function clearTBodySubj() {
            for (let i = 0; i < trTableGrade.length; i++) {
                for (let j = 1; j <= 6; j++) {
                    trTableGrade[i].cells[j].textContent = '';
                }
            }
        }
        clearTBodySubj();


        try {
            for (let i = 0; i < jsonGradeSubj.length; i++) {

                for (let j = 0; j < trTableGrade.length; j++) {
                    if (jsonGradeSubj[i]['SubjectCode'] == arrSubjCode[iArrSubjCode][j]) {

                        trTableGrade[j].cells[jsonGradeSubj[i]['Quarter']].textContent = jsonGradeSubj[i]['GradeRating'];
                    }
                }
            }

            getAveMAPEH(iArrSubjCode, gradeLevel);
            calculateFinalWithRemark();
            calculateAverage(iArrSubjCode, gradeLevel);
        } catch (err) {
            console.log(err);
        }
    }


    let query = '';

    query += 'SELECT * ';
    query += 'FROM ( ';
    query += 'SELECT GradeID, SubjectCode, Quarter, GradeRating ';
    query += 'FROM grade_subject_backup ';
    query += 'WHERE LRNNum IN (' + txt_LRN.textContent + ') ';
    query += 'AND GradeLevel IN (' + gradeLevel + ') ';
    query += 'ORDER BY DateCreated DESC ';
    query += 'LIMIT 18446744073709551615 '; // https://stackoverflow.com/questions/255517/mysql-offset-infinite-rows
    query += ') AS sub ';
    query += 'GROUP BY sub.GradeID ';

    SimplifiedQuery('SELECT', query, '', getGradeSubjDB);
}


function getAveMAPEH(iArrSubjCode, gradeLevel) {
    for (let i = 0; i < trTableGrade.length; i++) {

        if (trTableGrade[i].textContent === 'MAPEH 7' ||
            trTableGrade[i].textContent === 'MAPEH 8' ||
            trTableGrade[i].textContent === 'MAPEH 9' ||
            trTableGrade[i].textContent === 'MAPEH 10') {
            for (let j = 1; j <= 4; j++) {
                let aveMAPEH = 0;
                let isMAPEHGradeCompleted = true;

                Object.keys(objMAPEH[indexgradeLevel(gradeLevel)]).forEach((key) => {
                    let childMAPEH = trTableGrade[arrSubjCode[iArrSubjCode].indexOf(key)].cells[j].textContent;

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


function calculateAverage(iArrSubjCode, gradeLevel) {
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
                if (Object.keys(objMAPEH[indexgradeLevel(gradeLevel)]).includes(arrSubjCode[iArrSubjCode][j])) {
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



let init = (function() {
    let gradeLevels = [7, 8, 9, 10];
    let scholasticRecord = document.querySelector("#scholasticRecord");
    let scholasticRecordHTML = scholasticRecord.innerHTML;

    for (let i = 1; i < gradeLevels.length; i++) {
        scholasticRecord.insertAdjacentHTML("afterbegin", scholasticRecordHTML);
    }

    for (let i = 0; i < gradeLevels.length; i++) {
        setSubjectListDB(i, i, gradeLevels[i]);
    }
})();