<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Панель управления</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin-dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="70">
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">


        @foreach($adminMainMenu as $key => $item)
            @if ($item['type'] === 'route')
                <li class="nav-item">
                    <a class="nav-link" href="{{ $item['route'] }}">
                        <i class="{{ $item['icon'] }}"></i>
                        <span>{{ $item['title'] }}</span></a>
                </li>
            @endif

            @if ($item['type'] === 'group')

                <li class="nav-item">
                    <a class="nav-link @if(!key_exists($currentRouteName, $item['routes'])) collapsed @endif" href="#"
                       data-toggle="collapse" data-target="#collapse_{{ $key }}"
                       aria-expanded="true" aria-controls="collapse_{{ $key }}">
                        <i class="{{ $item['icon'] }}"></i>
                        <span>{{ $item['title'] }}</span>
                    </a>

                    <div id="collapse_{{ $key }}"
                         class="collapse @if(key_exists($currentRouteName, $item['routes'])) show @endif"
                         aria-labelledby="heading_{{ $key }}"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">

                            <h6 class="collapse-header">{{ $item['title'] }}</h6>

                            @foreach($item['routes'] as $routeName => $item)
                                <a class="collapse-item @if($routeName === $currentRouteName) active @endif" href="{{ $item['route'] }}"
                                   @if($item['blank']) target="_blank" @endif>{{ $item['title'] }}</a>
                            @endforeach

                        </div>
                    </div>
                </li>

        @endif

        @if(!$loop->last)
            <!-- Divider -->
                <hr class="sidebar-divider">
        @endif
    @endforeach

    <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">0</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Сообщения
                            </h6>
                            {{-- <a class="dropdown-item d-flex align-items-center" href="#">
                                 <div class="dropdown-list-image mr-3">
                                     <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                     <div class="status-indicator bg-success"></div>
                                 </div>
                                 <div class="font-weight-bold">
                                     <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                     <div class="small text-gray-500">Emily Fowler · 58m</div>
                                 </div>
                             </a>--}}

                            {{--<a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>--}}
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            <img class="img-profile rounded-circle" src="{{ asset('images/empty_logo.png') }}"
                                 width="30">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Профиль
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Выход
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Filemanager Modal -->
<div class="modal fade" id="file_manager_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-fluid" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">File manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="fm"></div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Удалить?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="title_delete_model">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-danger btn-sm" id="approve_btn_delete">Удалить</button>
            </div>
        </div>
    </div>
</div>

</body>
<!-- Scripts -->
<script src="{{ asset('js/admin/app.js') }}"></script>

<script src='https://cloud.tinymce.com/4/tinymce.min.js'></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        tinymce.init({
            selector: '.textarea_tinymce',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table directionality',
                'emoticons template paste textcolor colorpicker textpattern image imagetools textcolor',
            ],
            toolbar: 'forecolor backcolor | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
            relative_urls: false,
            height: 400,
            file_browser_callback: function (field_name, url, type, win) {
                tinyMCE.activeEditor.windowManager.open({
                    file: '/file-manager/tinymce',
                    title: 'File Manager',
                    width: window.innerWidth * 0.8,
                    height: window.innerHeight * 0.8,
                    resizable: 'yes',
                    close_previous: 'no',
                }, {
                    setUrl: function (url) {
                        win.document.getElementById(field_name).value = url;
                    },
                });
            },
            init_instance_callback: function (editor) {
                var freeTiny = document.querySelector('.mce-notification');
                freeTiny.style.display = 'none';
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        fm.$store.commit('fm/setFileCallBack', function (fileUrl) {
            let modal = $('#file_manager_modal');
            let modalTarget = modal.data('targetSelectedImage');

            $('#' + modalTarget).val(fileUrl);
            $('#selected_' + modalTarget).attr('src', fileUrl);

            modal.modal('hide');
            return false;
        });
    });

    let imageSelectedItems = document.querySelectorAll(".select_image");
    for (let i = 0; i < imageSelectedItems.length; i++) {
        imageSelectedItems[i].addEventListener("click", function (event) {
            $('#file_manager_modal').data('targetSelectedImage', $(this).data('targetSelectedImage')).modal('show');
        }, false);
    }
</script>
</html>
