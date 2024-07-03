<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class MovieController extends Controller
{
    protected $genres;

    public function __construct()
    {
        $genres = Http::withToken(env('TMDB_API_TOKEN'))
            ->get(env('TMDB_BASE_URL').'/genre/movie/list?language=vi-VN')
            ->json()['genres'];

        $this->genres = $genres;
        View::share('genres', $genres);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Phổ biến
        $popularMovie = Http::withToken(env('TMDB_API_TOKEN'))
            ->get(env('TMDB_BASE_URL').'/movie/popular?language=vi-VN')
            ->json()['results'];

        // Sắp chiếu
        $upcomingMovie = Http::withToken(env('TMDB_API_TOKEN'))
            ->get(env('TMDB_BASE_URL').'/movie/upcoming?language=vi-VN')
            ->json()['results'];

        // Tạo mảng chứa thông tin phim
        $popularMovies = [];
        foreach ($popularMovie as $movie) {
            $popularMovies[] = [
                'title' => $movie['title'],
                'poster' => 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'],
                'release_date' => $movie['release_date'],
                'id' => $movie['id'],
                'backdrop' => 'https://image.tmdb.org/t/p/original'.$movie['backdrop_path'],
            ];
        }

        $upcomingMovies = [];
        foreach ($upcomingMovie as $movie) {
            $upcomingMovies[] = [
                'title' => $movie['title'],
                'poster' => 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'],
                'release_date' => $movie['release_date'],
                'id' => $movie['id'],
                'backdrop' => 'https://image.tmdb.org/t/p/w1250'.$movie['backdrop_path'],
            ];
        }

        // Truyền dữ liệu vào view
        return view('pages.main', [
            'popularMovies' => $popularMovies,
            'upcomingMovies' => $upcomingMovies,
        ]);
    }

    /**
     * Trang chi tiết phim.
     */
    public function show(int $id)
    {
        $movieDetail = Http::withToken(env('TMDB_API_TOKEN'))
            ->get(env('TMDB_BASE_URL')."/movie/$id?language=vi-VN")
            ->json();

        $data = [
            'data' => $movieDetail,
        ];

        return view('pages.movie', $data);
    }

    /**
     * Trang danh mục phim.
     */
    public function category(int $id)
    {
        $filteredArrayGenre = array_filter($this->genres, function ($item) use ($id) {
            return $item['id'] === $id;
        });
        $categoryName = reset($filteredArrayGenre)['name'];

        $movies = Http::withToken(env('TMDB_API_TOKEN'))
            ->get(env('TMDB_BASE_URL')."/discover/movie?include_adult=false&include_video=false&language=vi-VN&sort_by=popularity.desc&with_genres=$id")
            ->json()['results'];

        $data = [
            'data' => $movies,
            'categoryName' => $categoryName,
        ];

        return view('pages.category', $data);
    }

    /**
     * Trang tìm kiếm phim.
     */
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $movies = Http::withToken(env('TMDB_API_TOKEN'))
            ->get(env('TMDB_BASE_URL')."/search/movie?query=$keyword&include_adult=false&language=vi-VN&page=1&region=vi-VN")
            ->json()['results'];

        $data = [
            'data' => $movies,
            'categoryName' => 'Tìm kiếm',
        ];

        return view('pages.category', $data);
    }

    /**
     * Trang xem phim.
     */
    public function watch(int $id)
    {
        $movies = [
            '<iframe width="1280" height="720" src="https://www.youtube.com/embed/m30S4Ax9BOM?si=-ic_8H8mchcdgjSu" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
            '<iframe width="1280" height="720" src="https://www.youtube.com/embed/B2Jlyq_Tf3Y?si=YP1kcdTGtDNo8JqM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
            '<iframe width="1280" height="720" src="https://www.youtube.com/embed/YUWkCwWsurE?si=1wmwV_QX14B2P23w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>',
        ];

        $data = [
            'iframe' => $movies[array_rand($movies)],
        ];

        return view('pages.watch', $data);
    }

    /**
     * Hàm post like phim.
     */
    public function like(int $id)
    {
        $checkExists = Favorite::where([
            'movie_id' => $id,
            'customer_id' => Auth::guard('web')->id(),
        ])->exists();

        if ($checkExists) {
            Favorite::where([
                'movie_id' => $id,
                'customer_id' => Auth::guard('web')->id(),
            ])->delete();
        } else {
            Favorite::create([
                'movie_id' => $id,
                'customer_id' => Auth::guard('web')->id(),
            ]);
        }

        return redirect()->back();
    }

    /**
     * Trang danh sách phim yêu thích.
     */
    public function favorites()
    {
        $favorites = Favorite::where([
            'customer_id' => Auth::guard('web')->id(),
        ])->get();

        foreach ($favorites as $item) {
            $movieId = $item->movie_id;
            $movies[] = Http::withToken(env('TMDB_API_TOKEN'))
                ->get(env('TMDB_BASE_URL')."/movie/$movieId?language=en-vi-VN")
                ->json();
        }

        $data = [
            'data' => $movies,
            'categoryName' => 'Yêu thích',
        ];

        return view('pages.category', $data);
    }
}
