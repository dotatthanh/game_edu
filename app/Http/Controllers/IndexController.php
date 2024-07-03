<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveProfileRequest;
use App\Models\Favorite;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('id')->get();
        $data = [
            'games' => $games,
        ];

        return view('pages.index', $data);
    }

    /**
     * Hàm post like và unlike game.
     */
    public function like(int $id)
    {
        $checkExists = Favorite::where([
            'game_id' => $id,
            'customer_id' => Auth::guard('web')->id(),
        ])->exists();

        if ($checkExists) {
            Favorite::where([
                'game_id' => $id,
                'customer_id' => Auth::guard('web')->id(),
            ])->delete();
        } else {
            Favorite::create([
                'game_id' => $id,
                'customer_id' => Auth::guard('web')->id(),
            ]);
        }

        return redirect()->back();
    }

    /**
     * Trang danh sách game yêu thích.
     */
    public function favorites()
    {
        $favorites = Favorite::where([
            'customer_id' => Auth::guard('web')->id(),
        ])->get();

        $data = [
            'data' => $favorites,
            'categoryName' => 'Yêu thích',
        ];

        return view('pages.favorites', $data);
    }

    /**
     * Trang danh sách game yêu thích.
     */
    public function profile()
    {
        $data = [
            'user' => auth('web')->user(),
        ];

        return view('pages.profile', $data);
    }

    /**
     * post lưu thông tin khách hàng.
     */
    public function saveProfile(SaveProfileRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        auth('web')->user()->update($data);

        return redirect()->back();
    }
}
