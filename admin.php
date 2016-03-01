<!DOCTYPE>
<html>
    <head>
    
    	<title>Hello World - Registered Users</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <!-- jquery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    	<style>
			table
			{
				border:solid 3px black;	
			}
		</style>
    </head>

    <body>
    	<div class="container">
        	<h2>Registered Users</h2>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Country</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                <?
					include_once("php/db_control.php");
					$db = new DB_Control();
					
					$users = $db->query("SELECT fname,lname,concat(address1,' ',address2) as address,city,state,zip,country,date FROM User ORDER BY date DESC",true);
					foreach($users as $userInfo)
					{
						echo("<tr>");
						foreach ($userInfo as $key => $value)
						{
							echo("<td>" . $value . "</td>");
						}
						echo("</tr>");
					}
				?>
                </tbody>
            </table>
        </div>
    </body>
</html>