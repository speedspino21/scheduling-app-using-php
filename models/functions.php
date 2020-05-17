<?php 
require_once('initialization.php');

function find_calendar($month, $year){

    $appointment = new Appointment();

    $bookings = array();

    $userAppoinrtments = $appointment->find_date_month_year($month, $year);

    $count = $userAppoinrtments->rowCount();

    if($count > 0){
        while($row = $userAppoinrtments->fetch(PDO::FETCH_ASSOC)){
            $bookings[] = $row['date'];
        }
    }

    // array of names of all days in week
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

    // get the first day of the month
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    //numbers of days in a month 
    $numberDays = date('t', $firstDayOfMonth);

    // info about first day 
    $dateComponents = getdate($firstDayOfMonth);

    // name of the month 
    $monthName = $dateComponents['month'];

    // Getting index value 0-6 of thefirst day of the month 
    $dayOfWeek = $dateComponents['wday'];

    // Getting current date
    $dateToday = date('Y-m-d');

    // Now creating HTML Table
    $calendar = "<table class='table table-border'>";
    $calendar .= "<center><h2>{$monthName} {$year}</h2>";
    $calendar .= "<a href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."' class='btn btn-xs btn-info'>Previous Month</a>";
    $calendar .= "<a href='?month=".date('m')."&year=".date('Y')."' class='btn btn-xs btn-info'>Current Month</a>";
    $calendar .= "<a href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."' class='btn btn-xs btn-info'>Next Month</a>";
    $calendar.="</center><br/>";
    $calendar .= "<tr>";
    // creating calendar headers 
    foreach($daysOfWeek as $day){
        $calendar .= "<th class='header'>{$day}</th>";
    }
    $calendar .= "</tr>"; 

    $calendar .= "<tr>";
    // The variable $dayOfWeek will make sure columns are seven
    if($dayOfWeek > 0){
        for($k=0; $k<$dayOfWeek; $k++){
            $calendar .= "<td></td>";
        }
    }

    // initialize the day counter
    $currentDay = 1;

    // Getting the month Number

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while($currentDay <= $numberDays){
        if($dayOfWeek == 7){
            $dayOfWeek = 0;
            $calendar .= "</tr>";
            $calendar .= "<tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "{$year}-{$month}-{$currentDayRel}";
 

        $dayName = strtolower(date('l', strtotime($date)));
        $eventNum = 0;

        $today = $date==date('Y-m-d') ? "today":"";

        if($dayName == 'saturday' && $dayName =='sunday'){
            $calendar .= "<td>";
            $calendar .= "<h4>{$currentDay}</h4>";
            $calendar .= "<button class='btn btn-xs btn-danger'>Holiday</button>";
            $calendar .= "</td>";
        }elseif($date<date('Y-m-d')){
            $calendar .= "<td>";
            $calendar .= "<h4>{$currentDay}</h4>";
            $calendar .= "<button class='btn btn-xs btn-danger'>N/A</button>";
            $calendar .= "</td>";
        }elseif(in_array($date, $bookings)){
            $calendar .= "<td class='{$today}'>";
            $calendar .= "<h4>{$currentDay}</h4>";
            $calendar .= "<button class='btn btn-xs btn-success'>Already Booked</button>";
            $calendar .= "</td>";
        }else{
            $calendar .= "<td class='{$today}'>";
            $calendar .= "<h4>{$currentDay}</h4>";
            $calendar .= "<a href='book.php?date=".$date."' class='btn btn-xs btn-primary'>Booking</a>";
            $calendar .= "</td>";
        }


        // increment the counters
        $currentDay++;
        $dayOfWeek++;

    }

    // Completing the row of the last day of the week 
    if($dayOfWeek!=7){
        $remainingDays=7-$dayOfWeek;
        for($i=0; $i<$remainingDays;$i++){
            $calendar.="<td></td>";
        }
    }
    $calendar .= "</tr>";
    $calendar .= "</table>";
    echo $calendar; 
}


// find time slots
function find_timeslots($duration, $cleanup, $start, $end) {
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();

    for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval)){
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if($endPeriod>$end){
            break;
        }
        $slots[] = $intStart->format("H:iA")."-".$endPeriod->format("H:iA");
    }

    return $slots;
}


?>