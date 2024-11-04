<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAfiliadoRequest;
use App\Http\Requests\UpdateAfiliadoRequest;
use App\Imports\AfiliadoImport;
use App\Models\Actividad;
use App\Models\Afiliado;
use App\Models\MateriaPrima;
use App\Models\Producto;
use App\Models\Servicio;
use App\Models\SolicitudAfiliado;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

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
            ->with('user')
            ->get();
        return view('afiliados.index', compact('afiliados'));
    }

    public function createByExcel() {
        $this->authorize('create', Afiliado::class);
        return view('afiliados.excel');
    }

    public function importExcel() {
        request()->validate([
            'afiliado' => 'required|file|mimes:xlsx,xls,csv'
        ]);
        Excel::import(new AfiliadoImport, request()->file('afiliado'));
        return redirect('/admin')->with('success', 'All good!');
    }

    public function store(StoreAfiliadoRequest $request) {
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

        $data_user = $request->safe()->only([
            'name',
            'email',
            'password'
        ]);

        DB::beginTransaction();
        try {
            # upload image
            if($request->hasFile('brand')) {
                $path = $request->file('brand')->store('public/brands');
                $payload['brand'] = $path;
            }

            # upload files
            if($request->hasFile('rif_path')) {
                $rifDocumentFile = $request->file('rif_path');
                $rifDocumentFileName = $rifDocumentFile->hashName();
                $rifDocumentFile->storeAs('afiliados', $rifDocumentFileName);
                $payload['rif_path'] = $rifDocumentFileName;
            }

            if($request->hasFile('registro_mercantil_path')) {
                $registroMercantilFile = $request->file('registro_mercantil_path');
                $registroMercantilFileName = $registroMercantilFile->hashName();
                $registroMercantilFile->storeAs('afiliados', $registroMercantilFileName);
                $payload['registro_mercantil_path'] = $registroMercantilFileName;
            }

            if($request->hasFile('estado_financiero_path')) {
                $estadoFinanciero = $request->file('estado_financiero_path');
                $estadoFinancieroName = $estadoFinanciero->hashName();
                $estadoFinanciero->storeAs('afiliados', $estadoFinancieroName);
                $payload['estado_financiero_path'] = $estadoFinancieroName;
            }

            $afiliado = Afiliado::create($payload);

            $afiliado->direccion()->create($request->safe()->only([
                'direccion_oficina',
                'ciudad_oficina',
                'telefono_oficina',
                'direccion_planta',
                'ciudad_planta',
                'telefono_planta'
            ]));

            $afiliado->personal()->create($request->safe()->only([
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
                if(!is_numeric($producto_id)) {
                    $producto = Producto::create(['nombre' => $producto_id]);
                    $producto_id = $producto->id;
                }

                $pivot_data[$producto_id] = [
                    'produccion_total_mensual'  => $data_productos['produccion_total_mensual'][$key],
                    'porcentage_exportacion'    => $data_productos['porcentage_exportacion'][$key],
                    'mercado_exportacion'       => $data_productos['mercado_exportacion'][$key]
                ];
            }
            $afiliado->productos()->attach($pivot_data);

            foreach($request->input('servicios') as $servicio) {
                if(is_numeric($servicio)) {
                    $afiliado->servicios()->attach($servicio);
                } else {
                    $newServicio = Servicio::create(['nombre_servicio' => $servicio]);
                    $afiliado->servicios()->attach($newServicio->id);
                }
            }

            foreach($request->input('materias_primas') as $materia) {
                if(is_numeric($materia)) {
                    $afiliado->materias_primas()->attach($materia);
                } else {
                    $newMateria = MateriaPrima::create(['materia_prima' => $servicio]);
                    $afiliado->materias_primas()->attach($newMateria->id);
                }
            }

            $afiliado->referencias()->attach($request->input('afiliados'));

            DB::commit();

            return redirect()
                ->route('afiliados.index')
                ->with('success', 'Se creó correctamente el afiliado.');
        } catch (Exception $e) {
            return $e;
            DB::rollback();
            return redirect()->back()->with('error', 'Error al crear la cuenta.');
        }
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

    public function create()
    {
        $actividades = Actividad::all();
        $productos = Producto::all();
        $materias_primas = MateriaPrima::all();
        $servicios = Servicio::all();
        $afiliados = Afiliado::all();
        $afiliado = new Afiliado();
        $solicitud = new SolicitudAfiliado();
        return view('afiliados.create', compact(
            'actividades',
            'productos',
            'materias_primas',
            'servicios',
            'afiliados',
            'afiliado',
            'solicitud'
        ));
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
            if($afiliado->brand && Storage::fileExists($afiliado->brand)) {
                Storage::delete($afiliado->brand);
            }
            $path = $request->file('brand')->store('public/brands');
            $payload['brand'] = $path;
        }

        # upload files
        if($request->hasFile('rif_path')) {
            if($afiliado->rif_path && Storage::fileExists('afiliados/' . $afiliado->rif_path)) {
                Storage::delete('afiliados/' . $afiliado->rif_path);
            }
            $rifDocumentFile = $request->file('rif_path');
            $rifDocumentFileName = $rifDocumentFile->hashName();
            $rifDocumentFile->storeAs('afiliados', $rifDocumentFileName);
            $payload['rif_path'] = $rifDocumentFileName;
        }

        if($request->hasFile('registro_mercantil_path')) {
            if($afiliado->registro_mercantil_path && Storage::fileExists('afiliados/' . $afiliado->registro_mercantil_path)) {
                Storage::delete('afiliados/' . $afiliado->registro_mercantil_path);
            }
            $registroMercantilFile = $request->file('registro_mercantil_path');
            $registroMercantilFileName = $registroMercantilFile->hashName();
            $registroMercantilFile->storeAs('afiliados', $registroMercantilFileName);
            $payload['registro_mercantil_path'] = $registroMercantilFileName;
        }

        if($request->hasFile('estado_financiero_path')) {
            if($afiliado->estado_financiero_path && Storage::fileExists('afiliados/' . $afiliado->estado_financiero_path)) {
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
            if(!is_numeric($producto_id)) {
                $producto = Producto::create(['nombre' => $producto_id]);
                $producto_id = $producto->id;
            }
            $pivot_data[$producto_id] = [
                'produccion_total_mensual'  => $data_productos['produccion_total_mensual'][$key],
                'porcentage_exportacion'    => $data_productos['porcentage_exportacion'][$key],
                'mercado_exportacion'       => $data_productos['mercado_exportacion'][$key]
            ];
        }
        $afiliado->productos()->sync($pivot_data);
        
        $serviciosIds = [];
        foreach ($request->input('servicios') as $servicio) {
            if (is_numeric($servicio)) {
                $serviciosIds[] = $servicio; // Añade los serviciosIds existentes al array
            } else {
                $newServicio = Servicio::create(['nombre_servicio' => $servicio]);
                $serviciosIds[] = $newServicio->id; // Añade el ID del nuevo servicio creado al array
            }
        }
        $afiliado->servicios()->sync($serviciosIds);

        $materiasIds = [];
        foreach ($request->input('materias_primas') as $servicio) {
            if (is_numeric($servicio)) {
                $materiasIds[] = $servicio; // Añade los materiasIds existentes al array
            } else {
                $newMateria = MateriaPrima::create(['materia_prima' => $servicio]);
                $materiasIds[] = $newMateria->id; // Añade el ID del nuevo servicio creado al array
            }
        }
        $afiliado->materias_primas()->sync($materiasIds);
        
        $afiliado->referencias()->sync($request->input('afiliados'));

        return request()->user()->afiliado
            ? redirect()->route('business.show')->with('success', 'Se guardó tu información')
            : redirect()->route('afiliados.index')->with('success', 'Se actualizó la información del afiliado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Afiliado $afiliado)
    {
        // return $afiliado->toArray();
        $afiliado->delete();

        return redirect()
            ->route('afiliados.index')
            ->with('success', 'Se eliminó el afiliado correctamente.');
    }

    public function trash() {
        $this->authorize('viewTrash', Afiliado::class);
        $afiliados = Afiliado::onlyTrashed()
            ->latest()
            ->get();
        return view('afiliados.trash', compact('afiliados'));
    }

    public function restore($id) {
        $afiliado = Afiliado::withTrashed()->find($id);
        $afiliado->restore();
        return redirect()
            ->route('afiliados.trash')
            ->with('success', 'Se restauró el afiliado correctamente');
    }
}
