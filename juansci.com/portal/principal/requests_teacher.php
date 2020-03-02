<?php
include 'partials/header.php';
?>
<script type="text/javascript">
    $('#lead').text('Requests');
    $('#teacher').addClass('active');
</script>
<div class="content-main mt-4">
    <div class="secondCol col-xl-12">
    <p class="h5 pb-2">
        <label class="float-right" for="Results">
            <select id="Category" class="mt-1 form-control rounded-0 bg-light">
                <option value="ControlNum" selected = "selected">Request Number</option>
                <option value="TeacherNum">Teacher ID</option>
                <option value="LastName">Last Name</option>
                <option value="FirstName">First Name</option>
                <option value="MiddleName">Middle Name</option>
                <option value="Action_">Action</option>
                <option value="Status_">Status</option>
            </select>   
            <input placeholder="Search" type="search" class="mt-1 form-control rounded-0 bg-light" id="Results">
        </label>
    </p>
    <table id="ResultsTable">
        <thead class="dark">
            <tr>
            <!-- <td>Section Number</td> -->
            <td id="ControlNum">Request Number</td>
            <td id="TeacherNum">Teacher ID</td>
            <td id="LastName">Last Name</td>
            <!-- <td id="Extension">Extension</td> -->
            <td id="FirstName">First Name</td>
            <td id="MiddleName">Middle Name</td>
            <td id="URL_Picture" style="display: none;"></td>
            <td id="CreatedBy">Creator ID</td>
            <td id="RequestedBy">Name</td>
            <td id="DateCreated">Date Requested</td>
            <td id="Action_">Action</td>
            <td id="Status_">Status</td>
            <td></td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>
</div>
<?php
include 'partials/footer.php';
?>
<script type="text/javascript">
    Search(window.location.href, "", "", tableUI);

    function tableUI(xhttp){
        CreateTBody(xhttp, null, null);
        let tr = document.querySelectorAll("#ResultsTable tbody tr");
        Hover(tr);
    }
    // cat.options[cat.selectedIndex].value + "=" + searchEmployee.value
    // let results_input = document.querySelector("#Results");
    // let category = document.querySelector("#Category");
    // Search(window.location.href, "", null);
    // results_input.addEventListener("change", function(){
    //     let content = category.options[category.selectedIndex].value + "=" + results_input.value;
    //     Search(window.location.href, content, null);
    // });

    // function print(xhttp){
    //     console.log(xhttp.responseText);
    // }
</script>