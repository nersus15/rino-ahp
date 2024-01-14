$(document).ready(function(){
    $('#next').click(function(){
        buatTampilanHal2();

        $('.hal-1').slideUp();
        $('.hal-2').slideDown('slow');
    });

    $("#back").click(function(){
        $('.hal-2').slideUp();
        $('.hal-1').slideDown('slow');
    });




    function buatTampilanHal2(){
        $("#bobot-kriteria").empty();
        $("#bobot-subkriteria").empty();

        var htmlKriteria = '<h4 class="col-12 mb-3">Isi Bobot Kriteria</h4>';
        var htmlSubKriteria = '<h4 class="col-12 mb-3">Isi Bobot Kriteria</h4>';

        htmlKriteria += '<p clas="col-12">Kode Kriteria Yang Dipilih </p><ul>';
        htmlSubKriteria += '<p clas="col-12">Kode Sub Kriteria Yang Dipilih </p><ul>';

        var selectedKriteria = $("input[name='kriteria']:checked");
        for(let i = 0; i < selectedKriteria.length; i++){
            var nama = $(selectedKriteria[i]).data('text');
            nama = nama.trim();
            htmlKriteria += '<li>K' + (i + 1) + ': ' + nama + '</li>'; 
        }
        htmlKriteria += '</ul>';

        var selectedSubKriteria = $("input[name='subkriteria']:checked");
        for(let i = 0; i < selectedSubKriteria.length; i++){
            var nama = $(selectedSubKriteria[i]).data('text');
            nama = nama.trim();
            htmlSubKriteria += '<li>SK' + (i + 1) + ': ' + nama + '</li>'; 
        }
        htmlSubKriteria += '</ul>';


        var tabelKriteria = '<table><thead><tr><th></th>';
        for(let i = 0; i < selectedKriteria.length; i++){
            tabelKriteria += '<th style="text-align: center">K' + (i + 1) + '</th>'; 
        }
        tabelKriteria += '</tr></thead><tbody>';
        for(let i = 0; i < selectedKriteria.length; i++){
            tabelKriteria += '<tr><td>K' + (i + 1) + "</td>";
            for(let j = 0; j < selectedKriteria.length; j++){
                tabelKriteria += '<td><input id="K'+ (i + 1) + '-' + 'K' + (j + 1)  +'" class="form-control input-kriteria"></td>';
            }
            tabelKriteria += '</tr>';
        }

        tabelKriteria += '</tbody></table>';



       for(let k = 0; k < selectedKriteria.length; k++){
            var tabelSubKriteria = '<p class="col-12"> Untuk Kriteria K' + (k + 1) + '</p><table class="mb-4"><thead><tr><th></th>';
            for(let i = 0; i < selectedSubKriteria.length; i++){
                tabelSubKriteria += '<th style="text-align: center">SK' + (i + 1) + '</th>'; 
            }
            tabelSubKriteria += '</tr></thead><tbody>';
            for(let i = 0; i < selectedSubKriteria.length; i++){
                tabelSubKriteria += '<tr><td>SK' + (i + 1) + "</td>";
                for(let j = 0; j < selectedSubKriteria.length; j++){
                    tabelSubKriteria += '<td><input id="K'+(k + 1)+'-SK'+ (i + 1) + '-' + 'SK' + (j + 1)  +'" class="form-control input-subkriteria"></td>';
                }
                tabelSubKriteria += '</tr>';
            }

            tabelSubKriteria += '</tbody></table>';

            htmlSubKriteria += tabelSubKriteria;
       }


        
        htmlKriteria += tabelKriteria;



       
        
        $("#bobot-kriteria").append(htmlKriteria);
        $("#bobot-subkriteria").append(htmlSubKriteria);

        $("#proses").click(function(){
             // Ambil Bobot Kriteria
            var data = {
                'kriteria': {},
                'subkriteria': {},
                'alternatif': [],
            }
            for(let i = 0; i < selectedKriteria.length; i++){
                for(let j = 0; j < selectedKriteria.length; j++){
                    var key = 'K' + (i + 1) + '-K' + (j + 1);
                    data.kriteria[key] =  parseFloat($("#" + key).val());
                }
            }

            for(let i = 0; i < selectedSubKriteria.length; i++){
            data.alternatif.push('A' + (i + 1));
            }
            
            for(let k = 0; k < selectedKriteria.length; k++){
                var kriteria = 'K' + (k + 1);
                data.subkriteria[kriteria] = {};
                for(let i = 0; i < selectedSubKriteria.length; i++){
                    var key = 'SK' + (i + 1);
                    for(let j = 0; j < selectedSubKriteria.length; j++){
                        var key = 'SK' + (i + 1) + '-SK' + (j + 1);
                        data.subkriteria[kriteria][key] =  parseFloat($("#" + kriteria + '-' + key).val());
                    }
                }
            }

            console.log(data);
            var ahp = Ahp(data);
            var hasil = ahp.proses();
            console.log(hasil);


            renderTabelProse(hasil);
        })
    }

    function renderTabelProse(result){
        $("#hasil-proses").empty();
    }

  

});