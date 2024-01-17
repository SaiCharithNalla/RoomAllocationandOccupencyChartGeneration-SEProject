<?php
include_once 'connection.php';
?>

<?php
if (isset($_GET['id'])) {
    $main_id = $_GET['id'];
    $sql_update = mysqli_query($con, "UPDATE message SET status=1 WHERE id='$main_id'");
}

$sql_get = mysqli_query($con, "SELECT * FROM message WHERE status=0");
$count = mysqli_num_rows($sql_get);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ&Ay"
        crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/own_styles.css">
    <title>My Notifications</title>
</head>

<body>

    
    <div class="container" id="table1">
        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">S.no</th>
                        <th scope="col">Date</th>
                        <th scope="col">Notification Type</th>
                        <th scope="col">Message</th>
                        <th scope="col">Description</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql_get = mysqli_query($con, "SELECT * FROM message WHERE status=1");
                    $Sr_no = 1; // Initialize the variable
                    while ($main_result = mysqli_fetch_assoc($sql_get)) :
                    ?>
                        <tr>
                            <th scope="row"><?php echo $Sr_no++; ?></th>
                            <td><?php echo $main_result['cr_date']; ?></td>
                            <td><?php echo $main_result['notificationType']; ?></td>
                            <td><?php echo $main_result['message']; ?></td> 
                            <td><?php echo $main_result['name']; ?></td><!-- Display the notification type -->
                            <td><a href="delete.php?id=<?php echo $main_result['id']; ?>" class="text-danger"><i class="fas fa-trash"></i></a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw5mjyVlW2mIMh3GtrTQsD3N/x0q32V7+Z6OaO0wT9JTpfXmULWj27Bqdjjtu/"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
        integrity="sha384-YPhs+JvUw5y9izJecDfJ8ro+ZGm4AjnQ5XwOAG+0Aj79KQsQWU+I5t3DBLUeW&aR"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-0K0j7dRr6jKQ5aFhc0ejkpBr6w1+rjjCvYqmy8i3Sq2vH9rf6hjHfBDrBY&AQHg9"
        crossorigin="anonymous"></script>
    -->
</body>

</html>
