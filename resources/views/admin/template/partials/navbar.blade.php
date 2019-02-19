<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="../../index.html">
          <img src="{{ asset('plugins/images/logo.svg') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="../../index.html">
          <img src="{{asset('plugins/images/logo-mini.svg')}}" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        @if( Auth::user()->admin() )
          <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
            <li class="nav-item">
              <a href="{{ url('/pdfuser') }}" class="nav-link" target="_blank">
                <i class="mdi mdi-bookmark-plus-outline icon-lg"></i>Puntuación de los Usuarios</a>
            </li>
          </ul>
        @else
            <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
              <li class="nav-item">
                <a href="{{ url('/pdfuser') }}" class="nav-link" target="_blank">
                  <i class="mdi mdi-bookmark-plus-outline"></i>Puntuación</a>
              </li>
              <li class="nav-item active">
                <a href="{{ url('/student/evaluacion') }}" class="nav-link">
                   <i class="mdi mdi-clipboard-outline icon-lg"></i>
                   Pruebas
                  @if( $count1 > 0)
                      <span class="badge badge-info ml-1">{{$count1}}</span>
                  @endif
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/student/practica') }}" class="nav-link">
                  <i class="mdi mdi-flask icon-lg"></i>
                  Practicas y Experimentos
                  @if( $count2 > 0)
                      <span class="badge badge-info ml-1">{{$count2}}</span>
                  @endif
                </a>
              </li>
            </ul>
        @endif
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-file-document-box"></i>
              @if(Auth::user()->admin())
                 <span class="count">{{$count}}</span>
              @else
                 <span class="count">+</span>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
               @if( Auth::user()->student() )
                 <div class="dropdown-item">
                  <p class="mb-0 font-weight-normal float-left">Enviar mensaje al admin</p>
                  <a data-toggle="modal" href="#mensaje_user"><span class="badge badge-info badge-pill float-right">Crear</span></a>
                </div>
                @endif
               @if(Auth::user()->admin())
                   @foreach($mensajes as $mensaje)
                     <div class="dropdown-divider"></div>
                      <a class="dropdown-item preview-item mensaje" href="{{$mensaje->id}}">
                        <div class="preview-thumbnail">
                          <img src=" {{asset('plugins/images/faces/default.jpg')}} " alt="image" class="profile-pic">
                        </div>
                        <div class="preview-item-content flex-grow">
                          <h6 class="preview-subject ellipsis font-weight-medium text-dark">De {{$mensaje->name}}
                          </h6>
                          <p class="font-weight-light small-text">
                           Tienes un nuevo mensaje
                          </p>
                        </div>
                      </a>
                   @endforeach
                @elseif(Auth::user()->student())
                   @foreach($mensajes2 as $mensaje2)
                     <div class="dropdown-divider"></div>
                      <a class="dropdown-item preview-item mensaje" href="{{$mensaje2->id}}">
                        <div class="preview-thumbnail">
                          <img src=" {{asset('plugins/images/faces/default.jpg')}} " alt="image" class="profile-pic">
                        </div>
                        <div class="preview-item-content flex-grow">
                          <h6 class="preview-subject ellipsis font-weight-medium text-dark">{{$mensaje2->name}}
                          </h6>
                          <p class="font-weight-light small-text">
                           Mensaje
                          </p>
                        </div>
                      </a>
                @endforeach
               @endif
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>