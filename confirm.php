<!DOCTYPE>
<html>
    <head>
    	<title>Hello World - Confirm</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- jquery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
        
        <!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
    	<link rel="stylesheet" href="css/main.css" />
		<script>
			$(document).ready(function(e) {
                $("#confirm_body").slideDown("slow");
            });
		</script>
    </head>
    
    <body>
    	<div id="confirm_body" style="display:none;" class="shadow border_radius">
        	
        	<h2><b><i>Thank You!</i></b></h2>
            <hr/>
                <div class="row">
                	<div class="form-group">
                		<p>Thank you <b><? echo $_GET["fname"] . "</b><b> ". $_GET["lname"] ?></b> for registering with us! You're all set to go!</p>
                    </div>
                </div>
        </div>
    </body>
</html>
