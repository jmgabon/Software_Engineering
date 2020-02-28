<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Teacher Scheduling');
    $('#schedule').addClass('active');
</script>
<div class="content-main mt-5">
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
	<div>
	<p>
		<!-- <label for="">Teacher: <input type="search" id="txt_TeacherEmployeeNum" style="display: none;" />
		<input type="search" id="txt_TeacherName" disabled/></label>
		<button class="modal-button"><i class="far fa-window-restore"></i></button> -->
		<select id="Category">
			<option value="employee" selected="selected">Employee Logs</option>
			<option value="room">Room Logs</option>
			<option value="sched">Schedule Logs</option>
			<option value="section">Section Logs</option>
			<option value="student">Student Logs</option>
			<option value="student_section">Student Assignment Logs</option>
			<option value="subject">Subject Logs</option>
			<option value="subjectcode">Subject Code Logs</option>
		</select>
	</p>
	<p>
		<!-- <label for="">Add Subject:</label>
		<button class="modal-button"><i class="far fa-window-restore"></i></button> -->
	</p><br/>
	</div>
	<div class="s-table">
	<!-- <table>
		<thead class="dark">
			
		</thead>
			
		<tbody>
			
		</tbody>
	</table> -->
	<!-- <button class="rounded-pill">RESET</button> -->
	</div>
	<script type="text/javascript">
		var user = "<?php echo($_SESSION['access']);?>";
		// console.log(user);


	</script>

<?php include 'partials/footer.php'; ?>
<script type="text/javascript" src="../js/logs.js"></script>