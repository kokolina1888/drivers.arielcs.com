<!DOCTYPE html>
<html lang="bg" data-textdirection="ltr" class="loading">
<head>  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <!-- <link rel="shortcut icon" type="image/png" href="../../app-assets/images/ico/favicon-32.png"> -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <!-- Styles -->
  <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> 
  
  <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="crossorigin="anonymous"></script>
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.css')); ?>">
  <!-- BEGIN ROBUST CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap-extended.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/app_robust.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/colors.css')); ?>">
  <!-- END ROBUST CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/menu/menu-types/vertical-menu.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/menu/menu-types/vertical-overlay-menu.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/pages/login-register.css')); ?>">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('style.css')); ?>">
  <!-- END Custom CSS-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> 
  <!-- date-time-range-picker -->    
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

  <!-- navbar-fixed-top-->
  <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav">
          <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
          <li class="nav-item"><a href="index.html" class="navbar-brand nav-link"><img alt="LOGO" src="" data-expand="../../app-assets/images/logo/robust-logo-light.png" data-collapse="../../app-assets/images/logo/robust-logo-small.png" class="brand-logo"></a></li>
          <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
        </ul>
      </div>
      <div class="navbar-container content container-fluid">
        <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
          <ul class="nav navbar-nav">
            <li class="nav-item hidden-sm-down"><a href="#" target="_blank" class="btn btn-success upgrade-to-pro">Последно влизане: <?php echo e(Carbon\Carbon::parse(Auth::user()->last_login_at_show)->format('d-m-Y H:i:s')); ?></i>
            </a></li>
          </ul>
          <ul class="nav navbar-nav float-xs-right">              
            <li class="dropdown nav-user nav-item">
              <a href="#" class="dropdown-toggle user-name nav-link" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                <?php echo e(Auth::user()->username); ?> <!-- <span class="caret"></span> -->
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="login" href="<?php echo e(route('logout')); ?>"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  Изход
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                  <?php echo e(csrf_field()); ?>

                </form>
              </li>
            </ul>
          </li>
        </li>
      </ul>
    </div>
  </div>
</div>
</nav>
<!-- main menu-->
<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
  <!-- main menu header-->
  <div class="main-menu-header">
  </div>
  <!-- / main menu header-->
  <!-- main menu content-->
  <div class="main-menu-content">
    <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
      <li class="nav-item active"><a <?php if(Route::currentRouteName() === 'home'){ echo 'class=open-active-list'; }?> href="<?php echo e(route('home')); ?>"><i class="fas fa-home"></i> Начало</a>         
      </li>
      <li class="nav-item <?php if(Route::currentRouteName() === 'drivers_list' || Route::currentRouteName() === 'drivers_create' || Route::currentRouteName() === 'drivers_edit' || Route::currentRouteName() === 'offices_list' || Route::currentRouteName() === 'offices_create' || Route::currentRouteName() === 'offices_edit'){ echo 'open-active open'; }?>"><a href="#"><i class="fas fa-male"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Водачи</span></a>
        <ul class="menu-content">
          <li><a <?php if(Route::currentRouteName() === 'drivers_list' || Route::currentRouteName() === 'drivers_edit'){ echo 'class=open-active-list'; }?> href="<?php echo e(route('drivers_list')); ?>" class="menu-item"><i class="fas fa-user-tie"></i> Списък водачи</a>
          </li>
          <?php if( Auth::user()->role == 'admin'): ?>
          <li><a <?php if(Route::currentRouteName() === 'drivers_create'){ echo 'class=open-active-list'; }?> href="<?php echo e(route('drivers_create')); ?>" data-i18n="nav.page_layouts.2_columns" class="menu-item">Добави водач</a>
          </li>  
          <?php endif; ?>
          <li><a <?php if(Route::currentRouteName() === 'offices_list' || Route::currentRouteName() === 'offices_edit'){ echo 'class=open-active-list'; }?> href="<?php echo e(route('offices_list')); ?>" class="menu-item"> <i class="fas fa-igloo"></i> Списък офиси</a>
          </li>
          <?php if( Auth::user()->role == 'admin'): ?>
          <li><a <?php if(Route::currentRouteName() === 'offices_create'){ echo 'class=open-active-list'; }?> href="<?php echo e(route('offices_create')); ?>" data-i18n="nav.page_layouts.2_columns" class="menu-item">Добави офис</a>
          <?php endif; ?>
          </li>            
        </ul>
      </li>
      <li class="nav-item <?php if(Route::currentRouteName() === 'trucks_list' || Route::currentRouteName() === 'trucks_create' || Route::currentRouteName() === 'trucks_edit' || Route::currentRouteName() === 'trucks_weight_categories_list' || Route::currentRouteName() === 'trucks_weight_category_create' || Route::currentRouteName() === 'trucks_weight_category_edit'){ echo 'open-active open'; }?>"><a href="#"><i class="fas fa-truck"></i><span data-i18n="nav.project.main" class="menu-title">МПС</span></a>
        <ul class="menu-content">
          <li><a <?php if(Route::currentRouteName() === 'trucks_list' || Route::currentRouteName() === 'trucks_edit'){ echo 'class=open-active-list'; }?> href="<?php echo e(route('trucks_list')); ?>" data-i18n="nav.invoice.invoice_template" class="menu-item">Списък МПС</a>
          </li>
          <?php if( Auth::user()->role == 'admin'): ?>
          <li><a <?php if(Route::currentRouteName() === 'trucks_create'){ echo 'class=open-active-list'; }?> href="<?php echo e(route('trucks_create')); ?>" data-i18n="nav.gallery_pages.gallery_grid" class="menu-item">Добави МПС</a>
          </li>
          <?php endif; ?>
          <li><a <?php if(Route::currentRouteName() === 'trucks_weight_categories_list' || Route::currentRouteName() === 'trucks_weight_category_edit'){ echo 'class=open-active-list'; }?> href="<?php echo e(route('trucks_weight_categories_list')); ?>" data-i18n="nav.gallery_pages.gallery_grid" class="menu-item">Списък - Тонажни категории</a>
          </li>
          <?php if( Auth::user()->role == 'admin'): ?>
          <li><a <?php if(Route::currentRouteName() === 'trucks_weight_category_create'){ echo 'class=open-active-list'; }?> href="<?php echo e(route('trucks_weight_category_create')); ?>" data-i18n="nav.gallery_pages.gallery_grid" class="menu-item">Добави тонажна категория</a>
          </li>
          <?php endif; ?>
        </ul>
      </li>
      <li class="nav-item <?php if(Route::currentRouteName() === 'documents_list' || Route::currentRouteName() === 'route_list_create' || Route::currentRouteName() === 'documents_edit' || Route::currentRouteName() === 'create_data_by_hand' || Route::currentRouteName() === 'edit_handentered_data' || Route::currentRouteName() === 'route_lists_list' || Route::currentRouteName() === 'bulk_add_sales_data' || Route::currentRouteName() === 'sales_data_file_list' || Route::currentRouteName()=='route_list_edit' || Route::currentRouteName() === 'data_hand_list' || Route::currentRouteName() === 'edit_handentered_data' || Route::currentRouteName() === 'update_handentered_data'){ echo 'open-active open'; }?>"><a href="#"><i class="fas fa-file"></i><span data-i18n="nav.cards.main" class="menu-title">Документи</span></a>
        <ul class="menu-content">
        	<li><a href="<?php echo e(route('documents_list', ['id', 'DESC'])); ?>"  <?php if(Route::currentRouteName() === 'documents_list' || Route::currentRouteName() === 'documents_edit' || Route::currentRouteName() === 'documents_list'){ echo 'class=open-active-list'; }?> class="menu-item"><i class="fas fa-clipboard-list"></i> Списък товарителници</a>
          </li>
          <li><a href="<?php echo e(route('route_lists_list', ['id', 'DESC'])); ?>"  <?php if(Route::currentRouteName() === 'route_lists_list' || Route::currentRouteName()=='route_list_edit'){ echo 'class=open-active-list'; }?> class="menu-item"><i class="fas fa-list-ul"></i> Списък пътни листове</a>
          </li>          
          <li><a href="<?php echo e(route('data_hand_list', ['id', 'DESC'])); ?>"  <?php if(Route::currentRouteName() === 'data_hand_list' || Route::currentRouteName() === 'edit_handentered_data' || Route::currentRouteName() === 'update_handentered_data'){ echo 'class=open-active-list'; }?> class="menu-item"><i class="fas fa-list-ol"></i> Списък ръчно въведени документи</a>
          </li>
          <li><a href="<?php echo e(route('route_list_create')); ?>" <?php if(Route::currentRouteName() === 'route_list_create'){ echo 'class=open-active-list'; }?> class="menu-item"><i class="fas fa-boxes"></i> Добавяне пътен лист <br> с товарителници</a>
          </li>          
          <li><a href="<?php echo e(route('create_data_by_hand')); ?>" <?php if(Route::currentRouteName() === 'create_data_by_hand'){ echo 'class=open-active-list'; }?> class="menu-item"><i class="fas fa-pencil-alt"></i> Въвеждане на данни/ръчно</a>
          </li> 
          <li>
            <a href="<?php echo e(route('bulk_add_sales_data')); ?>"  <?php if(Route::currentRouteName() === 'bulk_add_sales_data'){ echo 'class=open-active-list'; }?> class="menu-item">
              <i class="fa fa-upload" aria-hidden="true"></i>
              Добавяне справка продажби <br> с 2ра м. ед.
            </a>
          </li>           
          <li><a href="<?php echo e(route('sales_data_file_list', ['id', 'DESC'])); ?>" <?php if(Route::currentRouteName() === 'sales_data_file_list'){ echo 'class=open-active-list'; }?> class="menu-item">
            <i class="fas fa-warehouse"></i> Списък справки продажби <br> с 2ра м. ед.
          </a>
        </li> 
                
      </ul>
    </li>
    <li class="nav-item <?php if(Route::currentRouteName() === 'reports_original_init' || Route::currentRouteName() === 'reports_original_view' || Route::currentRouteName() === 'reports_spravka_init' || Route::currentRouteName() === 'reports_spravka_view' || Route::currentRouteName() === 'reports_international_init' || Route::currentRouteName() === 'reports_international_view' || Route::currentRouteName() === 'reports_noname_init' || Route::currentRouteName() === 'reports_noname_view' || Route::currentRouteName() === 'reports_drivers_to_days_init' || Route::currentRouteName() === 'reports_drivers_to_days_view' || Route::currentRouteName() === 'reports_drivers_for_period_init' || Route::currentRouteName() === 'reports_drivers_for_period_view' || Route::currentRouteName() === 'reports_province_drivers_in_sofia_init' || Route::currentRouteName() === 'reports_province_drivers_in_sofia_view'){ echo 'open-active open'; }?>"><a href="#"><i class="fas fa-file"></i><span data-i18n="nav.cards.main" class="menu-title">Справки</span></a>
      <ul class="menu-content">
        <li class="<?php if(Route::currentRouteName() === 'reports_original_init' || Route::currentRouteName() === 'reports_original_view'){ echo 'active'; }?>"><a href="<?php echo e(route('reports_original_init')); ?>" <?php if(Route::currentRouteName() === 'reports_original_init' || Route::currentRouteName() === 'reports_original_view' ){ echo 'class=open-active-list'; }?> class="menu-item"><i class="fas fa-barcode"></i> Справка "Оригинал"</a>
        </li>
        <li class="<?php if(Route::currentRouteName() === 'reports_international_init' || Route::currentRouteName() === 'reports_international_view'){ echo 'active'; }?>"><a href="<?php echo e(route('reports_international_init')); ?>" <?php if(Route::currentRouteName() === 'reports_international_init' || Route::currentRouteName() === 'reports_international_view'){ echo 'class=open-active-list'; }?> class="menu-item"><i class="fas fa-drafting-compass"></i> Справка "Международен транспорт"</a>
        </li>
        <li class="<?php if(Route::currentRouteName() === 'reports_noname_init' || Route::currentRouteName() === 'reports_noname_view'){ echo 'active'; }?>">
          <a href="<?php echo e(route('reports_noname_init')); ?>" class="menu-item <?php if(Route::currentRouteName() === 'reports_noname_init' || Route::currentRouteName() === 'reports_noname_view'){ echo 'open-active-list'; }?>"><i class="fas fa-bezier-curve"></i> Справка "Без име"</a>
        </li>
        <li class="<?php if(Route::currentRouteName() === 'reports_spravka_init' || Route::currentRouteName() === 'reports_spravka_view'){ echo 'active'; }?>">
          <a href="<?php echo e(route('reports_spravka_init')); ?>" class="menu-item <?php if(Route::currentRouteName() === 'reports_spravka_init' || Route::currentRouteName() === 'reports_spravka_view'){ echo 'open-active-list'; }?>"><i class="fas fa-chess-knight"></i> Справка "Справка"</a>
        </li>
        <li class="<?php if(Route::currentRouteName() === 'reports_drivers_to_days_init' || Route::currentRouteName() === 'reports_drivers_to_days_view'){ echo 'active'; }?>">
          <a href="<?php echo e(route('reports_drivers_to_days_init')); ?>" class="menu-item <?php if(Route::currentRouteName() === 'reports_drivers_to_days_init' || Route::currentRouteName() === 'reports_drivers_to_days_view'){ echo 'open-active-list'; }?>"><i class="fas fa-code-branch"></i> Шофьори - по дни</a>
        </li>
        <li class="<?php if(Route::currentRouteName() === 'reports_drivers_for_period_init' || Route::currentRouteName() === 'reports_drivers_for_period_view'){ echo 'active'; }?>">
          <a href="<?php echo e(route('reports_drivers_for_period_init')); ?>" class="menu-item <?php if(Route::currentRouteName() === 'reports_drivers_for_period_init' || Route::currentRouteName() === 'reports_drivers_for_period_view'){ echo 'open-active-list'; }?>"><i class="fas fa-chess"></i> Шофьори - сумарна</a>
        </li>
        <li class="<?php if(Route::currentRouteName() === 'reports_province_drivers_in_sofia_init' || Route::currentRouteName() === 'reports_province_drivers_in_sofia_init'){ echo 'active'; }?>">
          <a href="<?php echo e(route('reports_province_drivers_in_sofia_init')); ?>" class="menu-item <?php if(Route::currentRouteName() === 'reports_province_drivers_in_sofia_init' || Route::currentRouteName() === 'reports_province_drivers_in_sofia_view'){ echo 'open-active-list'; }?>"><i class="fas fa-dice-d20"></i> Шофьори - провинциални</a>
        </li>
      </ul>
    </li>      
    <?php if( Auth::user()->role == 'admin'): ?>
    <li class="nav-item <?php if(Route::currentRouteName() === 'users_list' || Route::currentRouteName() === 'users_create' || Route::currentRouteName() === 'users_edit'){ echo 'open-active open'; }?>"><a href="#"><i class="fas fa-key"></i><span data-i18n="nav.project.main" class="menu-title">Потребители</span></a>
      <ul class="menu-content">
        <li><a <?php if(Route::currentRouteName() === 'users_list' || Route::currentRouteName() === 'users_edit'){ echo 'class=open-active-list'; }?> href="<?php echo e(route('users_list')); ?>" class="menu-item">Списък потребители</a>
        </li>
        <li><a <?php if(Route::currentRouteName() === 'users_create'){ echo 'class=open-active-list'; }?> href="<?php echo e(route('users_create')); ?>" data-i18n="nav.gallery_pages.gallery_grid" class="menu-item">Добави потребител</a>
        </li>
      </ul>
    </li>
    <?php endif; ?>
  </ul>
</div>
<!-- /main menu content-->
<!-- main menu footer-->
<!-- include includes/menu-footer-->
<!-- main menu footer-->
</div>
<!-- / main menu-->

<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <?php echo $__env->yieldContent('content'); ?>
    </div>

  </div>
</div>
</div>


<!-- BEGIN VENDOR JS-->
<!-- <script src="../../app-assets/js/core/libraries/jquery.min.js" type="text/javascript"></script> -->
<script src="<?php echo e(asset('js/tether.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/perfect-scrollbar.jquery.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/unison.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/blockUI.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/jquery.matchHeight-min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/screenfull.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/pace.min.js')); ?>" type="text/javascript"></script>
<!-- BEGIN VENDOR JS
  <!-- BEGIN ROBUST JS-->
  <script src="<?php echo e(asset('js/app-menu.js')); ?>" type="text/javascript"></script>
  <script src="<?php echo e(asset('js/app.js')); ?>" type="text/javascript"></script>
  <!-- END ROBUST JS-->
  <!-- BEGIN PAGE LEVEL JS-->
<!-- <script src="<?php echo e(asset('js/dashboard-lite.js')); ?>" type="text/javascript"></script>
--><!-- END PAGE LEVEL JS-->
</body>
</html>
