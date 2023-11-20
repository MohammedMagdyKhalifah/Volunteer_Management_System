<?php
class Employee
{
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
    public function getAllVolunteerings($conn)
    {
        $sql = "SELECT * 
            FROM Volunteering 
            WHERE employee_id = $this->id 
            AND availability > 0;";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function updateVolunteerHours($volunteering_id, $conn)
    {
        // 1: Get the hours for the specific volunteering_id
        $hoursSql = "SELECT hours FROM Volunteering WHERE id = $volunteering_id";
        $hoursResult = mysqli_query($conn, $hoursSql);

        if (!$hoursResult || mysqli_num_rows($hoursResult) == 0) {
            echo "Error or no data for the specified volunteering ID: " . mysqli_error($conn);
            return;
        }
        $hoursRow = mysqli_fetch_assoc($hoursResult);
        $volunteeringHours = $hoursRow['hours'];

        // 2: Get all volunteer_ids for the specific volunteering_id
        $volunteerIdsSql = "SELECT volunteer_id FROM Volunteering_details WHERE volunteering_id = $volunteering_id";
        $volunteerIdsResult = mysqli_query($conn, $volunteerIdsSql);

        if (!$volunteerIdsResult) {
            echo "Error retrieving volunteer ids: " . mysqli_error($conn);
            return;
        }

        // 3: Update volunteering_hours for each volunteer
        while ($row = mysqli_fetch_assoc($volunteerIdsResult)) {
            $volunteer_id = $row['volunteer_id'];

            // Update the volunteer table
            $updateSql = "UPDATE volunteer SET 	volunteering_hours = volunteering_hours + $volunteeringHours , number_v= number_v + 1 WHERE id = $volunteer_id";
            if (!mysqli_query($conn, $updateSql)) {
                echo "Error updating volunteer (ID: $volunteer_id): " . mysqli_error($conn);
            }
        }
    }
    public function RateIfNotRated($volunteering_id, $conn)
    {
        // لو كان مقيمها
        $sql = "SELECT is_rated FROM Volunteering WHERE id=$volunteering_id AND is_rated>0 ;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            return;
        } else {
            // هات كل المتطوعين المسجلين
            $volunteerIdsSql = "SELECT volunteer_id FROM Volunteering_details WHERE volunteering_id = $volunteering_id";
            $volunteerIdsResult = mysqli_query($conn,$volunteerIdsSql);
            $volunteers = mysqli_fetch_all($volunteerIdsResult, MYSQLI_ASSOC);
            // اضافة تقييم لكل متطوع
            foreach ($volunteers as $volunteer) {
                $rate = 10;
                // echo $volunteer['name'].$rate;
                $id = $volunteer["id"];
                $sql = "UPDATE volunteer
                SET rates = rates + $rate
                WHERE `volunteer`.`id` = $id ;";
                if (!mysqli_query($conn, $sql)) {
                    echo "error in updating rate" . mysqli_error($conn);
                }
            }
            $sql3 = "UPDATE Volunteering SET is_rated=1 WHERE id=$volunteering_id";
            if (!mysqli_query($conn, $sql3)) {
                echo "error and updating rateIfNotRated" . mysqli_error($conn);
            }
            return;
        }
    }
    public function completed_volunteering($volunteering_id, $conn)
    {
        $sql = "UPDATE Volunteering SET availability = 0 WHERE id = $volunteering_id";
        if (mysqli_query($conn, $sql)) {
            echo '<script type=text/javascript> alert("You have successfully Completed this Volunteering opportunity!");window.location.href=window.location.href;</script>';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    public function getVolunteeringName($volunteering_id, $conn)
    {
        $sql = "SELECT title FROM Volunteering WHERE id = $volunteering_id";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC)[0]["title"];
    }
    public function getAllVolunteers($volunteering_id, $conn)
    {

        $sql = "SELECT volunteer.id, volunteer.name, volunteer.phone,volunteer.academic_id, volunteer.skills, volunteer.rates
                FROM volunteer
                INNER JOIN Volunteering_details ON volunteer.id = Volunteering_details.volunteer_id
                WHERE Volunteering_details.volunteering_id = $volunteering_id; ";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function saveRates($volunteers, $volunteering_id, $conn)
    {
        // لو كان مقيهم قبل كدا
        $sql2 = "SELECT is_rated FROM Volunteering WHERE id=$volunteering_id AND is_rated>0 ;";
        $result = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result) > 0) {
            echo '<script type=text/javascript> alert("You have Rated this Volunteering opportunity before!");window.location.href=window.location.href;</script>';
        } else {
            foreach ($volunteers as $volunteer) {
                $rate = $_POST['rate_' . htmlspecialchars($volunteer['id'])];
                // echo $volunteer['name'].$rate;
                $id = $volunteer["id"];
                $sql = "UPDATE volunteer
                SET rates = rates + $rate
                WHERE `volunteer`.`id` = $id ;";
                if (!mysqli_query($conn, $sql)) {
                    echo "error in updating rate" . mysqli_error($conn);
                }
            }
            $sql3 = "UPDATE Volunteering SET is_rated=1 WHERE id=$volunteering_id";
            if (!mysqli_query($conn, $sql3)) {
                echo "error and updating is_rated" . mysqli_error($conn);
            }
            echo '<script type=text/javascript> alert("You have Successfully Rated this Volunteering opportunity!");window.location.href=window.location.href;</script>';
        }
    }
}
?>