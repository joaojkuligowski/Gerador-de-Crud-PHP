var getBaseUrl = function() {
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    return baseUrl;
};

const baseUrl = getBaseUrl().split('/')[2];
const basePath = getBaseUrl().split('/')[1];
const baseProtocol = getBaseUrl().split('/')[0];
const url = baseProtocol + '//' + baseUrl + '/' + basePath + 'app/helpers/crud.php';

$(document).ready(function(){
    $('[data-bs-create="modal"]').on('click', function(){
        var formData = $('#create').serializeArray();
        console.log(formData);
        var data = {};
        $(formData).each(function(index, obj){
            data[obj.name] = obj.value || '';
        });

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                data: {
                    tabela: data.table,
                    action: 'create',
                    formData: data
                }
            },
            success: function(response){
                $('#createModal').modal('hide');
                location.reload();
            },
            error: function(response){
                alert('Erro, por favor, verifique as informaçoes');
            }
        });

    });
});
$(document).ready(function(){
    $("#notification").hide();
    $('[data-bs-update="modal"]').on('click', function(){
        var formData = $('#edit').serializeArray();
        var data = {};
        $(formData).each(function(index, obj){
            data[obj.name] = obj.value;
        });
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                data: {
                    tabela: data.table,
                    action: 'update',
                    formData: data
                }
            },
            success: function(response){
                $('#updateModal').modal('hide');
                $('#loader').show();
                setTimeout(function() {
                    $('#loader').hide();
                    $("#notification").show();
                    $('#notification').addClass('show');
                }, 1000);
            }

        });
    });
});
$(document).on('click', '#del', function(){
    var deletebutton = $(this).val();
    var arr = deletebutton.split('|');
    var tabela = arr[0];
    var id = arr[1];
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            data: {
                tabela: tabela,
                action: 'delete',
                formData: {
                    id: id
                }
            }
        },
        success: function(response){
            location.reload();
        }
    });
});
$(document).on('click', '#edit', function(){
    var deletebutton = $(this).val();
    var arr = deletebutton.split('|');
    var tabela = arr[0];
    var id = arr[1];
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            data: {
                tabela: tabela,
                action: 'edit',
                formData: {
                    id: id
                }
            }
        },
        success: function(response){
            console.log(response);
            location.reload();
        }
    });
});
$(document).ready(function(){
    var vehicles = [
        {value: "A", label: "Moto"},
        {value: "B", label: "Carro"},
        {value: "C", label: "Caminhão"},
        {value: "D", label: "Ônibus"}
    ];
    var options = '';
    for(var i = 0; i < vehicles.length; i++){
        options += '<option value="' + vehicles[i].value + '">' + vehicles[i].label + '</option>';
    }
    $('input[name="vehicle_category"]').on('click', function(){
        $('input[name="vehicle_category"]').hide();
        $('input[name="vehicle_category"]').after('<select name="vehicle_category" class="form-control" id="vehicle_category">' + options + '</select>');
    });
});

$(document).ready(function() {
    const $driverInput = $('input[name="driver_id"]');
    const $vehicleInput = $('input[name="vehicle_id"]');

    const $driverSelect = $('<select>', { name: 'driver_id', class: 'form-control' });
    $driverInput.replaceWith($driverSelect);

    const $vehicleSelect = $('<select>', { name: 'vehicle_id', class: 'form-control' });
    $vehicleInput.replaceWith($vehicleSelect);
    const $useDateInput = $('input[name="use_date"]');

    const currentDate = new Date().toISOString().slice(0, 19).replace('T', ' ');
    $useDateInput.val(currentDate);

    $useDateInput.attr('readonly', true);

    $('input[name="vehicle_id"]').hide();

    function updateVehicleSelect(driverId) {
        $.post(url, {
            data: {
                tabela: 'motoristas',
                action: 'query',
                formData: {
                    query: `SELECT cnh_category FROM motoristas WHERE id = ${driverId}`
                }
            }
        })
            .done(function(response) {
                const vehicleCategories = response[0].cnh_category.split(',');
                $.post(url, {
                    data: {
                        tabela: 'veiculos',
                        action: 'query',
                        formData: {
                            query: `SELECT id, plate FROM veiculos WHERE vehicle_category IN ('${vehicleCategories.join("','")}')`
                        }
                    }
                })
                    .done(function(response) {
                        const options = response.map(function(vehicle) {
                            return `<option value="${vehicle.id}">${vehicle.plate}</option>`;
                        });
                        $vehicleSelect.html(options.join('')).val('');
                    })
                    .fail(function() {
                        console.error('Failed to update vehicle select');
                    });
            })
            .fail(function() {
                console.error('Failed to update vehicle categories');
            });
    }

    function updateDriverSelect() {
        $.post(url, {
            data: {
                tabela: 'motoristas',
                action: 'query',
                formData: {
                    query: 'SELECT id, name FROM motoristas'
                }
            }
        })
            .done(function(response) {
                const options = response.map(function(driver) {
                    return `<option value="${driver.id}">${driver.name}</option>`;
                });
                $driverSelect.html(options.join('')).val('');
            })
            .fail(function() {
                console.error('Failed to update driver select');
            });
    }

    $driverSelect.on('change', function() {
        updateVehicleSelect($(this).val());
    });

    updateDriverSelect();
});

$(document).ready(function(){
    var categories = [
        {value: "A", label: "Categoria A"},
        {value: "B", label: "Categoria B"},
        {value: "C", label: "Categoria C"},
        {value: "D", label: "Categoria D"},
    ];
    $('input[name="cnh_category"]').on('click', function(){
            $('input[name="cnh_category"]').after('<select name="cnh_category2" class="form-control" id="cnh_category"></select>');
            $('select[name="cnh_category2"]').select2({
                // esco
                placeholder: 'Selecione as categorias...',
                multiple: true,
                data: categories.map(function(item){
                    return {id: item.value, text: item.label};
                }),
                closeOnSelect: false,
                allowClear: true,
            });

            $('select[name="cnh_category2"]').on('change', function(){
                var selected = $(this).val();
                selected = selected.join(',');
                console.log(selected);
                $('input[name="cnh_category"]').val(selected);
                $('select[name="cnh_category2"]').remove();
            });
        }
    );
});