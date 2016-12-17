<?php
$DBNAME      = "interview";
$DBUSER      = "root";
$DBPASS      = "Mary1962";
define("DB_SERVER",    "localhost");
define("DB_USER",      "$DBUSER");
define("DB_PASS",      "$DBPASS");
define("DB_NAME",      "$DBNAME");
define("TBL_USERS",    "interview" );

class DB
{
	var $connection;         // The MySQL database connection
	var $error;				 // error message
	
	/* Database object constructor */
	function DB()
	{
		/* Make connection to database */
		$this->connection = mysqli_connect( DB_SERVER, DB_USER, DB_PASS, DB_NAME );
		if (!$this->connection) {
			echo mysqli_connect_errno() . PHP_EOL;
			echo mysqli_connect_error() . PHP_EOL;
		}
	}
	
	/*
	 * Load questions from the database for a category
	 */
	function GetQuestions( $category )
	{
		$q = "SELECT rank,question,answer FROM " . TBL_INTERVIEW . " WHERE category = '$category'";
		$result = mysqli_query( $this->connection, $q );
		//echo "Q $q<br/>";
        //echo mysql_error( $this->connection ) . "<br/>";

		if(  !$result || ( mysqli_num_rows( $result ) < 1 ) )
			return;
		
		return mysqli_fetch_array($result);
	}
	
	/* 
	 * Add a new question to a category
	 */
	function AddQuestion( $category, $question, $answer, $rank )
	{
		$q = "INSERT INTO " . TBL_INTERVIEW . "( category, question, rank ) VALUES ( 
				'$category',
				'$question',
				'$answer',
				'$rank' )";
		$result = mysqli_query( $this->connection, $q );
		//echo "Q $q<br/>";
        //echo mysql_error( $this->connection ) . "<br/>";

		if(  !$result || ( mysqli_num_rows( $result ) < 1 ) )
			return;
		
		return mysqli_fetch_array($result);
	}
	
	/*
	 * Update an existing question
	 */
	function UpdateQuestion( $id, $category, $question, $answer, $rank )
	{
		$q = "UPDATE " . TBL_INTERVIEW . "SET 
				category='$category',
				question='$question',
				answer='$answer',
				rank='$rank'
				WHERE id=$id";
		$result = mysqli_query( $this->connection, $q );
		//echo "Q $q<br/>";
        //echo mysql_error( $this->connection ) . "<br/>";

		if(  !$result || ( mysqli_num_rows( $result ) < 1 ) )
			return;
		
		return mysqli_fetch_array($result);
	}
}
?>