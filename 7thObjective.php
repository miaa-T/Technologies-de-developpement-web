
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
    
<table border="2" align="center">
            <thead  ><tr>
        <th scope="col">Feautures</th>
        <th scope="col">Huawei P30
            Lite</th>
        <th scope="col">SamsuYng
            Galaxy 21
            Ultra</th>
        <th scope="col">Apple iPhone
            15 plus</th>
        <th scope="col">Xiaomi Redmi
            Note 12</th></tr>
</thead>
<tbody><tr>
    <th scope="row">Storage</th>
    <td>128GB</td>
    <td>512GB</td>
    <td>1TB</td>
    <td>128GB</td>
</tr><tr>
    <th scope="row">Dispaly</th>
    <td>6.67-inch</td>
    <td>6.70-inch</td>
    <td>6.80-inch</td>
    <td>6.15-inch</td>
    </tr>
    <tr>
        <th scope="row">RAM</th>
        <td>6GB</td>
        <td>6GB</td>
        <td>6GB</td>
        <td>6GB</td>
        </tr>
<tr>
    <th scope="row">iOs</th>
    <td>Android</td>
    <td>iOS</td>
    <td colspan="2" align="center">Android</td>

  
</tr>
<tr>
    <th scope="row" >Removable battery</th>
    <td rowspan="2" align="center">No</td>
    <td colspan="3" align="center">No</td>
    
</tr>
<tr>
    <th scope="row">Wireless charging</th>
    
    <td colspan="2" align="center">Yes</td>
   
    <td>No</td>
</tr>
</tbody>
        </table>    
</body>
</html><?php
session_start();
include("Addfeature.php");
include("AddSmartphone.php");

?>
