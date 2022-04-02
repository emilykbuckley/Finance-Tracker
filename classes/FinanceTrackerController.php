<?php
class FinanceTrackerController {

    private $command;

    private $db;

    public function __construct($command) {
        $this->command = $command;
        $this->db = new Database();
    }

    public function run() {
        switch($this->command) {
            case "newTransaction":
                $this->newTransaction();
                break;
            case "tracker":
                $this->tracker();
                break;
            case "logout":
                $this->destroySession();
            case "login":
            default:
                $this->login();
                break;
        }
    }

    private function destroySession() {          
        session_destroy();
    }
    

    // Display the login page (and handle login logic)
    public function login() {
        if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["name"]) && !empty($_POST["name"])) {
            $data = $this->db->query("select * from hw5_user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    $_SESSION["name"] = $data[0]["name"];
                    $_SESSION["email"] = $data[0]["email"];
                    header("Location: ?command=tracker");
                } else {
                    $error_msg = "Wrong password";
                }
            } else {
                // input validation
                $insert = $this->db->query("insert into hw5_user (name, email, password) values (?, ?, ?);",
                        "sss", $_POST["name"], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT));
                if ($insert === false) {
                    $error_msg = "Error inserting user";
                } else {
                    $_SESSION["name"] = $_POST["name"];
                    $_SESSION["email"] = $_POST["email"];
                    header("Location: ?command=tracker");
                }
            }
        }
        include "templates/login.php";
    }

    // Display the tracker template and handle logic
    public function tracker() {
        // set user information for the page from the session
        $user = [
            "name" => $_SESSION["name"],
            "email" => $_SESSION["email"],
        ];
        
        // if the user submitted a transaction, add to db
        if (isset($_POST["transaction"])) {
            //check transaction is valid
            $amount = $_POST["amount"];
            if ($_POST["type"] === "Debit") {
                $amount = -$amount;
            }
            $insert = $this->db->query("insert into hw5_history (email, transaction, amount, date, category, type) values (?, ?, ?, ?, ?, ?);",
                                        "ssdsss", $user["email"], $_POST["transaction"], $amount, $_POST["date"], $_POST["category"], $_POST["type"]);
            if ($insert === false) {
                $error_msg = "Error adding transaction";
            }
        }
        
        $transactions = $this->db->query("select * from hw5_history where email = ? order by date desc;", "s", $user["email"]);
        $balance = $this->db->query("select sum(amount) as balance from hw5_history where email = ?;", "s", $user["email"]);
        if ($balance[0]["balance"] === null) {
            $balance = '0.00';
        } else {
            $balance = $balance[0]["balance"];
        }
        $categoryBalances = $this->db->query("select category, sum(amount) as balance from hw5_history where email = ? group by category;", "s", $user["email"]);
        $table = "";
        foreach ($transactions as $key => $transaction) {
            $table .= "<tr>\n";
            $table .= "<td>" . $transaction["transaction"]. "</td>\n";
            $table .= "<td>" . $transaction["amount"]. "</td>\n";
            $table .= "<td>" . $transaction["date"]. "</td>\n";
            $table .= "<td>" . $transaction["category"]. "</td>\n";
            $table .= "<td>" . $transaction["type"]. "</td>\n";
            $table .= "</tr>\n";
        }

        $categories = "";
        foreach ($categoryBalances as $key => $category) {
            $categories .= "<tr>\n";
            $categories .= "<td>" . $category["category"]. "</td>\n";
            $categories .= "<td>" . $category["balance"]. "</td>\n";
            $categories .= "</tr>\n";
        }

        include("templates/tracker.php");
    }

    // Display the newTransaction template and handle logic
    public function newTransaction() {
        // set user information for the page from the session
        $user = [
            "name" => $_SESSION["name"],
            "email" => $_SESSION["email"],
        ];
        $balance = $this->db->query("select sum(amount) as balance from hw5_history where email = ?;", "s", $user["email"]);
        if ($balance[0]["balance"] === null) {
            $balance = '0.00';
        } else {
            $balance = $balance[0]["balance"];
        }

        include("templates/newTransaction.php");
    }
}