let misQuery = function(func, val, callback) {
    let data = 'func=' + func;
    data += val;

    AJAX(data, true, "post", "php/Query_Grade_Teacher.php", true, callback);
}