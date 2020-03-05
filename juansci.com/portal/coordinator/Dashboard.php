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
    $('#lead').text('JuanSci Portal');
    $('#dashboard').addClass('active');
    $('#navbarNav').removeClass('d-md-block');
</script>      

      <div class="content">
        <div class="mt-5 ml-5 d-none d-md-block">
          <p class='text-lg'>
            <span class="text-md pb-0">WELCOME TO</span>
            <span class="head-text text-maroon"><em>JUAN</span><span class="head-text text-secondary">SCI</em>
            <span class="h1 mt-0"> PORTAL      
          </p>
          <h1 class="">Sir Hernan Apurada</h1>
          <a id="SidebarToggler" class="btn btn-danger btn-lg text-light mt-3 send-to-front"><i class="fa fa-caret-left mr-2"></i>Get Started</a>
        </div>
      </div>
      <div class="bg-red w-100">
        </div>
      
<?php include 'partials/footer.php'; ?>
        
                  
