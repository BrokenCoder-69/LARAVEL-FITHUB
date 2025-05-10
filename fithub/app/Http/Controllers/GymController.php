<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use Illuminate\Http\Request;

class GymController extends Controller
{
    //find users location using ip address
    public function findNearestGyms(Request $request)
    {
        $ip = request()->ip();      // Get the IP address from the request

        // Check for proxies or load balancers
        if (request()->server('HTTP_X_FORWARDED_FOR')) {
            $ip = explode(',', request()->server('HTTP_X_FORWARDED_FOR'))[0];       // If so, take the first IP from the list
        }
        // Call the IP geolocation API to get latitude and longitude based on IP
        $url = "http://ip-api.com/json/$ip";

        $locationData = json_decode(file_get_contents($url), true);
        $latitude = $locationData['lat'] ?? null;
        $longitude = $locationData['lon'] ?? null;

        if ($latitude && $longitude) {
            return $this->searchNearestGyms($latitude, $longitude);
        } else {
            return response()->json([
                'message' => 'Location could not be determined from IP address.',
                'ip' => $ip
            ], 400);
        }
    }
    // close gym    
    private function searchNearestGyms($latitude, $longitude)
    {
        $radius = 4;
           // Use the Haversine formula to calculate the distance between the user's location and each gym
        $gyms = Gym::selectRaw(
            "
        id, name, address, latitude, longitude,
        (6371 * acos(cos(radians(?)) * cos(radians(latitude)) 
        * cos(radians(longitude) - radians(?)) + sin(radians(?)) 
        * sin(radians(latitude)))) AS distance",
            [$latitude, $longitude, $latitude]
        )
            ->having("distance", "<", $radius)      // Filter gyms within the specified radius
            ->orderBy("distance")                   // Order results by distance (nearest first)
            ->get();
        if ($gyms->isEmpty()) {
            return response()->json(['message' => 'No gyms found within the specified radius.'], 404);
        }
        return response()->json($gyms);
    }
}
