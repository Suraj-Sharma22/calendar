<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/calendar.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new calendar($db);

    $data = json_decode(file_get_contents("php://input"));

    //REQUIRED INPUTS
    if(!empty($data->joinersId) && !empty($data->title) && !empty($data->duration) && !empty($data->start_date) && !empty($data->end_date)){

        $item->joinersId = $data->joinersId;
        $item->title = $data->title;
        $item->duration = $data->duration;
        $item->start_date = $data->start_date;
        $item->end_date = $data->end_date;
        $item->created_by = $data->created_by;
        $item->created_on = date('Y-m-d H:i:s');


        // CHECK AVAILABILITY
        $meetings = $item->checkAvailaibilty($data->start_date,$data->end_date);
        $count = $meetings->rowCount();

        if($count > 0){
            http_response_code(201);
            echo json_encode(array("status"=>"Success", "message" => "Meeting is already scheduled at the selected time."));
        }else if($item->createMeetings()){
            http_response_code(201);
            echo json_encode(array("status"=>"Success", "message" => "Meeting Scheduled successfully.", "data" =>$data));
        } else{
            http_response_code(503);
            echo json_encode(array("status"=>"Failure", "message" => "Something went wrong."));
        }
    }else{
        http_response_code(400);
        echo json_encode(array("status"=>"Failure", "message" => "joinersId, title, duration, start_date, and end_date are required."));

    }
?>