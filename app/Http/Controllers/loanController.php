<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Loan;
use App\Models\Payment;
use Carbon\Carbon;
use App\Exports\LoansExport;

class loanController extends Controller
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
        $loans = Loan::with('client')->orderBy('id')->get();
        return view('loans.index',[
            'loans' => $loans
        ]);
    }

    public function exportExcel()
    {
       $loanExport = new loansExport;
       return $loanExport->download('loans.xlsx');
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
        $request->validate([
            'client_id' => 'required',
            'amount' => 'required',
            'payments_number' => 'required',
            'fee' => 'required',
            'ministry_date' => 'required',
            'due_date' => 'required',
        ]);

        $loan = new Loan();
        $loan->client_id = $request->client_id;
        $loan->amount = $request->amount;
        $loan->payments_number = $request->payments_number;
        $loan->fee = $request->fee;
        $loan->ministry_date = $request->ministry_date;
        $loan->due_date = $request->due_date;
        $loan->finished = 0;
        $loan->save();

        $date = Carbon::createFromDate($loan->ministry_date); //Guarda la fecha en la varible date
        $count = 0;
        while($count < $loan->payments_number)
        {
            $date->addDay(); //Incrementa un día a la fecha date
            if($date->isWeekday()) //Verifica si date es día de semana
            {
                $payment = new Payment();
                $payment->client_id = $loan->client_id;
                $payment->loan_id = $loan->id;
                $payment->number = $count+1;
                $payment->amount = $loan->fee;
                $payment->received_amount = 0;
                $payment->payment_date = $date;
                $payment->save();
                $count++;
            }
        }
        return redirect()->route('loans.index');
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
            
        $request->validate([
            'client_id' => 'required',
            'amount' => 'required',
            'payments_number' => 'required',
            'fee' => 'required',
            'ministry_date' => 'required',
            'due_date' => 'required',
        ]);

        $loan = Loan::find($id);
        $saldoAbonado = $loan->saldoAbonado;
       
        if( $saldoAbonado > 0){
            return redirect()->route('loans.index')
                ->withError('No puede editar un prestamo que tenga pagos registrados.');
        }
        else{ //Editar el prestamo

            $loan->client_id = $request->client_id;
            $loan->amount = $request->amount;
            $loan->payments_number = $request->payments_number;
            $loan->fee = $request->fee;
            $loan->ministry_date = $request->ministry_date;
            $loan->due_date = $request->due_date;
            $loan->finished = 0;
            $loan->save();

            //Borrar payments
            Payment::where('loan_id',$id)->delete();

            $date = Carbon::createFromDate($loan->ministry_date); //Guarda la fecha en la varible date
            $count = 0;
            while($count < $loan->payments_number)
            {
                $date->addDay(); //Incrementa un día a la fecha date
                if($date->isWeekday()) //Verifica si date es día de semana
                {
                    $payment = new Payment();
                    $payment->client_id = $loan->client_id;
                    $payment->loan_id = $loan->id;
                    $payment->number = $count+1;
                    $payment->amount = $loan->fee;
                    $payment->received_amount = 0;
                    $payment->payment_date = $date;
                    $payment->save();
                    $count++;
                }
            }
            return redirect()->route('loans.index');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loan = Loan::with('client')->find($id);
        return view('loans.edit', [
            'loan' => $loan,
        ]);
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loan = Loan::find($id);
        foreach($loan->payments as $payment)
        {
            $payment->delete();
        }
        $loan->delete();
    }
}
