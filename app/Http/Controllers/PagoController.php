<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\MetodoPago;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('afiliado')
            ->whereHas('afiliado', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->latest()->get();
        return view('pagos.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'metodo_pago_id'    => 'numeric|required|exists:metodos_pago,id',
            'monto'             => 'required|numeric',
            'referencia'        => 'required',
            'comprobante'       => 'file|required|mimes:pdf,png,jpg,jpeg',
            'invoice_id'        => 'numeric|required|exists:invoices,id'
        ]);

        $comprobanteFile = $request->file('comprobante');
        $comprobanteFileName = $comprobanteFile->hashName();
        $comprobanteFile->storeAs('comprobantes', $comprobanteFileName);

        $payload['comprobante'] = $comprobanteFileName;

        $invoice = Invoice::where('id', $payload['invoice_id'])->first();

        $this->authorize('view', $invoice); // todo change this policie for anyone more especific

        Pago::create([
            'metodo_pago_id'    => $payload['metodo_pago_id'],
            'invoice_id'        => $payload['invoice_id'],
            'monto'             => $payload['monto'],
            'referencia'        => $payload['referencia'],
            'comprobante'       => $payload['comprobante'],
        ]);

        $invoice->update([ 'estado' => 'REVISION' ]);

        return redirect()->route('pagos.index')->with('success', 'Pago realizado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        //
    }

    public function invoiceDetails(Invoice $invoice) {
        $this->authorize('view', $invoice);
        return view('pagos.invoice', compact('invoice'));
    }

    public function payInvoice(Invoice $invoice) {
        $this->authorize('view', $invoice);
        $metodos_pago = MetodoPago::all();
        return view('pagos.create', compact('invoice', 'metodos_pago'));
    }
}
