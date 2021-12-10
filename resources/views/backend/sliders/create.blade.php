@extends('backend.layout')

@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Slider Ekleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('slider.store')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="">Resim Seç</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="slider_file" required type="file" multiple>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Başlık</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="slider_title" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Slug</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="slider_slug" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Url</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="slider_url" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">İçerik</label>
                        <div class="row">
                            <div class="col-xs-12">

                                    <textarea class="form-control" id="ckeditor"
                                              name="slider_content"></textarea>
                                <script>
                                    CKEDITOR.replace('ckeditor');
                                </script>

                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="">Durum</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="slider_status" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Pasif</option>
                                </select>
                            </div>
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
