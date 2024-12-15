<?php
if (!isset($_SESSION)) { 
    session_start(); 
}
if (!isset($_SESSION['user'])) {
    header("Location:index.php");
}
include_once "config.php";
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Преподаватели от ПМФ</title>
    <link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo time(); ?>">
    <?php
    if (isset($_GET['dell'])) {
        echo '<script type="text/javascript">
            var answer = confirm("Преподавател No '.$_GET['dell'].' ЩЕ БЪДЕ ИЗТРИТ ОТ БАЗАТА ДАННИ")
            if (answer) {
                window.location="teachers.php?delltrue='.$_GET['dell'].'";
            } else {
                window.location="teachers.php";
            }
        </script>';
    }

    if (isset($_GET['delltrue'])) {
        mysqli_query($connection, "DELETE FROM `teachers` WHERE id='$_GET[delltrue]'");
        mysqli_query($connection, "OPTIMIZE TABLE `teachers`");
    }
    ?>
</head>

<body>
    <div class="container">
        <div class="logout">
            <?php if (isset($_SESSION['user'])) {
                echo '<p>Потребител: <strong>' . $_SESSION['user'] . '</strong> - '; 
            } ?>
            <a href="index.php?logout"><strong>Изход</strong></a>
        </div>

        <?php include_once "links.htm"; ?>

        <h3>Преподаватели от ПМФ</h3>

        <div id="add-teacher" align="center">
            <a href="add_teacher.php">
                <strong>Добавяне на нов преподавател</strong>
            </a>
        </div>

        <div class="form-container">
            <form name="form_course" action="teachers.php" method="get">
                <div class="form-group">
                    <label for="courses">Избираеми дисциплина:</label>
                    <select name="courses" id="courses">
                        <option value="0" selected>Всички</option>
                        <?php
                            $result_courses = mysqli_query($connection, "SELECT * FROM courses");
                            while ($row_course = mysqli_fetch_array($result_courses)) {
                                echo '<option value="' . $row_course['id'] . '"';
                                if (isset($_GET['courses']) && $_GET['courses'] == $row_course['id']) {
                                    echo ' selected>' . $row_course['name'] . '</option>';
                                } else {
                                echo '>' . $row_course['name'] . '</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <input type="submit" value="сортирай">
            </form>

            <form name="form_search" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
                <div class="form-group">
                    <label for="search_text">Въведете име:</label>
                    <input name="search_text" id="search_text" type="text" placeholder="Търси преподавател">
                </div>
                <input type="submit" value="търсене">
            </form>
	    </div>

        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Име</th>
                    <th>Презиме</th>
                    <th>Фамилия</th>
                    <th>Избираема дисциплина</th>
                    <th>Изтриване</th>
                    <th>Редактиране</th>
                </tr>

                <?php
                if (isset($_GET['courses']) && $_GET['courses'] != 0) {
                    $result = mysqli_query($connection, "SELECT * FROM teachers, courses WHERE teachers.course_id=$_GET[courses] AND courses.id=$_GET[courses];");
                } elseif (isset($_GET['search_text'])) {
                    $result = mysqli_query($connection, "SELECT * FROM teachers, courses WHERE (fname LIKE '%$_GET[search_text]%' OR mname LIKE '%$_GET[search_text]%' OR lname LIKE '%$_GET[search_text]%') AND teachers.course_id=courses.id;");
                    if (mysqli_num_rows($result) == 0) {
                        echo '<tr><td colspan="7" class="error">Няма намерени резултати</td></tr>';
                        $result = mysqli_query($connection, "SELECT * FROM teachers, courses WHERE teachers.course_id=courses.id;");
                    }
                } else {
                    $result = mysqli_query($connection, "SELECT * FROM teachers, courses WHERE teachers.course_id=courses.id;");
                }

                while ($row_teacher = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                    echo '<tr>
                        <td>' . $row_teacher['id'] . '</td>
                        <td>' . $row_teacher['fname'] . '</td>
                        <td>' . $row_teacher['mname'] . '</td>
                        <td>' . $row_teacher['lname'] . '</td>
                        <td>' . $row_teacher['name'] . '</td>
                        <td><a href="teachers.php?dell=' . $row_teacher['id'] . '">Изтриване</a></td>
                        <td><a href="edit_teacher.php?id=' . $row_teacher['id'] . '">Редактиране</a></td>
                        </tr>';
                    }
                ?>
            </table>
        </div>
    </div>

<?php mysqli_close($connection); ?>

</body>
</html>
