@extends('template')

@section('title', 'Accueil')

@section('state_accueil', 'class=borderBottom')

@section('state_accueil_active', 'active')

@section('content')
    <div class="col-md-6 col-lg-8 flex-row pt-4 pe-0" id="containerlog">
        <div class="row">
            <div class="col position-relative">
                <div><img class="img-fluid img-cross" src="assets/img/Group%202.png"></div>
                <div class="position-absolute start-0 translate-middle-y w-100 titre-mutuelle p-lg-3">                            
                    <div class="ms-lg-2 ms-sm-0 text-primary d-flex justify-content-center">
                        <span class="titre-mutuelle-text1 d-none d-sm-flex d-md-flex me-3">Couverture santé El Raffa</span>
                        <span class="titre-mutuelle-text1 d-sm-none d-md-none d-lg-none  me-3 fs-1">Couverture santé El Raffa</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col d-inline-flex flex-row flex-wrap">
                <div class="col-lg-6 position-relative card-zone p-2">
                    <img class="img-fluid card-action w-100 shadow" src="assets/img/evequemod.png" width="300px" height="150px">
                    <button class="btn btn-light d-flex action p-3 fs-3 d-flex align-items-center position-absolute bottom-0 start-50 translate-middle-x mb-2" type="button" data-bs-toggle="modal" data-bs-target="#LoginModalCenter" data-bs-backdrop="static" data-titre="Evêques" data-zone="eveques">
                        <span class="col-4 d-flex">
                            <i class="fas fa-arrow-right justify-content-start"></i>
                        </span>
                        <span class="col-5 fs-6 fw-bold">Eveques</span>
                    </button>
                </div>
                <div class="col-lg-6 position-relative card-zone p-2">
                    <img class="img-fluid card-action w-100 shadow" src="assets/img/fidelemod.png" width="300px" height="150px">
                    <button class="btn btn-light d-flex action p-3 fs-3 d-flex align-items-center position-absolute bottom-0 start-50 translate-middle-x mb-2" type="button" data-bs-toggle="modal" data-bs-target="#LoginModalCenter" data-bs-backdrop="static" data-titre="Pasteurs, Prêtres et Fidèles" data-zone="pasteursEtFideles">
                        <span class="col-1 d-flex">
                            <i class="fas fa-arrow-right justify-content-start"></i>
                        </span>
                        <span class="col-11 fs-6 fw-bold">Pasteurs, Prêtres et Fidèles
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-none d-md-flex d-lg-flex d-xl-flex d-xxl-flex col-lg-4">
        <picture><img class="img-fluid" src="assets/img/index_solo1.png" width="500%" style="position: sticky; left: 127px;top: 147px;max-width: 125%;z-index: -1;"></picture>
    </div>
@endsection