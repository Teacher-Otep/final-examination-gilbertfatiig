<?php
$conn = mysqli_connect("localhost", "root", "", "dbstudents");


if (isset($_POST['save'])) {
    $n = $_POST['name']; $s = $_POST['surname']; $m = $_POST['middlename'];
    $a = $_POST['address']; $c = $_POST['contact'];
    mysqli_query($conn, "INSERT INTO students (name, surname, middlename, address, contact_number) VALUES ('$n', '$s', '$m', '$a', '$c')");
    header("Location: index.php?status=success");
}


if (isset($_POST['update'])) {
    $id = $_POST['id']; $n = $_POST['name']; $s = $_POST['surname']; $m = $_POST['middlename'];
    mysqli_query($conn, "UPDATE students SET name='$n', surname='$s', middlename='$m' WHERE id=$id");
    header("Location: index.php");
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM students WHERE id=$id");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management Pro</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <img src="logo.svg" id="logo" onclick="hideContent()" alt="Logo">
            <div class="nav-links">
                <button class="nav-btn" onclick="showSection('create')">Create</button>
                <button class="nav-btn" onclick="showSection('read')">Read</button>
                <button class="nav-btn" onclick="showSection('update')">Update</button>
                <button class="nav-btn" onclick="showSection('delete')">Delete</button>
            </div>
        </div>
    </nav>

    <main class="main-container">
        <section id="home" class="homecontent"> 
            <h1 class="splash">Student Management System</h1>
            <p>Welcome back. Manage your student records with ease.</p>
        </section>
        
        <section id="create" class="content card" style="display:none;">
            <h2 class="contenttitle">Register New Student</h2>
            <form method="POST" class="form-grid">
                <div class="input-group"><label>Surname</label><input type="text" name="surname" required></div>
                <div class="input-group"><label>Name</label><input type="text" name="name" required></div>
                <div class="input-group"><label>Middle Name</label><input type="text" name="middlename"></div>
                <div class="input-group"><label>Address</label><input type="text" name="address"></div>
                <div class="input-group"><label>Contact</label><input type="text" name="contact"></div>
                <div class="btn-row">
                    <button type="button" class="btn-sec" onclick="clearFields()">Clear Fields</button>
                    <button type="submit" name="save" class="btn-pri">Save Student</button>
                </div>
            </form>   
        </section>

        <section id="read" class="content card" style="display:none;">
            <h2 class="contenttitle">Database Records</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr><th>ID</th><th>Surname</th><th>Name</th><th>Middle Name</th></tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = mysqli_query($conn, "SELECT * FROM students");
                        while($row = mysqli_fetch_assoc($res)) {
                            echo "<tr><td>{$row['id']}</td><td>{$row['surname']}</td><td>{$row['name']}</td><td>{$row['middlename']}</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="update" class="content card" style="display:none;">
            <h2 class="contenttitle">Update Record</h2>
            <form method="POST" class="form-grid">
                <div class="input-group"><label>ID to Update</label><input type="number" name="id" required></div>
                <div class="input-group"><label>New Surname</label><input type="text" name="surname"></div>
                <div class="input-group"><label>New Name</label><input type="text" name="name"></div>
                <div class="input-group"><label>New Middle</label><input type="text" name="middlename"></div>
                <button type="submit" name="update" class="btn-pri full-width">Update Information</button>
            </form>
        </section>

        <section id="delete" class="content card" style="display:none;">
            <h2 class="contenttitle">Danger Zone</h2>
            <p>Select a student to remove them from the system permanently.</p>
            <div class="delete-list">
                <?php
                $res = mysqli_query($conn, "SELECT * FROM students");
                while($row = mysqli_fetch_assoc($res)) {
                    echo "<div class='delete-item'>
                            <span>{$row['name']} {$row['surname']}</span>
                            <a href='index.php?delete={$row['id']}' class='btn-del'>Delete</a>
                          </div>";
                }
                ?>
            </div>
        </section>
    </main>

    <div id="success-toast" class="toast">Successfully Saved!</div>

    <script src="script.js"></script>
</body>
</html>
