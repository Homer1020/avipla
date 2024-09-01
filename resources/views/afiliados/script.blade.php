<script>
  $(document).ready(function() {
    $('#actividad_principal').select2({
      theme: 'bootstrap-5',
      tags: true,
    })

    $('#productos').select2({
      theme: 'bootstrap-5',
      tags: true,
    })

    $('#materias_primas').select2({
      theme: 'bootstrap-5',
      tags: true,
    })

    $('#servicios').select2({
      theme: 'bootstrap-5',
      tags: true,
    })

    $('#afiliados').select2({
      theme: 'bootstrap-5'
    })

    $('#productos').on('select2:select', function(e) {
      const parameter = e.params.data.text

      const newInputProduccionTotalMensual = `
        <div class="row" id="producto-${ parameter.toLowerCase().trim().replace(' ', '-') }">
          <div class="col-12">
            <p class="fw-bold text-uppercase text-muted">
              <small>Detalles de ${parameter}</small>
            </p>
          </div>
          <div class="col-lg-4 mb-3">
            <input
              type="number"
              placeholder="Producción total mensual (TM)"
              name="produccion_total_mensual[]"
              class="form-control"
            />
            <div class="form-text">Producción total mensual (TM)</div>
          </div>
          <div class="col-lg-4 mb-3">
            <input
              type="number"
              placeholder="Porcentaje destinados a exportación"
              name="porcentage_exportacion[]"
              class="form-control"
            />
            <div class="form-text">Porcentaje destinados a exportación</div>
          </div>
          <div class="col-lg-4 mb-3">
            <input
              type="number"
              placeholder="Mercados de importación / exportación"
              name="mercado_exportacion[]"
              class="form-control"
            />
            <div class="form-text">Mercados de importación / exportación</div>
          </div>
        </div>
      `.trim()

      $('#products_details').append(newInputProduccionTotalMensual)
    })

    $('#productos').on('select2:unselect', function (e) {
      const parameter = e.params.data.text
      console.log(parameter.toLowerCase().trim().replace(' ', '-'))
      $(`#producto-${ parameter.toLowerCase().trim().replace(' ', '-') }`).remove()
    });
  })
</script>