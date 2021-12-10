@extends('backend.layout')

@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sayfa Düzenleme</h3>
            </div>
            <div class="box-body">
                <form action="{{route('activity.update',$activities->id)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="">Yüklü Görsel</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <img width="100" src="/images/activities/{{$activities->activity_file}}" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Resim Seç</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="activity_file"  type="file" multiple>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Başlık</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="activity_title" type="text"
                                       value="{{$activities->activity_title}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Slug</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" name="activity_slug" type="text"
                                       value="{{$activities->activity_slug}}">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="">İçerik</label>
                        <div class="row">
                            <div class="col-xs-12">

                                    <textarea class="form-control" id="ckeditor"
                                              name="activity_content">{{$activities->activity_content}}</textarea>
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
                                <select name="activity_status" class="form-control">
                                    <option {{$activities->activity_status=="1" ? "selected=''" : ""}} value="1">Aktif
                                    </option>
                                    <option {{$activities->activity_status=="0" ? "selected=''" : ""}} value="0">Pasif
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="old_file" value="{{$activities->activity_file}}">

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
