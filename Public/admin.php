<?php 
    include "../Controller/AdminController.php";

    $adminController = new AdminController();
    $adminController->checkBtn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subs List</title>
    <style>
        a{
            text-decoration: none; 
            color: black;  
        }
        .container{
            width: 1100px;
            margin: 0 auto;
        }
        .main{
            margin-top: 100px;
        }
        th, td{
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
        form{
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="main container">
        <a href="/">Main Page</a>
        <span> | </span>
        <a href="admin.php">Update Page</a>
        <h2>Subscribers List</h2>
        <form id="admin-form" action="admin.php" method="POST">
            <input type="text" name="input" placeholder="Search for email..">
            <button type="submit" name="search">
                Search
            </button>

            <label for="sort">Sort: </label>
            <select name="sort">
                <option value="id-desc">Id DESC</option>
                <option value="id-asc">Id ASC</option>
                <option value="email-desc">Email DESC</option>
                <option value="email-asc">Email ASC</option>
                <option selected value="date-desc">Date DESC</option>
                <option value="date-asc">Date ASC</option>
            </select>

            <label for="filter">Filter: </label>
            <select name="filter">
                <option value="" selected>Default</option>
                <?php
                    $adminController->displayDomains();
                ?>
            </select>
            <button type="submit" name="export">
                Export CSV
            </button>
            <button type="submit" type="submit" form="admin-form" value="'.$value['id'].'" name="delete">
                DELETE
            </button>
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
                <?php
                    $adminController->displayEmails();
                ?>
        </table>
    </div>
</body>
</html>