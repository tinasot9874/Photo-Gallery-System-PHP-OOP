<?php require_once("core/init.php");?>

<?php
if ($session->is_signed_in()){
    redirect("index.php");
}

if (isset($_POST['login-submit'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //Method to check database user

   $user_found = User::verify_user($username, $password);


    if ($user_found){
        // verify role admin
        if ($user_found->role == 1){
            $session->login($user_found);
            redirect("index.php");
        }else{
            redirect("403.html");
        }

    }else{
        $the_message = "Your username or password were incorrect.";
    }
}else{
    $the_message    = "";
    $username       = "";
    $password       = "";
}

?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- Custom CSS -->
<link href="css/login.css" rel="stylesheet">

<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" role="form" style="display: block;">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?php echo htmlentities($username); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="<?php echo htmlentities($password); ?>">
                                </div>
                                <div class="form-group text-center">
                                    <p style="color: red;"><?php echo $the_message; ?></p>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

