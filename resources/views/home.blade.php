@extends('layouts.app')

@section('content')

<div class="container">
  @isset($success)
      <div class="alert alert-success">
          {{ $success }}
      </div>
    @endisset
  <img src="/images/portada.jpg" id="foto-portada">
  <div>
          <div class="flex-grid-2">
          	<section class="panel"><img src="/images/logo.jpg"></section>
          	<section class="panel descripcion"><p>Lemon Hill es una marca registrada de ropa ecologica, pero tambien es una plataforma de eventos de musica electronica y otros estilos. En esta web podrás encontrar eventos de musica en tu ciudad: Barcelona, Laviana, Amsterdam, etc. Nos gustaría que compraras una camiseta y asistieras a un evento de Lemon Hill. Somos un grupo de jovenes de entre Asturias y Barcelona con muchas ganas de hacer ruido y fomentar la ropa ecológica. Espero que disfruteis y tengais una buena experiéncia en esta página.</p></section>
          </div>
  </div>

  <div>
    <div class="flex-grid-2">
      <section class="panel">En esta seccion os mostramos algunos de los diseños en los que estamos trabajando. Tambien podeis ver los diseños finalizados en nuestra tienda online. Espero que os gusten y compreis alguno.</section>
      <section class="panel">
                    <div class="slider">
                      <nav>
                        <label for="carousel-1"></label>
                        <label for="carousel-2"></label>
                        <label for="carousel-3"></label>
                      </nav>
                      <ul>
                        <li>
                          <input type="radio" id="carousel-1" name="carousel" hidden checked>
                          <div hidden>
                            <img src="/images/camiseta1.jpg" alt="Camiseta 1">
                            <label for="carousel-3"><</label>
                            <label for="carousel-2">></label>
                          </div>
                        </li>
                        <li>
                          <input type="radio" id="carousel-2" name="carousel" hidden>
                          <div hidden>
                            <img src="/images/camiseta2.jpg" alt="Camiseta 2">
                            <label for="carousel-1"><</label>
                            <label for="carousel-3">></label>
                          </div>
                        </li>
                        <li>
                          <input type="radio" id="carousel-3" name="carousel" hidden>
                          <div hidden>
                            <img src="/images/camiseta3.jpg" alt="Camiseta 3">
                            <label for="carousel-2"><</label>
                            <label for="carousel-1">></label>
                          </div>
                        </li>
                      </ul>
                    </div>
      </section>
    </div>
  </div>
</div>
@endsection
