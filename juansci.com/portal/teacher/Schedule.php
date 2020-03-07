	<?php include 'partials/header.php'; ?>

	<script type="text/javascript">
		$('#lead').text('Check Schedule');
	</script>     
    <div class="room-container mt-5">
    <div class="s-table">
	<table>
		<thead class="dark">
			<tr>
				<td>TIME</td>
				<td>Monday</td>
				<td>Tuesday</td>
				<td>Wednesday</td>
				<td>Thursday</td>
				<td>Friday</td>
			</tr>
		</thead>
			<tr>
				<td>6:00-7:00</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>7:00-8:00</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>8:00-9:00</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>9:00-9:20</td>
				<!-- AM BREAK -->
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>9:20-10:20</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>10:20-11:20</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>11:20-12:20</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>12:20-1:00</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>1:00-2:00</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>2:00-3:00</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>3:00-4:00</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		<tbody>
			
		</tbody>
	</table>
	</div>
	</div>
	<?php include 'partials/footer.php'; ?>
	
	<script>
        let teacherNum = <?php echo $_SESSION['TeacherNum']?>;
        let accessType = '<?php echo $_SESSION['AccessType']?>';
        if (accessType === '') {
            accessType = 'teacher';
        }

        console.log('accessType: ' + accessType);
        console.log('teacherNum: ' + teacherNum);
    </script>

	<!-- <script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/cms.js"></script>
	<script type="text/javascript" src="js/utility.js"></script>
	<script type="text/javascript" src="../../js/modal.js"></script>
	<script type="text/javascript" src="../../js/TeacherScheduling.js"></script> -->



	<script type="text/javascript">
		var table = document.querySelector("table"); //
		var tr = document.querySelectorAll("tbody tr"); //
		function RetrieveTeacherSchedule(){
			query = "SELECT main_subject.SubjectID, SubjectTime, SubjectDay, main_section.SectionName, main_subjectcode.SubjectDescription ";
			query += "FROM main_subject LEFT JOIN main_sched ON main_subject.SubjectID = main_sched.SubjectID ";
			query += "LEFT JOIN main_section ON main_subject.SectionNum = main_section.SectionNum ";
			query += "LEFT JOIN main_subjectcode ON main_subjectcode.SubjectCode = main_subject.SubjectCode ";
			query += "WHERE main_subject.TeacherNum = '<?php echo($_SESSION['TeacherNum']);?>'";
			// function SimplifiedQuery(crud,query,searchbox,callback){
			SimplifiedQuery(
				"SELECT",
				query,
				null,
				Retrieved
			);
		}
		function Retrieved(xhttp){
			var json;	
			json = JSON.parse(xhttp.responseText);
			console.log(json);
			for(var i = 1; i < tr.length+1; i++){
				for(var j = 1; j < tr[0].childElementCount; j++){
					table.rows[i].cells[j].innerHTML = "";
				}	
			}
			try{
				for(var i = 0; i < json.length; i++){
					table.rows[GetParentRow(json[i][1])].cells[GetParentCol(json[i][2])].innerHTML = json[i][0];
					if(table.rows[GetParentRow(json[i][1])].cells[GetParentCol(json[i][2])].innerHTML != ""){
						var title = document.createAttribute("title"); //SETTING TITLE
						title.value = "Subject: " + json[i][4] +" Section: " + json[i][3];
						table.rows[GetParentRow(json[i][1])].cells[GetParentCol(json[i][2])].setAttributeNode(title);
					}
				}
			}
			catch(err){
				console.log(err);
			}
		}
		RetrieveTeacherSchedule();
	</script>
</body>
</html>