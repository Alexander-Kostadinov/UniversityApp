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
    <title>Избираеми дисциплини от ПМФ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css?ver=<?php echo time(); ?>">

    <?php
    if (isset($_GET['dell'])) {
        echo '<script type="text/javascript">
        var answer = confirm("Избираема дисциплина No ' . $_GET['dell'] . ' ЩЕ БЪДЕ ИЗТРИТА ОТ БАЗАТА ДАННИ")
        if (answer) {
            window.location="courses.php?delltrue=' . $_GET['dell'] . '";
        } else {
            window.location="courses.php";
        }
        </script>';
    }

    if (isset($_GET['delltrue'])) {
        mysqli_query($connection, "DELETE FROM `courses` WHERE id='$_GET[delltrue]'");
        mysqli_query($connection, "OPTIMIZE TABLE `courses`");
    }
    ?>
</head>

<body>
    <div class="container">
        <div class="logout">
            <?php if (isset($_SESSION['user'])) {
                echo '<p>Потребител: <strong>' . $_SESSION['user'] . '</strong> - ';
            } ?>
            <a href="index.php?logout">
                <strong>Изход</strong>
            </a>
        </div>

        <?php include_once "links.htm"; ?>

        <h3>Избираеми дисциплини от ПМФ</h3>

        <div id="add-course" align="center">
            <a href="add_course.php">
                <strong>Добавяне на нова дисциплина</strong>
            </a>
        </div>

        <div class="form-container">
            <form name="form_course" action="courses.php" method="get">
                <div class="form-group">
                    <label for="courses">Избираема дисциплина:</label>
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
                    <input name="search_text" id="search_text" type="text" placeholder="Търси дисциплина">
                </div>
                <input type="submit" value="търсене">
            </form>
        </div>

        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Име</th>
                    <th>Изтриване</th>
                    <th>Редактиране</th>
                </tr>

                <?php
                if (isset($_GET['courses']) && $_GET['courses'] != 0) {
                    $result = mysqli_query($connection, "SELECT * FROM courses WHERE id='$_GET[courses]'");
                } elseif (isset($_GET['search_text'])) {
                    $result = mysqli_query($connection, "SELECT * FROM courses WHERE name LIKE '%$_GET[search_text]%'");
                    if (mysqli_num_rows($result) == 0) {
                        echo '<tr><td colspan="4" class="error">Няма намерени резултати</td></tr>';
                        $result = mysqli_query($connection, "SELECT * FROM courses");
                    }
                } else {
                    $result = mysqli_query($connection, "SELECT * FROM courses");
                }

                while ($row_course = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                    echo '<tr>
                        <td>' . $row_course['id'] . '</td>
                        <td>' . $row_course['name'] . '</td>
                        <td><a href="courses.php?dell=' . $row_course['id'] . '">Изтриване</a></td>
                        <td><a href="edit_course.php?id=' . $row_course['id'] . '">Редактиране</a></td>
                    </tr>';
                }
                ?>
            </table>
        </div>
    </div>

    <?php mysqli_close($connection); ?>
</body>

</html>
