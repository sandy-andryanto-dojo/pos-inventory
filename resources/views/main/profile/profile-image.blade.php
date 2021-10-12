<div id="crop-avatar">
    <div class="avatar avatar-view text-center">
        <img src="{{ asset(\Auth::User()->getImageProfile()) }}" class="img-circle" alt="profile-image">
        <h1></h1>
        <a href="javascript:void(0);" class="btn btn-success btn-block btn-sm" data-toggle='tooltip' data-placement='top'  data-original-title='Upload'>
            <i class="fa fa-upload"></i>&nbsp; Upload
        </a>
    </div>
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog"  tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {!! Form::open(array('route' => 'upload.user.profile','method'=>'POST','class'=>'avatar-form','id'=>'avatar-form','role'=>'form','enctype'=>'multipart/form-data')) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="avatar-modal-label">Upload Profile Picture</h4>
                </div>
                <div class="modal-body">
                    <div class="avatar-body">

                        <!-- Upload image and data -->
                        <div class="avatar-upload text-left">
                            <input type="hidden" class="avatar-src" name="avatar_src">
                            <input type="hidden" class="avatar-data" name="avatar_data">
                            <input type="file" class="avatar-input file-input" id="avatarInput" name="avatar_file" accept="image/x-png,image/gif,image/jpeg">
                        </div>

                         <!-- Crop and preview -->
                         <div class="row">
                            <div class="col-md-9">
                                <div class="avatar-wrapper"></div>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg"></div>
                                <div class="avatar-preview preview-md"></div>
                                <div class="avatar-preview preview-sm"></div>
                            </div>
                        </div>

                        <div class="row avatar-btns">
                            <div class="col-md-9 text-left">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm" data-method="rotate" data-option="-90" title="Rotate -90 degrees">Rotate Left</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-method="rotate" data-option="-15">-15deg</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-method="rotate" data-option="-30">-30deg</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-method="rotate" data-option="-45">-45deg</button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm" data-method="rotate" data-option="90" title="Rotate 90 degrees">Rotate Right</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-method="rotate" data-option="15">15deg</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-method="rotate" data-option="30">30deg</button>
                                    <button type="button" class="btn btn-primary btn-sm" data-method="rotate" data-option="45">45deg</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-block avatar-save btn-sm">
                                    <i class="fa fa-check"></i>&nbsp;Finish & Save
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</div>