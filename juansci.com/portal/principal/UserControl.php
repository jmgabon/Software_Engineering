<?php
include 'partials/header.php'; 
$query = "SELECT * FROM access";
?>
<script type="text/javascript">
    $('#lead').text('User Control');
    $('#UserControl').addClass('active');
</script>
<div class="content-main mt-4">
	
	<p class="h5 pb-2"><label class="float-right" for="">
        <select id="Category" class="mt-1 form-control rounded-0 bg-light" >
            <option value="EmployeeNum">Employee Number</option>
            <option value="LastName">Last Name</option>
            <option value="Extension">Extension</option>
            <option value="FirstName">First Name</option>
            <option value="MiddleName">Middle Name</option>
            <option value="Position">Account Type</option>
        </select>   
        <input placeholder="Search for Employees.." type="search" class="mt-1 form-control rounded-0 bg-light" id="SearchEmployee" onclick="toAJAX('<?php echo $query;?>')">
    </label></p>
    <div class="secondCol col-xl-12">
    </div>
</div>
<?php
include 'partials/footer.php'; 
?>
<!-- <script type="text/javascript" src="js/UserControl.js"></script> -->