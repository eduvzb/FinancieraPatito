<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Loan;
use Carbon\Carbon;


class paymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $loans = Loan::orderBy('id')->get();
        return view('payments.index',[
            'loans' => $loans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay($id)
    {
        $loan = Loan::find($id);
        return view('payments.pay',[
            'loan' => $loan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $payments = Payment::where('loan_id', $id)
        ->where('paid',0)
        ->orderBy('number')
        ->get();
        $acum = $request->received_amount;
         foreach($payments as $payment)
         {
             $amount = $payment->amount;
             if( $amount > $acum && $acum>0)
             {
                 if($acum + $payment->received_amount > $amount)
                 {
                     $payment->received_amount = $amount;
                     $payment->paid = 1;

                 }else{
                    $payment->received_amount+= $acum;
                 }
                 $payment->receipt_date = Carbon::now();
                    if($payment->received_amount == $amount){
                        $payment->paid = 1;
                    }
                 $payment->save();
                 break;
             }
             else if ($amount <= $acum){
                 $dif = $amount - $payment->received_amount;
                 $payment->received_amount+= $dif;
                 $payment->paid = 1;
                 $payment->receipt_date = Carbon::now();
                 $payment->save();
                 $acum-= $dif;
             }
         }

         return redirect()->route('payments.show', [
             'id'=> $id
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loans = Loan::find($id);
        return view('payments.show',[
            'loans' => $loans
        ]);
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
