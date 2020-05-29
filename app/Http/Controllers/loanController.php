<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Loan;

class loanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::with('client')->get();
        return view('loans.index',[
            'loans' => $loans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $name = Client::pluck('id','name');
        $names = $name->all();
        return view ('loans.create', [
            'names' => $names
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /*  $request->validate([
            'client_id' => 'required',
            'amount' => 'required',
            'payments_number' => 'required',
            'fee' => 'required',
            'ministry_date' => 'required',
            'due_date' => 'required'
        ]);  */
        
        $loan = new loan();
        $loan->client_id = $request->client_id;
        $loan->amount = $request->amount;
        $loan->payments_number = $request->payments_number;
        $loan->fee = $request->fee;
        $loan->ministry_date = $request->ministry_date;
        $loan->due_date = $request->due_date;
        $loan->finished = 0;
        $loan->save();

        return redirect()->route('loans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
