<?php
session_start();
$fieldclass = isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] ? 'is-dark' : 'is-primary';
$buttontheme = isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] ? 'button-dark' : 'button-normal';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $energyBill = $_POST['energyBill'];//monthly bill
    $miles = $_POST['miles']; //kgc02 per mile from car;
    $annualFlights = $_POST['annualFlights'];//amount of one way flights per year
    $flightlen = $_POST['flightlen'];//length of the average flight

    if ($_POST['heating']) {
        $option1 = $_POST['heating'];
        if ($option1 == "1") {
            $heating = 0.225; // uk average kgco2 for gas
        } elseif ($option1 == "2") {
            $heating = 0.018; // uk average kgco2 for electricity
        }
    }

    if ($_POST['carType']) {
        $option2 = $_POST['carType'];
        // average emissions per mile for:
        if ($option2 == '1') {
            $carType = 0.28; // Petrol
        } elseif ($option2 == '2') {
            $carType = 0.00; // Electric
        } elseif ($option2 == '3') {
            $carType = 0.27; // Diesel
        } elseif ($option2 == '4') {
            $carType = 0.14;  // Hybrid
        }

        $carCO2 = $miles * $carType * 12; // per year
    }

    if ($_POST['recycling']) {
        $option3 = $_POST['recycling'];
        // the reduction in kg of CO2:
        if ($option3 == '1') {
            $recycling = -100; // average reduction
        } elseif ($option3 == '2') {
            $recycling = -50; // half the average
        } elseif ($option3 == '3') {
            $recycling = 0; // no recycling, no reduction
        }
    }

    $flightCO2 = $annualFlights * (250 * $flightlen);//250 kg is the average footprint per hour

    if ($_POST['foodConsumption']) {
        $option4 = $_POST['foodConsumption'];
        // average british food carbon footprint per year:
        if ($option4 == '1') {
            $foodConsumption = 1400; // Plant-based
        } elseif ($option4 == '2') {
            $foodConsumption = 2000; // Mixed
        } elseif ($option4 == '3') {
            $foodConsumption = 2600; // Animal-based
        }

        if ($_POST['foodConsumptionComparison']) {
            $option4 = $_POST['foodConsumptionComparison'];
            // multiplier for food consumption:
            if ($option4 == '1') {
                $foodConsumptionComparison = 1.2; // more
            } elseif ($option4 == '2') {
                $foodConsumptionComparison = 0.8; // less
            } elseif ($option4 == '3') {
                $foodConsumptionComparison = 1; // average
            }
        }

        $foodCO2 = $foodConsumption * $foodConsumptionComparison;
    }
    if ($energyBill > 100000) {
        $energyBill = 100000;
    }

    $totalEnergy = ($energyBill / 0.54) * 12; //0.54 is the average price per day that you pay to your provider
    $totalCO2 = $heating + $carCO2 + $flightCO2 + $foodCO2 + $recycling;//measured in kg CO2e per year
}
?>
<html>

<head>
    <title>Energy/CO2</title>
    <link href="bulma.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
</head>

<body id="EnergyCO2">
    <?php require 'include\navbar.php'; ?>
    <section class="section" id="title">
        <h1 class="title">Energy/Carbon footprint tracker</h1>
        <h2 class="subtitle">Answer the questions bellow to find out your estimated Energy usage and carbon footprint.</h2>
        <br>
    </section>
    <form method="post">
        <div class="field <?= $fieldclass ?>">
            <label class="label <?= $fieldclass ?>" for="energyBill">
                <p>How much is your average monthly energy bill? (£):</p>
            </label>
            <input class="input <?= $fieldclass ?>" name="energyBill" id="energyBill" placeholder="type here..." type='number' required maxlength=>
        </div>
        <div class="field <?= $fieldclass ?>">
            <label class="label <?= $fieldclass ?>" for="heating">
                <p>What type of heating do you use?:</p>
            </label>
            <div class="select <?= $fieldclass ?>">
                <select name='heating'>
                    <option value="1">Gas</option>
                    <option value="2">Electricity</option>
                </select>
            </div>
        </div>
        <div class="field <?= $fieldclass ?>">
            <label class="label <?= $fieldclass ?>" for="car">
                <p>What type of car do you use?:</p>
            </label>
            <div class="select <?= $fieldclass ?>">
                <select name='car'>
                    <option value="1">Petrol</option>
                    <option value="2">Electric</option>
                    <option value="3">Diesel</option>
                    <option value="4">Hybrid</option>
                </select>
            </div>
            <div class="field <?= $fieldclass ?>">
                <label class="label <?= $fieldclass ?>" for="miles">
                    <p>How many miles do you drive per month?:</p>
                </label>
                <input class="input <?= $fieldclass ?>" name="miles" id="miles" placeholder="type here..." type='number' required maxlength=>
            </div>
        </div>
        <div class="field <?= $fieldclass ?>">
            <label class="label <?= $fieldclass ?>" for="recycling">
                <p>Do you regularly recycle?</p>
            </label>
            <div class="select <?= $fieldclass ?>">
                <select name="recycling">
                    <option value="1">Yes, I recycle everything I can</option>
                    <option value="2">I recycle some items</option>
                    <option value="3">No, I don’t recycle</option>
                </select>
            </div>
        </div>
        <div class="field <?= $fieldclass ?>">
            <label class="label <?= $fieldclass ?>" for="annualFlights">
                <p>How many flights do you take a year on average, and the duration(hours)?</p>
            </label>
            <input class="input <?= $fieldclass ?>" name="annualFlights" id="annualFlights" type="number" placeholder="amount..." required>
            <input class="input <?= $fieldclass ?>" name="flightlen" id="flightlen" type="number" placeholder="hours...." required>
        </div>
        <div class="field <?= $fieldclass ?>">
            <label class="label <?= $fieldclass ?>" for="foodConsumption">
                <p>What is your typical diet like?</p>
            </label>
            <div class="select <?= $fieldclass ?>">
                <select name="foodConsumption">
                    <option value="1">Mostly plant-based</option>
                    <option value="2">A balanced mix of plant-based and animal products</option>
                    <option value="3">Mostly animal-based products</option>
                </select>
            </div>
        </div>
        <div class="field <?= $fieldclass ?>">
            <label class="label <?= $fieldclass ?>" for="foodConsumptionComparison">
                <p>Do you eat more or less than the average person?</p>
            </label>
            <div class="select <?= $fieldclass ?>">
                <select name="foodConsumptionComparison">
                    <option value="1">More</option>
                    <option value="2">Less</option>
                    <option value="3">Average</option>
                </select>
            </div>
        </div>
        <button class="<?= $buttontheme ?>" type="submit">Calculate</button>
    </form>
    <section class="section" id="energy">
        <h1 class="title">Total energy per year: <u><?php echo number_format($totalEnergy, 2); ?> kWh</u></h1>
        <br>
        <h2 class="subtitle">Judging from your energy bill, this is the estimated personal energy usage per year</h2>
    </section>
    <section class="section" id="CO2">
        <h1 class="title">Total personal carbon footprint per year: <u><?php echo number_format($totalCO2, 2); ?> kg CO2e</u></h1>
        <br>
        <h2 class="subtitle">Judging from the answers provided combined with the averages fro the uk, this is the estimated personal carbon footprint per year</h2>
    </section>
</body>
