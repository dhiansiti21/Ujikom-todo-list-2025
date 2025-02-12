<?php
include 'database.php';
session_start();
if (!isset($_SESSION['username'])) {
    // Jika user belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}


if(isset($_POST['add'])){
    // Ambil data task dan prioritas dari form
    $task = $_POST['task'];
    $priority = $_POST['priority'];  // Ambil prioritas dari form
    $q_insert = "INSERT INTO tasks (tasklabel, taskstatus, priority) VALUES ('$task', 'open', '$priority')";
    $run_q_insert = mysqli_query($conn, $q_insert);
    if($run_q_insert){
        header('Refresh:0; url=index.php');
    }
}

// Proses show data
$q_select = "SELECT * FROM tasks ORDER BY taskid DESC";
$run_q_select = mysqli_query($conn, $q_select);

// Proses delete
if(isset($_GET['delete'])){
    $q_delete = "DELETE FROM tasks WHERE taskid = '".$_GET['delete']."'";
    $run_q_delete = mysqli_query($conn, $q_delete);
    header('Refresh:0; url=index.php');
}


// Proses update data
if(isset($_GET['done'])){
    $status = ($_GET['status'] == 'open') ? 'close' : 'open';
    $q_update = "UPDATE tasks SET taskstatus = '".$status."' WHERE taskid = '".$_GET['done']."'";
    $run_q_update = mysqli_query($conn, $q_update);
    header('Refresh:0; url=index.php');
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href ="style_todolists.css">
</head>
<body>

<div class="container">

<div class="header">
    <div class="title">
        <i class='bx bx-sun'></i>
        <span>To Do List</span>
    </div>
    <div class="description">
        <?= date("l, d M Y") ?>
    </div>
</div>

<div class="content">
    <div class="card">
        <form action="" method="post">
            <input type="text" name="task" class="input-control" placeholder="Add task" required>
            <!-- Dropdown untuk memilih prioritas -->
            <select name="priority" class="input-control" required>
                <option value="rendah">Rendah</option>
                <option value="tinggi">Tinggi</option>
            </select>
            <div class="text-right">
                <button type="submit" name="add">Add</button>
            </div>
        </form>
    </div>

    <?php
            if(mysqli_num_rows($run_q_select) > 0){
                while($r = mysqli_fetch_array($run_q_select)){
                    // Menentukan kelas untuk menandakan prioritas tinggi
                    $priorityClass = ($r['priority'] == 'tinggi') ? 'high-priority' : 'low-priority';
            ?>
            <div class="card">
                <div class="task-item <?=$r['taskstatus'] == 'close' ? 'done' : '' ?> <?=$priorityClass?>">
                    <div>
                        <input type="checkbox" onclick="window.location.href = '?done=<?= $r['taskid'] ?>&status=<?= $r['taskstatus'] ?>'" <?=$r['taskstatus'] == 'close' ? 'checked' : '' ?>>
                        <span><?= $r['tasklabel'] ?></span>
                    </div>
                    <div>
                        <a href="edit.php?id=<?= $r['taskid']?>" class="text-orange" title="Edit"><i class="bx bx-edit"></i></a>
                        <a href="?delete=<?= $r['taskid'] ?>" class="text-red" title="Remove" onclick="return confirm('Are you sure?')"><i class="bx bx-trash"></i></a>
                    </div>
                </div>
            </div>
            <?php }} else { ?>
                <div>Belum ada task</div>
            <?php } ?>
        </div>

    </div>

    
</body>
</html>
