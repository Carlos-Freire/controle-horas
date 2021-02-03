<?php if (!defined('CONTROLE')) return; ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Controle de Horas</h3>
  </div>
  <div class="panel-body">
    <form id="filter-datatables">
      <div class="row">
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="dev2">Desenvolvedor</label>
              <input type="text" class="form-control" name="dev2" id="dev2" placeholder="Coloque o nome do desenvolvedor aqui...">
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="cliente2">Cliente</label>
              <input type="text" class="form-control" name="cliente2" id="cliente2" placeholder="Coloque o nome do cliente aqui...">
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="area2">Área</label>
              <input type="text" class="form-control" name="area2" id="area2" placeholder="Coloque o nome da área aqui...">
            </div>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-12">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#por_data" aria-controls="home" role="tab" data-toggle="tab">Filtrar por data</a></li>
                  <li role="presentation"><a href="#por_periodo" aria-controls="profile" role="tab" data-toggle="tab">Filtrar por período</a></li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="por_data" style="padding: 20px 10px;">
                      <div class="row">
                          <div class="col-sm-12 col-md-4">
                              <div class="form-group">
                                  <label for="dia2">Dia</label>
                                  <input type="date" class="form-control" name="dia2" id="dia2" placeholder="Informe a data da tarefa...">
                              </div>
                          </div>
                          <div class="col-sm-12 col-md-4">
                              <div class="form-group">
                                  <label for="hora_ini2">Hora inicial</label>
                                  <input type="time" min="00:00:00" max="23:59:59" class="form-control" name="hora_ini2" id="hora_ini2">
                              </div>
                          </div>
                          <div class="col-sm-12 col-md-4">
                              <div class="form-group">
                                  <label for="hora_fim2">Hora final</label>
                                  <input type="time" min="00:00:00" max="23:59:59" class="form-control" name="hora_fim2" id="hora_fim2"  placeholder="Informe a hora de término...">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="por_periodo" style="padding: 20px 10px;">
                      <div class="row">
                          <div class="col-sm-12 col-md-4">
                              <div class="form-group">
                                  <label for="de">De</label>
                                  <input type="date" class="form-control" name="de" id="de" placeholder="Informe a data de início...">
                              </div>
                          </div>
                          <div class="col-sm-12 col-md-4">
                              <div class="form-group">
                                  <label for="ate">Até</label>
                                  <input type="date" class="form-control" name="ate" id="ate" placeholder="Informe a data final...">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-12">
            <button type="button" id="search" class="btn btn-primary">Pesquisar</button>
            <button type="button" id="clean" class="btn btn-default">Limpar</button>
        </div>
      </div>
    </form>
    <hr>

    <div class="row mt-5">
        <div class="col-md-12">
            <table id="tabela" style="width:100%" class="table table-striped table-bordered display datatables" data-url="?action=datatables">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Desenvolvedor</th>
                        <th>Cliente</th>
                        <th>Área</th>
                        <th>Dia</th>
                        <th>Hora inicial</th>
                        <th>Hora Final</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Desenvolvedor</th>
                        <th>Cliente</th>
                        <th>Área</th>
                        <th>Dia</th>
                        <th>Hora inicial</th>
                        <th>Hora Final</th>
                    </tr>
                </tfoot>
            </table>
        </div>
      </div>
  </div>
</div>


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modal-form" id="modal-form">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-form-title">Controle de Horas</h4>
      </div>
      <div class="modal-body">
          <?php include 'form.php'; ?>
      </div>
    </div>
  </div>
</div>