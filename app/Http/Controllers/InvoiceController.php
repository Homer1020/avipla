<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::latest()->get();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $afiliados = Afiliado::all();
        return view('invoices.create', compact('afiliados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'afiliado_id'   => 'required|numeric|exists:afiliados,id',
            'monto_total'   => 'required|numeric',
            'documento'     => 'required|file|mimes:pdf'
        ]);

        $numeroFactura = Str::random(32);

        $documentFile = $request->file('documento');
        $documentFileName = $documentFile->hashName();
        $documentFile->storeAs('invoices', $documentFileName);

        $payload['documento'] = $documentFileName;
        $payload['numero_factura'] = $numeroFactura;

        $user = Auth::user();

        if ($user !== null && $user instanceof User) {
            $user->invoices()->create($payload);
            return redirect()->route('invoices.index')->with('success', 'Se creo la factura correctamente');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
