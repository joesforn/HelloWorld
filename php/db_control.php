<?
	//DB Control class!
	
	class DB_Control
	{
		private $db_username = "helloworld", $db_password = "helloworld", $db_database = "HelloWorld", $db_url = "localhost";
		private $mysql;
		
		 	/* Constructor */
            function __construct()
            {
                $this->mysql = new mysqli($this->db_url, $this->db_username, $this->db_password, $this->db_database);
                if(mysqli_connect_error())
                {
                    $this->mysqlError(mysqli_connect_error());
                }
            }
			
			/* Clean dirty strings! */
			public function CleanValue($value)
			{
				return $this->mysql->real_escape_string($value);
			}
			
			/*
             * Uses standard mysql query
             */
            public function query($query, $return = false)
            {
				//Clean prior results
				while($this->mysql->more_results())
				{
					$this->mysql->next_result();
					if($r = $this->mysql->store_result())
					{
						$r->free();
					}
				}
				
				
                $q = $this->mysql->query($query);
                if(mysqli_error($this->mysql))
                {
                    $this->mysqlError(mysqli_error($this->mysql));
                }
                if($return)
                {
                    $returnArray = array();
                    while($row = mysqli_fetch_assoc($q))
                    {
                        $returnArray[] = $row;
						
                    }
                    return $returnArray;
					
                }
                return true;
            }
            /* Uses key pair attribute! */
			public function insert($table, $attr)
			{
					$attrStr = "";
					$valuesStr = "";
					
					while(list($k,$v) = each($attr))
					{
						$k = $this->CleanValue($k);
						$v = $this->CleanValue($v);
						
						$attrStr .= $k . ",";
						$valuesStr .= "'" . $v . "',";
					}
					
					$attrStr = substr($attrStr, 0, strlen($attrStr)-1);
					$valuesStr = substr($valuesStr, 0, strlen($valuesStr)-1);
					
					$query = "INSERT INTO $table ($attrStr) VALUES ($valuesStr)";
					
					$this->query($query);
					
			}
            
            private function mysqlError($error)
            {
                die(json_encode(array("error"=>'Mysql Error! Error -> ' . $error)));
            }
            
	}

?>