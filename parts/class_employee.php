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
    public function completed_volunteering($volunteering_id, $conn){
        $sql = "UPDATE Volunteering SET availability = 0 WHERE id = $volunteering_id";
        if (mysqli_query($conn, $sql)) {
            echo '<script type=text/javascript> alert("You have successfully Completed this Volunteering opportunity!");window.location.href=window.location.href;</script>';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    public function saveRates($volunteers,$volunteering_id,$conn){
        // لو كان مقيهم قبل كدا
        $sql2 = "SELECT is_rated FROM Volunteering WHERE id=$volunteering_id AND is_rated>0 ;";
        $result = mysqli_query($conn,$sql2);
        if (mysqli_num_rows($result) > 0) {
            echo '<script type=text/javascript> alert("You have Rated this Volunteering opportunity before!");window.location.href=window.location.href;</script>';
        }else{
            foreach($volunteers as $volunteer){
                $rate = $_POST['rate_'.htmlspecialchars($volunteer['id'])];
                // echo $volunteer['name'].$rate;
                $id = $volunteer["id"];
                $sql = "UPDATE volunteer
                SET rates = rates + $rate
                WHERE `volunteer`.`id` = $id ;";
                if(!mysqli_query($conn,$sql)){
                    echo "error in updating rate".mysqli_error($conn);
                }
            }
            $sql3 = "UPDATE Volunteering SET is_rated=1 WHERE id=$volunteering_id";
            if(!mysqli_query($conn,$sql3)){
                echo "error and updating is_rated".mysqli_error($conn);
            }
            echo '<script type=text/javascript> alert("You have Successfully Rated this Volunteering opportunity!");window.location.href=window.location.href;</script>';
        }
    }
}
?>