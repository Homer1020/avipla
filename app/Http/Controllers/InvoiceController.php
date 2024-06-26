<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\Invoice;
use App\Models\User;
use App\Notifications\InvoiceCreated;
use App\Notifications\InvoiceStatusChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Invoice::class, 'invoice');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('pago')->latest()->get();
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
            'afiliado_id'       => 'required|numeric|exists:afiliados,id',
            'monto_total'       => 'required|numeric',
            'numero_factura'    => 'required|numeric|unique:invoices,numero_factura',
            'documento'         => 'required|file|mimes:pdf'
        ]);

        $codigo_factura = Str::random(32);

        $documentFile = $request->file('documento');
        $documentFileName = $documentFile->hashName();
        $documentFile->storeAs('invoices', $documentFileName);

        $payload['documento'] = $documentFileName;
        $payload['codigo_factura'] = $codigo_factura;

        $user = Auth::user();

        if ($user !== null && $user instanceof User) {
            $invoice = $user->invoices()->create($payload);
            $invoice->afiliado->user->notify(new InvoiceCreated($invoice));
            return redirect()->route('invoices.index')->with('success', 'Se creo la factura correctamente');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load(['user', 'afiliado', 'pago']);
        return view('invoices.show', compact('invoice'));
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
        $invoice->estado = $request->input('invoice_status');
        $invoice->observaciones = $request->input('observaciones');
        $invoice->save();

        $administradores = User::whereHas('roles', function ($query) {
            $query->where('name', 'administrador');
        })
        ->where('id', '!=', $request->user()->id)
        ->get();
        foreach ($administradores as $administrador) {
            $administrador->notify(new InvoiceStatusChange($invoice));
        }
        $invoice->afiliado->user->notify(new InvoiceStatusChange($invoice));
        return redirect()->route('invoices.index', $invoice)->with('success', 'Se actualizo el estado de la factura.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
