<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Models\AvisoCobro;
use App\Models\Invoice;
use App\Models\User;
use App\Notifications\InvoiceCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Invoice::class, 'factura');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('avisoCobro')->latest()->get();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $avisosCobro = AvisoCobro::where('estado', 'REVISION')->get();
        return view('invoices.create', compact('avisosCobro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        $payload = $request->validated();

        $codigo_factura = Str::random(32);

        $documentFile = $request->file('invoice_path');
        $documentFileName = $documentFile->hashName();
        $documentFile->storeAs('invoices', $documentFileName);

        $payload['invoice_path'] = $documentFileName;
        $payload['codigo_factura'] = $codigo_factura;

        $user = Auth::user();

        if ($user !== null && $user instanceof User) {
            $invoice = $user->invoices()->create($payload);
            $AvisoCobro = AvisoCobro::where('id', $payload['aviso_cobro_id'])->first();
            $AvisoCobro->update([
                'estado' => 'CONCILIADO'
            ]);

            # Send notifications
            $administradores = User::whereHas('roles', function ($query) {
                $query->where('name', 'administrador');
            })
            ->where('id', '!=', $request->user()->id)
            ->get();
            foreach ($administradores as $administrador) {
                $administrador->notify(new InvoiceCreated($invoice));
            }
            $AvisoCobro->afiliado->user->notify(new InvoiceCreated($invoice));

            return response()->json([
                'success'   => true,
                'data'      => [
                    'message'   => 'Se facturó correctamente el pago ' . '#' . $invoice->numero_factura,
                    'invoice'   => $invoice
                ]
            ]);
        }
        
    }

    public function formStore(Request $request) {
        $payload = $request->validate([
            'aviso_cobro_id'    => 'required',
            'monto_total'       => 'required|numeric',
            'observaciones'     => 'nullable',
            'numero_factura'    => 'required|unique:invoices,numero_factura',
            'invoice_path'      => 'required'
        ]);

        $avisoCobro = AvisoCobro::where('id', $payload['aviso_cobro_id'])->first();
        $payload['pago_id'] = $avisoCobro->pago->id;

        $codigo_factura = Str::random(32);

        $documentFile = $request->file('invoice_path');
        $documentFileName = $documentFile->hashName();
        $documentFile->storeAs('invoices', $documentFileName);

        $payload['invoice_path'] = $documentFileName;
        $payload['codigo_factura'] = $codigo_factura;

        $user = Auth::user();

        if ($user !== null && $user instanceof User) {
            $invoice = $user->invoices()->create($payload);
            $avisoCobro->update([
                'estado' => 'CONCILIADO'
            ]);
            return redirect()->route('invoices.index')->with('success', 'Se facturó el recibo correctamente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $factura)
    {
        $factura->load('avisoCobro', 'pago');
        return view('invoices.show', compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        // $previous_state = $invoice->estado;
        $invoice->estado = $request->input('invoice_status');
        $invoice->observaciones = $request->input('observaciones');
        $invoice->save();

        return redirect()->route('invoices.index', $invoice)->with('success', 'Se actualizó el estado de la factura.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
