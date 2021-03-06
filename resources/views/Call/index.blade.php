@extends('admin_layout', ['title' => 'User'])
@section('content')
 <div class="row">
        <div class="col-sm-4">
            <a href="create" class=" btn btn-success waves-effect waves-success mb-3"><i class="fas fa-plus-square"></i> {{trans('message.creat_call')}} </a>
        </div>


          <table class="table table-bordered">
            <thead>
              <tr>
                <th>STT</th>
                <th scope="col">{{trans('message.name_call')}}</th>
                <th scope="col">{{trans('message.phone_call')}}</th>
                <th scope="col">{{trans('message.description_call')}}</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php $stt = 1; ?>
              @foreach($data as $item)
              <tr>
                <th scope="row">{{ $stt++ }}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->phone_number}}</td>
                <td>{{$item->description}}</td>
                <td><a href="edit/{{$item->id}}" data-toggle="tooltip" title="" class="btn btn-xs  btn-warning" data-original-title="Edit"> <i class="fas fa-edit "></i></a> </td>
                <td><a href="delete/{{$item->id}}" data-toggle="tooltip" title="" class="btn btn-xs btn-danger delete-confirm" data-original-title="Delete"><i class="fas fa-trash-alt"></i></a> </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
@endsection

