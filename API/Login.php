<?php
    //decodes the json input from the front end
    $input = json_decode(file_get_contents('php://input'), true);

    $id = 0;
    $firstname = "";
    $lastname = "";

    //connects to database with the hostname, username, password, database name
    $conn = new mysqli("localhost", "nstuh", "COP4331Contact", "COP4331"); 

    //If there is an error connecting return a connection error to front end.
    if( $conn->connect_error )
	{
		returnWithError( $conn->connect_error );
	}

    else
	{
        //creates an sql statement
		$stmt = $conn->prepare("SELECT ID,FirstName,LastName FROM Users WHERE (Username=? AND Password=?)");
        //binds the input data to the sql statement
		$stmt->bind_param("ss", $input["username"], $input["password"]);
        //executes the sql statment
		$stmt->execute();
        //gets the results from the sql statement
		$result = $stmt->get_result();

        //returns the info if record is found
		if( $row = $result->fetch_assoc()  )
		{
			returnWithInfo( $row['FirstName'], $row['LastName'], $row['ID'] );
		}
        //returns an error to front end if no record is found.
		else
		{
			returnWithError("No Records Found");
		}

		$stmt->close();
		$conn->close();
	}
    
    
    //Sends json string to front end.
    function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
    
    //returns an error to the front end
    function returnWithError( $err )
	{
		$retValue = '{"id":0,"firstname":"","lastname":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}


    //compile data into json format and return info to the front end
    function returnWithInfo( $firstName, $lastName, $id )
	{
		$retValue = '{"id":' . $id . ',"firstname":"' . $firstName . '","lastname":"' . $lastName . '","error":""}';
		sendResultInfoAsJson( $retValue );
	}

?>