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



const wrapperGradeSettingMain = (function(wrapGrSort) {
    const DOMGrSort = wrapGrSort.getDOMString();
    let selectGradeLevel = wrapGrSort.selectGradeLevel;


    let setupEventListeners = function() {
        document.querySelector(DOMGrSort.btnSaveSubj).addEventListener('click', saveSubject);
    };


    let saveSubject = function() {
        wrapGrSort.saveSubject();
    };


    return {
        init: () => {
            console.log('Application has started.');
            setupEventListeners();
            selectGradeLevel();
        },
    };
})(wrapperGradeSorter);

wrapperGradeSettingMain.init();