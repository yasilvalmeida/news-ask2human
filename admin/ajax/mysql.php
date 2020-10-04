<?php
	class MySQL 
	{ 
		private $connection; 
		private $select; 
		private $query; 
		function connect() { 
			$connection = mysqli_connect("ybytesi.com", "news-a2h_sa", "N3ws*2020%$", "news-ask2human_db");
			if(!$connection){
				echo "Error: Unable to connect to MySQL." . PHP_EOL;
				echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
				echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
				exit;
			}
			return $connection;
		} 
		function query($connection, $query) 
		{ 
			$result = mysqli_query($connection, $query); 
			if (!$result) 
			{ 
				echo 'Could not run query: ' . mysqli_error($connection); 
				exit; 
			}
			return $result;
		} 
		
		function multiquery($connection, $queries) 
		{ 
			$resp = 0;
			foreach($queries as $query){
				/* execute multi query */
				if (mysqli_multi_query($connection, $query)) {
					do {
						/* store first result set */
						if ($result = mysqli_store_result($connection)) {
							while ($row = mysqli_fetch_row($result)) {
								printf("%s\n", $row[0]);
							}
							mysqli_free_result($result);
						}
						/* print divider */
						if (mysqli_more_results($connection)) {
							$resp++;
						}
					} while (mysqli_next_result($connection));
				}
			}

			/* close connection */
			mysqli_close($connection);
			return $resp;
		} 
		function close($connection) 
		{ 
			mysqli_close($connection);
		} 
	}
?>