@extends('layouts.master')

@section('title', 'About |')
@section('menuAbout', 'active')

@section('content')
<div class="container text-center mt-5">
  <div class="card br-card def-shadow py-4 py-md-5 px-3 mb-5 mx-4 mx-md-5">

    <div class="row">
      <div class="col-12 col-md-4 mb-4 mb-md-0">
        <img src="{{ asset('img/alaska-logo.png') }}"
      style="width: 300px; height: 300px; object-fit: cover; object-position: center;" alt="">
      </div>
      <div class="col-12 col-md-8">
         <h2 style="color:#f4473e; text-align: left">Tentang Alaska</h2>
          <hr class="mb-4" width="175px" size="7px">
          <p class="d-block" style="max-width: 600px; text-align:left">
            Website Alaska adalah sebuah website e-commerce yang berfokus pada penawaran jasa editing video, foto, dan animasi. Website ini bertujuan untuk mempromosikan skill Editing orang-orang dan mengembangkan potensinya serta mendapatkan income dengan sistem jual beli jasa.
            <br><br>
            Selain itu, banyak masyarakat di Indonesia yang cerdas dan penuh potensi namun sayang belum mendapatkan mediasi yang baik, sehingga diharapkan dengan adanya website ini dapat membantu masyarakat luas khususnya dibidang tersebut.
          </p>
      </div>
  
    </div>
  </div>
  <h3 class="mb-3">Team Kami</h3>
  <hr class="mb-3 mx-auto" width="100px" size="7px">
  <div class="row justify-content-md-center mt-4 mb-5 mx-4 mx-md-0">
    <div class="col-12 col-md-4 mb-3 mb-md-0">
      <div class="card br-card def-shadow p-4">

        <h4 style="color: #f4473e">Muhammad Prasetyo Nugroho</h4>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card br-card def-shadow p-4">

        <h4 style="color: #f4473e">Titto Mahogany Attaraqie</h4>
      </div>
    </div>
  </div>
 

</div>

{{-- <footer class="position-absolute bottom-0 col-12 bg-dark py-4 text-white mt-4">
  <div class="container">
    dibuat oleh:
    <br>
    Titto Mahogany attaraqie, Tirsa Pambayun, Muhammad Prasetyo Nugroho
    <br>
    | Copyright &copy; {{date("M Y")}}

</div>
</footer> --}}

@endsection