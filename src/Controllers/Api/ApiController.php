<?php

namespace Azuriom\Plugin\playerapi\Controllers\Api;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ApiController extends Controller
{
    /**
     * Show the plugin API default page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // var_dump($request->parameters);

        $users = User::all();

        $ranks = [];
        foreach ($users as $user) {
            // hide value from $user->role
            unset($user->role->created_at);
            unset($user->role->updated_at);
            unset($user->role->power);
            unset($user->role->is_admin);
            // make custom object
            $usrobj = new \stdClass();
            $usrobj->id = $user->id;
            $usrobj->name = $user->name;
            $usrobj->role = $user->role;
            $ranks[] = $usrobj;
        }
        return response()->json($ranks);
    }

        /**
     * Show the plugin API default page.
     *
     * @return \Illuminate\Http\Response
     */
    public function withid(Request $request, $id)
    {

        // echo $id;

        $users = User::where('id', $id)->get();

        $ranks = [];
        foreach ($users as $user) {
            // hide value from $user->role
            unset($user->role->created_at);
            unset($user->role->updated_at);
            unset($user->role->power);
            unset($user->role->is_admin);
            // make custom object
            $usrobj = new \stdClass();
            $usrobj->id = $user->id;
            $usrobj->name = $user->name;
            $usrobj->role = $user->role;
            $ranks[] = $usrobj;
        }

        if (count($ranks) == 0)
            return response()->json(['error' => 'User not found'], 404);

        return response()->json($ranks);
    }
}
