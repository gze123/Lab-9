<!DOCTYPE html>
<html>
<?php
session_start();
include_once("config.php");
$message = "";
if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
    $id = $_SESSION['user_id'];

    $name = $studentID = $email  =  $birthday = $event = "";
    // $id = 17;
    $sql = "SELECT * FROM members WHERE id=?";
    $stmt = mysqli_prepare($mysqli, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    // mysqli_stmt_store_result($stmt);

    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $name = $row['name'];
        $studentID = $row['studentID'];
        $email = $row['email'];
        $birthday = $row['birthday'];
        $event = $row['event'];
    }
    $message = "Hi " . $name . ". Welcome to SE Club ";
} else {
    $message = "Only logged in and authorized member can access this page";
} ?>

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

        .form-signin {
            max-width: 330px;
            margin: 0 auto;
            padding: 15px;
            width: 100%;
        }

        th {
            width: 30%;
        }

        td {
            width: 70%;
            float: left;
        }
    </style>
</head>

<body>

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
                    <li class="nav-item ">
                        <a class="nav-link" href="signup.html">Sign Up<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="memberProfile.php">Profile<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log Out<span class="sr-only">(current)</span></a>
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
                    <h1>SE Club - Member Profile</h1>
                </div>

                <div class="alert alert-info" role="alert">
                    <p> <?php echo $message; ?></p>
                </div>
                <div>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['user_email'] && $_SESSION['logged_in'] == true) {
                        echo "<table class='table table-striped' style= 'width :100%'>";
                        echo "<tr><th>Name:</th>" . "<td>" . $name . "</td></tr>";
                        echo "<tr><th>Student ID:</th>" . "<td>" . $studentID . "</td></tr>";
                        echo "<tr><th>Email:</th>" . "<td>" . $email . "</td></tr>";
                        echo "<tr><th>Birthday:</th>" . "<td>" . $birthday . "</td></tr>";
                        echo "<tr><th>Most Favourite Event:</th>" . "<td>" . $event . "</td></tr>";
                    }
                    ?>
                </div>


            </div>
        </main>

        <!-- <footer class="container text-center font-italic">
            <hr />
            Copyright &copy; 2019 UM Software Engineering Club<br />
            <a href="umseclub@um.edu.my">umseclub@um.edu.my</a>
        </footer> -->
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>