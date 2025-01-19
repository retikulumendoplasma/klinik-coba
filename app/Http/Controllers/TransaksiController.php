<?php

namespace App\Http\Controllers;

use App\Models\billing_report;
use Illuminate\Http\Request;

class TransaksiController extends Controller
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

    public function formTransaksi()
    {
        return view('dashBoard.formTransaksi', [
            "title" => "Data resep",
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\billing_report  $billing_report
     * @return \Illuminate\Http\Response
     */
    public function show(billing_report $billing_report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\billing_report  $billing_report
     * @return \Illuminate\Http\Response
     */
    public function edit(billing_report $billing_report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\billing_report  $billing_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, billing_report $billing_report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\billing_report  $billing_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(billing_report $billing_report)
    {
        //
    }
}
