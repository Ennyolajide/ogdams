 @if( session('notification'))
    <!-- .modal -->
    <div class="modal fade" id="notification-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-9 col-sm-9 col-xs-10">
                            <h4 class="text-center {{  session('notification')->status ? 'text-success' : 'text-danger' }}">
                                <i class="block-center
                                    {{ session('notification')->status ? 'fa fa-check' : 'fa fa-exclamation-triangle' }}"></i>
                                &nbsp;&nbsp;
                                <em>{!! session('notification')->message !!}</em>
                            </h4>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-2">
                            <h4 class="text-right text-danger">
                                <button type="button" class="text-danger" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-close text-right"></i>
                                </button>
                            </h4>
                        </div>
                    <div>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
            <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endif
