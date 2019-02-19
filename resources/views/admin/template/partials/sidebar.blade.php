<div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  @if( Auth::user()->admin() )
                      <img src=" {{asset('plugins/images/faces/usuario.jpg')}} " alt="profile image">
                  @else
                     <img src=" {{asset('plugins/images/faces/default.jpg')}} " alt="profile image">
                  @endif
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{ Auth::user()->name }} </p>
                  <div>
                    <small class="designation text-muted">En línea</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
              <button id="edit_user" class="btn btn-info btn-block" data-toggle="modal">
				 <i class="mdi mdi-account-edit"></i>
              	Editar Perfil
              </button>
            </div>
          </li>
          <li class="nav-item">
            @if( Auth::user()->admin() )
                <a class="nav-link" href="{{ url('/admin') }}">
                  <i class="menu-icon mdi mdi-television"></i>
                  <span class="menu-title">Tablero</span>
                </a>
            @else
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/student') }}">
                    <i class="menu-icon mdi mdi-home"></i>
                    <span class="menu-title">Inicio</span>
                  </a>
                </li>
                @foreach($contenidos as $contend)
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#{{$contend->id}}" aria-expanded="false" aria-controls="ui-basic">
                      <i class="menu-icon mdi mdi-content-copy"></i>
                      <span class="menu-title">{{$contend->name}}</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="{{$contend->id}}">
                      <ul class="nav flex-column sub-menu">
                        @foreach($clases as $clase)
                          @if($clase->contend_id == $contend->id)
                              <li class="nav-item">
                                <a class="nav-link ver_clase" href="{{$clase->id}}">{{$clase->name}}</a>
                              </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  </li>
                @endforeach
            @endif
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" href="#password_user">
              <i class="menu-icon mdi mdi-key-variant"></i>
              <span class="menu-title">Cambiar clave</span>
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               <i class="menu-icon mdi mdi-logout"></i>
               <span class="menu-title">Cerrar sesión</span>
            </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </nav>