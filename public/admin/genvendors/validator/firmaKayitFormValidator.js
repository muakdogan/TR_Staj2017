var count = 0;
var count_for_header = 5;




$('#custom-headers').multiSelect({
    selectableHeader: "</i><input type='text'  class='search-input col-sm-12 search_icon' autocomplete='off' placeholder='Sektör Seçiniz'></input>",
    selectionHeader: "<p id = 'sektor_count' style='font-size:12px;color:red'>Max '"+count_for_header+"' sektör seçebilirsiniz</p>",
    afterInit: function(ms){
      var that = this,
          $selectableSearch = that.$selectableUl.prev(),
          $selectionSearch = that.$selectionUl.prev(),
          selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
          selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

      that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
      .on('keydown', function(e){
        if (e.which === 40){
          that.$selectableUl.focus();
          return false;
        }
      });

    },

    afterSelect: function(values){
      count++;


      if(count>5){
          $('#custom-headers').multiSelect('deselect', values);

      }else{
          count_for_header--;

      }
      $("#sektor_count").text("Max '"+count_for_header+"' sektör seçebilirsiniz");
      this.qs1.cache();



    },

    afterDeselect: function(values){
      count--;
      if(count!=5){
        count_for_header++;
        $("#sektor_count").text("Max '"+count_for_header+"' sektör seçebilirsiniz");
      }

      this.qs1.cache();
    }

});

$('#il_id').on('change', function (e) {
    console.log(e);


    var il_id = e.target.value;
    //ajax

    $.get("{{route('ajax-subcat?il_id=')}}"+il_id, function (data) {
        //success data
        //console.log(data);

        beforeSend:( function(){
            $('.ajax-loader').css("visibility", "visible");
        });

        $('#ilce_id').empty();
         $('#ilce_id').append('<option value="" selected disabled> Seçiniz </option>');
        $.each(data, function (index, subcatObj) {
            $('#ilce_id').append('<option value="' + subcatObj.id + '">' + subcatObj.adi + '</option>');
        });
    }).done(function(data){

          $('.ajax-loader').css("visibility", "visible");
        }).fail(function(){
           alert('İller Yüklenemiyor !!!  ');
        });
});


$('#ilce_id').on('change', function (e) {
    console.log(e);

    var ilce_id = e.target.value;

    //ajax

    $.get("{{asset('ajax-subcatt?ilce_id=')}}"+ ilce_id, function (data) {

        beforeSend:( function(){
            $('.ajax-loader').css("visibility", "visible");

        });

        $('#semt_id').empty();
        $('#semt_id').append('<option value="" selected disabled>Seçiniz </option>');
        $.each(data, function (index, subcatObj) {
            $('#semt_id').append('<option value="' + subcatObj.id + '">' + subcatObj.adi + '</option>');
        });
    }).done(function(data){

          $('.ajax-loader').css("visibility", "hidden");
        }).fail(function(){
           alert('İller Yüklenemiyor !!!  ');
        });
});
