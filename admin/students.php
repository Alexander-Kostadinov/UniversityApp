<?php
if (!isset($_SESSION)) { 
  session_start(); 
}
if(!isset($_SESSION['user'])){header("Location:index.php");}
include_once "config.php";
?>

<!DOCTYPE html>

<html>
    
<head>
    <title>Студенти от ПМФ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo time(); ?>">
    <?php
    if(isset($_GET['dell'])) {
        echo '<script type="text/javascript">
        var answer = confirm("Студент No '.$_GET['dell'].' ЩЕ БЪДE ИЗТРИТ ОТ БАЗАТА ДАННИ")
        if (answer) {
            window.location="students.php?delltrue='.$_GET['dell'].'";
        } else {
            window.location="students.php";
        }
        </script>';
    }

    if(isset($_GET['delltrue'])) {
        mysqli_query($connection,"DELETE FROM `students` WHERE id='$_GET[delltrue]'"); 
        mysqli_query($connection,"OPTIMIZE TABLE `students`");
    }
    ?>
</head>

<body>
<div class="container">
    <div class="logout">
        <?php if(isset($_SESSION['user'])) { 
            echo '<p>Потребител: <strong>'.$_SESSION['user'].'</strong> - '; 
        } ?>
        <a href="index.php?logout">
			<strong>Изход</strong>
		</a>
    </div>

    <?php include_once "links.htm"; ?>

    <h3>Студенти от ПМФ</h3>

    <div id="add-teacher" align="center">
            <a href="add_student.php">
                <strong>Добавяне на нов студент</strong>
            </a>
    </div>

    <div class="form-container">
        <form name="form_course" action="students.php" method="get">
            <div class="form-group">
                <label for="courses">Избираема дисциплина:</label>
                <select name="courses" id="courses">
                    <option value="0" selected>Всички</option>
                    <?php
                        $result_courses = mysqli_query($connection, "SELECT * FROM courses");
                        while ($row_course = mysqli_fetch_array($result_courses)) {
                            echo '<option value=' . $row_course['id'];
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
                <input name="search_text" id="search_text" type="text" placeholder="Търси студент">
            </div>
            <input type="submit" value="търсене">
        </form>
    </div>

    <div class="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>Факултетен номер</th>
                <th>Име</th>
                <th>Презиме</th>
                <th>Фамилия</th>
                <th>Курс</th>
                <th>Лаб.група</th>
                <th>Избираема дисциплина</th>
                <th>Изтриване</th>
                <th>Редактиране</th>
            </tr>
            <?php
            if (isset($_GET['courses']) && $_GET['courses'] != 0) {
                $result = mysqli_query($connection,"SELECT * FROM students, courses WHERE students.course_id=$_GET[courses] AND courses.id=$_GET[courses];");
            } elseif (isset($_GET['search_text'])) {
                $result = mysqli_query($connection,"SELECT * FROM students, courses WHERE (fname LIKE '%$_GET[search_text]%' OR mname LIKE '%$_GET[search_text]%' OR lname LIKE '%$_GET[search_text]%') AND students.course_id=courses.id;");
                if (mysqli_num_rows($result) == 0) {
                    echo '<tr><td colspan="10" class="error">Няма намерени резултати</td></tr>';
                    $result = mysqli_query($connection,"SELECT * FROM students, courses WHERE students.course_id=courses.id;");
                }
            } else {
            $result = mysqli_query($connection,"SELECT * FROM students, courses WHERE students.course_id=courses.id;");
            }

            while($row_students = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                echo '<tr>
                    <td>'.$row_students['0'].'</td>
                    <td>'.$row_students['fnum'].'</td>
                    <td>'.$row_students['fname'].'</td>
                    <td>'.$row_students['mname'].'</td>
                    <td>'.$row_students['lname'].'</td>
                    <td>'.$row_students['course'].'</td>
                    <td>'.$row_students['lgroup'].'</td>
                    <td>'.$row_students['name'].'</td>
                    <td><a href="students.php?dell='.$row_students['0'].'">Изтриване</a></td>
                    <td><a href="edit_student.php?id='.$row_students['0'].'">Редактиране</a></td>
                </tr>';
            }
            ?>
        </table>
    </div>
</div>
<?php mysqli_close($connection); ?>
</body>
</html>
