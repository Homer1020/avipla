@extends('layouts.main')
@section('title', 'Directorio')
@section('content')
    <div class="header-separator"></div>

    <section class="section">
      <div class="container-md">
        <h1 class="section__title">Directorio</h1>
        <form class="d-flex mb-3">
          <input type="text" class="form-control me-3" placeholder="Buscar...">
          <input class="btn btn-primary" type="submit" value="Buscar">
        </form>


        <div class="card mb-3 border-primary">
          <div class="card-body">
            <p class="text-primary">Agua Mineral Miranda, C.A.</p>
            <ul class="list ps-4 text-primary mb-0">
              <li>02123728383</li>
              <li>amazzoneb@gmail.com</li>
              <li>Carretera Nac. San Diego y San J</li>
            </ul>
          </div>
        </div>

        <div class="card mb-3 border-primary">
          <div class="card-body">
            <p class="text-primary">Agua Mineral Miranda, C.A.</p>
            <ul class="list ps-4 text-primary mb-0">
              <li>02123728383</li>
              <li>amazzoneb@gmail.com</li>
              <li>Carretera Nac. San Diego y San J</li>
            </ul>
          </div>
        </div>

        <div class="card mb-3 border-primary">
          <div class="card-body">
            <p class="text-primary">Agua Mineral Miranda, C.A.</p>
            <ul class="list ps-4 text-primary mb-0">
              <li>02123728383</li>
              <li>amazzoneb@gmail.com</li>
              <li>Carretera Nac. San Diego y San J</li>
            </ul>
          </div>
        </div>

        <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-5">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </section>
    <!-- /section -->

    <!-- section -->
    <section class="section">
      <div class="container-sm">
        <h2 class="section__title">Organismos y representaciones</h2>
        <div class="row align-items-center">
          <div class="col-md-3 mb-5 mb-md-0 text-center">
            <img src="./assets/img/busines1.png" alt="Empresa 1" class="img-fluid" width="150">
          </div>
          <div class="col-md-3 mb-5 mb-md-0 text-center">
            <img src="./assets/img/busines2.png" alt="Empresa 1" class="img-fluid" width="150">
          </div>
          <div class="col-md-3 mb-5 mb-md-0 text-center">
            <img src="./assets/img/busines3.png" alt="Empresa 1" class="img-fluid" width="150">
          </div>
          <div class="col-md-3 mb-5 mb-md-0 text-center">
            <img src="./assets/img/busines4.png" alt="Empresa 1" class="img-fluid" width="150">
          </div>
        </div>
      </div>
    </section>
    <!-- /section -->

    <footer class="bg-secondary footer">
      <div class="container-sm">
        <div class="row justify-content-center">
          <div class="offset-md-3 col-md-4">
            <div class="text-center">
              <img src="./assets/img/logowhite.png" alt="Logo" width="100">
            </div>
          </div>

          <div class="col-md-3 mt-5 mt-md-0">
            <address class="text-light text-center text-lg-start">
              <small>
                Multicentro Macaracuay Piso 7 - Oficina 709 Avenida Principal de Macaracuay Municipio Sucre - Caracas
                1070.
              </small>
            </address>
          </div>

          <div class="col-12">
            <div class="social-links d-flex justify-content-center">
              <a href="#" class="social-link">
                <i class="fab fa-xl fa-x-twitter"></i>
              </a>
              <a href="#" class="social-link">
                <i class="fab fa-xl fa-instagram"></i>
              </a>
              <a href="#" class="social-link">
                <i class="fab fa-xl fa-facebook"></i>
              </a>
              <a href="#" class="social-link">
                <i class="fab fa-xl fa-youtube"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>
@endsection