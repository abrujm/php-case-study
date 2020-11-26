<?php

namespace App\Http\Controllers;

use App\Models\Events;

class EventController extends BaseApiController
{
    public function eventList() {
        try {
            $events = Events::all('id', 'event_name', 'event_date', 'latitude', 'longitude');

            return $this->sendResponse(true, 200,
              "Event List", ['events' => $events]);
        }
        catch (\Exception $e) {
            return $this->sendResponse(false, 500,
              "Some error occurred");
        }
    }

    public function activeEventList() {
        try {
            $events = Events::getActiveEvents();

            return $this->sendResponse(true, 200,
              "Active Event List", ['events' => $events]);
        }
        catch (\Exception $e) {
            return $this->sendResponse(false, 500,
              "Some error occurred");
        }
    }
}
