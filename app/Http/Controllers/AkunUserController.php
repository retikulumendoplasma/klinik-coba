<?php

namespace App\Http\Controllers;

use App\Models\akun_user;
use App\Http\Requests\Storeakun_userRequest;
use App\Http\Requests\Updateakun_userRequest;

class AkunUserController extends Controller
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
     * @param  \App\Http\Requests\Storeakun_userRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeakun_userRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\akun_user  $akun_user
     * @return \Illuminate\Http\Response
     */
    public function show(akun_user $akun_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\akun_user  $akun_user
     * @return \Illuminate\Http\Response
     */
    public function edit(akun_user $akun_user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateakun_userRequest  $request
     * @param  \App\Models\akun_user  $akun_user
     * @return \Illuminate\Http\Response
     */
    public function update(Updateakun_userRequest $request, akun_user $akun_user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\akun_user  $akun_user
     * @return \Illuminate\Http\Response
     */
    public function destroy(akun_user $akun_user)
    {
        //
    }
}
