<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicationRequest;
use App\Models\Publisher;
use Session;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

            $publisher = Publisher::all();

        return view('admin.publisher.index', compact('publisher'));
    }

    public function getPublisher()
    {
        $publisher = Publisher::select('id', 'publisherName')->get();
        return response()->json($publisher);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PublicationRequest $request)
    {
        
        $requestData = $request->all();
        
        Publisher::create($requestData);
        $notification = array(
            'message' => "Publisher   successfully added!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);

        return redirect('admin/publisher');
    }

    public function publisherStore(PublicationRequest $request)
    {
        if ($request->ajax()) {
            $requestData = $request->only('publisherName', 'publisherPhone', 'publisherEmail', 'publisherAddress');
            Publisher::create($requestData);
            return "Publisher successfully created!";
        }
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
        $item = Publisher::findOrFail($id);

        return view('admin.publisher.show', compact('item'));
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
        $publisher = Publisher::findOrFail($id);

        return view('admin.publisher.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PublicationRequest $request, $id)
    {
        
        $requestData = $request->all();
        
        $publisher = Publisher::findOrFail($id);
        $publisher->update($requestData);
        $notification = array(
            'message' => "Publisher   successfully updated!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);

        return redirect('admin/publisher');
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
        Publisher::destroy($id);
        $notification = array(
            'message' => "Publisher   successfully deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);

        return redirect('admin/publisher');
    }
}
