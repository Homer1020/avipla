@extends('layouts.main')
@section('title', 'Inicio')
@section('content')
  <!-- section -->
  <section class="section pb-0">
    <div class="container-sm">
        <h2 class="section__title">¿Qué es AVIPLA?</h2>
        <div class="row">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="./assets/img/botellas.jpg" alt="Botellas" class="rounded img-fluid h-100 object-fit-cover shadow-sm">
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta quas officiis sapiente harum dolorem inventore rem quidem delectus totam repellat nisi repudiandae ratione doloribus nesciunt, ex magni odit asperiores optio?</p>
                        <ul class="mb-4">
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dicta soluta mollitia reiciendis, suscipit ratione quaerat reprehenderit quae quisquam magni provident consectetur excepturi distinctio repellendus non quis obcaecati ipsa officiis dignissimos.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dicta soluta mollitia reiciendis, suscipit ratione quaerat reprehenderit quae quisquam magni provident consectetur excepturi distinctio repellendus non quis obcaecati ipsa officiis dignissimos.</li>
                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dicta soluta mollitia reiciendis, suscipit ratione quaerat reprehenderit quae quisquam magni provident consectetur excepturi distinctio repellendus non quis obcaecati ipsa officiis dignissimos.</li>
                        </ul>
                        <a href="#" class="btn btn-outline-primary">Saber más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /section -->

<!-- section -->
<section class="section">
    <div class="container-sm">
        <h2 class="section__title">Noticias de la Industria</h2>
        <div class="row">
            <div class="col-md-4">
                <article class="mb-5 mb-md-0">
                    <a href="article.html" class="d-block">
                        <img src="./assets/img/reciclaje2.jpg" class="figure-img img-fluid rounded shadow-sm object-fit-cover d-block mb-4" alt="">
                    </a>
                    <h3 class="fs-5 article__title mb-4"><a class="text-primary" href="article.html">El problema del plástico en la naturaleza ¿Cómo puedes ayudar?</a></h3>

                    <a href="article.html" class="btn btn-outline-primary">Leer artículo</a>
                </article>
            </div>
            <div class="col-md-4">
                <article class="mb-5 mb-md-0">
                    <a href="article.html" class="d-block">
                        <img src="./assets/img/reciclaje2.jpg" class="figure-img img-fluid rounded shadow-sm object-fit-cover d-block mb-4" alt="">
                    </a>
                    <h3 class="fs-5 article__title mb-4"><a class="text-primary" href="article.html">El problema del plástico en la naturaleza ¿Cómo puedes ayudar?</a></h3>

                    <a href="article.html" class="btn btn-outline-primary">Leer artículo</a>
                </article>
            </div>
            <div class="col-md-4">
                <article class="mb-5 mb-md-0">
                    <a href="article.html" class="d-block">
                        <img src="./assets/img/reciclaje2.jpg" class="figure-img img-fluid rounded shadow-sm object-fit-cover d-block mb-4" alt="">
                    </a>
                    <h3 class="fs-5 article__title mb-4"><a class="text-primary" href="article.html">El problema del plástico en la naturaleza ¿Cómo puedes ayudar?</a></h3>

                    <a href="article.html" class="btn btn-outline-primary">Leer artículo</a>
                </article>
            </div>
            <div class="col-12 text-center" style="margin-top: 4rem;">
                <a href="article.html" class="btn btn-primary text-uppercase">Ver más</a>
            </div>
        </div>
    </div>
</section>
<!-- /section -->

<!-- section -->
<section class="section section--with-decoration bg-secondary text-white">
    <div class="container-sm">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="section__title text-white mb-4">Afiliados</h2>
                <p class="mb-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui beatae doloribus velit voluptate totam, minus asperiores sapiente. Vitae, sint id quisquam tempore accusantium reprehenderit eius sit obcaecati labore, praesentium iure.</p>
                <h3 class="section__subtitle mb-4">Colsulte nuestros afiliados</h3>
                <a href="#" class="btn btn-outline-light me-2">
                    <i class="fa fa-address-book"></i>
                    Ver directorio
                </a>
                <a href="#" class="btn btn-light">
                    <i class="fa fa-pen"></i>
                    Afiliate
                </a>
            </div>
            <div class="col-md-6">
            </div>
        </div>
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
@endsection