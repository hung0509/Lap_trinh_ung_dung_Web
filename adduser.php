<?

    // require "config.php";
    // require "classes/database.php";
    // require "classes/user.php";

    require "inc/init.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username != '' && $password != ''){
            $conn = require "inc/db.php";
             // Tạo 1 đối tượng user <-> Create(C)
            $user = new User($username, $password);
            try{
                if($user->addUser($conn)){
                    echo "Added user successfully";
                }else{
                    echo "Cannot add user!";
                }
            }catch(PDOException $e){
                echo $e->getMessage();
                //Có thể gọi trang xư lý lối ở đây
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Books Store</title>
</head>
<body>
    <!-- Day la body -->
    <h2>Add New User</h2>
    <form name="formADDUSER" method="post">
        <fieldset> 
            <legend>User Information</legend>
            <p>
                <label for="username">User name:</label>
                <input name="username" id="username" type="text" placeholder="User name"/>
            </p>
            <p>
                <label for="password">Pass word:</label>
                <input name="password" id="password" type="password" placeholder="Pass word"/>
            </p>
            <p>
                <input type="submit" value="Lưu">
                <input type="submit" value="Hủy">
            </p>
        </fieldset>
    </form>
</body>
</html>