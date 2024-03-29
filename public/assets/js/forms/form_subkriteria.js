$(document).ready(function(){
    var form_data = <?= $form_data ?>;
    var edited_data = <?= $form_cache ?>;
    var formid = form_data.formid;
    var components = {
        form: $("#" + formid),
        method: $("#method"),
        id: $('#id'),
        subkriteria: $('#subkriteria')
    };

    _persiapan_data().then(data => {
        _add_event_listener(data);
        _persiapan_nilai(data);
    
    });
   



    async function _persiapan_data(){
        var data = {};
       
        return data;
    }


    function _add_event_listener(data){

    }


    function _persiapan_nilai(data){
        console.log(edited_data);
        if(form_data.mode == 'edit' && edited_data){
            components.method.val('update');
            components.id.val(edited_data.id);
            components.subkriteria.val(edited_data.nama);
        }else if(form_data.mode == 'baru'){
            components.method.val('POST');
        }
    }

});