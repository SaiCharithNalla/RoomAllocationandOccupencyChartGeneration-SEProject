<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">

  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="styles.css">

  <title>Send Notification</title>
  <link rel="stylesheet" type="text/css" href="styled.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <style>
      .notification-dropdown {
        right: 0; /* Add this to align the dropdown to the right */
      }
    </style>
</head>


<body>
<?php include 'header.php'; ?>

  <div class="container" id="center">
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <form method="post" onsubmit="return validateForm()">
          <div class="mb-3">
            <label for="notificationType" class="form-label">Notification Type</label>
            <select class="form-select" name="notificationType" id="notificationType">
              <option value="General">General</option>
              <option value="Urgent">Urgent</option>
              <option value="Reminder">Reminder</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Send To:</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="sendTo[]" value="students" id="sendToStudents">
              <label class="form-check-label" for="sendToStudents">
                Students
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="sendTo[]" value="faculty" id="sendToFaculty">
              <label class="form-check-label" for="sendToFaculty">
                Faculty
              </label>
            </div>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Message</label>
            <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Type your message" required>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" name="msg" id="exampleFormControlTextarea1" rows="3" required></textarea>
          </div>
          <button type="submit" name="send" class="btn btn-primary">Submit</button>
        </form>

        <?php
        include_once 'connection.php';

        if (isset($_POST['send'])) {
          $name = $_POST['name'];
          $msg = $_POST['msg'];
          $date = date('y-m-d h:i:s');
          $notificationType = $_POST['notificationType']; // Get the selected notification type

          $sql_insert = mysqli_query($con, "INSERT INTO message(name, message, cr_date, notificationType) VALUES ('$name', '$msg', '$date', '$notificationType')");

          if ($sql_insert) {
              echo "<div id='successAlert' class='alert alert-success'>Message sent!</div>";
          } else {
              echo "<div class='alert alert-danger'>" . mysqli_error($con) . "</div>";
              exit;
          }
        }
        ?>
      </div>
      <div class="col-sm-4"></div>
    </div>
  </div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>
-->

<script>
  // Close the success alert after 7 seconds
  setTimeout(function() {
    document.getElementById('successAlert').style.display = 'none';
  }, 3000);

  function validateForm() {
    // Get the input field values
    var name = document.getElementById("exampleInputEmail1").value;
    var msg = document.getElementById("exampleFormControlTextarea1").value;

    // Check if the mandatory fields are empty
    if (name === "" || msg === "") {
      alert("Please fill in all the mandatory fields.");
      return false; // Prevent form submission
    }

    // Form is valid, allow submission
    return true;
  }
</script>
<script src="header.js"></script>

</body>
</html>
