@extends('admin_layout', ['title' => 'Contact'])
@section('content')
<form id="update-user" action="{{action('Admin\ContactController@update')}}"  method="post">
    {{ csrf_field() }}
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <h4 class="page-title">{{trans('message.update')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                <input type="hidden" value="{{$data->id}}" id="id" name="id">
                        <div class="row">
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <label for="title">{{trans('message.title')}}</label>
                                    <input type="text" value="{{$data->title}}" id="title" name="title" class="form-control" />
                                    <label for="number">{{trans('message.phone_call')}}</label>
                                    <input type="text" value="{{$data->number}}" id="number" name="number" class="form-control" />
                                    <label for="description">{{trans('message.description_call')}}</label>
                                    <input type="text" value="{{$data->description}}" id="description" name="description" class="form-control" />
                                </div>

                            </div> <!-- end col-->
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-warning waves-effect waves-light m-1" ><i class="fe-check-circle mr-1"></i> {{trans('message.update')}}</button>
                            <button type="button" class="btn btn-light waves-effect waves-light m-1"  onclick="window.location='{{ URL::previous() }}'"><i class="fe-x mr-1"></i>{{trans('message.cancel')}}</button>
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
