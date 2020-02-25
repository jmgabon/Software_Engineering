<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Manage Sections');
    $('#section').addClass('active');
</script>
<div style="margin: 50px 100px 0 300px !important" class="row">
	<div class="col-xl-4" id="Section">
		<p class="h5 pb-2">Add New Section</p>
		<p><input type="text" id="txt_SectionNum" style="display: none;"/>
		<label for="">Section Name: <br/><input type="text" id="txt_SectionName" required/></label></p>
	<p>
		<label for="">Room: <input class="mt-2 small" type="search" id="txt_RoomNum" disabled/></label>
		<button onclick="CreateModal('Available Rooms', 'Room')">&check;</button>
	</p>
	<p>
		<label for="">Adviser: <br/><input type="search" id="txt_EmployeeNum" style="display: none;" />
		<input type="search" id="" disabled/></label>
		<button onclick="CreateModal('Available Teachers', 'Teacher')">&check;</button>
	</p>
	<!-- <p class="mt-2"><label for="">Population: <input type="number" id="Population" disabled value="0"/></label> -->
	<label class="ml-2" for="GradeLevel">Grade Level: <select id="GradeLevel" name="GradeLevel">
		<option selected="selected">7</option>
		<option>8</option>
		<option>9</option>
		<option>10</option>
	</select></label></p>
	<button class="mt-3 rounded-pill create-button" id="CreateSection">Create</button>
	<button class="mt-3 rounded-pill" id="ResetSection">Reset</button>
	</div>

	<div id="modal">
		<div id="modal-content">
			<span id="close" onclick="closeModal(document.getElementById('modal-body'));">&times;</span>
			<div id="modal-header" >
				<h2 id="modal-title"></h2>
			</div>
			<div id= "modal-body">
			</div>
			<div id="modal-footer">	
			</div>
		</div>
	</div>
	<div class="col-xl-8">
		<p class="h5 pb-2">List of Sections
			<label class="float-right" for="SearchRoom">
				<input placeholder="Search for sections.." type="search" class="mt-1 form-control rounded-0 bg-light" id="SearchSection">
			</label></p>
		<table id="SearchSectionTable">
			<thead class="dark">
				<tr>
				<!-- <td>Section Number</td> -->
				<td id="SectionNum" style="display: none;">Section Number</td>
				<td id="SectionName">Section Name</td>
				<td id="RoomNum">Room Number</td>
				<td id="Section.EmployeeNum" style="display: none"></td>
				<td id="Adviser">Adviser</td>
				<td id="Population">Population</td>
				<td id="GradeLevel">GradeLevel</td>
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
    <?php include 'partials/footer.php'; ?>
	<script type="text/javascript" src="../js/Section.js"></script>
