@extends('admin_layout', ['title' => 'ChatFaceBook'])
@section('content')
<div class="row container">
    <form id="form1" action="{{action("Admin\ChatzalologController@index")}}" method="get" class="form-group">
        <div class="col-md-12" style="display: flex">
            <div class="col-md-6">
                <select id="paginate" class="form-control">
                    <option value="0">--Chọn số trang--</option>
                    <option value="1">10</option>
                    <option value="2">15</option>
                </select>
                <input id="paginator" type="hidden" name="paginator" value="">
            </div>
            <div class="col-md-6">
                <a class="btn btn-primary" href="{{route('second', ['chatzalolog', 'download'])}}">{{trans('message.download')}}</a>
            </div>
        </div>

    </form>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">STT</th>
        <th scope="col">Zalo id</th>
        <th scope="col">Ip</th>
        <th scope="col">{{trans('message.location')}}</th>
        <th scope="col">{{trans('message.date')}}</th>
      </tr>
    </thead>
    <tbody>
      <?php $stt = 1; ?>
      @foreach ($data as $item)
       <tr>
        <th scope="row">{{ $stt++ }}</th>
        <td>{{$item->zalo_id}} </td>
        <td>{{$item->ip}} </td>
        <td>{{$item->location}} </td>
        <td>{{$item->created_at}} </td>
      </tr>
      @endforeach
    </tbody>
  </table>
    <span>{!! $data->render() !!}</span>
</div>
@endsection
<script>
    $(document).ready(function () {
        $("#paginate").change(function () {
            $("select option:selected").each(function () {
                str = $(this).val();
                $("#paginator").val(str);
                var form = $('#form1');
                //$(document.body).append(form);
                form.submit();
            });
        })
    })
</script>

