<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Pago;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function getFile(string $dir, string $path) {
        $invoice = Invoice::where('documento', $path)->first();
        $pago = Pago::where('comprobante', $path)->first();

        if(!$invoice && $pago) {
            $invoice = $pago->invoice;
        }
        
        $this->authorize('view', $invoice);

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
