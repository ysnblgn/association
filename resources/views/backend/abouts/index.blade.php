@extends('backend.layout')

@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Hakkımızda</h3>

                <div align="right">
                    <a href="{{route('about.create')}}"><button class="btn btn-success">Sayfa Ekle</button></a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Başlık</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tbody id="sortable">
                    @foreach($data['about'] as $about)
                    <tr id="item-{{$about->id}}">
                        <td class="sortable">{{$about->about_title}}</td>
                        <td width="5"><a href="{{route('about.edit',$about->id)}}"><i class="fa
                        fa-pencil-square"></i></a></td>
                        <td width="5">
                            <a href="javascript:void(0)"><i id="{{$about->id}}" class="fa fa-trash-o"></i></a></td>
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
                        url: "{{ route('about.Sortable')}}",
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
                    url:"about/"+destroy_id,
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
