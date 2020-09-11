@extends('admin_layout', ['title' => 'ChatFaceBook'])
@section('content')

    <div class="row container" >

        <form id="form1" action="{{action("Admin\CalllogController@index")}}" method="get" class="form-group">
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
                <a class="btn btn-primary" href="{{route('second', ['calllog', 'download'])}}">{{trans('message.download')}}</a>
            </div>
            </div>
        </form>

        <table  class="table table-bordered" style="text-align: center;width: 100%;!important;">
            <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Call id</th>
                <th scope="col">{{trans('message.id_call')}}</th>
                <th scope="col">{{trans('message.location')}}</th>
                <th scope="col">{{trans('message.date')}}</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt = 1; ?>
            @foreach ($data as $item)
                <tr>
                    <th scope="row">{{ $stt++ }}</th>
                    <td>{{$item->call_id}} </td>
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
<script src="{{asset('public/frontend/vendor/jquery/jquery.min.js')}}"></script>
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

