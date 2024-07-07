<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = News::query();

        if ($request->search) {
            $news = News::where('title', 'like', '%'.$request->search.'%');
        }
        $news = $news->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'news' => $news,
        ];

        return view('admin.news.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($request->file('image')) {
                $name = time().'_'.$request->image->getClientOriginalName();
                $file_path_image = 'uploads/news/'.$name;
                Storage::disk('public_uploads')->putFileAs('news', $request->image, $name);
            }

            News::create([
                'title' => $request->title,
                'image' => $file_path_image,
                'content' => $request->content,
                'summary' => $request->summary,
                'type' => $request->type,
            ]);

            DB::commit();

            return redirect()->route('news.index')->with('alert-success', 'Thêm tin tức thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Thêm tin tức thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $data = [
            'data_edit' => $news,
        ];

        return view('admin.news.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        try {
            DB::beginTransaction();

            $data = [
                'title' => $request->title,
                'content' => $request->content,
                'summary' => $request->summary,
                'type' => $request->type,
            ];

            if ($request->file('image')) {
                $name = time().'_'.$request->image->getClientOriginalName();
                $file_path_image = 'uploads/news/'.$name;
                Storage::disk('public_uploads')->putFileAs('news', $request->image, $name);
                $data['image'] = $file_path_image;
            }

            $news->update($data);

            DB::commit();

            return redirect()->route('news.index')->with('alert-success', 'Sửa tin tức thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Sửa tin tức thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        try {
            DB::beginTransaction();

            News::destroy($news->id);

            DB::commit();

            return redirect()->route('news.index')->with('alert-success', 'Xóa tin tức thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Xóa tin tức thất bại!');
        }
    }
}
