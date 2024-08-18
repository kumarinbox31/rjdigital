<?php
class Winner_certificate {
    private $db;
    private $table = 'winner_certificate';

    // Certificate properties
    public $id;
    public $name;
    public $father;
    public $center_id;
    public $enrollment_no;
    public $grade;
    public $issue_date;
    public $image;
    public $status;
    public $created_at;
    public $updated_at;

    public $center = [];

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->db = $db;
    }

    // Method to add a new certificate
    public function save() {
        $sql = "INSERT INTO $this->table (name, father, center_id, enrollment_no, grade, issue_date, image, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssisssss', 
            $this->name, 
            $this->father, 
            $this->center_id, 
            $this->enrollment_no, 
            $this->grade, 
            $this->issue_date, 
            $this->image, 
            $this->status
        );
        
        return $stmt->execute();
    }

    // Method to retrieve all certificates
    public function getAll() {
        $sql = "SELECT * FROM $this->table";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Method to update a certificate by ID
    public function update() {
        $sql = "UPDATE $this->table SET 
                name = ?, 
                father = ?, 
                center_id = ?, 
                enrollment_no = ?, 
                grade = ?, 
                issue_date = ?, 
                image = ?, 
                status = ? 
                WHERE id = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssisssssi', 
            $this->name, 
            $this->father, 
            $this->center_id, 
            $this->enrollment_no, 
            $this->grade, 
            $this->issue_date, 
            $this->image, 
            $this->status, 
            $this->id
        );
        
        return $stmt->execute();
    }

    // Method to retrieve a certificate by ID
    public function getById() {
        $sql = "SELECT * FROM $this->table WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result) {
            $this->name = $result['name'];
            $this->father = $result['father'];
            $this->center_id = $result['center_id'];
            $this->enrollment_no = $result['enrollment_no'];
            $this->grade = $result['grade'];
            $this->issue_date = $result['issue_date'];
            $this->image = $result['image'];
            $this->status = $result['status'];
            $this->created_at = $result['created_at'];
            $this->updated_at = $result['updated_at'];
        }

        return $result;
    }
    public function getByEnrollmentNo() {
        $sql = "SELECT * FROM $this->table WHERE enrollment_no = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $this->enrollment_no);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result) {
            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->father = $result['father'];
            $this->center_id = $result['center_id'];
            $this->enrollment_no = $result['enrollment_no'];
            $this->grade = $result['grade'];
            $this->issue_date = $result['issue_date'];
            $this->image = $result['image'];
            $this->status = $result['status'];
            $this->created_at = $result['created_at'];
            $this->updated_at = $result['updated_at'];
        }

        return $result;
    }
    function delete(){
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $this->id);
        return $stmt->execute();
    }

    public function getCenter(){
        $sql = "SELECT * FROM centers WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $this->center_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_object();
        if ($result) {
            $this->center = $result;
        }
        return $result;
    }
}
