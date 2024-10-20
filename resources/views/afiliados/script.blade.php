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
  
    // validatet steps
    const validateTab = (tab) => {
      return Array.from(document.getElementById(tab).querySelectorAll('input, select, textarea')).every(item => item.validity.valid)
    }

    const $afiliadoForm = document.getElementById('afiliado-form')
    const $allElements = Array.from($afiliadoForm.elements)
    const buttonsTab = {
      profile: document.getElementById('profile-tab'),
      messages: document.getElementById('messages-tab'),
      final: document.getElementById('final-tab'),
    }

    const toggleTabs = () => {
      if(validateTab('business-data')) {
        buttonsTab.profile.disabled = false
      } else {
        buttonsTab.profile.disabled = true
      }

      if(validateTab('business-data') && validateTab('profile')) {
        buttonsTab.messages.disabled = false
      } else {
        buttonsTab.messages.disabled = false
      }

      if(validateTab('business-data') && validateTab('profile') && validateTab('messages')) {
        buttonsTab.messages.disabled = false
      } else {
        buttonsTab.messages.disabled = false
      }
    }

    $allElements.forEach(element => {
      element.addEventListener('input', toggleTabs)
    })

    validateTab('business-data')
    validateTab('profile')
    validateTab('messages')
  })
</script>