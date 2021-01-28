<?php if (!defined('CONTROLE')) return; ?>     
      <form class="myFormValidate" id="form-controle" method="post" action="?action=add" data-ajax="true" data-callback="formReload">
          <div class="form-group">
              <label for="dev">Desenvolvedor</label>
              <input type="text" class="form-control" name="dev" id="dev" placeholder="Nome do desenvolvedor..." aria-required="true" required>
          </div>
          <div class="form-group">
              <label for="cliente">Cliente</label>
              <input type="text" class="form-control" name="cliente" id="cliente" placeholder="Nome do cliente..." aria-required="true" required>
          </div>
          <div class="form-group">
              <label for="area">Área</label>
              <textarea class="form-control" cols="10" rows="5" name="area" id="area" placeholder="Descreva o que você realizou nessa tarefa..." aria-required="true" required></textarea>
          </div>
          <div class="form-group">
              <label for="dia">Dia</label>
              <input type="date" value="<?php escape_echo($vars['dia']); ?>" class="form-control" name="dia" id="dia" placeholder="Informe a data da tarefa..." aria-required="true" required>
          </div>

          <div class="form-group row">
              <div class="col-md-6">
                  <label for="hora_ini">Hora inicial</label>
                  <input type="time" value="<?php escape_echo($vars['hora_ini']); ?>" min="00:00:00" max="23:59:59" class="form-control" name="hora_ini" id="hora_ini" placeholder="Informe a hora de início..." aria-required="true" required>
              </div>
              <div class="col-md-6">
                  <label for="hora_fim">Hora final</label>
                  <input type="time" value="<?php escape_echo($vars['hora_fim']); ?>" min="00:00:00" max="23:59:59" class="form-control" name="hora_fim" id="hora_fim"  placeholder="Informe a hora de término..." aria-required="true" required>
              </div>
          </div>

          <button type="submit" class="btn btn-success">Salvar</button> <span class="hidden send-form"><i class="fa fa-refresh fa-spin fa-2x fa-fw"></i></span>
      </form>
<script>
    function addZero(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    };

    function formReload()
    {
        var date = new Date;
        var seconds = addZero(date.getSeconds());
        var minutes = addZero(date.getMinutes());
        var hour = addZero(date.getHours());
        var value = hour + ':' + minutes + ':' + seconds;

        $('#form-controle')[0].reset();
        $('#hora_ini').val(value);
        $('#hora_fim').val(value);

        $('#modal-form').modal('hide');
    }
</script>