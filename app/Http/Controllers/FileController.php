<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\Invoice;
use App\Models\Pago;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function getFile(string $dir, string $path) {
        # authorizarions
        if($dir === 'comprobantes') {
            $pago = Pago::where('comprobante', $path)->first();
            $this->authorize('view', $pago);
        }

        if($dir === 'invoices') {
            $invoice = Invoice::where('invoice_path', $path)->first();
            $this->authorize('view', $invoice);
        }

        if($dir === 'afiliados') {
            $afiliado = Afiliado::where('rif_path', $path)->orWhere('estado_financiero_path', $path)->orWhere('registro_mercantil_path', $path)->first();
            if(!request()->user()->afiliado || request()->user()->afiliado->id !== $afiliado->id) {
                $this->authorize('view', $afiliado);
            }
        }

        function mapExtensionToContentType(string $extension): string
        {
            $mappings = [
                'png' => 'image/png',
                'jpg' => 'image/jpeg',
                'pdf' => 'application/pdf',
                'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'xlsx' => 'application/vnd.openxmlformats-officedocedocument.spreadsheetml.sheet',
            ];
        
            return $mappings[$extension] ?? 'application/octet-stream';
        }

        $file = Storage::get($dir . '/' . $path);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $contentType = mapExtensionToContentType($extension);
        $response = response()->make($file, 200);
        $response->header('Content-Type', $contentType);
        return $response;
    }
}
