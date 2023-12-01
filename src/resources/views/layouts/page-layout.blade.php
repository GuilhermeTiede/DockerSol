
<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>@yield('pageTitle')</title>

    <!-- Site favicon -->
    <link
        rel="apple-touch-icon"
        sizes="180x180"
        href="{{asset('back/vendors/images/apple-touch-icon.png')}}"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="{{asset('back/vendors/images/favicon-32x32.png')}}"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="{{asset('back/vendors/images/favicon-16x16.png')}}"
    />

    <!-- Mobile Specific Metas -->
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1"
    />

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('back/vendors/styles/core.css') }}"/>
    <link
        rel="stylesheet"
        type="text/css"
        href="{{asset('back/vendors/styles/icon-font.min.css')}}"
    />

    <link
        rel="stylesheet"
        type="text/css"
        href="{{asset('back/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{asset('back/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="{{asset('back/src/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}"
    />
    <link rel="stylesheet" type="text/css" href="{{asset('back/vendors/styles/style.css')}}" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">


    <script src="{{asset('back/src/scripts/jquery.min.js')}}"></script>
    <script src="{{asset('back/src/scripts/jquery.mask.min.js')}}"></script>
    <script src="{{asset('back/src/scripts/money.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    @stack('stylesheets')


</head>
<body>
<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
        <div
            class="search-toggle-icon bi bi-search"
            data-toggle="header_search"
        ></div>
    </div>
    <div class="header-right">
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a
                    class="dropdown-toggle"
                    href="#"
                    role="button"
                    data-toggle="dropdown"
                >
							<span class="user-icon">
								<img src="{{ asset($user->photo) }}" alt="" />
							</span>
                    <span class="user-name">{{ $user->name }}</span>
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="dw dw-logout"></i> Log Out
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="right-sidebar">
    <div class="sidebar-title">
        <h3 class="weight-600 font-16 text-blue">
            Layout Settings
            <span class="btn-block font-weight-400 font-12"
            >User Interface Settings</span
            >
        </h3>
        <div class="close-sidebar" data-toggle="right-sidebar-close">
            <i class="icon-copy ion-close-round"></i>
        </div>
    </div>
    <div class="right-sidebar-body customscroll">
        <div class="right-sidebar-body-content">
            <h4 class="weight-600 font-18 pb-10">Header Background</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a
                    href="javascript:void(0);"
                    class="btn btn-outline-primary header-white active"
                >White</a
                >
                <a
                    href="javascript:void(0);"
                    class="btn btn-outline-primary header-dark"
                >Dark</a
                >
            </div>

            <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
            <div class="sidebar-btn-group pb-30 mb-10">
                <a
                    href="javascript:void(0);"
                    class="btn btn-outline-primary sidebar-light"
                >White</a
                >
                <a
                    href="javascript:void(0);"
                    class="btn btn-outline-primary sidebar-dark active"
                >Dark</a
                >
            </div>

            <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
            <div class="sidebar-radio-group pb-10 mb-10">
                <div class="custom-control custom-radio custom-control-inline">
                    <input
                        type="radio"
                        id="sidebaricon-1"
                        name="menu-dropdown-icon"
                        class="custom-control-input"
                        value="icon-style-1"
                        checked=""
                    />
                    <label class="custom-control-label" for="sidebaricon-1"
                    ><i class="fa fa-angle-down"></i
                        ></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input
                        type="radio"
                        id="sidebaricon-2"
                        name="menu-dropdown-icon"
                        class="custom-control-input"
                        value="icon-style-2"
                    />
                    <label class="custom-control-label" for="sidebaricon-2"
                    ><i class="ion-plus-round"></i
                        ></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input
                        type="radio"
                        id="sidebaricon-3"
                        name="menu-dropdown-icon"
                        class="custom-control-input"
                        value="icon-style-3"
                    />
                    <label class="custom-control-label" for="sidebaricon-3"
                    ><i class="fa fa-angle-double-right"></i
                        ></label>
                </div>
            </div>

            <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
            <div class="sidebar-radio-group pb-30 mb-10">
                <div class="custom-control custom-radio custom-control-inline">
                    <input
                        type="radio"
                        id="sidebariconlist-1"
                        name="menu-list-icon"
                        class="custom-control-input"
                        value="icon-list-style-1"
                        checked=""
                    />
                    <label class="custom-control-label" for="sidebariconlist-1"
                    ><i class="ion-minus-round"></i
                        ></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input
                        type="radio"
                        id="sidebariconlist-2"
                        name="menu-list-icon"
                        class="custom-control-input"
                        value="icon-list-style-2"
                    />
                    <label class="custom-control-label" for="sidebariconlist-2"
                    ><i class="fa fa-circle-o" aria-hidden="true"></i
                        ></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input
                        type="radio"
                        id="sidebariconlist-3"
                        name="menu-list-icon"
                        class="custom-control-input"
                        value="icon-list-style-3"
                    />
                    <label class="custom-control-label" for="sidebariconlist-3"
                    ><i class="dw dw-check"></i
                        ></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input
                        type="radio"
                        id="sidebariconlist-4"
                        name="menu-list-icon"
                        class="custom-control-input"
                        value="icon-list-style-4"
                        checked=""
                    />
                    <label class="custom-control-label" for="sidebariconlist-4"
                    ><i class="icon-copy dw dw-next-2"></i
                        ></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input
                        type="radio"
                        id="sidebariconlist-5"
                        name="menu-list-icon"
                        class="custom-control-input"
                        value="icon-list-style-5"
                    />
                    <label class="custom-control-label" for="sidebariconlist-5"
                    ><i class="dw dw-fast-forward-1"></i
                        ></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input
                        type="radio"
                        id="sidebariconlist-6"
                        name="menu-list-icon"
                        class="custom-control-input"
                        value="icon-list-style-6"
                    />
                    <label class="custom-control-label" for="sidebariconlist-6"
                    ><i class="dw dw-next"></i
                        ></label>
                </div>
            </div>

            <div class="reset-options pt-30 text-center">
                <button class="btn btn-danger" id="reset-settings">
                    Reset Settings
                </button>
            </div>
        </div>
    </div>
</div>

<div class="left-side-bar">
    <div class="brand-logo">
        <a href="/">
            <img src="{{asset('back/vendors/images/logo1.svg')}}" alt="" class="dark-logo" />
            <img
                src="{{asset('back/vendors/images/logo1.svg')}}"
                alt=""
                class="light-logo"
            />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="/" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-house"></span
                                ><span class="mtext">Home</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bicropper bi-textarea-resize"></span
                                ><span class="mtext">Cadastros</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('empresas.index')}}">Empresas</a></li>
                        <li>
                            <a href="{{route('clientes.index')}}">Clientes</a>
                        </li>
                        <li><a href="{{route('contratos.index')}}">Contratos</a></li>
                        <li><a href="{{route('fontespagadoras.index')}}">Fonte Pagadora</a></li>
                        <li><a href="{{route('veiculos.index')}}">Veiculos</a></li>
                        <li><a href="{{route('motoristas.index')}}">Motoristas</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="{{route('fluxocaixas.index')}}" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-currency-dollar"></span
                                ><span class="mtext">Fluxo de Caixa</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('ordensservicos.index')}}" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-file-text"></span
                                ><span class="mtext">Ordem de Serviço</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-credit-card"></span
                                ><span class="mtext"> Financeiro </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('contasapagar.index')}}">Contas a Pagar</a></li>
                        <li><a href="{{route('notasfiscais.index')}}">Faturamento</a></li>
                        <li><a href="{{route('painelcontrole.index')}}">Painel de Controle</a></li>
                        <li><a href="{{route('painelcontrole.mensal')}}">Gerência</a></li>
                        <li><a href="{{route('painelcontrole.graficos')}}">Gráficos - Provisório</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>@yield('actualPage')</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    @yield('actualPage')
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Botao Utilitário-->
                    {{--                            <div class="dropdown-menu dropdown-menu-right">--}}
                    {{--                                <a class="dropdown-item" href="#">Exportar Algo</a>--}}
                    {{--                                <a class="dropdown-item" href="#">Mudar alguma coisa</a>--}}
                    {{--                            </div>--}}
                    <div class="col-md-6 col-sm-12 text-right">
                        <div class="button">
                            <button class="btn btn-primary"
                                    onclick="window.location.href = '@yield('link')' "
                            >@yield('button')</button>
                        </div>
                    </div>


                </div>
            </div>
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                @yield('content')
            </div>
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            @yield('footer')
        </div>
    </div>
</div>

<!-- js -->

<script src="{{asset('back/vendors/scripts/core.js')}}"></script>
<script src="{{asset('back/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('back/vendors/scripts/process.js')}}"></script>
<script src="{{asset('back/vendors/scripts/layout-settings.js')}}"></script>
{{--<script src="{{asset('back/vendors/scripts/datatable-setting.js')}}"></script>--}}
<script src="{{ asset('js/clientes.js') }}"></script>
<!--Datatable -->
<script src=" {{asset('back/src/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('back/src/plugins/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('back/src/plugins/datatables/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('back/src/plugins/datatables/js/responsive.bootstrap4.min.js')}}"></script>

<!--Charts-->
<script src="{{asset('back/src/plugins/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('back/vendors/scripts/apexcharts-setting.js')}}"></script>


<!-- buttons for Export datatable -->
<script src="{{asset('back/src/plugins/datatables/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('back/src/plugins/datatables/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('back/src/plugins/datatables/js/buttons.print.min.js')}}"></script>
<script src="{{asset('back/src/plugins/datatables/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('back/src/plugins/datatables/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('back/src/plugins/datatables/js/pdfmake.min.js')}}"></script>
<script src="{{asset('back/src/plugins/datatables/js/vfs_fonts.js')}}"></script>
<!-- Datatable Setting js -->
<script src="{{asset('back/vendors/scripts/datatable-setting.js')}}"></script>


@stack('scripts')
</body>
</html>
