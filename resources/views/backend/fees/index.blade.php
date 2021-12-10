@extends('backend.layout')

@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Aidat Sorgulama</h3>

{{--                <div align="right">--}}
{{--                    <a href="{{route('activity.create')}}"><button class="btn btn-success">Etkinlik Ekle</button></a>--}}
{{--                </div>--}}
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Ad-Soyad</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                    <tbody id="sortable">
                    @foreach($users as $user)
                        <tr id="item-{{$user->id}}">
{{--                            <td class="sortable" width="150"><img width="100" src="/images/users/{{$user->user_file}}" alt=""></td>--}}
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td><a href="{{route('fee.edit',$user->id)}}" class="btn btn-primary">Bilgileri
                                    Getir</a></td>

{{--                            <td width="5"><a href="{{route('user.edit',$user->id)}}"><i class="fa fa-pencil-square"></i></a></td>--}}
{{--                            <td width="5"><a href="javascript:void(0)"><i id="{{$user->id}}" class="fa fa-trash-o"></i></a></td>--}}
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
                        url: "{{ route('activity.Sortable')}}",
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

                    $.ajax({
                        type:"DELETE",
                        url:"activity/"+destroy_id,
                        success: function (msg) {
                            if (msg)
                            {
                                $("#item-"+destroy_id).remove();
                                alertify.success("Silme İşlemi Başarılı");
                            } else {
                                alertify.error("İşlem Tamamlanamadı");
                            }
                        }
                    });
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









