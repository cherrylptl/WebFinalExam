<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Final Exam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#myform').on('submit', function(e){
                e.preventDefault();
                
                // Fetch the form data
                var formData = $(this).serialize();

                // AJAX call
                $.ajax({
                    type: 'POST',
                    url: 'registrationprocess.php',
                    data: formData,
                    success: function(response){
                        // Update receipt section with received data
                        $('#formResult').html(response);
                    },
                    error: function(xhr, status, error){
                        // Handle error response
                        console.error(xhr.responseText);
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="green-text">Veterinary Clinic</h1>
        </header>
        <div class="nav">
            <?php include('includes/nav.php'); ?>
        </div>

        <div class="form-page">
            <form name="myform" id="myform" method="Post" action="">
                <div class="main-container">
                    <div class="product-page">
                        <div class="slider">
                            <h1>Confirmation Details</h1>
                            <p id="formResult">The Confirmation will show .</p>
                        </div>
                    </div>
                    <div class="slider">
                        <h1>Patient Details</h1>
                        <br>
                        <label for="patientName">Patient Name *</label>
                        <input id="patientName" placeholder="Enter patient name" type="text" name="patientName">

                        <label>Patient Type *:</label>
                        <select id="patientType" name="patientType">
                            <option value="" disabled selected>Select Patient Type</option>
                            <option value="dog">Dog</option>
                            <option value="cat">Cat</option>
                            <option value="bird">Bird</option>
                            <option value="other">Other</option>
                        </select>

                        <label for="nameOfOwner">Name of Owner *</label>
                        <input id="nameOfOwner" placeholder="Enter name of owner" type="" name="nameOfOwner">

                        <label for="address">Address *</label>
                        <input id="address" placeholder="Enter address" type="" name="address">

                        <label for="telephone">Telephone *</label>
                        <input id="telephone" placeholder="Enter telephone" type="" name="telephone">

                        <label for="email">Email *</label>
                        <input id="email" placeholder="Enter your email" type="" name="email">

                        <br><br>
                        <input type="submit" value="Register" name="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Veterinary Clinic PVT LTD. All rights reserved.</p>
    </footer>
</body>
</html>
