$(function() {
    $.ajax({
        url: "/labcontrol/web/app_dev.php/reportes/grafica",
        cache: false,
        dataType: "json",
        success: function (data) {
            Morris.Area({
                element: 'morris-area-chart',
                data: data.data,
                xkey: 'period',
                ykeys: ['muestra1', 'muestra2', 'muestra3'],
                labels: ['Muestra 1', 'Muestra 2', 'Muestra 3'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });
        }
    });
});
