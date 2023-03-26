<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facebook\Facebook;

class FbController extends Controller
{
    //
    public function index(){
        $fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v11.0',
        ]);
        $access_token = 'EAANWnAsMZA7sBAEf2eOX7wTCeiZA5Dpc0ydq5gG3nSZC4gaVuzy6ZAfdVHERdRJKmuIWj5SZCIMfdBgijXgUViD4Se2hIks7r9MYttsxAonnKFpEO3KTlQyKFky5pcad7blQV8vDWcVkQlHP8Q9MMRoOXLlZCZB7IDdyrUOKjeC9frbRtWaSstRC5FeVkXKSrWvr7tZCPlkB6AZDZD';
        // $response = $fb->get('/me/groups', $access_token);
        $response = $fb->get('/me/groups', $access_token);
        $groups = $response->getGraphEdge();

        // $user = $response->getGraphUser();
        
        dd($groups);
        foreach ($groups as $group) {
            dd("Asdsad");
            $group_id = $group->getField('id');
            $group_name = $group->getField('name');
            $group_description = $group->getField('description');
            $group_cover = $group->getField('cover');
            dd($group_name);
            // Do something with the group information
        }
        
    }
}
