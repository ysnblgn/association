@extends('frontend.layout')
@section('title',"Anasayfa Başlığı")

@section('content')

    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Bize Ulaşın</h1>
        <hr>

        @if (session()->has('success'))
            <div class="alert alert-success">
                <p>{{session('success')}}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Content Row -->
        <div class="row">
            <!-- Map Column -->
{{--            <div class="col-lg-8 mb-4">--}}
                <!-- Embedded Google Map -->
{{--                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49874.6745703786!2d27.059313873217786!3d38.62203535873466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14bbd484faf14a61%3A0x112386e26c13a843!2sMenemen%20Devlet%20Hastanesi!5e0!3m2!1str!2str!4v1625055779757!5m2!1str!2str" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>            </div>--}}
            <div class="col-lg-8 mb-4">
                <h3>İletişim Formu</h3>
                <form method="post">
                    @csrf
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Ad Soyad:</label>
                            <input type="text" class="form-control"  name="name"  placeholder="Ad Soyad">
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Mail:</label>
                            <input type="email" class="form-control" name="email"  placeholder="Mail">
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Telefon:</label>
                            <input type="text" class="form-control" name="phone"  placeholder="Telefon">
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message:</label>
                            <textarea rows="10" cols="100" class="form-control" name="message"  ></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary" >Gönder</button>
                </form>
            </div>

                <!-- Contact Details Column -->
            <div class="col-lg-4 mb-4">
                <h3>Adres</h3>
                <p>
					{!! $adres !!}
                    <br>{{$ilce}} / {{$il}}


                </p>
                <p>
                    {{$phone_sabit}}
                    <br>{{$phone_gsm}}
                </p>
                <p>
                    {{$mail}}
                </p>
{{--                <p>--}}
{{--					{{$saat}}--}}
{{--                </p>--}}
            </div>
        </div>
        <!-- /.row -->

        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->

        <!-- /.row -->

    </div>

@endsection
@section('css')@endsection
@section('js')@endsection
