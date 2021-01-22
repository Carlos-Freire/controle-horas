<?php if (!defined('CONTROLE')) return; ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Cadastro de horas</h3>
  </div>
  <div class="panel-body">
      <form>
          <div class="form-group">
              <label for="dev">Desenvolvedor</label>
              <input type="text" class="form-control" id="dev" placeholder="Nome do desenvolvedor..." required>
          </div>
          <div class="form-group">
              <label for="cliente">Cliente</label>
              <input type="text" class="form-control" id="cliente" placeholder="Nome do cliente..." required>
          </div>
          <div class="form-group">
              <label for="area">Área</label>
              <textarea class="form-control" cols="10" rows="5" id="area" placeholder="Descreva o que você realizou nessa tarefa..." required></textarea>
          </div>
          <div class="form-group">
              <label for="dia">Dia</label>
              <input type="date" class="form-control" id="dia" placeholder="Informe a data da tarefa..." required>
          </div>

          <div class="form-group row">
              <div class="col-md-6">
                  <label for="hora_ini">Hora inicial</label>
                  <input type="text" class="form-control" id="hora_ini" placeholder="Informe a hora de início..." required>
              </div>
              <div class="col-md-6">
                  <label for="hora_fim">Hora final</label>
                  <input type="text" class="form-control" id="hora_fim" placeholder="Informe a hora de término..." required>
              </div>
          </div>

          <button type="submit" class="btn btn-success">Salvar</button>
      </form>
  </div>
</div>