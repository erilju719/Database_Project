
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrapValidator.css"/>
    <link href="assets/bootstrap/css/addpage.css" rel="stylesheet">

    <script type="text/javascript" src="assets/jquery/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrapValidator.js"></script>
</head>
<body>
<!-------PHP connect------->
<?php
	$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
	or die('Could not connect: ' . pg_last_error());
?>

<!-------Register Form------->
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign up</h3>
                    </div>

                    <div class="panel-body">
                        <form id="regForm" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="user_name" placeholder="Name" />
                            </div>

							<div class="form-group">
                                <input type="text" class="form-control" name="user_email" placeholder="Email" />
                            </div>
							
                            <div class="form-group">
                               <textarea class="form-control" name="user_address" rows="3" placeholder="Your Address"></textarea>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="user_pass" placeholder="Password" />
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" name="confirmPass" placeholder="Retype password" />
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="formSubmit">Sign up</button>
								<input type="button" class="btn btn-primary" onclick="location.href='index.php';" value="Back" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
$(document).ready(function() {
    $('#regForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            user_name: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The name is required and can\'t be empty'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z\s]*$/,
                        message: 'The name can only consist of alphabetical letters'
                    }
                }
            },
			
            user_email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
			
			user_address: {
                message: 'The address is not valid',
                validators: {
                    notEmpty: {
                        message: 'The address is required and can\'t be empty'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9]/,
                        message: 'The address can only consist of alphabetical letters'
                    }
                }
            },
            user_pass: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'confirmPassword',
                        message: 'The password and its confirm are not the same'
                    }
                }
            },
            confirmPass: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'user_pass',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }
    });
});
</script>

<?php
if (isset($_POST['formSubmit'])){
	
		
		$user_email = $_REQUEST['user_email'];
		$user_pass = $_REQUEST['user_pass'];
		$user_name = $_REQUEST['user_name'];
		$user_address = $_REQUEST['user_address'];
		
		$query = "INSERT INTO account (email, name, address, password) VALUES('$user_email', '$user_name', '$user_address ', '$user_pass')";

		$result = pg_query($dbconn, $query);
		if($result){
			echo '<div class="alert alert-success">
            Account successfully created!
            </div>';
	    exit;
		} else {
			echo '<div class="alert alert-danger">
            There is already an account registered to this account.
            </div>';
		}
	}
?>
</body>
</html>