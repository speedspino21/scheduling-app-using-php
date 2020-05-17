<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../models/initialization.php';

$data = array();

$appointment = new Appointment();

$date = $_POST['date'];
$timeslot = $_POST['timeslot'];
 
$appointment->name = $_POST['name'];
$appointment->email = $_POST['email'];
$appointment->date = $date;
$appointment->timeslots = $timeslot;


// find by date and time slot
$current_appointment = $appointment->find_appointment_by_date_and_timeslots();

if($current_appointment){
    $data['message'] = "errorTime";
    echo json_encode($data);
    die();
}

if($appointment->save()){
    $data['message'] = "success";
}

echo json_encode($data);