@extends('backend.layout')

@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ayarlar</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Açıklama</th>
                        <th>İçerik</th>
                        <th>Anahtar Değer</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tbody id="sortable">
                    @foreach($data['adminSettings'] as $adminSettings)
                    <tr id="item-{{$adminSettings->id}}">
                        <td>{{$adminSettings->id}}</td>
                        <td class="sortable">{{$adminSettings->settings_description}}</td>
                        <td>
                            @if($adminSettings->settings_type=="file")
                                <img width="100" height="100"
                                     src="/images/settings/{{$adminSettings->settings_value}}" alt="">
                            @else
                                {{$adminSettings->settings_value}}
                            @endif
                        </td>
                        <td>{{$adminSettings->settings_key}}</td>
                        <td width="5"><a href="{{route('settings.Edit',['id'=> $adminSettings->id])}}"><i class="fa
                        fa-pencil-square"></i></a></td>
                        <td width="5">
                            @if($adminSettings->settings_delete)
                            <a href="javascript:void(0)"><i id="{{$adminSettings->id}}" class="fa fa-trash-o"></i></a></td>
                            @endif
                    </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(function(){

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#sortable').sortable({
                revert: true,
                handle: ".sortable",
                stop: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "{{ route('settings.Sortable')}}",
                        success: function (msg) {
                            //console.log(msg);
                            if (msg) {
                                alertify.success("işlem başarılı");
                            } else {
                                alertify.error("işlem başarısız");
                            }
                        }
                    });
                }
            });
            $('#sortable').disableselection();

        });

        $(".fa-trash-o").click(function() {
            destroy_id = $(this).attr('id');

            alertify.confirm('Silmek istediğinize emin misiniz?','Bu işlem geri alınamaz',
                function(){
                    location.href="/ybadmin/ayarlar/sil/"+destroy_id;
                },
                function(){
                    alertify.error('Silme işlemi iptal edildi')
                }
            )
        });
    </script>



@endsection

@section('css')@endsection
@section('js')@endsection
