<?php
/**
 * Created by PhpStorm.
 * User: abiehl
 * Date: 1/22/2017
 * Time: 11:04 AM
 */

require_once '../podio-php-4.3.0/PodioAPI.php';
require_once 'constants.php';

Podio::setup(PODIO_clientID, PODIO_clientSecretKey);
try
{
    Podio::authenticate_with_password(PODIO_User, PODIO_Password);
}catch (PodioError $e) {
    echo 'Podio API error occured.';
    var_dump($e);
    exit;
    //header('Location:'.site_url('error'));
}
echo '<pre>';
#endregion

$calendar_events = PodioCalendarEvent::get_for_app( 15913311,
    $attributes = array(
        'date_from'=>'2016-01-01',
        'date_to'=>'2018-08-31'
    )
);
$calendar_array_formatted = [];
foreach ($calendar_events as $calendar_event){
    array_push($calendar_array_formatted,
        [
            'title'=>$calendar_event->title,
            'link'=>$calendar_event->link,
            'start'=>$calendar_event->start,
            'end'=>$calendar_event->end
        ]
    );
}
echo json_encode($calendar_array_formatted);