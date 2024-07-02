<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use App\Models\Invoice;
use App\Models\MetodoPago;
use App\Models\Pago;
use App\Models\User;
use App\Notifications\InvoicePaid;
use App\Notifications\PayUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
     * Store a newly created resource in storage.
     */
    public function store(StorePagoRequest $request)
    {
        $payload = $request->validated();

        $comprobanteFile = $request->file('comprobante');
        $comprobanteFileName = $comprobanteFile->hashName();
        $comprobanteFile->storeAs('comprobantes', $comprobanteFileName);

        $payload['comprobante'] = $comprobanteFileName;

        $invoice = Invoice::where('id', $payload['invoice_id'])->first();

        $this->authorize('view', $invoice); // todo change this policie for anyone more especific

        Pago::create($payload);

        $invoice->update([ 'estado' => 'REVISION' ]);

        $administradores = User::whereHas('roles', function ($query) {
            $query->where('name', 'administrador');
        })->get();
        foreach ($administradores as $administrador) {
            $administrador->notify(new InvoicePaid($invoice));
        }

        return redirect()->route('pagos.index')->with('success', 'Pago realizado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        $payload = $request->validated();

        if($request->hasFile('comprobante')) {
            Storage::delete($pago->comprobante);
            $comprobanteFile = $request->file('comprobante');
            $comprobanteFileName = $comprobanteFile->hashName();
            $comprobanteFile->storeAs('comprobantes', $comprobanteFileName);

            $payload['comprobante'] = $comprobanteFileName;
        }

        $pago->update($payload);

        $pago->invoice->update([ 'estado' => 'REVISION' ]);

        $administradores = User::whereHas('roles', function ($query) {
            $query->where('name', 'administrador');
        })
        ->get();

        foreach ($administradores as $administrador) {
            $administrador->notify(new PayUpdated($pago->invoice));
        }

        return redirect()->route('pagos.index')->with('success', 'Se actualizó la información del pago correctamente.');
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

    public function updatePay(Invoice $invoice) {
        $invoice->load('pago');
        $this->authorize('update', $invoice);
        $metodos_pago = MetodoPago::all();
        return view('pagos.edit', compact('invoice', 'metodos_pago'));
    }
}
