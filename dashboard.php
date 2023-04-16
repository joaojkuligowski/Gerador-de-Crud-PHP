<?php
use App\Helpers\Label;
use App\Crud;
use App\Database;
?>

<div class="user-dashboard">
                    <h1><?php echo Label::get($get_table) ? Label::get($get_table) : 'Dashboard' ?></h1>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12 gutter">
                            <div class="sales">
                                <h2>Veículos</h2>

                                <div class="btn-group">
                                    <h3><?php echo Database::count('veiculos') ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 gutter">
                            <div class="sales">
                                <h2>Motoristas</h2>

                                <div class="btn-group">
                                    <h3><?php echo Database::count('motoristas') ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 gutter">
                            <div class="sales">
                                <h2>Uso de Veículos</h2>

                                <div class="btn-group">
                                    <h3><?php echo Database::count('uso_veiculos') ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<script>
    $(document).ready(function(){
    $('[data-toggle="offcanvas"]').click(function(){
        $("#navigation").toggleClass("hidden-xs");
    });
    });
</script>