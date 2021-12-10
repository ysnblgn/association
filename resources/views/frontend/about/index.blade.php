@extends('frontend.layout')
@section('title',"Anasayfa Başlığı")

@section('content')

    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Hakkımızda</h1>

        <!-- About Post -->
        @foreach($data['about'] as $about)
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="row">
                            <!-- Sidebar Column -->
                            <div class="col-lg-3 mb-4">
                                <div class="list-group">
                                    <a href="index.html" class="list-group-item">Home</a>
                                    <a href="about.html" class="list-group-item">About</a>
                                    <a href="services.html" class="list-group-item">Services</a>
                                    <a href="contact.html" class="list-group-item">Contact</a>
                                    <a href="portfolio-1-col.html" class="list-group-item">1 Column Portfolio</a>
                                    <a href="portfolio-2-col.html" class="list-group-item">2 Column Portfolio</a>
                                    <a href="portfolio-3-col.html" class="list-group-item">3 Column Portfolio</a>
                                    <a href="portfolio-4-col.html" class="list-group-item">4 Column Portfolio</a>
                                    <a href="portfolio-item.html" class="list-group-item">Single Portfolio Item</a>
                                    <a href="blog-home-1.html" class="list-group-item">Blog Home 1</a>
                                    <a href="blog-home-2.html" class="list-group-item">Blog Home 2</a>
                                    <a href="blog-post.html" class="list-group-item">Blog Post</a>
                                    <a href="full-width.html" class="list-group-item">Full Width Page</a>
                                    <a href="sidebar.html" class="list-group-item active">Sidebar Page</a>
                                    <a href="faq.html" class="list-group-item">FAQ</a>
                                    <a href="404.html" class="list-group-item">404</a>
                                    <a href="pricing.html" class="list-group-item">Pricing Table</a>
                                </div>
                            </div>
                            <!-- Content Column -->
                            <div class="col-lg-9 mb-4">
                                <h2>Section Heading</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, et temporibus, facere perferendis veniam beatae non debitis, numquam blanditiis necessitatibus vel mollitia dolorum laudantium, voluptate dolores iure maxime ducimus fugit.</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <a href="#">
                                <img class="img-fluid rounded" src="/images/abouts/{{$about->about_file}}" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <h2 class="card-title">{{$about->about_title}}</h2>
                            <p class="card-text">{!! substr($about->about_content,0,140) !!} </p>
                            <a href="{{route('about.Detail',$about->about_slug)}}" class="btn btn-primary">Devamını Oku &rarr;</a>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Yayınlanma Zamanı {{$about->created_at->format('d-m-Y h:i')}}
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
