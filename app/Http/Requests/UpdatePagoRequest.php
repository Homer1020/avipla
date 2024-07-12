<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePagoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $pago = $this->route('pago');
        return [
            'metodo_pago_id'    => 'numeric|required|exists:metodos_pago,id',
            'banco_id'          => 'numeric|required|exists:bancos,id',
            'monto'             => 'required|numeric',
            'referencia'        => 'required|unique:pagos,referencia,' . $pago->id,
            'comprobante'       => 'nullable|file|mimes:pdf,png,jpg,jpeg',
            'aviso_cobro_id'    => 'numeric|required|exists:aviso_cobros,id'
        ];
    }
}
