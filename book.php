<?php 
require_once('models/initialization.php');

if(isset($_GET['date'])){
    $date = htmlentities($_GET['date']);
}

/// add timeslots
$time_duration = 30;
$time_cleanup = 0;
$time_start = "07:00";
$time_end = "15:00";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/styles.css">
    <title>Office Appointment Signup</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="alertMessage"></div>
            </div>
            <div class="col-md-12">
                <?php 
                $timeSlots = find_timeslots($time_duration, $time_cleanup, $time_start, $time_end); 
                // echo json_encode($timeSlots);
                // echo $timeSlots;
                foreach($timeSlots as $ts){ ?>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button id="<?php echo $ts; ?>" class="btn btn-success bookingBtn">
                                <?php echo $ts; ?>
                            </button>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
     <!-- Modal -->
    <div class="modal fade" id="bookingModal" role="dialog">
        <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Office Hour Signup <span id="slot"></span></h4>
            </div>
            <form id="bookingForm" autocomplete="off">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Time Slot</label>
                            <input type="text" id="timeslot" class="form-control" name="timeslot" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="date" value="<?php echo $date; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Student Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="bookingSubmit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $('.bookingBtn').click(function(){
                var timeslot = $(this).attr('id');
                $('#slot').html(timeslot);
                $('#timeslot').val(timeslot);
                $('#bookingModal').modal('show');
            });

            $('#bookingForm').submit(function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url:'api/appointment/new_appointment.php',
                    type:"POST",
                    data:form_data,
                    dataType:'json',
                    beforeSend:function(){
                        $('#bookingSubmit').html('Loading...');
                    },
                    success:function(data){
                        $('#bookingSubmit').html('Save');
                        if(data.message == "success"){
                            $('#alertMessage').html('<div class="alert alert-success">Booking successfully</div>');
                            $('#bookingModal').modal('hide');
                        }

                        if(data.message == "errorTime"){
                            $('#alertMessage').html('<div class="alert alert-danger">Time Already taken</div>');
                            $('#bookingModal').modal('hide');
                            return false;
                        }
                        
                    }
                });
            });
        });
    </script>
</body>
</html>