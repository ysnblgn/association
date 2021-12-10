@extends('frontend.layout')
@section('title',"Anasayfa Başlığı")

@section('content')

    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Etkinliklerimiz</h1>

        <!-- Activity Post -->
        @foreach($data['activity'] as $activity)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="#">
                                <img class="img-fluid rounded" src="/images/activities/{{$activity->activity_file}}" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <h2 class="card-title">{{$activity->activity_title}}</h2>
                            <p class="card-text">{!! substr($activity->activity_content,0,140) !!} </p>
                            <a href="{{route('activity.Detail',$activity->activity_slug)}}" class="btn btn-primary">Devamını Oku &rarr;</a>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Yayınlanma Zamanı {{$activity->created_at->format('d-m-Y h:i')}}
                </div>
            </div>
    @endforeach


    <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
                <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
                <a class="page-link" href="#">Newer &rarr;</a>
            </li>
        </ul>

    </div>

@endsection
@section('css')@endsection
@section('js')@endsection
