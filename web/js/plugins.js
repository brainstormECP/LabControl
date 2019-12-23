$(document).ready(function(){
    // Multiselect    
    if($("#ms").length > 0)
        $("#ms").multiSelect({
            afterSelect: function(value, text){
                //action
            },
            afterDeselect: function(value, text){
                //action
            }});
    
    
    if($("#appbundle_pastoview_analisis").length > 0){
        $("#appbundle_pastoview_analisis").multiSelect({
            selectableHeader: "<div class='multipleselect-header'>Análisis a seleccionar</div>",
            selectedHeader: "<div class='multipleselect-header'>Análisis seleccionados</div>",
            afterSelect: function(value, text){
                //action
            },
            afterDeselect: function(value, text){
                //action
            }            
        });
        
        $("#ms_select").click(function(){
            $('#appbundle_pastoview_analisis').multiSelect('select_all');
        });
        $("#ms_deselect").click(function(){
            $('#appbundle_pastoview_analisis').multiSelect('deselect_all');
        });        
    }
});




