@extends('backend.layout')

@section('content')
    <section class="content-header">
        <form action="{{route('fee.determine')}}" method="Post">
            @csrf
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Aidat Sorgulama</h3>

                    {{--                <div align="right">--}}
                    {{--                    <a href="{{route('activity.create')}}"><button class="btn btn-success">Etkinlik Ekle</button></a>--}}
                    {{--                </div>--}}
                </div>
                <div class="custom-select" style="width:200px;">
                    <select name="period_year">
                        <option value="0">Seçiniz</option>
                        {{$year=date('Y', strtotime(now()))}}
                        @for($i=-1; $i<5; $i++)
                            <option value="{{$year+$i}}">{{$year+$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Aidat Miktarı</label>
                    <div class="row">
                        <div class="col-xs-12">
                            <input class="form-control" name="determine_amount" type="number">
                        </div>
                    </div>
                </div>
                <div align="right" class="box-footer">
                    <button type="submit" class="btn btn-success">Ekle</button>
                </div>
            </div>
        </form>

    </section>
@endsection
