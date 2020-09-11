@extends('admin_layout', ['title' => 'Call'])
@section('content')
<form id="create-menu" action="{{action('Admin\CallController@store')}}"  method="post">
    {{ csrf_field() }}
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <h4 class="page-title">{{trans('message.creat_call')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <label for="projectname">{{trans('message.name_call')}}</label>
                                    <input type="text" id="name" name="name" class="form-control" />
                                    <label for="projectname">{{trans('message.phone_call')}}</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" />
                                    <label for="projectname">{{trans('message.description_call')}}</label>
                                    <input type="text" id="description" name="description" class="form-control" />
                                </div>

                            </div> <!-- end col-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-1" ><i class="fe-check-circle mr-1"></i> {{trans('message.creat_call')}}</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light m-1"  onclick="window.location='{{ URL::previous() }}'"><i class="fe-x mr-1"></i>{{trans('message.cancel')}}</button>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

</div> <!-- container -->

    </form>
@endsection
