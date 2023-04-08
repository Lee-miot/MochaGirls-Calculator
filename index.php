<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="images/logo.png">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="form-bg">
        <div class="container">
            <div class="row">
                <div class="col-6 m-auto mt-5">
                    <div class="form-container">
                        <div class="form-icon"><i class="fa fa-area-chart"></i></div>
                        <h3 class="title">Calculator</h3>
                        <form method="POST" class="form-horizontal" action="">
                            <div class="form-group">
                                <label for="formula">Choose a formula:</label>
                                <select class="form-select currency mt-3" name="type" id="formula">
                                    <option value="">Select Your Option</option>
                                    <option value="circle">Circle</option>
                                    <option value="FC">Fahrenheit to Celsius</option>
                                    <option value="triangle">Triangle</option>
                                    <option value="rectangle">Rectangle</option>
                                </select>
                            </div>
                            <div class="form-group FG" id="circle-form">
                                <label>Radius</label>
                                <input class="form-control mt-3" type="number" name="radius" placeholder="Enter Radius">
                                <div class="image-container">
                                    <img src="images/circle.png" alt="Circle">
                                </div>
                            </div>
                            <div class="form-group FG" id="fahrenheit-form">
                                <label>Temperature (℉)</label>
                                <input class="form-control mt-3" type="number" name="temperature" placeholder="Enter Temperature in Fahrenheit">
                                <div class="image-container">
                                    <img src="images/celcius.png" alt="Celcius">
                                </div>
                            </div>
                            <div class="form-group FG" id="triangle-form">
                                <label>Base</label>
                                <input class="form-control mt-3" type="number" name="base" placeholder="Enter Base">
                            </div>
                            <div class="form-group FG" id="triangle-form1">
                                <label>Height</label>
                                <input class="form-control mt-3" type="number" name="height" placeholder="Enter Height">
                                <div class="image-container">
                                    <img src="images/triangle.png" alt="Triangle">
                                </div>
                            </div>
                            <div class="form-group FG" id="rectangle-form">
                                <label>Length</label>
                                <input class="form-control mt-3" type="number" name="length" placeholder="Enter Length">
                            </div>
                            <div class="form-group FG" id="rectangle-form1">
                                <label>Width</label>
                                <input class="form-control mt-3" type="number" name="width" placeholder="Enter Width">
                                <div class="image-container">
                                    <img src="images/rectangle.png" alt="Rectangle">
                                </div>
                            </div>

                            <!-- Calculate Button -->
                            <button type="submit" name="submit" class="btn btn-default">Calculate</button>
                            <div class="mt-5 text-center">


                            <!-- JAVASCRIPT -->
                            <script>
                                    // Get the select element
                                    var select = document.getElementById("formula");

                                    // Add event listener to handle selection change
                                    select.addEventListener("change", function() {
                                        // Get the selected value
                                        var selectedValue = select.value;

                                        // Hide all formula forms
                                        var forms = document.getElementsByClassName("FG");
                                        for (var i = 0; i < forms.length; i++) {
                                            forms[i].style.display = "none";
                                        }
                                        // Show the selected formula form
                                        if (selectedValue === "circle") {
                                            document.getElementById("circle-form").style.display = "block";
                                        } else if (selectedValue === "FC") {
                                            document.getElementById("fahrenheit-form").style.display = "block";
                                        } else if (selectedValue === "triangle") {
                                            document.getElementById("triangle-form").style.display = "block";
                                            document.getElementById("triangle-form1").style.display = "block";
                                        } else if (selectedValue === "rectangle") {
                                            document.getElementById("rectangle-form").style.display = "block";
                                            document.getElementById("rectangle-form1").style.display = "block";
                                        }
                                    });
                            </script>

                            <!-- PHP -->
                            <?php
                                function getArea($type, $radius, $temperature, $base, $height, $length, $width)
                                {
                                    switch ($type) {
                                        case 'circle':
                                            $area = M_PI * pow($radius, 2); /* Area */
                                            $circumference = 2 * M_PI * $radius; /* Circumference */
                                            $diameter = 2 * $radius; /* Diameter */
                                            return "Area of the " . ucwords($type) . " is " . number_format($area, 3) .
                                                "<br/>Circumference of the " . ucwords($type) . " is " . number_format($circumference, 3). "<br/>" .
                                                "Diameter of the " . ucwords($type) . " is " . number_format($diameter, 3);
                                        case 'FC':
                                            $celsius = ($temperature - 32) * 5/9; /* Celcius */
                                            return "Fahrenheit in Celcius is " . number_format($celsius, 3);
                                        case 'triangle':
                                            $area = 0.5 * ($base * $height); /* Area */
                                            return "Area of the " . ucwords($type) . " is {$area}";
                                        case 'rectangle':
                                            $area = $length * $width; /* Area */
                                            $perimeter = 2 * ($length + $width); /* Perimeter */
                                            return "Area of the " . ucwords($type) . " is " . number_format($area, 3) .
                                            "<br/>Perimeter of the " . ucwords($type) . " is " . number_format($perimeter, 3);
                                        default:
                                            return "Something Went Wrong.";
                                    }
                                }
                                if (isset($_POST['submit'])) {
                                    $type = $_POST['type'];
                                    $radius = $_POST['radius'];
                                    $temperature = $_POST['temperature'];
                                    $base = $_POST['base'];
                                    $height = $_POST['height'];
                                    $length = $_POST['length'];
                                    $width = $_POST['width'];

                                    /* Area, Circumference, & Diameter of a Circle */
                                    if ($type == 'circle') {
                                        if (empty($radius)) {
                                            echo "<p class=\"alert alert-danger d-flex justify-content-between\">All Fields Are Required ! <button data-bs-dismiss=\"alert\" class=\"btn-close\"></button></p>";
                                        } else {
                                            $area = getArea($type, $radius, $temperature, $base, $height, $length, $width);
                                            echo "<p class=\"alert alert-success d-flex justify-content-between\"> {$area} <button data-bs-dismiss=\"alert\" class=\"btn-close\"></button></p>";
                                        }
                                    } 
                                    /* Fahrenheit to Celsius */
                                    else if ($type == 'FC') {
                                        if (empty($temperature)) {
                                            echo "<p class=\"alert alert-danger d-flex justify-content-between\">All Fields Are Required ! <button data-bs-dismiss=\"alert\" class=\"btn-close\"></button></p>";
                                        } else {
                                            $celsius = getArea($type, $radius, $temperature, $base, $height, $length, $width);
                                            echo "<p class=\"alert alert-success d-flex justify-content-between\"> {$celsius} <button data-bs-dismiss=\"alert\" class=\"btn-close\"></button></p>";
                                        }
                                    }
                                    /* Area of a Triangle */
                                    else if ($type == 'triangle') {
                                        if (empty($base)) {
                                            echo "<p class=\"alert alert-danger d-flex justify-content-between\">All Fields Are Required ! <button data-bs-dismiss=\"alert\" class=\"btn-close\"></button></p>";
                                        } 
                                        else if (empty($height)) {
                                            echo "<p class=\"alert alert-danger d-flex justify-content-between\">All Fields Are Required ! <button data-bs-dismiss=\"alert\" class=\"btn-close\"></button></p>";
                                        } 
                                        else {
                                            $area = getArea($type, $radius, $temperature, $base, $height, $length, $width);
                                            echo "<p class=\"alert alert-success d-flex justify-content-between\"> {$area} <button data-bs-dismiss=\"alert\" class=\"btn-close\"></button></p>";
                                        }
                                    } 
                                    /* Area and Perimeter of a Rectangle */
                                    else if ($type == 'rectangle') {
                                        if (empty($length)) {
                                            echo "<p class=\"alert alert-danger d-flex justify-content-between\">All Fields Are Required ! <button data-bs-dismiss=\"alert\" class=\"btn-close\"></button></p>";
                                        } 
                                        else if (empty($width)) {
                                            echo "<p class=\"alert alert-danger d-flex justify-content-between\">All Fields Are Required ! <button data-bs-dismiss=\"alert\" class=\"btn-close\"></button></p>";
                                        } 
                                        else {
                                            $area = getArea($type, $radius, $temperature, $base, $height, $length, $width);
                                            echo "<p class=\"alert alert-success d-flex justify-content-between\"> {$area} <button data-bs-dismiss=\"alert\" class=\"btn-close\"></button></p>";
                                        }
                                    } 
                                    else {
                                        echo "<p class=\"alert alert-danger d-flex justify-content-between\">All Fields Are Required ! <button data-bs-dismiss=\"alert\" class=\"btn-close\"></button></p>";
                                    }
                                }
                            ?>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>