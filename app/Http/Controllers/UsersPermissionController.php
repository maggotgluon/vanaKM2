<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storeusers_permissionRequest;
use App\Http\Requests\Updateusers_permissionRequest;
use App\Models\users_permission;

class UsersPermissionController extends Controller
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
     * @param  \App\Http\Requests\Storeusers_permissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeusers_permissionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\users_permission  $users_permission
     * @return \Illuminate\Http\Response
     */
    public function show(users_permission $users_permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\users_permission  $users_permission
     * @return \Illuminate\Http\Response
     */
    public function edit(users_permission $users_permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateusers_permissionRequest  $request
     * @param  \App\Models\users_permission  $users_permission
     * @return \Illuminate\Http\Response
     */
    public function update(Updateusers_permissionRequest $request, users_permission $users_permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\users_permission  $users_permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(users_permission $users_permission)
    {
        //
    }
}
