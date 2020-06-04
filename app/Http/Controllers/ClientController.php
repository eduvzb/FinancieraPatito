<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Client;
use App\Imports\ClientsImport;

class clientController extends Controller
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
        $clients = Client::all();
        return view('clients.index', [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('clients.create');
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
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        Client::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address')
        ]);
        
        return redirect()->route('clients.index');
    }

    public function import()
    {
        return view('clients.import');
    }

    public function save(Request $request)
    {
        try{
            $loanExport = new ClientsImport;
            $loanExport->import(request()->file('file'));
        }catch(\Exception $ex){
            return redirect()->route('clients.index')->withError('Ha ocurrido un error al cargos todos los datos del archivo');
        }
        return redirect()->route('clients.index')->withMessage('Clientes cargados correctamente');
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
        $client = Client::find($id);
        foreach ($client->loans as $loan){
            foreach($loan->payments as $payment){
                $payment->delete();
            }
            $loan->delete();
        }
        $client->delete();

        return $client;
    }
}
