'use strict';



const wrapperGradeConfig = (function() {
    let setDOMString = {
        setQuarter: '#setQuarter',
        btnSaveQuarter: '#btnSaveQuarter',
        btnBypassGradeCase: '#btnBypassGradeCase',
        btnUpdateGradeCase: '#btnUpdateGradeCase',
        btnStartClass: '#btnStartClass',
        chk_EncodingEnabled: '#chk_EncodingEnabled',
        txt_CaseApproved: '#txt_CaseApproved',
        txt_CaseTotal: '#txt_CaseTotal',
        txt_Quarter: '#txt_Quarter',
        txt_SchoolYear: '#txt_SchoolYear',
    }

    let quarter;
    let totalApproved;
    let overall;
    let encodingEnabled;

    document.querySelector(setDOMString.txt_SchoolYear).textContent = '2020-2021'; //temp


    let setEncodingEnabled = function() {
        let val = '';

        misQuery('setEncodingEnabled', val, getEncodingEnabled);
    };


    let getEncodingEnabled = function(xhttp) {
        try {
            let json = JSON.parse(xhttp.responseText);

            encodingEnabled = (json[0]['SettingValue'] === '1') ? true : false;
            document.querySelector(setDOMString.chk_EncodingEnabled).checked = encodingEnabled;

            console.log(encodingEnabled);

        } catch (err) {
            alert('CANNOT FIND');
            console.log(xhttp.responseText);
            console.log(err);
        }
    }


    let updateEncodingEnabled = function() {
        let val = '';
        let en;
        let chk = document.querySelector(setDOMString.chk_EncodingEnabled);


        if (chk.checked) {
            if (quarter != 0) {
                if (confirm("Do you want to OPEN Encoding of Grades?")) {
                    en = 1;

                    updateGradeCaseValue(true, quarter) // set ALL to 1

                    val += '&en=' + en;

                    misQuery('updateEncodingEnabled', val, () => null);

                    console.log('Checked');
                } else {
                    chk.checked = false;
                    alert('Cancelled.');
                }
            } else {
                alert('Classes ended. Please start new class for new school year.');
                chk.checked = false;
            }


        } else {
            if (confirm("Do you want to CLOSE Encoding of Grades?")) {
                en = 0;

                if (updateGradeCaseValue(false, quarter)) {
                    val += '&en=' + en;

                    misQuery('updateEncodingEnabled', val, () => null);

                    setQuarter();
                    setGradeCaseValues();

                    console.log('Not checked');
                } else {
                    chk.checked = true;
                }
            } else {
                chk.checked = true;
                alert('Cancelled.');
            }
        }
    };


    let setQuarter = function() {
        misQuery('setQuarter', '', getQuarter);
    };


    let getQuarter = function(xhttp) {
        try {
            let json = JSON.parse(xhttp.responseText);
            quarter = json[0]['SettingValue']

            if (quarter != 0) {
                document.querySelector(setDOMString.txt_Quarter).innerHTML =
                    `<b>Quarter ${quarter}</b> is currently ongoing.`;
            } else {
                document.querySelector(setDOMString.txt_Quarter).textContent = 'Classes for this school year has been ended.';
            }


        } catch (err) {
            alert('CANNOT FIND');
            console.log(xhttp.responseText);
            console.log(err);
        }
    }


    let setGradeCaseValues = function() {
        misQuery('setGradeCaseValues', '', getGradeCaseValues);
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


    let updateGradeCaseValue = function(en, q) {
        if (en === true) {
            misQuery('changeGradeCaseValue1', '', () => null);

            alert(`Encoding of Grades for Quarter ${q} has been started.`);
        } else if (en === false) {
            if (totalApproved == overall) {
                if (updateQuarter(q)) {
                    misQuery('changeGradeCaseValue0', '', () => null);
                }

                return true;
            } else {
                alert('Please wait. Some teachers are not yet finished grading.');

                return false;
            }
        }
    }

    let updateQuarter = function(q) {
        let val = '';

        if (q != 4) {
            q++;

            val += '&q=' + q;
            misQuery('updateQuarter', val, () => null);

            alert(`Encoding of Grades done. Now, Quarter ${Number(q)} starts.`);

            return true;
        } else {
            q = 0;

            val += '&q=' + q;
            misQuery('updateQuarter', val, () => null);

            alert(`Encoding of Grades done. Now, Classes has been ended for this school year.`);

            return false;
        }
    }



    return {
        getDOMString: function() {
            return setDOMString;
        },


        bypassGradeCase: function(q) {
            misQuery('bypassGradeCase', '', () => null);
        },


        updateEncodingEnabled: function() {
            updateEncodingEnabled();
        },


        setEncodingEnabled: function() {
            setEncodingEnabled();
        },


        setQuarter: function() {
            setQuarter();
        },


        setGradeCaseValues: function() {
            setGradeCaseValues();
        },


        startclass: function() {
            if (quarter == 0) {
                if (confirm("Do you want to START classes for this school year?")) {
                    misQuery('truncateGradeCase', '', () => null);
                    misQuery('setupGradeCase', '', () => null);
                    misQuery('updateQuarter', '&q=1', () => {
                        setQuarter();
                        setGradeCaseValues();
                    });


                    alert('Classes for this school year has been started.')
                } else {
                    alert('Cancelled.');
                }
            } else {
                alert('Classes for this school year is ongoing.');
            }
        }
    }
})();



const wrapperGradeSettingMain = (function(wrapGrCon) {
    const DOMGrEn = wrapGrCon.getDOMString();


    let setupEventListeners = function() {
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector(DOMGrEn.chk_EncodingEnabled).addEventListener('change', wrapGrCon.updateEncodingEnabled);
        });

        document.querySelector(DOMGrEn.btnStartClass).addEventListener('click', wrapGrCon.startclass);
    };


    return {
        init: () => {
            console.log('Application has started.');
            setupEventListeners();

            wrapGrCon.setQuarter();
            wrapGrCon.setEncodingEnabled();
            wrapGrCon.setGradeCaseValues();
        },
    };
})(wrapperGradeConfig);

wrapperGradeSettingMain.init();


// START CLASS

// Q1
// ON ENC
// OFF ENC

// Q2
// ON ENC
// OFF ENC

// Q3
// ON ENC
// OFF ENC

// Q4
// ON ENC
// OFF ENC

// END CLASS