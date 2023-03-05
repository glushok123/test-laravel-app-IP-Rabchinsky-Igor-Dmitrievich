<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHistoryUserRequestRequest;
use App\Http\Requests\UpdateHistoryUserRequestRequest;
use App\Models\HistoryUserRequest;

class HistoryUserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHistoryUserRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHistoryUserRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoryUserRequest  $historyUserRequest
     * @return \Illuminate\Http\Response
     */
    public function show(HistoryUserRequest $historyUserRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoryUserRequest  $historyUserRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoryUserRequest $historyUserRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHistoryUserRequestRequest  $request
     * @param  \App\Models\HistoryUserRequest  $historyUserRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHistoryUserRequestRequest $request, HistoryUserRequest $historyUserRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoryUserRequest  $historyUserRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoryUserRequest $historyUserRequest)
    {
        //
    }
}
