<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAfiliadoRequest;
use App\Http\Requests\UpdateAfiliadoRequest;
use App\Mail\VerifyAfiliadoEmail;
use App\Models\Actividad;
use App\Models\Afiliado;
use App\Models\MateriaPrima;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\SolicitudAfiliado;
use Illuminate\Support\Facades\Storage;

class AfiliadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicitudes = SolicitudAfiliado::with('afiliado')
            ->where(function ($query) {
                $query
                    ->whereDoesntHave('afiliado')
                    ->orWhereHas('afiliado', function ($query) {
                        $query->where('estado', true);
                    });
            })
            ->latest()
            ->get();
        return view('afiliados.index', compact('solicitudes'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Afiliado $afiliado)
    {
        $afiliado->load([
            'user',
            'invoices',
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

        if($request->hasFile('brand') && Storage::fileExists($afiliado->brand)) {
            Storage::delete($afiliado->brand);
            $path = $request->file('brand')->store('public/brands');
            $payload['brand'] = $path;
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
            'correo_representante_avipla'
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
        ? redirect()->route('afiliados.index')->with('success', 'Se actualizo la información del afiliado')
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
            ->with('success', 'Se elimino el afiliado correctamente.');
    }
}
