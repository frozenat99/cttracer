@extends('layouts.app')

@section('includes')

@endsection

@section('style')
 
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 justify-align-center" id="index_content1"> 
        
        <div class="row justify-content-center">
            <div class="col-md-9 bx2 jumbotron">
                @include('inc.messages')
                @if(isset($data) && !is_null($data))
                {!!Form::open(['action' => ['PagesController@appSettingsUpdate',$data->settingID], 'method' => 'POST','class'=>'form1']) !!}
                        <fieldset>
                                <legend class="text-left"><span class="alert bg2">EDIT APPLICATION SETTINGS FORM</span><hr class="my-4"></legend>
                    
                            {{csrf_field()}} 
                        <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="document_folder_link">Documents Folder Link<span class="text-danger">*</span></label>
                                    <input type="url" maxlength="150" class="form-control" placeholder="URL link" name="document_folder_link" autocomplete="Document Link" required="yes" value="{{!is_null(old('document_folder_link')) ? old('document_folder_link') : $data->settingDocLink}}"> 
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="project_archive_folder_link">Project Archive Folder Link<span class="text-danger">*</span></label>
                                    <input type="url" maxlength="150" class="form-control" placeholder="URL link" name="project_archive_folder_link" autocomplete="Document Link" required="yes" value="{{!is_null(old('project_archive_folder_link')) ? old('project_archive_folder_link') : $data->settingProjArcLink}}"> 
                                </div>
                            </div>
        
                            <!-- required fields note -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <span><b>
                                        Note : fields with <span class="text-danger">*</span> are required fields.</b>
                                    </span>
                                </div>
                            </div>
                            <!-- required fields note -->
                    <div class="form-group text-right">
                            <hr class="my-4">
                            <button type="reset" class="btn btn-info btn-lg">
                              <span><i class="fas fa-recycle"></i> Reset Values</span>
                            </button>
                            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#confirm1">
                                <span><i class="far fa-edit"></i> Save Changes</span>
                            </button>
                            <button id="sub2" type="submit" class="btn btn-success btn-lg" style="display:none;">
                        </div>
                    <input type="hidden" name="_method" value="PUT">
                {!!Form::close() !!}
                @else
                <p>No results found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('includes2')
<script type="text/javascript">

$(document).ready(function () {


});

</script>
@endsection