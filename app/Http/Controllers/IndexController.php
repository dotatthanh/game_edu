<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveProfileRequest;
use App\Models\Favorite;
use App\Models\Game;
use App\Models\News;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    public function __construct()
    {
        $types = Type::all();
        View::share('types', $types);
    }

    public function index()
    {
        $games = Game::orderBy('id', 'desc')->get();
        $newsStudyFirst = News::orderBy('id', 'desc')->first();
        $newsStudy = News::orderBy('id', 'desc')->offset(1)->limit(3)->get();

        $data = [
            'games' => $games,
            'newsStudy' => $newsStudy,
            'newsStudyFirst' => $newsStudyFirst,
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

    /**
     * Trang tìm kiếm.
     */
    public function search(Request $request)
    {
        $games = Game::orderBy('id', 'desc');

        if ($request->search) {
            $games = Game::where('name', 'like', '%'.$request->search.'%');
        }
        $games = $games->paginate(8)->appends(['search' => $request->search]);

        $data = [
            'games' => $games,
        ];

        return view('pages.search', $data);
    }

    /**
     * Trang tin tức.
     */
    public function news()
    {
        $posts = News::where('type', News::NEWS)->orderBy('id', 'desc')->paginate(10);

        $data = [
            'posts' => $posts,
        ];

        return view('pages.news', $data);
    }

    /**
     * Trang danh mục game.
     */
    public function category(Request $request)
    {
        $games = Game::orderBy('id', 'desc');

        $categoryName = '';
        if ($request->type_id) {
            $games = Game::where('type_id', $request->type_id);
            $categoryName = Type::find($request->type_id)->name;
        }

        if ($request->class_id) {
            $games = Game::where('class_id', $request->class_id);
            $categoryName = getConst('class')[$request->class_id];
        }
        $games = $games->paginate(8)->appends([
            'type_id' => $request->type_id,
            'class_id' => $request->class_id
        ]);

        $data = [
            'games' => $games,
            'categoryName' => $categoryName,
        ];

        return view('pages.category', $data);
    }

    /**
     * Trang chi tiết tin tức.
     */
    public function newsDetail(News $news)
    {
        $data = [
            'data' => $news,
        ];

        return view('pages.news-detail', $data);
    }
}
