<?php
session_start();

$fieldclass = isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] ? 'is-dark' : 'is-primary';
$buttontheme = isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] ? 'button-dark' : 'button-normal';

$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

require 'include/connToDB.php';
require 'include/url-redirect.php';

$Service = '';
$DateTime = '';
$Address = '';
$ExprirationDate = '';
$CardNum = '';
$CVV = '';
$Price = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getDB();

    if ($_POST['Service']) {
        $option = $_POST['Service'];
        if ($option == "1") {
            $Service = 'Consultation';
            $Price = '250';
        } elseif ($option == "2") {
            $Service = 'Solar panel installation';
            $Price = '8000';
        } elseif ($option == "3") {
            $Service = 'Solar panel maintenance';
            $Price = '500';
        } elseif ($option == "4") {
            $Service = 'Electric vehicle charging station installation';
            $Price = '1000';
        } elseif ($option == "5") {
            $Service = 'Electric vehicle charging station maintenance';
            $Price = '400';
        } elseif ($option == "6") {
            $Service = 'Smart meter installation';
            $Price = '10';
        }
    }

    $conn = getDB();

    $DateTime = $_POST['DateTime'];
    $Address = $_POST['Address'];
    $ExprirationDate = $_POST['ExprirationDate1'] . '/' . $_POST['ExprirationDate2'];
    $CardNum = $_POST['CardNum'];
    $CVV = $_POST['CVV'];

    if (
        is_numeric($CardNum) && is_numeric($CVV) && is_numeric($_POST['ExprirationDate1']) && is_numeric($_POST['ExprirationDate2'])) {
            
        $sql = "INSERT INTO bookings (CustomerID, Service, DateTime, Address, ExprirationDate, CardNum, CVV, Price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "ssssssss", $_SESSION['CustomerID'], $Service, $DateTime, $Address, $ExprirationDate, $CardNum, $CVV, $Price);

        if (mysqli_stmt_execute($stmt)) {
            $BookingID = mysqli_insert_id($conn);
            $_SESSION['success'] = 'Booking Successful :)';
            redirect('/booking.php');
        };
    } else {
        $_SESSION['error'] = 'Card information must be Numeric';
        redirect('/booking.php');
    }
}
?>
<html>

<head>
    <title>Booking</title>
    <link href="bulma.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
</head>

<body id="booking">
    <?php require 'include\navbar.php'; ?>
    <section class="section" id="title">
        <h1 class="title">Booking</h1>
        <h2 class="subtitle">Fill out the information below to book one of our services</h2>
        <br>
    </section>
    <form method="post">
        <div>
            <label class="label <?= $fieldclass ?>" for="Service">
                <p>Which service do you want to book?:</p>
            </label>
            <div class="select <?= $fieldclass ?>">
                <select name='Service'>
                    <option value="1">Consultation (£250)</option>
                    <option value="2">Solar panel installation (£8,000)</option>
                    <option value="3">Solar panel maintenance (£500)</option>
                    <option value="4">Electric vehicle charging station installation (£1000)</option>
                    <option value="5">Electric vehicle charging station maintenance (£400)</option>
                    <option value="6">Smart meter installation (£10)</option>
                </select>
            </div>
        </div>
        <br>
        <div class="field <?= $fieldclass ?>">
            <label class='label <?= $fieldclass ?>' for="DateTime">
                <p>Date/Time for booking:</p>
            </label>
            <input class="input <?= $fieldclass ?>" type="datetime-local" name="DateTime" id="DateTime" required>
        </div>
        <div class="field <?= $fieldclass ?>">
            <script src="https://cdn.getaddress.io/scripts/getaddress-autocomplete-3.0.9.js">
            </script>

            <label class="label <?= $fieldclass ?>" for="Address">
                <p>Address:</p>
                <input class="input <?= $fieldclass ?>" name='Address' id="Address" type="text" placeholder="Type your postcode here" required>
                <script>
                    const enableAutocomplete = async () => {
                        await getAddress.autocomplete('Address', 'tPYJidRXZU20aZOGEgZc1A45471', {
                            selected: (address) => {
                                document.getElementById('Address').value = address.formatted_address;
                            }
                        });
                    }
                    enableAutocomplete();
                </script>
        </div>
        <div class="field <?= $fieldclass ?>">
            <label class="label <?= $fieldclass ?>" for="CardNum">
                <p>Card number:</p>
            </label>
            <input class="input <?= $fieldclass ?>" name="CardNum" id="CardNum" placeholder="XXXXXXXXXXXXXXXX" required maxlength=16>
        </div>
        <div class="field <?= $fieldclass ?>">
            <label class="label <?= $fieldclass ?>" for="ExprirationDate">
                <p>Expiration Date:</p>
            </label>
            <d id="Expiration">
                <input class="input <?= $fieldclass ?>" name="ExprirationDate1" id="ExprirationDate" placeholder="XX" required maxlength=2>
                <h2>/</h2>
                <input class="input <?= $fieldclass ?>" name="ExprirationDate2" id="ExprirationDate" placeholder="XX" required maxlength=2>
        </div>
        </div>
        <div class="field <?= $fieldclass ?>">
            <label class="label <?= $fieldclass ?>" for="CVV">
                <p>CVV:</p>
            </label>
            <input class="input <?= $fieldclass ?>" name="CVV" id="CVV" placeholder="XXX or XXXX" required maxlength=4>
        </div>
        <br>
        <button class="<?= $buttontheme ?>" Type='Submit'>Make booking</button>
        <br>
        <?php if (!empty($success)) { ?>
            <p><b><?= htmlspecialchars($success); ?></b></p>
        <?php } else {; ?>
            <p><b><?= htmlspecialchars($error); ?></b></p>
        <?php } ?>
    </form>
    <button class="<?= $buttontheme ?>" id="current"><a href="currentbooking.php">View current bookings</a></button>