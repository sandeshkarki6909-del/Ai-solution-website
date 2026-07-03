<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: admin-login.php");
    exit();
}

include "../config/database.php";

/* Delete Feedback */

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    mysqli_query(
        $conn,
        "DELETE FROM feedback WHERE id='$id'"
    );

    header("Location: manage-feedback.php");
    exit();
}

/* Get Feedback */

$result = mysqli_query(
    $conn,
    "SELECT * FROM feedback
     ORDER BY created_at DESC"
);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Manage Feedback</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    background:#f5f7fb;
}

.sidebar{
    width:250px;
    height:100vh;
    background:#0d6efd;
    position:fixed;
    left:0;
    top:0;
    padding-top:20px;
}

.sidebar h3{
    color:white;
    text-align:center;
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:15px 25px;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.2);
}

.main-content{
    margin-left:250px;
    padding:30px;
}

.table-container{
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

</style>

</head>

<body>

<!-- Sidebar -->

<div class="sidebar">

<h3>Admin Panel</h3>

<a href="admin-dashboard.php">
Dashboard
</a>

<a href="inquiries.php">
Inquiries
</a>

<a href="manage-feedback.php">
Manage Feedback
</a>

<a href="logout.php">
Logout
</a>

</div>

<!-- Main Content -->

<div class="main-content">

<h2 class="mb-4">
Manage Feedback
</h2>

<div class="table-container">

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Rating</th>
<th>Message</th>
<th>Date</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php
while(
$row =
mysqli_fetch_assoc($result)
)
{
?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $row['email']; ?>
</td>

<td>
<?php echo $row['rating']; ?>/5
</td>

<td>
<?php echo $row['message']; ?>
</td>

<td>
<?php echo $row['created_at']; ?>
</td>

<td>

<a
href="manage-feedback.php?delete=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this feedback?')">

Delete

</a>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</div>

</body>
</html>