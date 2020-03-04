<?php include 'partials/header.php'; 
require "../../php/ConnectToDB.php";

$stmt = $db->prepare("SELECT COUNT(LRNNum) FROM main_student");
$stmt->execute();
$numberOfStudents = $stmt->fetch()[0];

// $stmt = $db->prepare("SELECT COUNT(SectionNum) FROM section");
// $stmt->execute();
// $numberOfSections = $stmt->fetch()[0];

// $stmt = $db->prepare("SELECT COUNT(RoomNum) FROM room");
// $stmt->execute();
// $numberOfRooms = $stmt->fetch()[0];

$stmt->closeCursor();
// echo $numberOfStudents;
?>
<script type="text/javascript">
    $('#lead').text('Dashboard');
    $('#dashboard').addClass('active');
</script>      

      <div class="content mt-4">
        
      
<?php include 'partials/footer.php'; ?>

        
                  
