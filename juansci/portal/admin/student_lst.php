<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Students Masterlist');
    $('#student').addClass('active');
</script>

<div class="content-main mt-4">
	
	<div class="secondCol col-xl-12">
		<p class="h5 pb-2">
			<label class="float-right" for="SearchStudent">
				<select id="Category" class="mt-1 form-control rounded-0 bg-light">
					<option value="LRNNum">LRN Number</option>
					<option value="LastName">Last Name</option>
					<option value="Extension">Extension</option>
					<option value="FirstName">First Name</option>
					<option value="MiddleName">Middle Name</option>
					<option value="GradeLevel">Grade Level</option>
				</select>
				<input placeholder="Search for students.." type="search" class="mt-1 form-control rounded-0 bg-light" id="SearchStudent">
			</label></p>
		<table id="SearchStudentTable">
			<thead class="dark">
				<tr>
				<!-- <td>Section Number</td> -->
				<td id="LRNNum">LRN Number</td>
				<td id="LastName">Last Name</td>
				<td id="Extension">Extension</td>
				<td id="FirstName">First Name</td>
				<td id="MiddleName">Middle Name</td>
				<td id="Birthday" style="display: none;"></td>
				<td id="StreetAdd1" style="display: none;"></td>
				<td id="StreetAdd2" style="display: none;"></td>
				<td id="City" style="display: none;"></td>
				<td id="Province" style="display: none;"></td>
				<td id="URL_Picture" style="display: none;"></td>
				<td id="Country" style="display: none;"></td>
				<!-- <td id="Address">Address</td> -->
				<td id="Gender" style="display: none;">Gender</td>
				<td id="GradeLevel">Grade Level</td>
				<td id="Type" style="display: none;"></td>

				
				<!-- <td id="Population">Population</td> -->
				<!-- <td>Type</td> -->
				<td></td>
				</tr>
			</thead>
			<tbody>
				<!-- <td></td> -->
			</tbody>
		</table>
	</div>

</div>
	
    
    <?php include 'partials/footer.php'; ?>
	<script type="text/javascript" src="../js/StudentList.js"></script>
    
	
