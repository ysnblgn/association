@extends('backend.layout')

@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sayfa Düzenleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('about.update',$abouts->id)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="">Yüklü Görsel</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <img width="100" src="/images/abouts/{{$abouts->about_file}}" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Resim Seç</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="about_file"  type="file" multiple>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Başlık</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="about_title" type="text"
                                       value="{{$abouts->about_title}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Slug</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="about_slug" type="text"
                                       value="{{$abouts->about_slug}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="">İçerik</label>
                        <div class="row">
                            <div class="col-xs-12">

                                    <textarea class="form-control" id="ckeditor"
                                              name="about_content">{{$abouts->about_content}}</textarea>
                                <script>
                                    CKEDITOR.replace('ckeditor');
                                </script>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Durum</label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <select name="about_status" class="form-control">
                                        <option {{$abouts->about_status=="1" ? "selected=''" : ""}} value="1">Aktif
                                        </option>
                                        <option {{$abouts->about_status=="0" ? "selected=''" : ""}} value="0">Pasif
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="old_file" value="{{$abouts->about_file}}">


                        <div align="right" class="box-footer">
                            <button type="submit" class="btn btn-success">Düzenle</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </section>





@endsection

@section('css')@endsection
@section('js')@endsection
