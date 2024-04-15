<?php 
  session_start();
  if (!isset($_SESSION['rollnumber'])) {
  	header("Location: login.php");
  }
  if (isset($_GET['logout'])) {
    unset($_SESSION['rollnumber']);
    session_destroy();
    mysqli_close($db);
  	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <title>Student Profile - Housekeeper Student Dashboard</title>
  <?php require("meta.php"); ?>
</head>
<body data-bs-theme="dark">
  <!-- Side Navigation -->
  <?php require("sidenav.php"); ?>
  <!-- Main content -->
  <div class="main-content">
      <!-- Header -->
      <div class="header bg-background pb-6 pt-5 pt-md-6">
      <div class="container-fluid">
        <?php 
          require("headerstats.php"); 
          $student = getStudent($_SESSION['rollnumber'], $db); 
        ?>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--5">
      <div class="row mt-2">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Your Profile</h3>
                  <div class="form-check form-switch mx-4">
                    <input
                      class="form-check-input p-2"
                      type="checkbox"
                      role="switch"
                      id="flexSwitchCheckChecked"
                      checked
                      onclick="myFunction()"
                      style="border-color: black"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="font-size: 12px;">Roll Number</th>
                    <th scope="col" style="font-size: 13px;"><?php echo $student['rollnumber']; ?></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Hostel</th>
                    <td><?php echo strtoupper($student['hostel']); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Floor</th>
                    <td><?php echo $student['floor']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Room</th>
                    <td><?php echo strtoupper($student['room']); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function myFunction() {
      var element = document.body;
      element.dataset.bsTheme = 
        element.dataset.bsTheme == "light" ? "dark" : "light";
    }
  </script>
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/argon.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
