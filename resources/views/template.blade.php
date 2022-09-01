<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title> @yield('title')</title>
        <link rel="stylesheet" href="public/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="public/assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="public/assets/css/Navbar-Right-Links-icons.css">
        <link rel="stylesheet" href="public/assets/css/styles.css">
        <link rel="stylesheet" type="text/css" href="public/assets/css/contact.css">
        <!--     Fonts and icons from creative     -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" href="public/assets/css/styles0.css" />
        <link rel="icon" type="image/png" sizes="16x16" href="public/img/favicon-16x16.png">
        <link rel="stylesheet" href="public/assets/css/jquery.dataTables.min.css">
    </head>
    <body style="background: rgba(255,255,255,0);">
        <header>
            <nav class="d-none d-lg-flex d-xl-flex d-xxl-flex p-3 bg-primary d-flex justify-content-between">
                <div class="ms-5 col-lg-4"><a class="text-white text-decoration-none" href="#">Email : Info@mutuellechretienne-ci.org</a></div>
                <div class="pe-5 col-lg-4 text-end"><a class="text-white text-decoration-none" href="#">Suivez-nous sur</a><i class="fab fa-facebook-square text-white px-2"></i><i class="fab fa-instagram text-white"></i></div>
            </nav>
            <nav class="navbar navbar-light navbar-expand-md shadow px-lg-5">
                <div class="container-fluid">
                    <img class="img-fluid" src="public/assets/img/pasteur.png" width="53" height="52">
                    <a class="navbar-brand d-none d-lg-block fs-6 fw-bold ms-1 text-primary" href="#">Mutuelle Chrétienne de Côte d'Ivoire
                    </a>
                    <a class="navbar-brand d-sm-none d-md-none d-lg-none fw-bold ms-1 text-primary" style="font-size: 0.8rem;" href="#">Mutuelle Chrétienne de Côte d'Ivoire
                    </a>
                    <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse justify-content-end" id="navcol-1">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="active menu-link nav-link pb-1" href="#">Accueil</a>
                                <div class="borderBottom"></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#" onclick="location.href='apropos.php';">À propos de nous</a>
                                <div></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#" onclick="location.href='nosoffres.php';">Nos offres</a>
                                <div></div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#" data-bs-toggle="modal" data-bs-target="#contacter_nous" data-bs-backdrop="static" data-whatever="info@mutuellechretienne-ci.org">Contactez-nous</a>
                                <div></div>
                            </li>
                        </ul>
                        <button type="button" class="btn bg-secondary text-white rounded logout d-none" onclick="logout();">Se deconnecter</button>
                    </div>
                </div>
            </nav>
        </header>
        @section('sidebar')
            This is the master sidebar.
        @show
 
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>