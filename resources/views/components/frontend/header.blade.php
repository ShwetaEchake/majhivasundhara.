<style>
    .btn_model{
        border-radius: 33px;
        margin-left: 20%;
        background-color: #01120a !important;
    }
</style>
<div id="navbar" class="is-sticky">
    <nav class="navbar navbar-expand-lg navbar-custom sticky sticky-dark">
        <div class="container">
            <!-- LOGO -->
            <a class="navbar-brand logo text-uppercase py-0" href="{{ route('/') }}">
                <img src="{{ asset('frontend/images/favicon.png') }}" alt="" class="img-fluid" style="width: 60px">
                माझी वसुंधरा
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="nav-button ml-auto">
                    <ul class="nav navbar-nav navbar-end align-items-center">
                        <li>
                            <a data-scroll href="{{ route('/') }}" class="nav-link py-1">होम</a>
                        </li>

                        @guest
                            <li>
                                <a href="{{ route('login') }}" class="btn btn-primary navbar-btn btn-rounded px-4 py-1">लॉगिन करा</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="btn btn-primary navbar-btn btn-rounded px-4 py-1">नोंदणी करा</a>
                            </li>
                        @endguest

                        @auth
                            @if (Auth::user()->hasRole('User'))
                                <li>
                                    <a href="{{ route('contests.create') }}" class="btn btn-primary navbar-btn btn-rounded px-4 py-1">स्पर्धा</a>
                                </li>
                                {{-- @if ( Auth::user()->competition_type_id == 1 )
                                    <li>
                                        <a href="{{ route('contests.paryavaran-dut') }}" class="btn btn-primary navbar-btn btn-rounded px-4 py-1">पर्यावरण दूत</a>
                                    </li>
                                @endif --}}
                            @endif
                            <li class="nav-item dropdown d-flex">

                                <img src="{{ asset('frontend/images/default-user.png') }}" class="img-fluid rounded-circle" style="width: 70px;height: 50px" alt="">

                                <a class="nav-link dropdown-toggle px-0 mx-0" href="#navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->username }}</a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" id="navbarDropdown">
                                    <a class="dropdown-item text-dark py-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth

                        <li>
                            <button type="button" class="btn btn-primary btn_model" data-toggle="modal" data-target="#exampleModalCenter">
                                संपर्क साधा
                            </button>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" data-backdrop="true" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title " id="exampleModalLongTitle">संपर्क साधा</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-right" style="font-size: 20px;">
                    <b>अधिक माहितीसाठी संपर्क साधा : </b> <br>
                </div>
                <div class="justify-content-right">
                    <b>ईमेल : </b> support@coreocean.co.in <br>
                    <b>मोबाईल नं. :</b> 7304073989
                </div>
            </div>

          </div>
        </div>
    </div>
</div>
