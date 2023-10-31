
<!DOCTYPE html>
<html>
<head>
    <title>7th Objective</title>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<style>
        body {
            background-color: beige;
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: skyblue;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-size: 14px; /* Adjust the font size as per your requirement */
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            background-color: beige;
            color: #333;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #f5f5f5;
        }

        /* Add some spacing between the forms */
        form + form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php
include("displayeTableAdmin.php");
?>
</body>
</html><?php
include("Addfeature.php");
include("AddSmartphone.php");

?>
