@extends('backend.layout')

@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Slider Düzenleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('slider.update',$sliders->id)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="">Yüklü Görsel</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <img width="100" src="/images/sliders/{{$sliders->slider_file}}" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Resim Seç</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="slider_file" type="file" multiple>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Başlık</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="slider_title" type="text"
                                       value="{{$sliders->slider_title}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Slug</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="slider_slug" type="text"
                                       value="{{$sliders->slider_slug}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Url</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="slider_url" type="text"
                                       value="{{$sliders->slider_url}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="">İçerik</label>
                        <div class="row">
                            <div class="col-xs-12">

                                    <textarea class="form-control" id="ckeditor"
                                              name="slider_content">{{$sliders->slider_content}}</textarea>
                                <script>
                                    CKEDITOR.replace('ckeditor');
                                </script>

                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="old_file" value="{{$sliders->slider_file}}">

                    <div class="form-group">
                        <label for="">Durum</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="slider_status" class="form-control">
                                    <option {{$sliders->slider_status=="1" ? "selected=''" : ""}} value="1">Aktif
                                    </option>
                                    <option {{$sliders->slider_status=="0" ? "selected=''" : ""}} value="0">Pasif
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="old_file" value="{{$sliders->slider_file}}">


                    <div align="right" class="box-footer">
                        <button type="submit" class="btn btn-success">Düzenle</button>
                    </div>


                </form>
            </div>
        </div>
    </section>





@endsection

@section('css')@endsection
@section('js')@endsection
