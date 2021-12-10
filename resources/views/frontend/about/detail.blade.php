@extends('frontend.layout')
@section('title',"Anasayfa Başlığı")

@section('content')
    <div class="container">

    <!-- Page Heading/Breadcrumbs -->
        <hr>
        <h1 style="font-family:arial,helvetica,sans-serif" class="mt-4 mb-3">
            <a href="">{{$about->about_title}}</a>
        </h1>
        <hr>


    <div class="row">

        <!-- Post Content Column -->
        <div class="center-block">

            <!-- Preview Image -->
            <img class="float-right" alt="" src="/images/abouts/{{$about->about_file}}" >
            <br>



            <!-- Date/Time -->
{{--            <p>Yayınlanma Zamanı {{$about->created_at->format('d-m-Y h:i')}}</p>--}}



            <!-- Post Content -->
{{--            <p> {!! $about->about_content !!}</p>--}}
            <span style="font-size:14px">{!! $about->about_content !!}</span>



        </div>







            <!-- Side Widget -->
{{--            <div class="card my-4">--}}
{{--                <h5 class="card-header">Side Widget</h5>--}}
{{--                <div class="card-body">--}}
{{--                    You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!--}}
{{--                </div>--}}
{{--            </div>--}}



    </div>
    <!-- /.row -->

    </div>
@endsection
@section('css')@endsection
@section('js')@endsection
