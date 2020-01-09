<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disiplinary;
use App\Http\Resources\DisiplinaryResource;
use Illuminate\Support\Facades\DB;

class DisiplinaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responseData = Disiplinary::orderBy('created_at', 'desc')->paginate();
        return response()->json($responseData, 200);
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
        // validation
        $request->validate([
            'date' => 'required',
            'offence' => 'required',
            'natureOfPunishment' => 'required'
        ]);
        // create dataset
        $data = [
            'go_date' => $request->date,
            'offence' => $request->offence,
            'nature_of_punishment' => $request->natureOfPunishment,
            'punishment_line_1' => $request->punishmentLine_1,
            'punishment_line_2' => $request->punishmentLine_2,
            'remarks' => $request->remarks
        ];

        // insert data with db-transaction
        $result = DB::transaction(function () use ($data) {
            return Disiplinary::create($data);
        });
        // response insert data      
        return response()->json($result, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disiplinary  $disiplinary
     * @return \Illuminate\Http\Response
     */
    public function show(Disiplinary $disiplinary)
    {
        return $disiplinary;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disiplinary  $disiplinary
     * @return \Illuminate\Http\Response
     */
    public function edit(Disiplinary $disiplinary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($find = Disiplinary::find($request->id)) {
            $request->validate([
                'date' => 'required',
                'offence' => 'required',
                'natureOfPunishment' => 'required'
            ]);
            // create dataset
            $data = [
                'go_date' => $request->date,
                'offence' => $request->offence,
                'nature_of_punishment' => $request->natureOfPunishment,
                'punishment_line_1' => $request->punishmentLine_1,
                'punishment_line_2' => $request->punishmentLine_2,
                'remarks' => $request->remarks
            ];

            // update data with db-transaction
            $result = DB::transaction(function () use ($find, $data) {
                return $find->update($data);
            });
            return response()->json($result, 200);
        } else {
            return response()->json('error', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disiplinary  $disiplinary
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if ($find = Disiplinary::find($id)) {
            $find->delete();
            return response()->json('Success', 200);
        } else {
            return response()->json('No Data found', 404);
        }
    }
}
