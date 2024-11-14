@extends('layouts.dashboard')
@section('title', 'Importar excel')
@section('content')
<h1 class="mt-4 fs-4">
  <i class="fa fa-handshake fa-sm"></i>
  Importar afiliados
</h1>
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{ route('afiliados.index') }}">Afiliados</a></li>
  <li class="breadcrumb-item active">Importar excel</li>
</ol>

<div class="card mb-4">
  <div class="card-header">
    <p class="mb-0">Importar excel</p>
  </div>
  <div class="card-body">
    <a class="btn btn-primary mb-3" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      <i class="fa fa-info-circle"></i>
      Leer instrucciones
  </a>
  <div class="collapse" id="collapseExample">
    <div class="alert alert-info">
      <p>El archivo Excel debe seguir el siguiente formato para asegurar una correcta importación de los datos.</p>
  
      <table class="table table-sm table-bordered border-dark">
          <thead>
              <tr>
                  <th>Columna</th>
                  <th>Descripción</th>
                  <th>Tipo de Dato</th>
                  <th>Ejemplo</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>name</td>
                  <td>Nombre completo de la persona o empresa.</td>
                  <td>Texto</td>
                  <td>Antonio Mar</td>
              </tr>
              <tr>
                  <td>email</td>
                  <td>Correo electrónico de contacto.</td>
                  <td>Texto (formato de correo)</td>
                  <td>amazzoneb@gmail.com</td>
              </tr>
              <tr>
                  <td>anio_fundacion</td>
                  <td>Año de fundación en formato numérico. Usar 0 si no hay dato.</td>
                  <td>Entero (AAAA)</td>
                  <td>1987</td>
              </tr>
              <tr>
                  <td>actividad_id</td>
                  <td>Identificador de la actividad (1 o 2).</td>
                  <td>Entero</td>
                  <td>1</td>
              </tr>
              <tr>
                  <td>razon_social</td>
                  <td>Razón social de la empresa.</td>
                  <td>Texto</td>
                  <td>Agua Mineral</td>
              </tr>
              <tr>
                  <td>rif</td>
                  <td>Registro de información fiscal.</td>
                  <td>Texto (formato J-xxxxxxxx)</td>
                  <td>J-00261969-1</td>
              </tr>
              <tr>
                  <td>siglas</td>
                  <td>Siglas de la empresa, o N/A si no aplica.</td>
                  <td>Texto</td>
                  <td>N/A</td>
              </tr>
              <tr>
                  <td>pagina_web</td>
                  <td>URL del sitio web, o N/A si no aplica.</td>
                  <td>Texto (URL)</td>
                  <td>www.ejemplo.com</td>
              </tr>
              <tr>
                  <td>direccion_oficina</td>
                  <td>Dirección de la oficina principal.</td>
                  <td>Texto</td>
                  <td>Ctra. Nacional e/San D</td>
              </tr>
              <tr>
                  <td>ciudad_oficina</td>
                  <td>Ciudad de la oficina principal.</td>
                  <td>Texto</td>
                  <td>Maitana</td>
              </tr>
              <tr>
                  <td>telefono_oficina</td>
                  <td>Teléfono de la oficina principal.</td>
                  <td>Número</td>
                  <td>2123728484</td>
              </tr>
              <tr>
                  <td>direccion_planta</td>
                  <td>Dirección de la planta o sucursal.</td>
                  <td>Texto</td>
                  <td>Zona Industrial G</td>
              </tr>
              <tr>
                  <td>ciudad_planta</td>
                  <td>Ciudad de la planta o sucursal.</td>
                  <td>Texto</td>
                  <td>Guarenas</td>
              </tr>
              <tr>
                  <td>telefono_planta</td>
                  <td>Teléfono de la planta o sucursal.</td>
                  <td>Número</td>
                  <td>2123728484</td>
              </tr>
              <tr>
                  <td>correo_presidente</td>
                  <td>Correo del presidente o representante de la empresa.</td>
                  <td>Texto (formato de correo)</td>
                  <td>correo@ejemplo.com</td>
              </tr>
              <tr>
                  <td>numero_encargado_ws</td>
                  <td>Número de teléfono de WhatsApp del encargado o 0 si no aplica.</td>
                  <td>Número</td>
                  <td>4144667245</td>
              </tr>
          </tbody>
      </table>
  
      <h5>Notas Adicionales</h5>
      <ul>
          <li>Para campos donde no se cuenta con información (por ejemplo, sitio web o correo del presidente), se debe usar <strong>N/A</strong> o <strong>0</strong>, según el tipo de dato.</li>
          <li>Asegurarse de que los correos electrónicos y URLs estén en el formato correcto.</li>
          <li>El archivo debe mantener el orden de las columnas como se muestra arriba para asegurar la correcta importación de los datos.</li>
      </ul>
  
    </div>
  </div>
    <form action="{{ route('afiliados.importExcel') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label class="form-label" for="afiliados">Excel</label>
        <input
          class="form-control"
          type="file"
          name="afiliado"
          id="afiliados"
          required
        >
      </div>
      <button class="btn btn-success" type="submit">Importar excel</button>
    </form>
  </div>
</div>
@endsection