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
        <div class="row ml-4">
          <div class="col row col-12 col-md-8">
            <div class="card shadow border-0 students">
              <h1 class="count-text"><?php echo $numberOfStudents;?></h1>
              <p class="ml-4 lead pl-2">students</p>
            </div>
            <div class="card shadow border-0 teachers">
              <h1 class="count-text">0</h1>
              <p class="ml-4 lead pl-2">teachers</p>
            </div>
            <div class="row card shadow border-0 classes">
              <div class="col-5 pl-0">
                <h1 class="count-text">0</h1>
                <p class="ml-4 lead pl-2">classes</p>
              </div>
              <div class="col-7 mt-4 d-inline-block text-center">
                <div class="d-inline-block mr-3 mb-2">
                  <h1 class="count-text-classes">0</h1>
                  grade 7
                </div>
                <div class="d-inline-block">
                  <h1 class="count-text-classes">0</h1>
                  grade 8
                </div>
                <div class="d-inline-block mr-3">
                  <h1 class="count-text-classes">0</h1>
                  grade 9
                </div>
                <div class="d-inline-block">
                  <h1 class="count-text-classes">0</h1>
                  grade 10
                </div>
              </div>
              
            </div>
            <div class="card shadow border-0 rooms">
              <div class="row mt-4 text-center">
                <div class="col-4 mt-3 ml-5">
                  <h1 class="count-text m-0">0</h1>
                  <p class="text-rooms">available</p>
                </div>
                <div class="col-4 mt-3">
                  <h1 class="count-text m-0">0</h1>
                  <p class="text-rooms ">occupied</p>
                </div>
              </div>
              
              <p class="ml-4 lead pl-2">rooms</p>
            </div>
          </div>
          <div class="col col-4">
            
          </div>
        </div>

      </div>
      
<?php include 'partials/footer.php'; ?>

        
                  
