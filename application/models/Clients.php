<?php

class Application_Model_Clients
{
		private $_dbTable;
		public function __construct()
		{
			$this->_dbTable = new Application_Model_DbTable_Clients(); // new instance of db table
		}
		
		public function webClients() // web clients
		{
			$arr = $this->_dbTable->fetchAll(); // table rows
			
			$group = ""; // define group
			$group .= "<ul class='group'>"; // concatenate 
			foreach ($arr as $row){ // loop
				$web = $row->web; // set var to column
				if($web !== 'NULL'){ // if column is not null
					$group .= "<li> &bull; ".$web."</li>"; // web column
				} 
			}			
			$group .= "</ul>"; // concatenate
			
			return $group; // return data
		}
		
		public function otherClients() // tv / music clients
		{
			$arr = $this->_dbTable->fetchAll(); // table rows
			
			$group = ""; // define
			$group .= "<p><b>Film &amp; Television:</b></p>"; // header
			$group .= "<ul class='group'>";  // concatenate 
			foreach ($arr as $row){ // loop
				$tv = $row->tv;  // set var to column
				if($tv !== 'NULL'){  // if column is not null
					$group .= "<li> &bull; ".$tv."</li>"; // tv column
				}
			}
			$group .= "</ul>";
			$group .= "<p><b>Music &amp; Video:</b></p>";
			$group .= "<ul class='group'>";
			foreach ($arr as $row){
				$music = $row->music;  // music column
				if($music !== 'NULL'){
					$group .= "<li> &bull; ".$music."</li>";
				}
			}
			$group .= "</ul>";
			
			return $group; // return data
		}

}

