<?php
/**
 * Dev: Zack Eddy
 * Date: 01/19/2017
 */
$date = $phone = $canoe = $kayak = $raft = $fName = $lName = $age = $gender = $email = $cardNo = $termsRad = " "; //initialize variables
if ($_SERVER["REQUEST_METHOD"] == "POST") { // if they click the submit button this happens

    $servername = "localhost";        // initialized DB
    $username = "guest";
    $password = "password";
    $dbname = 'Ozark';

    $conn = mysqli_connect($servername, $username, $password);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully: <br />";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed" . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO rental (usrDate, fName, lName, age, gender, canoe, kayak, raft, phone, email, cardNo, terms) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"); // prepared statement
    $stmt->bind_param("sssssiiissss", $date, $fName, $lName, $age, $gender, $canoe, $kayak, $raft, $phone, $email, $cardNo, $termsRad);   //parameter for prepared statement


    $date = inputValid($_POST["date"]);// pull values from form to variables
    $fName = inputValid($_POST["tFName"]);
    $lName = inputValid($_POST["tLName"]);
    $age = inputValid($_POST["age"]);
    $gender = ($_POST["gender"]);
    $canoe = inputValid($_POST["canoe"]);
    $kayak = inputValid($_POST["kayak"]);
    $raft = inputValid($_POST["rafts"]);
    $phone = ($_POST["phone"]);
    $email = inputValid($_POST["email"]);
    $cardNo = inputValid($_POST["cardNo"]);
    $termsRad = ($_POST["termsCheck"]);

    $stmt->execute();

    $stmt->close();

}


function inputValid($data) // validates data, and strips away dangerous characters
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Wild River Rapids</title>
    <link rel="icon" href="https://pbs.twimg.com/media/C2Yrba5UQAA-_ai.jpg:large">
    <link rel= "stylesheet" type= "text/css" href="style.css">
    
</head>

<body>
    <div id="all-contents">
        <nav>
            
			<img src = "assets/rapidTabIcon.png"  height = "52" width = "52" alt = "logo" />
			<img src = "assets/rapidTabIcon.png"  height = "52" width = "52" alt = "logo" />
			<header></header>
			
			
            <ul>
                <li><a href="index.html">Home</a></li>
				<li><a href="rentals.html">Equipment Rentals</a></li>
                <li><a href="store.html">Country Store</a></li>
                <li><a href="snackBar.html">Snack Bar</a></li>
                <li><a href="guides.html">Guides</a></li>
            


            </ul>
        </nav>
    <main>
    <form>
        <h2> Greetings
            <?php if ($gender == 'Male') {
                echo("Mr. ");
            } else if($gender == 'Female') {
                echo("Ms. ");}
            else
            {echo( $fName . " ");
            }
            echo($lName)
            ?>
           and thank you for coming!
        </h2>
        <table style=" width: 70%; margin-left: 20vh;">
            <tr>
                <td>
                    You wanted <strong><?php echo $canoe ?> </strong>  Canoes, <strong><?php echo $kayak ?></strong> kayak, and <strong><?php echo $raft ?></strong> rafts
                </td>
            </tr>
            <tr>
                <th>
                    <h3>
                        Passenger Info:
                    </h3>
                </th>
            </tr>
            <tr>
                <td>
                    Name:
                </td>
                <td>
                    <?php echo($fName) ?> <?php echo($lName) ?>
                </td>
            </tr>
            <tr>
                <td>
                    Age:
                </td>
                <td>
                    <?php echo($age) ?>
                </td>
            </tr>
            <tr>
                <td>
                    Gender:
                </td>
                <td>
                    <?php echo $gender ?>
                </td>
            </tr>
            <tr>
                <td>
                    E-mail Address
                </td>
                <td>
                    <?php echo $email ?>
                </td>
            </tr>
            <tr>
                <td>
                    Card Number:
                </td>
                <td>
                    <?php echo $cardNo ?>
                </td>
            </tr>

        </table>
    </form>
        </div>
</main>
</body>
</html>