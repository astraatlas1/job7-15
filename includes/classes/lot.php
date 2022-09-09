<?php
class Lot {
    private $lot_id;
    private $lot_name;
    private $lot_description;
    private $lot_image;
    private $lot_number;
    private $lot_price;
    private $cat_id;

    public function __construct($input = false) {
        if (is_array($input)) {
            foreach ($input as $key => $val ) {
                $this->$key = $val;
            }
        }
    }
    public function getLot_id() {
        return $this->lot_id;
    }

    public function getLot_name() {
        return $this->lot_name;
    }

    public function getLot_description() {
        return $this->lot_description;
    }

    public function getLot_image() {
        return $this->lot_image;
    }

    public function getLot_number() {
        return $this->lot_number;
    }

    public function getLot_price() {
        return $this->lot_price;
    }

    public function getCat_id() {
        return $this->cat_id;
    }
    static public function getLots($cat_id) {
        // clear the results
        $items = [];
        // Get the connection
        $connection = Database::getConnection();
        // Set up the query
        $query = 'SELECT * FROM lots WHERE cat_id="'. (int) $cat_id.'" ORDER BY lot_id';
        // Run the query
        $result_obj = '';
        $result_obj = $connection->query($query);
        // Lopp through getting associative arrays,
        // passing the to a new version of this class,
        // and making a regular array of the objects
        try {
            while($result = $result_obj->fetch_array(MYSQLI_ASSOC)) {
                $items[]= new Lot($result);
            }
            // pass back the results
            return($items);
        }
        catch(Exception $e) {
            return false;
        }
    }
    public static function getLot($id) {
        //Get the DB connection
        $connection = Database::getConnection();
        //Prepare the query
        $query= 'SELECT * FROM `lots` WHERE lot_id="'. (int) $id.'"';
        // Run the MYSQL command
        $result_obj = $connection->query($query);
        try {
            while($result = $result_obj->fetch_array(MYSQLI_ASSOC)) {
                $item = new Lot($result);
            }
            //pass back the results
            return($item);
        }
        catch(Exception $e) {
            return false;
        }
    }

    public function addRecord() {
		// Verify the fields
		if ($this->_verifyInput()) {
			// Get the Database connection
			$connection = Database::getConnection();
			// Prepare the data
			$query = "INSERT INTO
			lots(lot_name, lot_description, lot_image, lot_number, lot_price,	cat_id)
			VALUES ('" . Database::prep($this->lot_name) . "',
				'" . Database::prep($this->lot_description) ."',
				'" . Database::prep($this->lot_image) . "',
				'" . (int) $this->lot_number . "',
				'" . (float) $this->lot_price . "',
				'" . (int) $this->cat_id . "'
				)";
			// Run the MySQL statement
			if ($connection->query($query)) {
				$return = array('', 'Lot Record successfully added.');
				// add success message
				return $return;
			} else {
				// send fail message and return to categorymaint
				$return = array('lotmaint', 'No Lot Record Added. Unable to create record.');
				return $return;
			}
		} else {
			// send fail message and return to categorymaint
			$return = array('lotmaint','No Lot Record Added. Missing required information.');
			return $return;
		}
	}

    protected function _verifyInput() {
        $error = false;
        if (!trim($this->lot_name)) {
            $error = true;
        }
        if ($error) {
            return false;
        } else {
            return true;
        }
    }
   
    public function editRecord() {
        // Verify the fields
        if ($this->_verifyInput()) {
            // Get the Database connection
            $connection = Database::getConnection();
            // Prepare the data
            // Set up the prepared statement
            $query = 'UPDATE lots
            SET lot_name=?, lot_description=?, lot_image=?, lot_number=?,
            lot_price=?, cat_id=?
            WHERE lot_id=?';
            $statement = $connection->prepare($query);
            // bind the parameters
            $statement->bind_param('sssidii',
                $this->lot_name, $this->lot_description, $this->lot_image,
                $this->lot_number, $this->lot_price, $this->cat_id, $this->lot_id);
            // Run the MySQL statement
            if ($statement) {
                $statement->execute();
                $statement->close();
                // add success message
                $return = array('', 'Lot Record successfully added.');
                // add success message
                return $return;
            } else {
                $return = array('lotmaint', 
                    'No Lot Record Added. Unable to create record.','');
                return $return;
            }
        } else {
            // send fail message and return to categorymaint
            $return = array('lotmaint',
                'No Lot Record Added. Missing required information.',
                (int) $this->lot_id);
            return $return;
        }
    }
    
    public static function deleteRecord($id) {
        // Get the Database connection
        $connection = Database::getConnection();
        //Set up query
        $query = 'DELETE FROM `lots` WHERE lot_id="'. (int) $id. '"';
        if ($result = $connection->query($query)) {
            $return = array('', 'Category Record successfully deleted.','');
            return $return;
        }else {
            $return = array('categorydelete','Unable to delete Category. ', (int) $id);
            return $return;
        }
    }
}
?>