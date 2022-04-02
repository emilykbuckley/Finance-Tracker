<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Emily Buckley">
        <meta name="description" content="New Transaction">  
        <title>New Transaction</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
        <link rel="stylesheet" href="styles/main.css">
    </head>
    <body>
        <div class="container" style="margin-top: 15px;">
            <div class="row col-xs-8">
                <h1>New Transaction</h1>
                <h3>Hello <?=$user["name"]?> (<?=$user["email"]?>)! Current balance: $<?=$balance?></h3>
            </div>
            <div class="row">
                <div class="col-xs-8 mx-auto">
                <form action="?command=tracker" method="post">
                    <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Add a transaction: </h2>
                    </div>
                    <div class="h-10 p-5 mb-3">
                        <label for="transaction" class="form-label">Transaction name</label>
                        <input type="text" class="form-control" id="transaction" name="transaction">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" step=0.01 min=0 class="form-control" id="amount" name="amount">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" name="category"><br>
                        <input type="radio" class="form-check-input" id="credit" name="type" value="Credit">
                        <label for="credit" class="form-check-label">Credit</label>
                        <input type="radio" class="form-check-input" id="debit" name="type" value="Debit">
                        <label for="debit" class="form-check-label">Debit</label>
                    </div>
                    <div class="text-center">         
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="?command=tracker" class="btn">Cancel</a>
                    <a href="?command=logout" class="btn btn-danger">Logout</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>