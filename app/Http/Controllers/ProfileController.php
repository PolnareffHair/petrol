<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function add_favorites(Request $request)
    {
        $product_id = $request->product_id;

        $values["isAuth"] = Auth::check();

        $values["currentUser"] = Auth::user();


        if (isset($values["currentUser"]["id"])) {
            $user_id = $values["currentUser"]["id"];
            $user = (array) DB::table("favorites")->where("user_id", $user_id)->select("product_ids", "user_id")->get()->first();

            if (isset($user["user_id"])) {
                $ids =  json_decode($user["product_ids"]);
                if (in_array($product_id, $ids)) {
                    return "allready added in favorites";
                }

                $ids[] = (int) $product_id;
                $user["product_ids"] = $ids;

                DB::table("favorites")->where("user_id", $user_id)->update(["product_ids" => json_encode($user["product_ids"])]);
                return "Favorite added";
            } else {

                DB::table("favorites")->insert(["user_id" => $values["currentUser"]["id"], "product_ids" => "[$product_id]"]);
                return "added first favorites";
            }
        } else return "no user logged";
    }
    public function remove_favorites(Request $request)
    {
        $product_id = $request->product_id;

        $values["isAuth"] = Auth::check();

        $values["currentUser"] = Auth::user();


        if (isset($values["currentUser"]["id"])) {
            $user_id = $values["currentUser"]["id"];
            $user = (array) DB::table("favorites")->where("user_id", $user_id)->select("product_ids", "user_id")->get()->first();
            $ids =  json_decode($user["product_ids"]);
            if (in_array($product_id, $ids)) {

                $key = array_search($product_id,  $ids);

                if ($key !== false) {
                    unset($ids[$key]); // Удаляем элемент
                }
                $ids = array_values($ids);

                $user["product_ids"] = $ids;

                DB::table("favorites")->where("user_id", $user_id)->update(["product_ids" => json_encode($ids)]);
                return [$ids, $product_id];
            } else {
                return "product or user didn`t exist  in list";
            }
        } else return "no user logged";
    }
    public function show_favorites(Request $request)
    {

        $values["isAuth"] = Auth::check();
        $values["currentUser"] = Auth::user();


        if (isset($values["currentUser"]["id"])) {
            $user_id = $values["currentUser"]["id"];

            $user = (array) DB::table("favorites")->where("user_id", $user_id)->select("product_ids", "user_id")->get()->first();
            if (isset($user["user_id"])) {


                return  json_decode($user["product_ids"]);;
            } else {
                return "product or user didn`t exist  in list";
            }
        } else return "no user logged";
    }
}