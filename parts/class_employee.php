<?php 
    class Employee {
        public $id;
        public $name;
        public $email;
        public $phone;
        public $username;
        public $rate;
        protected $db;

        public function __construct($email, $mysqli)
        {
            $this->db = $mysqli;
            $this->loadUserData($email);
        }
        // تحميل بيانات المستخدم كاملة
        private function loadUserData($e_email)
        {
            // Escape the user ID to prevent SQL injection
            $e_email = $this->db->real_escape_string($e_email);
    
            // Prepare the SQL statement
            $sql = "SELECT * FROM employee WHERE email = '$e_email'";
    
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
                    $this->username = $userData['username'];
                    $this->rate = $userData['rate'];
    
                }
    
                // Free the result set
                $result->close();
            }
    }
}
?>