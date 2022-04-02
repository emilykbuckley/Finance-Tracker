<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Emily Buckley">
        <meta name="description" content="Transaction History">  
        <title>Transaction History</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
        <link rel="stylesheet" href="styles/main.css">
    </head>
    <body>
        <div class="container" style="margin-top: 15px;">
            <div class="row col-xs-8">
                <h1>Transaction History</h1>
                <h3>Hello <?=$user["name"]?> (<?=$user["email"]?>)! Current balance: $<?=$balance?></h3>
            </div>
            <?php
                if (!empty($error_msg)) {
                    echo "<div class='alert alert-danger'>$error_msg</div>";
                }
            ?>
            <a href="?command=logout" class="btn btn-danger">Logout</a>
            <a href="?command=newTransaction" class="btn btn-primary">Add a new transaction</a>
            <div class="row">
                <div class="col-xs-8 mx-auto">
                    <br>
                    <table>
                        <tr>
                            <th>Transaction</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Type</th>
                        </tr>
                        <?= $table ?>
                    </table>
                    <br>
                    <table>
                        <tr>
                            <th>Category</th>
                            <th>Total</th>
                        </tr>
                        <?= $categories ?>
                    </table>
                    <br>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>