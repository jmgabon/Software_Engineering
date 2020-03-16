'use strict';



const wrapperGradeEnabler = (function() {
    let setDOMString = {
        selectQuarter: '#selectQuarter',
        btnSaveQuarter: '#btnSaveQuarter',
        btnBypassGradeCase: '#btnBypassGradeCase',
        btnUpdateGradeCase: '#btnUpdateGradeCase',
        chk_EncodingEnabled: '#chk_EncodingEnabled',
        txt_CaseApproved: '#txt_CaseApproved',
        txt_CaseTotal: '#txt_CaseTotal',
        txt_Quarter: '#txt_Quarter',
        txt_SchoolYear: '#txt_SchoolYear',
    }

    let jsonQuarter
    let totalApproved;
    let overall;
    let encodingEnabled;

    document.querySelector(setDOMString.txt_SchoolYear).textContent = '2020-2021'; //temp


    let setEncodingEnabledDB = function() {
        let val = '';

        misQuery('setEncodingEnabledDB', val, getEncodingEnabledDB);
    };


    let getEncodingEnabledDB = function(xhttp) {
        try {
            jsonQuarter = JSON.parse(xhttp.responseText);
            encodingEnabled = jsonQuarter[0]['SettingValue'];

            encodingEnabled = (encodingEnabled === '1') ? true : false;
            console.log(encodingEnabled);

            document.querySelector(setDOMString.chk_EncodingEnabled).checked = encodingEnabled;

        } catch (err) {
            alert('CANNOT FIND');
            console.log(xhttp.responseText);
            console.log(err);
        }
    }


    let setEncodingEnabled = function() {
        let chk = document.querySelector(setDOMString.chk_EncodingEnabled);

        if (chk.checked) {
            // do this
            console.log('Checked');
        } else {
            // do that
            console.log('Not checked');
        }
        alert('Another update for toggle is currently in progress...')
    };


    let setQuarter = function() {
        misQuery('setQuarter', '', getQuarter);
    };


    let getQuarter = function(xhttp) {
        try {
            jsonQuarter = JSON.parse(xhttp.responseText);


            document.querySelector(setDOMString.txt_Quarter).innerHTML =
                `<b>Quarter ${jsonQuarter[0]['SettingValue']}</b> is currently ongoing.`;

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


        setEncodingEnabled: function() {
            setEncodingEnabled();
        },


        setEncodingEnabledDB: function() {
            setEncodingEnabledDB();
        },


        setEncodingEnabled: function() {
            setEncodingEnabled();
        },


        selectQuarter: function() {
            setQuarter();
        },


        encodingEnabled: function() {
            return encodingEnabled;
        },


        setGradeCaseValues: function() {
            misQuery('setGradeCaseValues', '', getGradeCaseValues);
        }
    }
})();



const wrapperGradeSettingMain = (function(wrapGrEn) {
    const DOMGrEn = wrapGrEn.getDOMString();
    let selectQuarter = wrapGrEn.selectQuarter;


    let setupEventListeners = function() {
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector(DOMGrEn.chk_EncodingEnabled).addEventListener('change', setEncodingEnabled);
        });

        // document.querySelector(DOMGrEn.btnSaveQuarter).addEventListener('click', saveQuarter);
        // document.querySelector(DOMGrEn.btnBypassGradeCase).addEventListener('click', bypassGradeCase);
        // document.querySelector(DOMGrEn.btnUpdateGradeCase).addEventListener('click', updateGradeCase);
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


    let setEncodingEnabled = function() {
        wrapGrEn.setEncodingEnabled();
    }


    let setEncodingEnabledDB = function() {
        wrapGrEn.setEncodingEnabledDB();
    }


    return {
        init: () => {
            console.log('Application has started.');
            setupEventListeners();
            selectQuarter();
            setEncodingEnabledDB();
            setGradeCaseValues();
        },
    };
})(wrapperGradeEnabler);

wrapperGradeSettingMain.init();