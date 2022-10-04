<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Session;
use Str;
class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $author = Author::all();
        return view('admin.author.index', compact('author'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.author.create');
    }

    public function getJson()
    {
        $authors = Author::select('id', 'authorName')->get();
        return response()->json($authors);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AuthorRequest $request)
    {

        $requestData = $request->all();
        Author::create($requestData);
        $notification = array(
            'message' => "Author successfully created!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/author');
    }

    public function authorStore(AuthorRequest $request)
    {
        if ($request->ajax()) {
            $requestData = $request->only('authorName', 'email');
            $slug = $request->input('authorName');
            $requestData['slug'] = Str::slug($slug, '-'); //str_slug($slug);
            Author::create($requestData);
            return "Author successfully created!";
        }
    }
    public function ajaxPost(Request $request)
    {
        if ($request->ajax()) {
            $requestData = $request->all();
            Author::create($requestData);
            $authors = Author::pluck('authorName', 'id');
            return view('admin.author.new-author', compact('authors'));
        }
    }

    public function authorList()
    {
        $authors = Author::pluck('authorName', 'id');
        return response()->json($authors);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $item = Author::findOrFail($id);

        return view('admin.author.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $author = Author::findOrFail($id);

        return view('admin.author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(AuthorRequest $request, $id)
    {

        $requestData = $request->all();

        $author = Author::findOrFail($id);
        $author->update($requestData);
        $notification = array(
            'message' => "Author successfully Updated!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/author');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Author::destroy($id);
        $notification = array(
            'message' => "Author successfully deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/author');
    }
}
