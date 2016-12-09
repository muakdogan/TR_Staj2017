function(){
                function silme(name){                        
                        alert('içerde');
                        $('li[name='+name+']').remove();
                        if(name == "tarım" || name == "hizmet"){
                            $('.checkboxClass[name='+name+']').prop("checked", false);
                            getIlanlar(1);
                        }
                        if(name == "Nakit" || name == "Kredi Kartı" || name == "Havale" || name == "Çek" || name == "Senet"){
                            $('.checkboxClass2[name='+name+']').prop("checked", false);
                            getIlanlar(1);
                        }
                        if(name == "Mal" || name == "Hizmet" || name == "Yapım İşi"){
                            
                            $("#radioDiv input[type='radio']").each(function(){
                                alert($(this).val());
                                $(this).prop('checked', false);
                            });
                            getIlanlar(1);
                        }
                        if(name == "Açık" || name == "Belirli İstekler Arasında" || name == "Başvuru"){
                            
                            $("#radioDiv2 input[type='radio']").each(function(){
                                alert($(this).val());
                                $(this).prop('checked', false);
                                
                            });
                            getIlanlar(1);
                        }
                        if(name == "Birim Fiyatlı" || name == "Götürü Bedel"){
                            
                            $("#radioDiv4 input[type='radio']").each(function(){
                                alert($(this).val());
                                $(this).prop('checked', false);
                                
                            });
                            getIlanlar(1);
                        }
                        if(name.indexOf("başlangıç") != -1){
                            alert("ozge");
                            $(' input[type=date]').each( function resetDate(){
                                if(name.indexOf(this.value) != -1){
                                    this.value = this.defaultValue;
                                }
                            } );
                            getIlanlar(1);
                                            
                        }
                        if(name.indexOf("bitiş") != -1){
                            alert("ezgi");
                            $(' input[type=date]').each( function resetDate(){
                                if(name.indexOf(this.value) != -1){
                                    this.value = this.defaultValue;
                                }
                            } );
                            getIlanlar(1);
                                            
                        }
                        else{
                            $('.mutliSelect input[type="checkbox"]').each(function(){
                                var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').attr('name'),
                                title = $(this).attr('name');
                                if(name == title){
                                    $(this).prop('checked', false);
                                }
                            });
                             getIlanlar(1);
                        }
                    }
                function doldurma(name){
                        var key=0;
                         alert(name);           
                        $("#multisel"+key).empty();
                        var valName="'"+name+"'";
                        var html = '<li class="li" name="'+name+'"> <p class="pclass "><span title="' + name + '">' + name + '</span> <button onclick=silme("'+name+'")><img src="{{asset('images/kapat.png')}}"></button></p> </li>';
                        alert(name);
                        $("#multiSel"+key).append(html);                                     
                }
                $('#button').click(function(){
                    getIlanlar(1);
                });
                $('#il_id').change(function(){
                    var il = new Array();
                    var n = jQuery('.mutliSelect input[type="checkbox"]').length;
                    if (n > 0){
                        jQuery('.mutliSelect input[type="checkbox"]:checked').each(function(){
                        il.push($(this).val());
                        });
                    }
                    getIlanlar(1);
                    doldurma(il);
                });
                $('#baslangic_tarihi').change(function(){
                    var bas=$('#baslangic_tarihi').val()+"başlangıç";
                    getIlanlar(1);
                    doldurma(bas);
                    });
                $('#bitis_tarihi').change(function(){
                    var bit=$('#bitis_tarihi').val()+"bitiş";
                    getIlanlar(1);
                    doldurma(bit);
                });
                $('.tur').click(function(){
                    var tur=$("#radioDiv input[type='radio']:checked").val();
                    getIlanlar(1);
                    doldurma(tur);
                });
                $('.usul').click(function(){
                    var usul=$("#radioDiv2 input[type='radio']:checked").val();
                    getIlanlar(1);
                    doldurma(usul);
                });
                $('.sozlesme').click(function(){
                    var sozlesme=$("#radioDiv4 input[type='radio']:checked").val();
                    getIlanlar(1);
                    doldurma(sozlesme);
                });
                var odeme = new Array();
                $('.checkboxClass2').click(function(){
                    var sonSecilen;
                    var n = jQuery('.checkboxClass2:checked').length;
                    if (n > 0){
                        jQuery('.checkboxClass2:checked').each(function(){
                            sonSecilen = $(this).attr('name');
                            if(jQuery.inArray(sonSecilen, odeme) === -1){
                            console.log(sonSecilen);
                            odeme.push(sonSecilen);
                            return false;
                            }
                        });

                    }
                    getIlanlar(1);
                    doldurma(sonSecilen);
                });
                var sektor = new Array();
                $('.checkboxClass').click(function(){
                    var sonSecilen;
                    var n = jQuery('.checkboxClass:checked').length;
                        if (n > 0){
                            jQuery('.checkboxClass:checked').each(function(){
                            sonSecilen = $(this).attr('name');
                            if(jQuery.inArray(sonSecilen, sektor) === -1){
                                sektor.push(sonSecilen);
                                return false;
                            }
                            });
                        console.log(sonSecilen);
                    }
                    getIlanlar(1);
                    doldurma(sonSecilen);
                });
                $(".dropdown dt a").on('click', function() {
                    $(".dropdown dd ul").slideToggle('fast');
                });

                $(".dropdown dd ul li a").on('click', function() {
                    $(".dropdown dd ul").hide();
                });

                function getSelectedValue(id) {
                    return $("#" + id).find("dt a span.value").html();
                }

                $(document).bind('click', function(e) {
                    var $clicked = $(e.target);
                    if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
                });

                $('.mutliSelect input[type="checkbox"]').on('click', function() {
                    var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').attr('name'),
                      title = $(this).attr('name');

                    if ($(this).is(':checked')) {
                      var html = '<span title="' + title + '">' + title + '</span>';
                      $('.multiSel').append(html);
                      $(".hida").hide();
                      getIlanlar(1);
                      doldurma(title);
                    } else {
                      $('span[title="' + title + '"]').remove();
                      var ret = $(".hida");
                      $('.dropdown dt a').append(ret);
                    }
                });
                
                $(document).ready(function(){
                    $(document).on('click', '.pagination a', function (e){
                        getIlanlar($(this).attr('href').split('page=')[1]);
                        e.preventDefault();
                    });                    
                });
                
                function getIlanlar(page) {
                    var il_id=$('#il_id').val();
                    var basTar=$('#baslangic_tarihi').val();
                    var bitTar=$('#bitis_tarihi').val();
                    var selectedSektor = new Array();
                    var n = jQuery(".checkboxClass:checked").length;
                    if (n > 0){
                        jQuery(".checkboxClass:checked").each(function(){
                                selectedSektor.push($(this).val());
                                var html = '<span title="' + selectedSektor + '">' + selectedSektor + '</span>';
                            });
                    }
                    var selectedIl = new Array();
                    var n = jQuery('.mutliSelect input[type="checkbox"]').length;
                    if (n > 0){
                        jQuery('.mutliSelect input[type="checkbox"]:checked').each(function(){
                                selectedIl.push($(this).val());
                        });
                    }
                    var selectedOdeme = new Array();
                    var n = jQuery('.checkboxClass2:checked').length;
                    if (n > 0){
                        jQuery('.checkboxClass2:checked').each(function(){
                            selectedOdeme.push($(this).val());
                        });
                    }
                    var selectedTur = "";
                    var selected = $("#radioDiv input[type='radio']:checked");
                    if (selected.length > 0) {
                        selectedTur = selected.val();
                    }
                    var selectedUsul = "";
                    var selected2 = $("#radioDiv2 input[type='radio']:checked");
                    if (selected2.length > 0) {
                        selectedUsul = selected2.val();
                    }
                    var selectedSearch = "";
                    var inputSearch = "";
                    var selected3 = $("#radioDiv3 input[type='radio']:checked");
                    if (selected3.length > 0) {
                        selectedSearch = selected3.val();
                        inputSearch=$('#search').val();
                    }
                    var selectedSozlesme = "";
                    var selected4 = $("#radioDiv4 input[type='radio']:checked");
                    if (selected4.length > 0) {
                        selectedSozlesme = selected4.val();
                    }
                    $.ajax({
                        url : '?page='+page,
                        dataType: 'json',
                        data:{il:selectedIl,bas_tar:basTar,bit_tar:bitTar,sektor:selectedSektor,tur:selectedTur,
                                    usul:selectedUsul,radSearch:selectedSearch,input:inputSearch,odeme:selectedOdeme,
                                    sozles:selectedSozlesme
                        },
                    }).done(function(data){
                        $('.ilanlar').html(data);
                        location.hash = page;
                    }).fail(function(){ 
                        alert('İlanlar Yüklenemiyor !!!  ');
                    });
                }
            });