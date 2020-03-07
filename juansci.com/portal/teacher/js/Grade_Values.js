'use strict';


// WILL IMPROVE MODULE PATTERN LATER



let parent_id;
let SectionNum;
let jsonGradeVal;
let quarterSelected;

let GradeValID;
let LRNNum;
let gradeLevel;
let BehaviorID;
let Quarter;
let GradeValRating;
let trLen = document.querySelectorAll('#gradeTable tbody tr').length - 1;



const wrapperUIValues = (function() {
    let SectionName;

    const saveButton = {
        save1: document.querySelector('#save1'),
        save2: document.querySelector('#save2'),
        save3: document.querySelector('#save3'),
        save4: document.querySelector('#save4'),
    };


    let clearGrades = function() {
        for (let i = 1; i <= 4; i++) {
            for (let j = 0; j < trLen; j++) {
                document.querySelectorAll('.grValQ' + i)[j].value = '--';
            }
        }
    };


    let setSectionInfo = function() {
        let query = '';

        query += 'SELECT SectionNum, SectionName, GradeLevel ';
        query += 'FROM main_section ';
        query += 'WHERE Adviser IN (' + teacherNum + ') ';

        SimplifiedQuery('SELECT', query, '', getSectionInfo);
    };


    let getSectionInfo = function(xhttp) {
        try {
            let jsonSectionInfo = JSON.parse(xhttp.responseText);
            console.log(jsonSectionInfo);

            SectionNum = jsonSectionInfo[0][0]
            SectionName = jsonSectionInfo[0][1]
            gradeLevel = jsonSectionInfo[0][2]

            document.querySelector('#txt_LRNNum').innerHTML = LRNNum;
            document.querySelector('#txt_SectionName').innerHTML = SectionName;
            document.querySelector('#txt_GradeLevel').innerHTML = gradeLevel;

        } catch (err) {
            alert('CANNOT FIND');
            console.log(xhttp.responseText);
            console.log(err);
        }
    }

    function enablerQuarter(q) {
        if (q == quarterSelected) {
            return false
        }
        return true
    }


    let settingQuarter = function() {
        for (let i = 0; i < 7; i++) {
            for (let j = 1; j <= 4; j++) {
                document.querySelectorAll('.grValQ' + j)[i].disabled = enablerQuarter(j);
            }
        }

        saveButton.save1.disabled = enablerQuarter(1);
        saveButton.save2.disabled = enablerQuarter(2);
        saveButton.save3.disabled = enablerQuarter(3);
        saveButton.save4.disabled = enablerQuarter(4);
    };


    let setQuarterDB = function() {
        let query = '';

        query += 'SELECT SettingValue ';
        query += 'FROM setting ';
        query += 'WHERE SettingName = "quarter_enabled" ';

        SimplifiedQuery('SELECT', query, '', getQuarter);
    };


    let getQuarter = function(xhttp) {
        try {
            let jsonQuarter = JSON.parse(xhttp.responseText);
            quarterSelected = jsonQuarter[0]['SettingValue'];
            settingQuarter();

        } catch (err) {
            alert('CANNOT FIND');
            console.log(xhttp.responseText);
            console.log(err);
        }
    }

    return {
        saveButton,
        clearGrades,
        setQuarterDB,
        setSectionInfo,
    };
})();



const wrapperGradeValues = (function() {

    let setGradesValDB = function() {
        let query = '';

        query += 'SELECT GradeValID, BehaviorID, Quarter, GradeValRating ';
        query += 'FROM grade_values ';
        query += 'WHERE LRNNum IN (' + LRNNum + ') ';
        query += 'AND GradeValLevel IN (' + gradeLevel + ') ';


        SimplifiedQuery('SELECT', query, '', getGradesValDB);
    }


    let getGradesValDB = function(xhttp) {
        jsonGradeVal = JSON.parse(xhttp.responseText);
        console.log(jsonGradeVal);

        try {
            let getParentCol = function(child) {
                if (child.includes('1a')) return 0;
                else if (child.includes('1b')) return 1;
                else if (child.includes('2a')) return 2;
                else if (child.includes('2b')) return 3;
                else if (child.includes('3a')) return 4;
                else if (child.includes('3b')) return 5;
                else if (child.includes('4a')) return 6;
            }

            for (let i = 0; i < jsonGradeVal.length; i++) {
                document.querySelectorAll('.grValQ' + jsonGradeVal[i]['Quarter'])[getParentCol(jsonGradeVal[i]['BehaviorID'])].value = jsonGradeVal[i]['GradeValRating'];
            }

        } catch (err) {
            console.log(err);
        }
    }

    let checkIfAllFilled = function() {
        for (let i = 0; i < trLen; i++) {
            GradeValRating = document.querySelectorAll('.grValQ' + Quarter)[i].value;
            if (GradeValRating === '--') {
                return false;
            }
        }
        return true
    }

    let checkGradeVal = function() {
        if (checkIfAllFilled()) {
            for (let i = 0; i < trLen; i++) {
                GradeValID = 0;
                GradeValRating = document.querySelectorAll('.grValQ' + Quarter)[i].value;

                switch (i) {
                    case 0:
                        BehaviorID = '1a';
                        break;
                    case 1:
                        BehaviorID = '1b';
                        break;
                    case 2:
                        BehaviorID = '2a';
                        break;
                    case 3:
                        BehaviorID = '2b';
                        break;
                    case 4:
                        BehaviorID = '3a';
                        break;
                    case 5:
                        BehaviorID = '3b';
                        break;
                    case 6:
                        BehaviorID = '4a';
                        break;
                }

                for (let j = 0; j < jsonGradeVal.length; j++) {
                    if (jsonGradeVal[j]['BehaviorID'] === BehaviorID) {
                        if (jsonGradeVal[j]['Quarter'] === Quarter) {
                            GradeValID = jsonGradeVal[j]['GradeValID'];
                        }
                    }
                }

                if (GradeValRating !== '--') {
                    updateGradeDB();
                } else {
                    deleteGradeDB();
                }
            }

            alert('QUARTER ' + Quarter + ' GRADES SAVED');
            console.log('QUARTER ' + Quarter + ' GRADES SAVED');
            setGradesValDB();
        } else {
            alert('Invalid input! Check all grades.');
        }
    }


    let updateGradeDB = function() {
        let query = '';

        query += 'INSERT INTO grade_values ';
        query += '(GradeValID, LRNNum, GradeValLevel, BehaviorID, Quarter, GradeValRating) ';
        query += 'VALUES ("' + GradeValID + '", "';
        query += LRNNum + '", "';
        query += gradeLevel + '", "';
        query += BehaviorID + '", "';
        query += Quarter + '", "';
        query += GradeValRating + '") ';
        query += 'ON DUPLICATE KEY UPDATE GradeValRating = "' + GradeValRating + '"';

        SimplifiedQuery('INSERT', query, '', () => null);
    };

    let deleteGradeDB = function() {
        let query = 'DELETE FROM grade_values WHERE GradeValID = ' + GradeValID;

        SimplifiedQuery('INSERT', query, '', () => null);
    };


    return {
        setGradesValDB,
        checkGradeVal,
    };
})();



const mainController = (function(wrapUI, wrapVal) {
    let studentSelected = false;
    const modal_body = document.querySelector('#modal-body');
    const modal_button = document.querySelector('.modal-button');

    const setupEventListeners = function() {
        let activateSave = function(q) {
            if (studentSelected) {
                Quarter = q;
                wrapUI.checkGradeVal();
            } else {
                alert('Select student first.')
            }
        };

        wrapVal.saveButton.save1.addEventListener('click', () => activateSave(1));
        wrapVal.saveButton.save2.addEventListener('click', () => activateSave(2));
        wrapVal.saveButton.save3.addEventListener('click', () => activateSave(3));
        wrapVal.saveButton.save4.addEventListener('click', () => activateSave(4));

        modal_button.addEventListener('click', function() {
            let theadID = 'LRNNum@LastName@ExtendedName@FirstName@MiddleName';
            let theadHTML = 'LRN@Last Name@ExtendedName@First Name@Middle Name';
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

                query += 'SELECT main_student.LRNNum, LastName, ExtendedName, FirstName, MiddleName ';
                query += 'FROM main_student ';
                query += 'LEFT JOIN main_student_section ON main_student.LRNNum = main_student_section.LRNNum ';
                query += 'WHERE main_student_section.SectionNum IN (' + SectionNum + ')';

                if (searchStudent.value !== '') {
                    let queryAnd;
                    let queryNull;

                    if (cat.options[cat.selectedIndex].value === 'LRNNum') {
                        queryAnd = 'AND student.';
                    } else {
                        queryAnd = 'AND ';
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


        let PickStudent = function(xhttp) {
            console.log(JSON.parse(xhttp.responseText));
            CreateTBody(xhttp);
            let tbody_tr = document.querySelectorAll('#SearchStudentTable tbody tr');
            for (let i = 0; i < tbody_tr.length; i++) {
                tbody_tr[i].addEventListener('click', function() {
                    const txt_StudentModal = document.querySelector('#txt_StudentModal');
                    document.querySelector('#SearchStudent').value = '';
                    closeModal(modal_body);

                    let extName = this.childNodes[2].innerHTML;

                    if (extName !== '') {
                        extName = ' ' + extName;
                    }

                    LRNNum = this.childNodes[0].innerHTML;
                    txt_Student.innerHTML = this.childNodes[1].innerHTML;
                    txt_Student.innerHTML += extName + ', ';
                    txt_Student.innerHTML += this.childNodes[3].innerHTML + ' ';
                    txt_Student.innerHTML += this.childNodes[4].innerHTML;
                    txt_StudentModal.value = txt_Student.innerHTML;
                    studentSelected = true;

                    wrapVal.clearGrades();
                    wrapUI.setGradesValDB();
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
    };


    return {
        init: function() {
            console.log('Application has started.');
            wrapVal.setQuarterDB();
            wrapVal.setSectionInfo();
            setupEventListeners();
        },
    };
})(wrapperGradeValues, wrapperUIValues);

mainController.init();