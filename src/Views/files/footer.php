<?php if (!defined('CONTROLE')) return; ?>
</div>
</div>
<!-- /container -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_pt_BR.min.js" integrity="sha512-+FCfxJrlkCXOsuGOQ48Dc2at83izZqTjDgLjUWD5VhRZe6AHkIWy4EvmcVEir4xNGTZ0g8Au3fyV3NbkbVJvIA==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="../controle-horas/assets/js/form.js"></script>
<script src="../controle-horas/assets/js/datatable.js"></script>
<script>
$(document).ready(function() {
    $('#clean').on('click', function(e) {
        e.preventDefault();
        window.datatableApp.clean();
    });
    $('#search').on('click', function(e) {
        e.preventDefault();
        window.datatableApp.search();
    });
});
</script>
</body>
</html>