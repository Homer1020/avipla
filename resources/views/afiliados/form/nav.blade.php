<ul class="nav nav-tabs nav-fill mb-3" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-target="#business-data"
      type="button" role="tab" aria-controls="home" aria-selected="true">
      <div class="mb-1">
        <i class="fa fa-lg fa-building"></i>
      </div>
      <div>
        Datos de la empresa
      </div>
    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-target="#profile"
      type="button" role="tab" aria-controls="profile" aria-selected="false">
      <div class="mb-1">
        <i class="fa fa-lg fa-cogs"></i>
      </div>
      <div>
        Actividades y personal
      </div>
    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="messages-tab" data-bs-target="#messages"
      type="button" role="tab" aria-controls="messages" aria-selected="false">
      <div class="mb-1">
        <i class="fa fa-lg fa-box"></i>
      </div>
      <div>
        Productos y servicios
      </div>
    </button>
  </li>
  @if(!$afiliado->user)
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="final-tab" data-bs-target="#final"
      type="button" role="tab" aria-controls="final" aria-selected="false">
      <div class="mb-1">
        <i class="fa fa-lg fa-user-plus"></i>
      </div>
      <div>
        Registro de usuario
      </div>
    </button>
  </li>
  @endif
</ul>