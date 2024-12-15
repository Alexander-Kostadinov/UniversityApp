<?php
include_once "config.php";
?>

<!DOCTYPE html>

<html>
<head>
    <title>Студенти в ПМФ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo time(); ?>">
</head>

<body>
    <header>
        <h3 align="center">Студенти в ПМФ</h3>
    </header>

    <nav>
        <?php include_once "links.htm"; ?>
    </nav>

    <main>
        <section class="filter-section">
            <form name="form_course" action="students.php" method="get">
                <label for="courses">Избери дисциплина:</label>
                <select name="courses" id="courses">
                    <option value="0">Всички</option>
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
                <button type="submit">Сортирай</button>
            </form>
        </section>

        <section class="teacher-section" align="center" style="margin-top: 50px;">
            <?php
            if (isset($_GET['courses']) && $_GET['courses'] != 0) {
                $result = @mysqli_query($connection, "SELECT * FROM teachers WHERE course_id = $_GET[courses];");
                $row_teacher = @mysqli_fetch_array($result);
                if ($row_teacher) {
                    echo '<p>Преподавател: ' . $row_teacher['fname'] . ' ' . $row_teacher['lname'] . '</p>';
                } else {
                    echo '<p>Няма преподавател за избраната дисциплина.</p>';
                }
            }
            ?>
        </section>

        <section class="students-section">
            <table class="students-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ФН</th>
                        <th>Име</th>
                        <th>Презиме</th>
                        <th>Фамилия</th>
                        <th>Курс</th>
                        <th>Лаб. група</th>
                        <th>Избираема дисциплина</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['courses']) && $_GET['courses'] != 0) {
                        $result = @mysqli_query($connection, "SELECT students.id, students.fnum, students.fname, students.mname, students.lname, students.lgroup, courses.name AS course_name FROM students JOIN courses ON students.course_id = courses.id WHERE students.course_id = $_GET[courses];");
                    } else {
                        $result = mysqli_query($connection, "SELECT students.id, students.fnum, students.fname, students.mname, students.lname, students.lgroup, courses.name AS course_name FROM students JOIN courses ON students.course_id = courses.id;");
                    }

                    if (mysqli_num_rows($result) > 0) {
                        while ($row_students = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            echo '<td>' . $row_students['id'] . '</td>';
                            echo '<td>' . $row_students['fnum'] . '</td>';
                            echo '<td>' . $row_students['fname'] . '</td>';
                            echo '<td>' . $row_students['mname'] . '</td>';
                            echo '<td>' . $row_students['lname'] . '</td>';
                            echo '<td>' . $row_students['course_name'] . '</td>';
                            echo '<td>' . $row_students['lgroup'] . '</td>';
                            echo '<td>' . $row_students['course_name'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="8">Няма записани студенти</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <?php mysqli_close($connection); ?>
</body>
</html>
