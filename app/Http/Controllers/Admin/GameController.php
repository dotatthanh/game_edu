<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Game;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $games = Game::orderBy('id', 'desc');

        if ($request->search) {
            $games = Game::where('name', 'like', '%'.$request->search.'%');
        }
        $games = $games->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'games' => $games,
        ];

        return view('admin.game.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'types' => Type::all(),
        ];

        return view('admin.game.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameRequest $request)
    {
        try {
            DB::beginTransaction();

            $file_path = '';
            if ($request->file('image')) {
                $name = time().'_'.$request->image->getClientOriginalName();
                $file_path = 'uploads/image/game/'.$name;
                Storage::disk('public_uploads')->putFileAs('image/game', $request->image, $name);
            }

            Game::create([
                'name' => $request->name,
                'type_id' => $request->type_id,
                'class_id' => $request->class_id,
                'link' => $request->link,
                'description' => $request->description,
                'image' => $file_path,
            ]);

            DB::commit();

            return redirect()->route('games.index')->with('alert-success', 'Thêm trò chơi thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Thêm trò chơi thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        $data = [
            'types' => Type::all(),
            'data_edit' => $game,
        ];

        return view('admin.game.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        try {
            DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'type_id' => $request->type_id,
                'class_id' => $request->class_id,
                'link' => $request->link,
            ];

            if ($request->file('image')) {
                $name = time().'_'.$request->image->getClientOriginalName();
                $file_path = 'uploads/image/game/'.$name;
                Storage::disk('public_uploads')->putFileAs('image/game', $request->image, $name);
                $data['image'] = $file_path;

            }
            $game->update($data);

            DB::commit();

            return redirect()->route('games.index')->with('alert-success', 'Sửa trò chơi thành công!');
        } catch (Exception) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Sửa trò chơi thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        try {
            DB::beginTransaction();

            $game->favorites()->delete();
            $game->destroy($game->id);

            DB::commit();

            return redirect()->route('games.index')->with('alert-success', 'Xóa trò chơi thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Xóa trò chơi thất bại!');
        }
    }
}
