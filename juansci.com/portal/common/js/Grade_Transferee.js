'use strict';


let LRNNum;
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

let jsonGrade;
let SubjectCode;
let quarterSelected;


const select_GrLvl = document.querySelector('#select_GrLvl');
const selectSubjCode = document.querySelector('#selectSubjCode');
const CreateGradeTable = document.querySelector('#CreateGradeTable');
const inputGrade = document.querySelectorAll('#CreateGradeTable tbody input');
const btn_AddGrade = document.querySelector('#btn_AddGrade');


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



btn_AddGrade.addEventListener('click', () => {
    for (let i = 0; i < inputGrade.length; i++) {

        let val = '';

        val += '&GradeID=' + jsonGrade[0]['IDQ' + (i + 1)];;
        val += '&LRNNum=' + LRNNum;
        val += '&GradeLevel=' + GradeLevel;
        val += '&SubjectCode=' + SubjectCode;
        val += '&Quarter=' + (i + 1);
        val += '&GradeRating=' + Number(inputGrade[i].value);

        misQuery('saveTrGrade', val, () => null);
    }

    alert('Grades Saved!');
    labelMAPEH.style.display = 'none';
    resetTBodyGradeTable(false, true);

    setSubjectListDB(GradeLevel, LRNNum);
});


select_GrLvl.addEventListener('change', () => {
    GradeLevel = Number(select_GrLvl.value);

    resetTBodyGradeTable(false, true);
    setSubjectListDB(GradeLevel, LRNNum);
});


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

        misQuery('SearchTransfereeStudent', val, PickStudent);
    }
    Search();

    cat.addEventListener('change', () => {
        searchStudent.value = '';
        Search();
    });
    searchStudent.addEventListener('change', Search);
});


let PickStudent = function(xhttp) {
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


            resetTBodyGradeTable(true, true);
            selectGrLvl();
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


let selectGrLvl = function() {
    let val = '';
    val += '&LRNNum=' + LRNNum;

    misQuery('selectGrLvl', val, (xhttp) => {
        try {
            let json = JSON.parse(xhttp.responseText);
            let maxGradeLevel = json[0]['GradeLevel'];;

            select_GrLvl.innerHTML = '<option disabled selected value>?</option>';
            for (let grLvl = 7; grLvl < maxGradeLevel; grLvl++) {
                let opt = document.createElement('option');

                opt.appendChild(document.createTextNode(grLvl));
                opt.value = grLvl;
                select_GrLvl.appendChild(opt);
            }

        } catch (err) {
            alert('CANNOT FIND');
            console.log(xhttp.responseText);
            console.log(err);
        }
    });
}


let modalSubjectCode = function() {
    selectSubjCode.addEventListener('click', () => {
        if (GradeLevel === undefined) {
            alert('Select Student and Grade Level first');
        } else {
            let theadID = 'SubjectCode@SubjectDescription';
            let theadHTML = 'Subject Code@Subject Description';
            CreateSearchBox(theadID, theadHTML, '@', 'SearchSubject', 'search', modal_body);

            let cat = document.querySelector('#modal-body select');
            let hiddenCol = '';
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

                val += '&GradeLevel=' + GradeLevel;
                val += '&queryValue=' + queryValue;
                val += '&queryIndex=' + queryIndex;

                misQuery('SearchSubjectCode', val, getSubjectCode);
            }
            Search();

            searchSubject.addEventListener('change', Search);
            cat.addEventListener('change', () => {
                searchSubject.value = '';
                Search();
            });
        }
    });
}


let getSubjectCode = function(xhttp) {
    let jsonSubjectInfo = JSON.parse(xhttp.responseText);

    console.log(jsonSubjectInfo);
    CreateTBody(xhttp, getSubjectCode);
    const tbody_tr = document.querySelectorAll('#SearchSubjectTable tbody tr');

    for (let i = 0; i < tbody_tr.length; i++) {
        tbody_tr[i].addEventListener('click', function() {
            document.querySelector('#SearchSubject').value = '';
            closeModal(modal_body);

            const [_SubjectCode,
                _selectSubjCode,
            ] = this.childNodes;


            SubjectCode = _SubjectCode.textContent;
            selectSubjCode.textContent = _selectSubjCode.textContent;


            afterSubjectModal();
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


let afterSubjectModal = function() {
    resetTBodyGradeTable(false, false);

    if (SubjectCode.includes('MAPEH')) {
        selectSubjCode.textContent = 'SELECT MAPEH';
        labelMAPEH.style.display = 'block';
        selectMAPEH.value = selectMAPEH.options[0].value;
    } else {
        labelMAPEH.style.display = 'none';

        for (let i = 0; i < inputGrade.length; i++) {
            inputGrade[i].disabled = false;
        }
        setGrade();
    }
}

let setSubMAPEH = function() {
    resetTBodyGradeTable(false, false);

    SubjectCode = selectMAPEH.value + ' ' + GradeLevel;
    selectSubjCode.textContent = SubjectCode;

    for (let i = 0; i < inputGrade.length; i++) {
        inputGrade[i].disabled = false;
    }

    setGrade();
}


let setGrade = function() {
    let val = '';

    val += '&LRNNum=' + LRNNum;
    val += '&SubjectCode=' + SubjectCode;

    misQuery('setGrade', val, getGrade);
}


let getGrade = function(xhttp) {
    try {
        jsonGrade = JSON.parse(xhttp.responseText);
        console.log(jsonGrade);

        inputGrade[0].value = jsonGrade[0]['Q1'];
        inputGrade[1].value = jsonGrade[0]['Q2'];
        inputGrade[2].value = jsonGrade[0]['Q3'];
        inputGrade[3].value = jsonGrade[0]['Q4'];

        checkInputGrade();
        computeFinalAndRemark();

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


let checkInputGrade = function() {
    for (let i = 0; i < inputGrade.length; i++) {
        inputGrade[i].addEventListener('change', () => {
            let gradeVal = Number(inputGrade[i].value);
            if (checkValidInput(gradeVal)) {
                computeFinalAndRemark();
            } else {
                btn_AddGrade.disabled = true;
                CreateGradeTable.rows[2].cells[5].innerHTML = '';
                CreateGradeTable.rows[2].cells[6].innerHTML = '';
                alert('Error Input');
            }
        })
    }
}


let computeFinalAndRemark = function() {
    CreateGradeTable.rows[2].cells[5].innerHTML = '';
    CreateGradeTable.rows[2].cells[6].innerHTML = '';

    if (inputGrade[0].value !== '' &&
        inputGrade[1].value !== '' &&
        inputGrade[2].value !== '' &&
        inputGrade[3].value !== '') {

        let finalRating = (Number(inputGrade[0].value) + Number(inputGrade[1].value) +
            Number(inputGrade[2].value) + Number(inputGrade[3].value)) / 4;

        CreateGradeTable.rows[2].cells[5].innerHTML = finalRating.toFixed(0);

        if (finalRating >= 75) {
            CreateGradeTable.rows[2].cells[6].innerHTML = 'PASSED';
            btn_AddGrade.disabled = false;
        } else {
            CreateGradeTable.rows[2].cells[6].innerHTML = 'FAILED';
            btn_AddGrade.disabled = true;
        }
    }
}


let resetTBodyGradeTable = function(resetTBodySubj, resetLA) {
    if (resetTBodySubj) {
        const tbodySubject = document.querySelector('#tbodySubject');
        tbodySubject.innerHTML = '';
    }

    if (resetLA) {
        CreateGradeTable.rows[2].cells[0].innerHTML = 'CLICK HERE';
    }

    for (let i = 0; i < inputGrade.length; i++) {
        inputGrade[i].value = '';
        inputGrade[i].disabled = true;
    }

    CreateGradeTable.rows[2].cells[5].innerHTML = '';
    CreateGradeTable.rows[2].cells[6].innerHTML = '';
    btn_AddGrade.disabled = true;
}


let checkValidInput = function(GradeRating) {
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
    return true;
}


let indexGrLvl = function(grLvl) {
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

        setGradeSubjDB();

    } catch (err) {
        alert('CANNOT FIND');
        console.log(xhttp.responseText);
        console.log(err);
    }
}


let clearTBodySubj = function() {
    if (trTableGrade.length !== undefined) {
        for (let i = 0; i < trTableGrade.length; i++) {
            for (let j = 1; j <= 6; j++) {
                trTableGrade[i].cells[j].textContent = '';
            }
        }
    }
}


let setGradeSubjDB = function() {
    let val = '';

    val += '&LRNNum=' + LRNNum;
    val += '&GradeLevel=' + GradeLevel;
    val += '&AccessType=' + AccessType;
    misQuery('setGradeSubjDB', val, getGradeSubjDB);
}


let getGradeSubjDB = function(xhttp) {
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

        if (jsonGradeSubj.length !== 0) {
            getAveMAPEH();
            calculateFinalWithRemark();
            calculateAverage();
        }
    } catch (err) {
        console.log(err);
    }
}


let getAveMAPEH = function() {
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


let calculateFinalWithRemark = function() {
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


let calculateAverage = function() {
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
    modalSubjectCode();
})();