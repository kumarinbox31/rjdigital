<?php 
class ComputerTalentCertificate {
    private $db;
    private $table = 'computer_talent_certificate';
    public $id, $center_id, $name, $class, $session, $college_name, $status;

    function __construct($db) {
        $this->db = $db;
    }

    // Get all records
    function getAll() {
        $sql = "SELECT * FROM $this->table";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get a record by ID
    function getById() {
        $sql = "SELECT * FROM $this->table WHERE id = $this->id";
        $result = $this->db->query($sql);
        
        if ($result && $row = $result->fetch_assoc()) {
            $this->id = $row['id'];
            $this->center_id = $row['center_id'];
            $this->name = $row['name'];
            $this->class = $row['class'];
            $this->session = $row['session'];
            $this->college_name = $row['college_name'];
            $this->status = $row['status'];
            return $row;
        } else {
            return null; // No record found
        }
    }    

    // Get records by center ID
    function getByCenterId() {
        $sql = "SELECT * FROM $this->table WHERE center_id = $this->center_id";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Save a new record
    function save() {
        $sql = "INSERT INTO $this->table (center_id, name, class, session, college_name, status) 
                VALUES ('$this->center_id', '$this->name', '$this->class', '$this->session', '$this->college_name', '$this->status')";
        return $this->db->query($sql);
    }

    // Update an existing record
    function update() {
        $sql = "UPDATE $this->table 
                SET center_id = '$this->center_id', name = '$this->name', class = '$this->class', 
                    session = '$this->session', college_name = '$this->college_name', status = '$this->status' 
                WHERE id = $this->id";
        return $this->db->query($sql);
    }

    // Delete a record by ID
    function delete() {
        $sql = "DELETE FROM $this->table WHERE id = $this->id";
        return $this->db->query($sql);
    }
}
?>
