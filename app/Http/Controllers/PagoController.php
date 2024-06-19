<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
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
            ->get();
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
        //
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
}
