;
(function (window, document, $, undefined) {
    'use strict';

    var datatableApp = (function () {

        var $private = {};
        var $public = {};
        var $table;
        var $charts = [];

        $public.init = function() {
            var $tabela = $('#tabela');
            var $url = $tabela.data('url');
            $table = $tabela.DataTable({
                dom: 'Bfrtip',
                "processing": true,
                "serverSide": true,
                "stateSave": true,
                "searching": false,
                "lengthChange": false,
                "select": {
                    style: 'multi'
                },
                "language": {
                    url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                "columns": [
                    {data: 'id', name: 'id'},
                    {data: 'dev', name: 'dev'},
                    {data: 'cliente', name: 'cliente'},
                    {data: 'area', name: 'area'},
                    {data: 'dia', name: 'dia'},
                    {data: 'hora_ini', name: 'hora_ini'},
                    {data: 'hora_fim', name: 'hora_fim'}
                ],
                "ajax": {
                    url: $url,
                    data: function (d) {
                        d.dev = $('#dev2').val(),
                        d.cliente = $('#cliente2').val(),
                        d.area = $('#area2').val(),
                        d.dia = $('#dia2').val(),
                        d.hora_ini = $('#hora_ini2').val(),
                        d.hora_fim = $('#hora_fim2').val(),
                        d.de = $('#de').val(),
                        d.ate = $('#ate').val()
                    }
                },
                buttons: [
                    {
                        text: 'Selecionar Todos',
                        className: 'btn btn-default',
                        action: function () {
                            $table.rows().select();
                        }
                    },
                    {
                        text: 'Remover Seleção',
                        className: 'btn btn-default',
                        action: function () {
                            $table.rows().deselect();
                        }
                    },
                    {
                        text: '<i class="fa fa-plus" aria-hidden="true" title="Adicionar"></i>',
                        className: 'btn btn-default',
                        action: function ( e, dt, node, config ) {
                            $('#modal-form').modal('show');
                        }
                    },
                    {
                        text: '<i class="fa fa-pencil" aria-hidden="true" title="Editar Selecionado"></i>',
                        className: 'btn btn-default',
                        action: function ( e, dt, node, config ) {
                            $private.editar();
                        }
                    },
                    {
                        text: '<i class="fa fa-trash" aria-hidden="true" title="Deletar selecionados"></i>',
                        className: 'btn btn-danger',
                        action: function ( e, dt, node, config ) {
                            $private.deletar();
                        }
                    },
                    {
                        text: '<i class="fa fa-file-pdf-o" aria-hidden="true" title="Gerar PDF"></i>',
                        className: 'btn btn-default',
                        action: function ( e, dt, node, config ) {
                            $.ajax({
                                method: "POST",
                                url: '?action=pdf',
                                data: $('#filter-datatables').serialize(),
                                xhrFields: {
                                    responseType: 'blob'
                                },
                                success: function (data) {
                                    //console.log(data);
                                    var filename = 'report_' + new Date().getTime() + '.pdf';
                                    var a = document.createElement('a');
                                    var url = window.URL.createObjectURL(data, {type: 'application/pdf'});
                                    a.href = url;
                                    a.download = filename;
                                    a.click();
                                }
                            });
                        }
                    },
                    {
                        text: '<i class="fa fa-pie-chart" aria-hidden="true" title="Gerar Gráfico"></i>',
                        className: 'btn btn-default',
                        action: function ( e, dt, node, config ) {

                            for(var c in $charts) {
                                $charts[c].destroy();
                            }

                            $.ajax({
                                method: "POST",
                                url: '?action=chart',
                                data: $('#filter-datatables').serialize(),
                                success: function (data) {
                                    //console.log(data);


                                    $private.gerarChart(
                                        'chart01',
                                        'Gráfico de Horas - Desenvolvedores',
                                        data.dev,
                                        'rgba(255, 2, 0, 0.3)'
                                    );

                                    $private.gerarChart(
                                        'chart02',
                                        'Gráfico de Horas - Área',
                                        data.area,
                                        'rgba(0, 139, 0, 0.3)'
                                    );

                                    $private.gerarChart(
                                        'chart03',
                                        'Gráfico de Horas - Cliente',
                                        data.cliente,
                                        'rgba(255, 255, 0, 0.3)'
                                    );
                                    
                                    setTimeout(function() { 
                                        $('#modal-chart').modal('show');
                                    }, 50);
                                }
                            });
                        }
                    },
                ]
            });
        };

        $private.gerarChart = function(chartId, title, data, color) {
            var items = [];
            var hours = [];
            var phrase = [];

            for(var d in data) {
                items[d] = data[d].item;
                hours[d] = data[d].hours;
                phrase[d] = data[d].phrase;
            }

            if(items.length > 0 && hours.length > 0 && phrase.length > 0) {
                var ctx = document.getElementById(chartId);
                var chart = new Chart(ctx, {
                    // The type of chart we want to create
                    type: 'bar',

                    // The data for our dataset
                    data: {
                        labels: items,
                        datasets: [{
                            label: title,
                            backgroundColor: color,
                            borderColor: color,
                            borderWidth: 1,
                            data: hours
                        }]
                    },

                    // Configuration options go here
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    return phrase[tooltipItem.index];
                                }
                            }
                        }
                    }
                });
                $charts.push(chart);
            }
        };

        $private.editar = function() {
            var count = $table.rows( { selected: true } ).count();
            var data = $table.rows( { selected: true } ).data();

            if (count > 1) {
                Swal.fire(
                    'Erro!',
                    'Selecione pelo apenas um item para editar!',
                    'error'
                );
            } else if(count == 0) {
                Swal.fire(
                    'Erro!',
                    'Selecione pelo menos um item para poder editá-lo!',
                    'error'
                );
            } else {
                var $form = $('#form-controle');
                var dataForm = data[0];
                var id = dataForm.id;
                var $newUrl = '?action=edit&id=' + id;

                $form.attr('action',$newUrl);

                $('#dev').val(dataForm.dev);
                $('#cliente').val(dataForm.cliente);
                $('#area').val(dataForm.area);
                $('#dia').val(dataForm.dia);
                $('#hora_ini').val(dataForm.hora_ini);
                $('#hora_fim').val(dataForm.hora_fim);

                $('#modal-form').modal('show');
            }
        };

        $private.deletar = function() {
            var count = $table.rows( { selected: true } ).count();
            var data = $table.rows( { selected: true } ).data();

            if (count == 1) {
                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Este item será excluído do banco para sempre!",
                    icon: 'warning',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: `Sim`,
                    denyButtonText: `Não`
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = data[0].id;
                        $private.ajaxDeletar(id);
                    }
                });

            } else if(count > 1) {
                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Estes itens serão excluídos do banco para sempre!",
                    icon: 'warning',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: `Sim`,
                    denyButtonText: `Não`
                }).then((result) => {
                    if (result.isConfirmed) {
                        var total = count-1;
                        for (var x=0; x<total; x++) {
                            var id = data[x].id;
                            $private.ajaxDeletar(id, false);
                        }
                        window.setTimeout(function() {
                            $table.draw();
                            var data = {result: 'success', message: 'Os registros foram excluídos com sucesso!'};
                            $private.deleteMessage(data);
                        },5000);
                    }
                });
            } else {
                Swal.fire(
                    'Erro!',
                    'Selecione pelo menos um item antes de apertar o botão excluir!',
                    'error'
                );
            }
            //console.log('data', data);
            //console.log('selected', count);
        };

        $private.ajaxDeletar = function(id, showMessage = true) {
            $.ajax({
                method: "GET",
                url: '?action=delete',
                data: {id: id},
                dataType: "json",
                success: function (data) {
                    if (showMessage) {
                        $private.deleteMessage(data);
                    } else {
                        $table.draw();
                    }
                }
            });
        };

        $private.deleteMessage = function(data) {
            if (data.result == 'success') {
                Swal.fire(
                    'Sucesso!',
                    data.message,
                    'success'
                ).then(()=> {
                    $table.draw();
                });
            } else {
                Swal.fire(
                    'Erro!',
                    data.message,
                    'error'
                );
            }
        };

        $public.search = function() {
            $table.draw();
        };

        $public.clean = function() {
            $('#dev2').val('');
            $('#cliente2').val('');
            $('#area2').val('');
            $('#dia2').val('');
            $('#hora_ini2').val('');
            $('#hora_fim2').val('');
            $('#de').val('');
            $('#ate').val('');
            $table.draw();
        };

        return $public;
    })();

    // Global
    window.datatableApp = datatableApp;
    datatableApp.init();

})(window, document, jQuery);
