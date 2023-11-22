<?php
    class User
    {
        public $id;
        public $name;
        public $email;
        public $phone;
        public $volunteering_hours;
        public $academic_id;
        public $address;
        public $skills;
        public $number_v;
        public $available;
        public $rate;
    
        protected $db;
    
        public function __construct($userEmail, $mysqli)
        {
            $this->db = $mysqli;
            $this->loadUserData($userEmail);
        }
        // تحميل بيانات المستخدم كاملة
        private function loadUserData($userEmail)
        {
            // Escape the user ID to prevent SQL injection
            $userEmail = $this->db->real_escape_string($userEmail);
    
            // Prepare the SQL statement
            $sql = "SELECT * FROM volunteer WHERE email = '$userEmail'";
    
            // Execute the SQL statement
            $result = $this->db->query($sql);
    
            if ($result) {
                // Fetch the user data from the database
                $userData = $result->fetch_assoc();
    
                if ($userData) {
                    // Assign the data to the object properties
                    $this->id = $userData['id'];
                    $this->name = $userData['name'];
                    $this->email = $userData['email'];
                    $this->phone = $userData['phone'];
                    $this->volunteering_hours = $userData['volunteering_hours'];
                    $this->academic_id = $userData['academic_id'];
                    $this->address = $userData['address'];
                    $this->skills = $userData['skills'];
                    $this->number_v = $userData['number_v'];
                    $this->rate = $userData['rate'];
                    $this->available=$userData['availability'];
                    // $this->db = $userData[''];
    
                }
    
                // Free the result set
                $result->close();
            }
        }
        public function getRanking($conn){
            $sql = "SELECT name, volunteering_hours, skills, number_v, rate FROM volunteer ORDER BY `volunteer`.`volunteering_hours` DESC LIMIT 10;";
            $result = mysqli_query($conn, $sql);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
?>