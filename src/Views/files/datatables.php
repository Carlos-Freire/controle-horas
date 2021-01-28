<?php if (!defined('CONTROLE')) return; ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Controle de Horas</h3>
  </div>
  <div class="panel-body">
    <form>
      <div class="row">
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="dev2">Desenvolvedor</label>
              <input type="text" class="form-control" id="dev2" placeholder="Coloque o nome do desenvolvedor aqui...">
            </div>
            <div class="form-group">
                <label for="dia2">Dia</label>
                <input type="date" class="form-control" name="dia2" id="dia2" placeholder="Informe a data da tarefa...">
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="cliente2">Cliente</label>
              <input type="text" class="form-control" id="cliente2" placeholder="Coloque o nome do cliente aqui...">
            </div>
            <div class="form-group">
                <label for="hora_ini2">Hora inicial</label>
                <input type="time" min="00:00:00" max="23:59:59" class="form-control" name="hora_ini2" id="hora_ini2">
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="form-group">
              <label for="area2">Área</label>
              <input type="text" class="form-control" id="area2" placeholder="Coloque o nome da área aqui...">
            </div>
            <div class="form-group">
                <label for="hora_fim2">Hora final</label>
                <input type="time" min="00:00:00" max="23:59:59" class="form-control" name="hora_fim2" id="hora_fim2"  placeholder="Informe a hora de término...">
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </div>
      </div>
    </form>
    <hr>

    <div class="row mt-5">
        <div class="col-md-12">
            <table id="example" style="width:100%" class="table table-striped table-bordered display">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Desenvolvedor</th>
                        <th>Cliente/Area</th>
                        <th>Dia</th>
                        <th>Hora inicial</th>
                        <th>Hora Final</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($x=0; $x<100; $x++) { ?>
                    <tr>
                        <td><?php echo $x; ?></td>
                        <td>Rafael</td>
                        <td>
                            <strong>Proped</strong>
                            <p><small>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</small></p>
                        </td>
                        <td>26/07/1983</td>
                        <td>00:00:00</td>
                        <td>18:31:00</td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Desenvolvedor</th>
                        <th>Cliente/Area</th>
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