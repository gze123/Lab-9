<!DOCTYPE html>
<html>

<head>
    <title>SE Club</title>
    <!-- <link rel="stylesheet" href="seclub.css" /> -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <style>
        .jumbotron {
            background-color: #f0f8ff;
        }

        body {
            background-color: #add8e6;
        }
    </style>
</head>

<body>
    <?php
    include_once("config.php");

    $name = $studentID = $email = $repeat = $password = $birthday = $event = $hash_password = $verifiedMessage = "";
    $verify = False;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $name  = $_POST['name'];
        $studentID  = $_POST['studentID'];
        $email  = $_POST['email'];
        $password = $_POST["password"];
        $repeat = $_POST["repassword"];
        $birthday  = $_POST['birthday'];
        $event  = $_POST['event'];
        $verify  = checkPassword($password, $repeat);
        $sql = "SELECT * FROM members WHERE email= ? OR studentID = ?";

        if ($verify) {
            if ($stmt = mysqli_prepare($mysqli, $sql)) {
                mysqli_stmt_bind_param($stmt, 'ss', $email, $studentID);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $verifiedMessage = "duplicate";
                    mysqli_stmt_close($stmt);
                } else {
                    $verifiedMessage = "New record";
                    mysqli_stmt_close($stmt);
                    $sql_insert = "INSERT INTO members(name,studentID,email,password,birthday,event) VALUES (?,?,?,?,?,?)";
                    $hash_password = password_hash($password, PASSWORD_BCRYPT);
                    $stmt = mysqli_prepare($mysqli, $sql_insert);
                    mysqli_stmt_bind_param($stmt, 'ssssss', $name, $studentID, $email, $hash_password, $birthday, $event);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $verifiedMessage = "New record successfully added";
                    mysqli_stmt_close($stmt);
                }
            }
            mysqli_close($mysqli);
        } else {
            $verifiedMessage = "Password does not match";
        }
    }

    function checkPassword($pwd1, $pwd2)
    {
        if ($pwd1 == $pwd2) {
            return True;
        } else return False;
    }

    ?>
    <div class="container pt-5 mt-5">
        <!-- <header>
        <h1>Software Engineering Club</h1>
      </header> -->

        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="#"><img src="selogo.jpg" width="30px" height="30px" class="d-inline-block align-top" alt="" />Software Engineering Club</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="index.html">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="events.html">Event</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="signup.html">Sign Up<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Log In<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0 ">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                        Search
                    </button>
                </form>
            </div>
        </nav>

        <main>
            <div class="jumbotron">

                <div>
                    <div class="alert alert-primary" role="alert">
                        <p>
                            <span style="color:red"><?php echo $verifiedMessage; ?></span>

                            <?php
                            if ($verify) {
                                echo "<br>";
                                echo "<a href='signup.html'>Sign Up</a>";
                            }
                            ?>
                            <br><br>

                            <!-- <a href="profile.php">Log In</a> -->
                        </p>
                    </div>

                </div>
            </div>
        </main>

        <footer class="container text-center font-italic">
            <hr />
            Copyright &copy; 2019 UM Software Engineering Club<br />
            <a href="umseclub@um.edu.my">umseclub@um.edu.my</a>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>