<?php

namespace Azuriom\Plugin\playerapi\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\playerapi\Models\WhitelistedUser;
use Azuriom\Models\User;
use Azuriom\Models\Ban;
use Azuriom\Support\Discord\DiscordWebhook;
use Azuriom\Support\Discord\Embed;
use Illuminate\Http\Request;
use Azuriom\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    /**
     * Show the home admin page of the plugin.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $i = WhitelistedUser::getAllFormated();
        return view('playerapi::admin.index', [
            "user_created" => false,
            "error" => false,
            "users" => $i
        ]);
    }

    /**
     * Show the home admin page of the plugin.
     *
     * @return string
     */
    public function whitelist(Request $request)
    {
        $i = WhitelistedUser::all();
        if(is_null($request->username) || is_null($request->discordID)) {
            abort(500);
        }
        $k = User::firstWhere('name', $request->username);

        $isUserWhitelised = WhitelistedUser::firstWhere('target_id', $k->id);

        if(!is_null($isUserWhitelised)) {
            return view("playerapi::admin.index", [
                "user_created" => false,
                "error" => true,
                "users" => $i
            ]);
        } else {
            WhitelistedUser::create([
                "target_id" => $k->id,
                "author_id" => Auth::id(),
                "discord_id" => $request->discordID
            ]);
        }

        return view("playerapi::admin.index", [
            "user_created" => true,
            "added_username" => $k->name,
            "error" => false,
            "users" => $i
        ]);
    }

    public function unwhitelist(Request $request, $id)
    {
        $i = WhitelistedUser::all();

        if(!is_null(WhitelistedUser::firstWhere("target_id", $id))) {
            WhitelistedUser::firstWhere("target_id", $id)->delete();
            return view("playerapi::admin.index", [
                "user_created" => false,
                "error" => false,
                "users" => $i
            ]);
        } else {
            return view("playerapi::admin.index", [
                "user_created" => false,
                "error" => true,
                "users" => $i
            ]);
    }
        return "ok";
    }
}
