<div id="searchChangeCodeModal" class="modal" style="display:none">
    <div class="swal2-container swal2-fade swal2-in" style="overflow-y: auto;">
        <div class="swal2-modal swal2-show" style="display: block; width: 600px; padding: 20px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; min-height: 286px;" tabindex="-1">
            <div class="swal2-content" style="display: block;">
                <div class="row formss">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-icon" data-background-color="gray">
                                <i class="material-icons">border_color</i>
                            </div>
                            <div class="card-content">
                                <form id="idFormSchoolEditUser" method="post" enctype="multipart/form-data" action="{{ route('buscar.changecode', ['year' => $params['year'], 'option' => $params['option'], 'search' => $params['search'], 'cicleid' => $params['cicleid']]) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="idCodeAlumn" class="form-control" name="codealumn" type="text" value="">
                                    <input type="hidden" id="idYear" class="form-control" name="year" type="text" value="">
                                    <h4 id="idTitleSearchChangeCodeModal" class="card-title"></h4>
                                    <div class="form-group label-floating is-empty">
                                        <label style="width: 100%; text-align: left; font-size: 11px;">@lang('messages.SearchChangeCodeModalCurrentCode'):</label>
                                        <input id="idCurrentCode" class="form-control" name="currentcode" type="text">
                                        <label style="width: 100%; text-align: left; font-size: 11px;">@lang('messages.SearchChangeCodeModalNewCode'):</label>
                                        <input id="idNewCode" class="form-control" name="newcode" type="text">
                                        <span class="material-input"></span>
                                    </div>
                                    <input type="submit" class="btn btn-success" style="width: 121px" value="{{ __('messages.save') }}">
                                    <input type="button" class="btn btn-danger" style="width: 121px" value="{{ __('messages.cancel') }}" onclick="closeModalLevels()">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>