@extends('backend.layout')

@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Kullanıcı Ekleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('user.store')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="">Resim Seç</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="user_file" required type="file" multiple>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Ad Soyad</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="name" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Kullanıcı Adı</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="email" type="email">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Şifre</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="password" type="password">
                            </div>
                        </div>
                    </div>

                    <label for="">Kullanıcı Rolü</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <select name="user_role" class="form-control">
                                <option
                                        value="yönetici">yönetici
                                </option>
                                <option
                                        value="üye">üye
                                </option>
                            </select>
                        </div>
                    </div>




                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-success">Ekle</button>
                        </div>

                </form>
            </div>
        </div>
    </section>





@endsection

@section('css')@endsection
@section('js')@endsection
