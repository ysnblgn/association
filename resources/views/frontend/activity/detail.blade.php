@extends('frontend.layout')
@section('title',"Anasayfa Başlığı")

@section('content')
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">{{$activity->activity_title}}</h1>

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-8">

                <!-- Preview Image -->
                <img class="img-fluid rounded" src="/images/activities/{{$activity->activity_file}}" alt="">

                <hr>

                <!-- Date/Time -->
                <p>Yayınlanma Zamanı {{$activity->created_at->format('d-m-Y h:i')}}</p>

                <hr>

                <!-- Post Content -->
                <p>{!! $activity->activity_content !!}</p>

                <hr>

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">


                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Diğer Etkinlikler</h5>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($activityList as $list)
                                <a href="{{route('activity.Detail',$list->activity_slug)}}">
                                    <li class="list-group-item">{{$list->activity_title}}</li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->

    </div>
@endsection
@section('css')@endsection
@section('js')@endsection
