<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemStandardNumberRequest;
use App\Models\ItemStandardNumber;
use Session;

class ItemStandardNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $itemstandardnumber = ItemStandardNumber::all();

        return view('admin.item-standard-number.index', compact('itemstandardnumber'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.item-standard-number.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ItemStandardNumberRequest $request)
    {
        
        $requestData = $request->all();
        
        ItemStandardNumber::create($requestData);
        $notification = array(
            'message' => "Item Standard Number successfully added!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/item-standard-number');
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
        $item = ItemStandardNumber::findOrFail($id);

        return view('admin.item-standard-number.show', compact('item'));
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
        $itemstandardnumber = ItemStandardNumber::findOrFail($id);

        return view('admin.item-standard-number.edit', compact('itemstandardnumber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ItemStandardNumberRequest $request, $id)
    {
        $requestData = $request->all();
        $itemstandardnumber = ItemStandardNumber::findOrFail($id);
        $itemstandardnumber->update($requestData);
        $notification = array(
            'message' => "Item Standard Number successfully updated!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);
        return redirect('admin/item-standard-number');
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
        ItemStandardNumber::destroy($id);
        $notification = array(
            'message' => "Item Standard Number   successfully deleted!",
            'alert-type' => 'success'
        );
        Session::flash('notification',$notification);

        return redirect('admin/item-standard-number');
    }
}
