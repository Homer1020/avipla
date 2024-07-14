<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAfiliadoRequest;
use App\Models\Actividad;
use App\Models\Afiliado;
use App\Models\MateriaPrima;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\SolicitudAfiliado;
use Illuminate\Support\Facades\Storage;

class AfiliadosController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Afiliado::class, 'afiliado');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $afiliados = Afiliado::latest()
            ->get();
        return view('afiliados.index', compact('afiliados'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Afiliado $afiliado)
    {
        $afiliado->load([
            'user',
            'direccion',
            'productos',
            'materias_primas',
            'servicios',
            'referencias',
            'personal',
            'actividad'
        ]);
        return view('afiliados.show', compact('afiliado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Afiliado $afiliado)
    {
        $actividades = Actividad::all();
        $productos = Producto::all();
        $materias_primas = MateriaPrima::all();
        $servicios = Servicio::all();
        $afiliados = Afiliado::where('id', '!=', $afiliado->id)->get();
        $afiliado->load([
            'direccion',
            'personal',
            'productos',
            'materias_primas',
            'servicios'
        ]);
        return view('afiliados.edit', compact(
            'afiliado',
            'actividades',
            'productos',
            'materias_primas',
            'servicios',
            'afiliados'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAfiliadoRequest $request, Afiliado $afiliado)
    {
        $payload = $request->safe()->only([
            'razon_social',
            'rif',
            'anio_fundacion',
            'capital_social',
            'pagina_web',
            'actividad_id',
            'relacion_comercio_exterior',
            'correo',
            'siglas'
        ]);

        if($request->hasFile('brand')) {
            if(Storage::fileExists($afiliado->brand)) {
                Storage::delete($afiliado->brand);
            }
            $path = $request->file('brand')->store('public/brands');
            $payload['brand'] = $path;
        }

        # upload files
        if($request->hasFile('rif_path')) {
            if(Storage::fileExists('afiliados/' . $afiliado->rif_path)) {
                Storage::delete('afiliados/' . $afiliado->rif_path);
            }
            $rifDocumentFile = $request->file('rif_path');
            $rifDocumentFileName = $rifDocumentFile->hashName();
            $rifDocumentFile->storeAs('afiliados', $rifDocumentFileName);
            $payload['rif_path'] = $rifDocumentFileName;
        }

        if($request->hasFile('registro_mercantil_path')) {
            if(Storage::fileExists('afiliados/' . $afiliado->registro_mercantil_path)) {
                Storage::delete('afiliados/' . $afiliado->registro_mercantil_path);
            }
            $registroMercantilFile = $request->file('registro_mercantil_path');
            $registroMercantilFileName = $registroMercantilFile->hashName();
            $registroMercantilFile->storeAs('afiliados', $registroMercantilFileName);
            $payload['registro_mercantil_path'] = $registroMercantilFileName;
        }

        if($request->hasFile('estado_financiero_path')) {
            if(Storage::fileExists('afiliados/' . $afiliado->estado_financiero_path)) {
                Storage::delete('afiliados/' . $afiliado->estado_financiero_path);
            }
            $estadoFinanciero = $request->file('estado_financiero_path');
            $estadoFinancieroName = $estadoFinanciero->hashName();
            $estadoFinanciero->storeAs('afiliados', $estadoFinancieroName);
            $payload['estado_financiero_path'] = $estadoFinancieroName;
        }

        $afiliado->update($payload);

        $afiliado->direccion()->update($request->safe()->only([
            'direccion_oficina',
            'ciudad_oficina',
            'telefono_oficina',
            'direccion_planta',
            'ciudad_planta',
            'telefono_planta'
        ]));

        $afiliado->personal()->update($request->safe()->only([
            'correo_presidente',
            'correo_gerente_general',
            'correo_gerente_compras',
            'correo_gerente_marketing_ventas',
            'correo_gerente_planta',
            'correo_gerente_recursos_humanos',
            'correo_administrador',
            'correo_gerente_exportaciones',
            'correo_representante_avipla',
            'numero_encargado_ws'
        ]));

        $data_productos = $request->safe()->only([
            'productos',
            'produccion_total_mensual',
            'porcentage_exportacion',
            'mercado_exportacion'
        ]);

        foreach ($data_productos['productos'] as $key => $producto_id) {
            $pivot_data[$producto_id] = [
                'produccion_total_mensual'  => $data_productos['produccion_total_mensual'][$key],
                'porcentage_exportacion'    => $data_productos['porcentage_exportacion'][$key],
                'mercado_exportacion'       => $data_productos['mercado_exportacion'][$key]
            ];
        }

        $afiliado->productos()->sync($pivot_data);
        $afiliado->servicios()->sync($request->input('servicios'));
        $afiliado->materias_primas()->sync($request->input('materias_primas'));
        $afiliado->referencias()->sync($request->input('afiliados'));

        return request()->user()->is_admin()
        ? redirect()->route('afiliados.index')->with('success', 'Se actualizó la información del afiliado')
        : redirect()->route('business.show')->with('success', 'Se guardó tu información');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Afiliado $afiliado)
    {
        // return $afiliado->toArray();
        $afiliado->update([
            'estado' => 0
        ]);

        return redirect()
            ->route('afiliados.index')
            ->with('success', 'Se eliminó el afiliado correctamente.');
    }
}
