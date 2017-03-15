<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;

use App\Libraries\ZuiThreePresenter;
use App\Tag;
use Cache;
use Config;

class TagController extends AdminController
{
    private $sidebarTagsCacheKey;

    public function __construct()
    {
        parent::__construct();

        $this->sidebarTagsCacheKey = Config::get('cache_keys.HomeSidebarTags');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'asc')
            ->orderBy('Id', 'asc')
            ->paginate(15);

        // dd($tags);

        return view('admin/tag/tag_index')->with([
            'tags'       => $tags,
            'pagination' => $tags->render(new ZuiThreePresenter($tags))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/tag/tag_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tag.name'  => 'required|max:255',
            'tag.color' => 'required|max:255'
        ]);

        $tag = new tag;
        $tag->name  = $request->input('tag.name');
        $tag->color = $request->input('tag.color');

        if ($tag->save()) {
            Cache::forget($this->sidebarTagsCacheKey);
            return redirect('/admin/tag');
        } else {
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin/tag/tag_edit')->with([
            'tag' => tag::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tag.name'  => 'required|max:255',
            'tag.color' => 'required|max:255'
        ]);

        $tag = tag::find($id);
        $tag->name  = $request->input('tag.name');
        $tag->color = $request->input('tag.color');

        if ($tag->save()) {
            Cache::forget($this->sidebarTagsCacheKey);
            return redirect('/admin/tag');
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if ($tag->delete()) {
            return redirect('/admin/tag');
        } else {
            return back();
        }
    }
}
