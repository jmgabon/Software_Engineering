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
let GradeLevel;
let SectionNum;
let sectionName;
let principalName;
let adviserName;
let numFailed;

let parent_id;
let trTableGrade;
let arrSubjCode = [];

let quarterSelected;


let maxGradeLevel;


const btn_encode = document.querySelector('#btn_encode');
const select_GrLvl = document.querySelector('#select_GrLvl');


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


if (AccessType === 'student') {
    select_GrLvl.addEventListener('change', () => {
        GradeLevel = Number(select_GrLvl.value);

        setSubjectListDB(GradeLevel, LRNNum);
        setIfSectionAssigned();
    });
}



let selectGrLvl = function() {
    for (let grLvl = 7; grLvl <= maxGradeLevel; grLvl++) {
        let opt = document.createElement('option');

        opt.appendChild(document.createTextNode(grLvl));
        opt.value = grLvl;
        select_GrLvl.appendChild(opt);
    }
    select_GrLvl.value = maxGradeLevel;
}


if (AccessType === 'teacher') {
    modal_button.addEventListener('click', function() {
        let theadID = 'LRNNum@LastName@ExtendedName@FirstName@MiddleName';
        let theadHTML = 'LRN@Last Name@ExtendedName@First Name@Middle Name';
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
            let val = '';
            let queryValue = searchStudent.value;
            let queryIndex = cat.options[cat.selectedIndex].value;

            val += '&SectionNum=' + SectionNum;
            val += '&queryValue=' + queryValue;
            val += '&queryIndex=' + queryIndex;

            misQuery('SearchStudent', val, PickStudent);
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
    let jsonStudentInfo = JSON.parse(xhttp.responseText);
    console.log(jsonStudentInfo);

    CreateTBody(xhttp, PickStudent);
    const tbody_tr = document.querySelectorAll('#SearchStudentTable tbody tr');

    for (let i = 0; i < tbody_tr.length; i++) {
        tbody_tr[i].addEventListener('click', function() {
            const txt_StudentModal = document.querySelector('#txt_StudentModal');
            document.querySelector('#SearchStudent').value = '';
            closeModal(modal_body);
            let LastName, ExtendedName, FirstName, MiddleName;

            const [_LRNNum,
                _LastName,
                _ExtendedName,
                _FirstName,
                _MiddleName,
                _Birthday,
                _Gender,
            ] = this.childNodes;


            LRNNum = _LRNNum.textContent;
            LastName = _LastName.textContent;
            ExtendedName = _ExtendedName.textContent;
            FirstName = _FirstName.textContent;
            MiddleName = _MiddleName.textContent;
            studentAge = _Birthday.textContent;
            studentSex = _Gender.textContent;

            if (ExtendedName !== null) {
                ExtendedName = ' ' + ExtendedName;
            } else {
                ExtendedName = '';
            }

            txt_StudentName.textContent = LastName;
            txt_StudentName.textContent += ExtendedName + ', ';
            txt_StudentName.textContent += FirstName + ' ';
            txt_StudentName.textContent += MiddleName;

            txt_StudentModal.value = txt_StudentName.textContent;
            studentName = txt_StudentName.textContent;


            if (document.querySelector('#print-btnI').disabled === true) {
                document.querySelector('#print-btnI').disabled = false;
            }

            btn_encode.disabled = true;
            // clearTBodySubj();
            setSubjectListDB(GradeLevel, LRNNum);
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
    let schoolYear = 2020; //temp

    formData.elements["LRNNum"].value = LRNNum;
    formData.elements["schoolYear"].value = String(schoolYear + '-' + (schoolYear + 1));
    formData.elements["studentName"].value = studentName;
    formData.elements["studentAge"].value = Number(schoolYear - studentAge.slice(0, 4));
    formData.elements["studentSex"].value = studentSex;
    formData.elements["GradeLevel"].value = GradeLevel;
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
    tbodySubject.innerHTML = '';
    arrSubjCode.length = 0;


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
                Object.keys(objMAPEH[indexGrLvl(GradeLevel)]).forEach((key) => {
                    tr = document.createElement('tr');

                    for (let j = 0; j < columnLen; j++) {
                        td = document.createElement('td');
                        td.innerHTML = (j == 0) ? '&nbsp &nbsp' + objMAPEH[indexGrLvl(GradeLevel)][key] : '';
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


let setSubjectListDB = function(grLvl, LRNNum) {
    let val = '';
    val += '&grLvl=' + grLvl;
    val += '&LRNNum=' + LRNNum;

    misQuery('setSubjectListDB', val, getSubjectListDB);
}


let getSubjectListDB = function(xhttp) {
    let jsonSubject;

    try {
        jsonSubject = JSON.parse(xhttp.responseText);
        createTBodySubj(jsonSubject);

        if (AccessType === 'teacher') {
            setGradeSubjDB();
            setGradeValDB();
        }

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}

let setStudentInfo = function() {
    let val = '';
    val += '&LRNNum=' + LRNNum;

    misQuery('setStudentInfo', val, getStudentInfo);
}

let getStudentInfo = function(xhttp) {
    let jsonStudentInfo = JSON.parse(xhttp.responseText);
    console.log(jsonStudentInfo)

    try {
        let extName = jsonStudentInfo[0]['ExtendedName'];
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

        studentAge = jsonStudentInfo[0]['Birthday'];
        studentSex = jsonStudentInfo[0]['Gender'];

        GradeLevel = jsonStudentInfo[0]['GradeLevel'];
        txt_GradeLevel.textContent = GradeLevel;
        maxGradeLevel = GradeLevel;

        setSubjectListDB(GradeLevel, LRNNum);
        setIfSectionAssigned();
        selectGrLvl();

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


let setIfSectionAssigned = function() {
    let val = '';
    val += '&LRNNum=' + LRNNum;
    val += '&GradeLevel=' + GradeLevel;

    misQuery('setIfSectionAssigned', val, getIfSectionAssigned);
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
    let val = '';

    if (AccessType === 'teacher') {
        val += '&AccessType=teacher';
        val += '&TeacherNum=' + TeacherNum;
    } else if (AccessType === 'student') {
        val += '&AccessType=student';
        val += '&LRNNum=' + LRNNum;
        val += '&GradeLevel=' + GradeLevel;
    }

    misQuery('setSectionInfo', val, getSectionInfo);
}


function getSectionInfo(xhttp) {
    try {
        let jsonSecInfo = JSON.parse(xhttp.responseText);
        const txt_AdviserName = document.querySelector('#txt_AdviserName');
        const txt_SectionName = document.querySelector('#txt_SectionName');
        const txt_GradeLevel = document.querySelector('#txt_GradeLevel');

        console.log(jsonSecInfo);

        SectionNum = jsonSecInfo[0]['SectionNum'];
        adviserName = jsonSecInfo[0]['Adviser'];
        sectionName = jsonSecInfo[0]['SectionName'];

        if (AccessType === 'teacher') {
            GradeLevel = jsonSecInfo[0]['GradeLevel'];
        }

        txt_AdviserName.textContent = adviserName;
        txt_SectionName.textContent = sectionName;
        txt_GradeLevel.textContent = GradeLevel;



    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


function clearTBodySubj() {

    if (trTableGrade.length !== undefined) {
        for (let i = 0; i < trTableGrade.length; i++) {
            for (let j = 1; j <= 6; j++) {
                trTableGrade[i].cells[j].textContent = '';
            }
        }
    }

}


function setGradeSubjDB() {
    let val = '';

    val += '&LRNNum=' + LRNNum;
    val += '&GradeLevel=' + GradeLevel;

    if (AccessType === 'student') {
        val += '&AccessType=student';
        misQuery('setGradeSubjDB', val, getGradeSubjDB);
    } else if (AccessType === 'teacher') {
        val += '&AccessType=teacher';
        misQuery('setGradeSubjDB', val, getGradeSubjDB);

        val = '';
        val += '&LRNNum=' + LRNNum;
        val += '&GradeLevel=' + GradeLevel;
        val += '&AccessType=student';
        misQuery('setGradeSubjDB', val, (xhttp) => {
            if (JSON.parse(xhttp.responseText).length === 0) {
                btn_encode.disabled = false;
                btn_encode.textContent = 'ENCODE QUARTER ' + quarterSelected;
            } else {
                btn_encode.textContent = 'QUARTER ' + quarterSelected + ' ALREADY ENCODED';
            }
        });
    }
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

        if (trTableGrade[i].textContent.includes('MAPEH 7') ||
            trTableGrade[i].textContent.includes('MAPEH 8') ||
            trTableGrade[i].textContent.includes('MAPEH 9') ||
            trTableGrade[i].textContent.includes('MAPEH 10')) {
            for (let j = 1; j <= 4; j++) {
                let aveMAPEH = 0;
                let isMAPEHGradeCompleted = true;

                Object.keys(objMAPEH[indexGrLvl(GradeLevel)]).forEach((key) => {
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


function setQuarterDB() {
    let val = '';

    misQuery('setQuarterDB', val, getQuarter);
};


function getQuarter(xhttp) {
    try {
        let jsonQuarter = JSON.parse(xhttp.responseText);
        quarterSelected = jsonQuarter[0]['SettingValue'];
        console.log('Quarter Now: ' + quarterSelected)

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
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
                if (Object.keys(objMAPEH[indexGrLvl(GradeLevel)]).includes(arrSubjCode[j])) {
                    lenChild++;
                    continue;
                } else {
                    colAverage += Number(trTableGrade[j].cells[i].textContent);
                }
            }

            colAverage /= ((trTableGrade.length - 1) - lenChild);
            colAverage = colAverage.toFixed(0);
            trTableGrade[trTableGrade.length - 1].cells[i].textContent = colAverage;

            // if (quarterSelected == i) {
            //     if (colAverage != '') {
            //         btn_encode.disabled = false;
            //     }
            // }
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
    let val = '';

    val += '&LRNNum=' + LRNNum;
    val += '&GradeLevel=' + GradeLevel;

    misQuery('setGradeValDB', val, getGradesValDB);
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
            document.querySelectorAll('.grValQ' + jsonGradeVal[i]['Quarter'])[getParentCol(jsonGradeVal[i]['BehaviorCode'])].textContent = jsonGradeVal[i]['GradeRating'];
        }

    } catch (err) {
        console.log(err);
    }
}


function getParentCol(child) {
    if (child.includes('A1')) return 0;
    else if (child.includes('A2')) return 1;
    else if (child.includes('B1')) return 2;
    else if (child.includes('B2')) return 3;
    else if (child.includes('C1')) return 4;
    else if (child.includes('C2')) return 5;
    else if (child.includes('D1')) return 6;
}


function printInnerReportCard() {
    window.print();
}



let init = (function() {
    setQuarterDB();


    if (AccessType === 'teacher') {
        setSectionInfo();
        btn_encode.style.display = 'block';
    } else if (AccessType === 'student') {
        setStudentInfo();
    }

    btn_encode.addEventListener('click', () => {
        if (confirm("Do you want to store grades to the database?")) {
            let val = '';

            val += '&LRNNum=' + LRNNum;
            val += '&GradeLevel=' + GradeLevel;
            val += '&quarterSelected=' + quarterSelected;

            misQuery('btn_encode', val, () => null);


            alert('Encoding done. Grades are stored to the database!');
            btn_encode.textContent = 'QUARTER ' + quarterSelected + ' ALREADY ENCODED';
            btn_encode.disabled = true;
        } else {
            alert('Cancelled.');
        }
    });
})();