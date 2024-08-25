<?php 
class Centers {
    private $db;
    private $table = 'centers';
    public $id, $timestamp, $center_number, $name, $assistant_manager, $reg_no, $institute_name, $dob, 
           $pan_number, $aadhar_number, $center_full_address, $pincode, $state_id, $city_id, 
           $no_of_computer_operator, $no_of_class_room, $total_computer, $space_of_computer_center, 
           $whatsapp_number, $contact_number, $email_id, $qualification_of_center_head, 
           $staff_room, $water_supply, $toilet, $reception, $username, $password, $transection_id, 
           $status, $image, $is_deleted, $session, $valid_upto;

    function __construct($db) {
        $this->db = $db;
    }

    // Get all records
    function getAll() {
        $sql = "SELECT * FROM $this->table WHERE is_deleted = 0";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get a record by ID
    function getById() {
        $sql = "SELECT * FROM $this->table WHERE id = $this->id AND is_deleted = 0";
        $result = $this->db->query($sql);
        
        if ($result && $row = $result->fetch_assoc()) {
            $this->fill($row);
            return $row;
        } else {
            return null; // No record found
        }
    }

    // Get records by center ID
    function getByCenterId() {
        $sql = "SELECT * FROM $this->table WHERE center_id = $this->center_id AND is_deleted = 0";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Save a new record
    function save() {
        $sql = "INSERT INTO $this->table 
                (center_number, name, assistant_manager, reg_no, institute_name, dob, pan_number, aadhar_number, 
                 center_full_address, pincode, state_id, city_id, no_of_computer_operator, no_of_class_room, 
                 total_computer, space_of_computer_center, whatsapp_number, contact_number, email_id, 
                 qualification_of_center_head, staff_room, water_supply, toilet, reception, username, password, 
                 transection_id, status, image, is_deleted, session, valid_upto) 
                VALUES 
                ('$this->center_number', '$this->name', '$this->assistant_manager', '$this->reg_no', 
                 '$this->institute_name', '$this->dob', '$this->pan_number', '$this->aadhar_number', 
                 '$this->center_full_address', '$this->pincode', '$this->state_id', '$this->city_id', 
                 '$this->no_of_computer_operator', '$this->no_of_class_room', '$this->total_computer', 
                 '$this->space_of_computer_center', '$this->whatsapp_number', '$this->contact_number', 
                 '$this->email_id', '$this->qualification_of_center_head', '$this->staff_room', '$this->water_supply', 
                 '$this->toilet', '$this->reception', '$this->username', '$this->password', '$this->transection_id', 
                 '$this->status', '$this->image', '$this->is_deleted', '$this->session', '$this->valid_upto')";
        return $this->db->query($sql);
    }

    // Update an existing record
    function update() {
        $sql = "UPDATE $this->table SET 
                center_number = '$this->center_number', name = '$this->name', 
                assistant_manager = '$this->assistant_manager', reg_no = '$this->reg_no', 
                institute_name = '$this->institute_name', dob = '$this->dob', pan_number = '$this->pan_number', 
                aadhar_number = '$this->aadhar_number', center_full_address = '$this->center_full_address', 
                pincode = '$this->pincode', state_id = '$this->state_id', city_id = '$this->city_id', 
                no_of_computer_operator = '$this->no_of_computer_operator', no_of_class_room = '$this->no_of_class_room', 
                total_computer = '$this->total_computer', space_of_computer_center = '$this->space_of_computer_center', 
                whatsapp_number = '$this->whatsapp_number', contact_number = '$this->contact_number', 
                email_id = '$this->email_id', qualification_of_center_head = '$this->qualification_of_center_head', 
                staff_room = '$this->staff_room', water_supply = '$this->water_supply', 
                toilet = '$this->toilet', reception = '$this->reception', username = '$this->username', 
                password = '$this->password', transection_id = '$this->transection_id', 
                status = '$this->status', image = '$this->image', is_deleted = '$this->is_deleted', 
                session = '$this->session', valid_upto = '$this->valid_upto'
                WHERE id = $this->id";
        return $this->db->query($sql);
    }

    // Delete a record by ID (soft delete)
    function delete() {
        $sql = "UPDATE $this->table SET is_deleted = 1 WHERE id = $this->id";
        return $this->db->query($sql);
    }

    // Helper function to fill object properties with a row from the database
    private function fill($row) {
        $this->id = $row['id'];
        $this->center_number = $row['center_number'];
        $this->name = $row['name'];
        $this->assistant_manager = $row['assistant_manager'];
        $this->reg_no = $row['reg_no'];
        $this->institute_name = $row['institute_name'];
        $this->dob = $row['dob'];
        $this->pan_number = $row['pan_number'];
        $this->aadhar_number = $row['aadhar_number'];
        $this->center_full_address = $row['center_full_address'];
        $this->pincode = $row['pincode'];
        $this->state_id = $row['state_id'];
        $this->city_id = $row['city_id'];
        $this->no_of_computer_operator = $row['no_of_computer_operator'];
        $this->no_of_class_room = $row['no_of_class_room'];
        $this->total_computer = $row['total_computer'];
        $this->space_of_computer_center = $row['space_of_computer_center'];
        $this->whatsapp_number = $row['whatsapp_number'];
        $this->contact_number = $row['contact_number'];
        $this->email_id = $row['email_id'];
        $this->qualification_of_center_head = $row['qualification_of_center_head'];
        $this->staff_room = $row['staff_room'];
        $this->water_supply = $row['water_supply'];
        $this->toilet = $row['toilet'];
        $this->reception = $row['reception'];
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->transection_id = $row['transection_id'];
        $this->status = $row['status'];
        $this->image = $row['image'];
        $this->is_deleted = $row['is_deleted'];
        $this->session = $row['session'];
        $this->valid_upto = $row['valid_upto'];
    }
}
?>
