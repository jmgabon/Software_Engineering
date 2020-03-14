'use strict';


const wrapperGradeSorter = (function() {
    let jsonSubject;

    let setDOMString = {
        uListSubject: '#uListSubject',
        selectGradeLevel: '#selectGradeLevel',
        btnSaveSubj: '#btnSaveSubj',
    }


    let setSubjectListDB = function(grLvl) {
        let val = '';
        val += '&grLvl=' + grLvl;

        misQuery('setSubjectListDB', val, getSubjectListDB);
    }


    let getSubjectListDB = function(xhttp) {
        try {
            jsonSubject = JSON.parse(xhttp.responseText);
            console.log(jsonSubject);

            createList(jsonSubject);
            sortSubject(document.querySelector(setDOMString.uListSubject), (item) => console.log(item));

        } catch (err) {
            alert('CANNOT FIND');
            console.log(xhttp.responseText);
            console.log(err);
        }
    }

    let createList = function(subj) {

        for (let i = 0; i < subj.length; i++) {
            var node = document.createElement("LI");
            var textnode = document.createTextNode(subj[i]['SubjectCode']);
            node.appendChild(textnode);
            document.querySelector(setDOMString.uListSubject).appendChild(node);
        }
    }

    let clearList = function() {
        const subjectList = document.querySelector(setDOMString.uListSubject);

        while (subjectList.firstChild) {
            subjectList.removeChild(subjectList.firstChild);
        }
    }

    let sortSubject = function(listSubject) {
        let dragEl;

        [].slice.call(listSubject.children).forEach(function(itemEl) {
            itemEl.draggable = true;
        });


        let _onDragOver = function(evt) {
            evt.preventDefault();
            evt.dataTransfer.dropEffect = 'move';

            let target = evt.target;
            if (target && target !== dragEl && target.nodeName == 'LI') {

                listSubject.insertBefore(dragEl, target.nextSibling || target);
            }
        }


        let _onDragEnd = function(evt) {
            evt.preventDefault();

            dragEl.classList.remove('ghost');
            listSubject.removeEventListener('dragover', _onDragOver, false);
            listSubject.removeEventListener('dragend', _onDragEnd, false);
            // onUpdate(dragEl);
        }


        listSubject.addEventListener('dragstart', function(evt) {
            dragEl = evt.target;

            evt.dataTransfer.effectAllowed = 'move';
            evt.dataTransfer.setData('Text', dragEl.textContent);

            listSubject.addEventListener('dragover', _onDragOver, false);
            listSubject.addEventListener('dragend', _onDragEnd, false);

            setTimeout(function() {

                dragEl.classList.add('ghost');
            }, 0)
        }, false);


        listSubject.addEventListener('click', function(evt) {
            clickEl = evt.target;
        }, false);
    }

    let setSaveSubjListDB = function(subj, num) {
        let val = '';

        val += '&subj=' + subj;
        val += '&num=' + num;

        misQuery('setSaveSubjListDB', val, () => null);
    }


    return {
        getDOMString: function() {
            return setDOMString;
        },


        saveSubject: function() {
            let orderNumber = 1;
            let listSubj = document.querySelector(setDOMString.uListSubject).childNodes;

            for (let s in listSubj) {
                if (listSubj.hasOwnProperty(s)) {
                    setSaveSubjListDB(listSubj[s].textContent, orderNumber);
                    orderNumber++;
                }
            }

            alert('New Arrangement Saved!');
        },


        selectGradeLevel: function() {
            let GradeLevel = document.querySelector(setDOMString.selectGradeLevel).value

            clearList();
            console.log('Grade ' + GradeLevel + ' selected.')
            setSubjectListDB(GradeLevel);
        },
    }
})();



const wrapperGradeEnabler = (function() {
    let setDOMString = {
        selectQuarter: '#selectQuarter',
        btnSaveQuarter: '#btnSaveQuarter',
        btnBypassGradeCase: '#btnBypassGradeCase',
        btnUpdateGradeCase: '#btnUpdateGradeCase',
        txt_CaseApproved: '#txt_CaseApproved',
        txt_CaseTotal: '#txt_CaseTotal',
    }
    let jsonQuarter
    let totalApproved;
    let overall;


    let setQuarter = function() {
        misQuery('setQuarter', '', getQuarter);
    };


    let getQuarter = function(xhttp) {
        try {
            jsonQuarter = JSON.parse(xhttp.responseText);

            document.querySelector(setDOMString.selectQuarter).value = jsonQuarter[0]['SettingValue'];

        } catch (err) {
            alert('CANNOT FIND');
            console.log(xhttp.responseText);
            console.log(err);
        }
    }


    let getGradeCaseValues = function(xhttp) {
        try {
            let jsonCaseVal = JSON.parse(xhttp.responseText);
            console.log(jsonCaseVal);

            totalApproved = document.querySelector(setDOMString.txt_CaseApproved).textContent = jsonCaseVal[0]['TotalApproved'];
            overall = document.querySelector(setDOMString.txt_CaseTotal).textContent = jsonCaseVal[0]['Overall'];

        } catch (err) {
            alert('CANNOT FIND');
            console.log(xhttp.responseText);
            console.log(err);
        }
    }


    let changeGradeCaseValue = function(q) {
        if (confirm("Do you want to save Quarter?")) {
            if (q == 0) {
                if (totalApproved == overall) {
                    misQuery('changeGradeCaseValue0', '', () => null);

                    alert('Enabled Quarter is set to ' + q);
                    return true;
                } else {
                    alert('Some teachers are not yet finished grading.');
                    return false;
                }
            } else {
                if (jsonQuarter[0][0] == 0) {
                    if (q == 1) {
                        misQuery('truncateGradeCase', '', () => null);
                        misQuery('setupGradeCase', '', () => null);
                    }

                    misQuery('changeGradeCaseValue1', '', () => null);

                    alert('Enabled Quarter is set to ' + q);
                    return true;


                } else {
                    alert('Error input. Quarter ' + jsonQuarter[0][0] + ' ongoing.');
                    return false;
                }
            }
        } else {
            alert('Cancelled.');
        }
    }


    return {
        getDOMString: function() {
            return setDOMString;
        },


        saveQuarter: function(q) {
            if (changeGradeCaseValue(q)) {
                let val = '';
                val += '&q=' + q;

                misQuery('saveQuarter', val, () => null);
            }
        },


        bypassGradeCase: function(q) {
            misQuery('bypassGradeCase', '', () => null);
        },


        updateGradeCase: function(q) {
            misQuery('truncateGradeCase', '', () => null);
            misQuery('setupGradeCase', '', () => null);
        },


        selectQuarter: function() {
            setQuarter();
        },


        setGradeCaseValues: function() {
            misQuery('setGradeCaseValues', '', getGradeCaseValues);
        }
    }
})();



const wrapperGradeSettingMain = (function(wrapGrSort, wrapGrEn) {
    let selectGradeLevel = wrapGrSort.selectGradeLevel;
    let selectQuarter = wrapGrEn.selectQuarter;
    let DOMGrSort = wrapGrSort.getDOMString();
    let DOMGrEn = wrapGrEn.getDOMString();


    let setupEventListeners = function() {
        document.querySelector(DOMGrSort.btnSaveSubj).addEventListener('click', saveSubject);
        document.querySelector(DOMGrEn.btnSaveQuarter).addEventListener('click', saveQuarter);
        document.querySelector(DOMGrEn.btnBypassGradeCase).addEventListener('click', bypassGradeCase);
        document.querySelector(DOMGrEn.btnUpdateGradeCase).addEventListener('click', updateGradeCase);
    };


    let saveSubject = function() {
        wrapGrSort.saveSubject();
    };


    let saveQuarter = function() {
        let selectedQuarter = document.querySelector(DOMGrEn.selectQuarter).value;

        wrapGrEn.saveQuarter(selectedQuarter);
        wrapGrEn.setGradeCaseValues();
    };

    let bypassGradeCase = function() {
        wrapGrEn.bypassGradeCase();
        wrapGrEn.setGradeCaseValues();
    };

    let updateGradeCase = function() {
        wrapGrEn.updateGradeCase();
    };


    let setGradeCaseValues = function() {
        wrapGrEn.setGradeCaseValues();
    }


    return {
        init: () => {
            console.log('Application has started.');
            setupEventListeners();
            selectGradeLevel();
            selectQuarter();
            setGradeCaseValues();
        },
    };
})(wrapperGradeSorter, wrapperGradeEnabler);

wrapperGradeSettingMain.init();