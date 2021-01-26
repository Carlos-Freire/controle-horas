<?php if (!defined('CONTROLE')) return; ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Cadastro de horas</h3>
  </div>
  <div class="panel-body">
      <form class="myFormValidate" method="post" action="" data-ajax="true">
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
              <input type="date" class="form-control" name="dia" id="dia" placeholder="Informe a data da tarefa..." aria-required="true" required>
          </div>

          <div class="form-group row">
              <div class="col-md-6">
                  <label for="hora_ini">Hora inicial</label>
                  <input type="time" class="form-control" name="hora_ini" id="hora_ini" placeholder="Informe a hora de início..." aria-required="true" required>
              </div>
              <div class="col-md-6">
                  <label for="hora_fim">Hora final</label>
                  <input type="time" class="form-control" name="hora_fim" id="hora_fim" placeholder="Informe a hora de término..." aria-required="true" required>
              </div>
          </div>

          <button type="submit" class="btn btn-success">Salvar</button>
      </form>
  </div>
</div>