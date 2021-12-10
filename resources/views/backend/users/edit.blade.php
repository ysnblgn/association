@extends('backend.layout')

@section('content')
    <section class="content-header ">
        <div class="col-md-6 col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Kullanıcı Düzenleme</h3>
                    <div class="box-body">
                        <form action="{{route('user.update',$users->id)}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="">Yüklü Görsel</label>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <img width="100" src="/images/users/{{$users->user_file}}" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Resim Seç</label>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input class="form-control" name="user_file" type="file" multiple>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Ad Soyad</label>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input class="form-control" name="name" type="text"
                                               value="{{$users->name}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Kullanıcı Adı</label>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input class="form-control" name="email" type="email"
                                               value="{{$users->email}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Şifre</label>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input class="form-control" name="password" type="password">
                                        <small>Şifreyi değiştirmek istemiyorsanız boş bırakın!</small>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="">Kullanıcı Rolü</label>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <select name="user_role" class="form-control">
                                            <option {{$users->user_role=="yönetici" ? "selected=''" : ""}}
                                                    value="yönetici">yönetici
                                            </option>
                                            <option {{$users->user_role=="üye" ? "selected=''" : ""}}
                                                    value="üye">üye
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <input type="hidden" name="old_file" value="{{$users->user_file}}">

                                <div align="right" class="box-footer">
                                    <button type="submit" class="btn btn-success">Düzenle</button>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Aidat</h3>
                    <table class="table table-striped">
                        <tr>
                            <th>Ay</th>
                            <th>Yıl</th>
                            <th>Ödeme Durumu</th>
                            <th>Düzenle</th>
                        </tr>
                        @foreach($fees as $fee)
                            <tr>
                                <td>{{$fee->period_month}}</td>
                                <td>{{$fee->period_year}}</td>
                                <td id="{{"td".$fee->id}}">{{$fee->paid_status ? 'ödendi': 'ödenmedi'}}</td>
                                <td><a href="#" class="btn btn-primary fee_update"
                                       element_id="{{$fee->id}}">Düzenle</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!-- Trigger the modal with a button -->
        <button id="btn_modal" hidden data-toggle="modal"
                data-target="#myModal">
        </button>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog" style="margin-top: 25%">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span id="modal_title"></span></h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <label for="cars">Ödeme Durumu</label>

                            <select name="cars" id="che_paid_status">
                                <option value="1">Ödendi</option>
                                <option value="0">Ödenmedi</option>
                            </select>
                            <input type="hidden" id="csrf" value="{{csrf_token()}}">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="status_save" type="button" class="btn btn-default"
                                data-dismiss="modal">Save
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <script>
            $(document).ready(function () {
                var csrf = $('#csrf').val();
                var id = "";
                var paid_status = "";
                $(".fee_update").click(function () {
                    id = $(this).attr('element_id');
                    var title = id + ' id li aidat';

                    $('#modal_title').html(title);
                    $('#btn_modal').trigger('click');

                });

                $("#status_save").click(function () {
                    paid_status = $('#che_paid_status').val();
                    $.ajax({
                        url: "{{route('fee.updated')}}",
                        method: "post",
                        datatype: "json",
                        data: {_token: csrf, paid_status: paid_status, id: id},
                        success: function (response) {
                            if (response.result){

                                var td_id="#td"+id;
                                console.log(paid_status);

                                var deger=(paid_status ==1) ?'ödendi': 'ödenmedi';
                                $(td_id).html(deger);

                                alertify.success(response.message);
                            }

                            else
                                alertify.error(response.message);
                        }

                    })
                })
            });
        </script>
    </section>

    <section class="content-header">


    </section>





@endsection

@section('css')

@endsection
@section('js')

@endsection

