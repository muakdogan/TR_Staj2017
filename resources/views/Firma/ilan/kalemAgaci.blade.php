<div class="modal fade  m_kalemAgaci" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:800px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel"><img src="{{asset('images/arrow.png')}}">&nbsp;<strong>Kalem Ağacı</strong></h4>
            </div>
            <div class="modal-body">
                   <div class="panel panel-default">
                          <input name="search" placeholder="Filter..." autocomplete="off">
                          <button id="btnResetSearch">&times;</button>
                          <span id="matches"></span>
                          <div class="panel-body ftree">
                              <div id="tree" class="panel-body fancytree-colorize-hover ">
                              </div>
                          </div>
                   </div>
              <input style="float:right" type="button" class="action-button btn" id="tamamBtn" value=" Tamam" />
              <input type="hidden" name="input_mal_id"  id="input_mal_id" value=""><!--hangi inputa atama olacak id-->
              <input type="hidden" name="input_hizmet_id"  id="input_hizmet_id" value=""><!--hangi inputa atama olacak id-->
              <input type="hidden" name="input_goturu_id"  id="input_goturu_id" value=""><!--hangi inputa atama olacak id-->
              <input type="hidden" name="input_yapim_id"  id="input_yapim_id" value=""><!--hangi inputa atama olacak id-->
            </div>
            <br>
            <br>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
