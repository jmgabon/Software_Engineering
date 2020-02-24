<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Student Drafting');
    $('#student').addClass('active');
</script>
<div class="content-main mt-4">
	<div class="row">
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
	<div id="firstCol" class="ml-5">
		<p class="h5 m-3">Select an option:</p>
		<button class="btn-sm btn-light border-dark ml-4">Add to Section</button>
		<button class="btn-sm btn-light border-dark ml-4 mr-4">Change Section</button>
		<div class="border-top border-dark mt-3 p-4">
			<p><label for="">LRN Number:	<input class="form-control" type="search" id="txt_LRNNum" disabled/></label> <button class="modal-button"><i class="far fa-window-restore"></i></button></p>
			<p><label for="">Student Name: <input class="form-control" type="search" id="txt_StudentName" disabled/></label></p>
			<p><label for="">Grade Level: <input class="form-control" type="search" id="txt_GradeLevel" disabled/></label></p>
			<!-- <p><label for="">Pick Section:</label><button>&check;</button></p> -->
			<p>
				<label for="">Section:
					<input class="form-control" type="search" id="txt_SectionNum" style = "display: none;" disabled/>
					<input class="form-control" type="search" id="txt_SectionName" disabled/>
				</label>
				<button class="modal-button"><i class="far fa-window-restore"></i></button>
			</p>
		</div>
		
	</div>
   	<script type="text/javascript">
		var user = "<?php echo($_SESSION['access']);?>";
		// console.log(user);
	</script>
	
	<script type="text/javascript" src="../js/StudentDrafting.js"></script>
	<?php include 'partials/footer.php'; ?>
