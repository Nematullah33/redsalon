<!-- <form action="{{url('user/save')}}" method="post"> -->
@extends('layout.erp.home')
@section('content')

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">

            <!-- Page body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <!-- Basic Form Inputs card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5><a href="{{url('product')}}">Manage Mail</a></h5>

                            </div>
                            <div class="card-block">

                                <form action="{{route('send-mail')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Mail To</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='emailRecipient'
                                                class="form-control form-control-round" placeholder="To" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">CC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='emailCc' class="form-control form-control-round"
                                                placeholder="CC">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">BCC</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='emailBcc' class="form-control form-control-round"
                                                placeholder="BCC">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Subject</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='emailSubject' class="form-control form-control-round"
                                                placeholder="Email Subject">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Message</label>
                                        <div class="col-sm-10">
                                            <textarea name="emailBody" id="" cols="50" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Upload File</label>
                                        <div class="col-sm-10">
                                            <input type="file" multiple="multiple" name="emailAttachments[]" class="form-control form-control-round">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-sm-12">
                                            <input type="submit" name='btnMail'
                                                class="form-control form-control-round btn-primary" value='Send Email'>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- Basic Form Inputs card end -->
                    </div>
                </div>
            </div>
            <!-- Page body end -->

        </div>

    </div>
</div>
    <!-- Main-body end -->
    <div id="styleSelector">
    </div>
@endsection