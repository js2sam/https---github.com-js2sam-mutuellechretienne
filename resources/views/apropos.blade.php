@extends('template')
 
@section('title', 'À propos de nous')

@section('state_apropos', 'class="borderBottom"')

@section('state_apropos_active', 'active')
 
@section('content')
    <div class="col-md-6 col-lg-8 flex-row pt-5 pe-0" id="containerlog">
        <div class="row">
            <div class="col position-relative">
                <div><img class="img-fluid img-cross" src="public/assets/img/Group%202.png"></div>
                <div class="position-absolute start-0 translate-middle-y w-100 titre-mutuelle p-lg-3">                            
                    <div class="ms-lg-2 ms-sm-0 text-primary d-flex justify-content-center">
                        <span class="titre-mutuelle-text1 d-none d-sm-flex d-md-flex me-3">À propos de nous</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col d-inline-flex flex-row flex-wrap">
                <p class="fs-5" style="text-justify:distribute;">
                    Nous sommes la Mutuelle Chrétienne de Côte d'Ivoire. <br> Ayant constaté de nombreuses d'insuffisances dans le corps ecclésiastique,<br> nous avons penser à :
                    <ul style="list-style-type: '- ';" class="pl-10rem fs-5">
                        <li>Fédérer les chrétiens et les associations cultuelles en vue œuvres sociales ;</li>
                        <li>Promouvoir le bien être social et humanitaire ;</li>
                        <li>Encourager la solidarité et l'épargne ;</li>
                        <li>Promouvoir la santé et lutter contre la pauvreté ;</li>
                        <li>Rechercher des voies de financement pour les adhérents ; et enfin</li>
                        <li>Créer un cadre de développement harmonieux et durable.</li>
                    </ul>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-none d-md-flex d-lg-flex d-xl-flex d-xxl-flex col-lg-4">
        <picture><img class="img-fluid" src="public/assets/img/index_solo1.png" width="500%" style="position: sticky; left: 127px;top: 147px;max-width: 125%;z-index: -1;"></picture>
    </div>
@endsection