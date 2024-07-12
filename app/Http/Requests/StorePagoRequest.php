<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoRequest extends FormRequest
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
        return [
            'metodo_pago_id'    => 'numeric|required|exists:metodos_pago,id',
            'banco_id'          => 'numeric|nullable|exists:bancos,id',
            'tasa'              => 'numeric|nullable',
            'referencia'        => 'nullable|unique:pagos,referencia',
            'monto'             => 'required|numeric',
            'comprobante'       => 'file|required|mimes:pdf,png,jpg,jpeg',
            'aviso_cobro_id'    => 'numeric|required|exists:aviso_cobros,id',
            'fecha_pago'        => 'required|date',
        ];
    }
}
