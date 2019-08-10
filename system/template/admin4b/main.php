<?php
$theme_URL=site_url("system/template/admin4b",true);
?><!doctype html>
<html lang="en">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#2e8cc2">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="author" content="Marx JMoura">
    <meta name="copyright" content="LogiQ System">
    <meta name="description" content="Blank page is a startup point for creating your content.">
    <title><?php print $systemTitle; ?> - <?php print $title; ?></title>
    <link rel="icon" href="/docs/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php print $theme_URL?>/src/dist/admin4b.min.css" rel="stylesheet">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="<?php print $theme_URL?>/src/dist/admin4b.min.js"></script>
    <script src="<?php print $theme_URL?>/src/docs/assets/js/docs.js"></script>
    <style>
        .app-sidebar .sidebar-header {
  background-image: url("<?php print $theme_URL?>/src/docs/assets/img/sidebar-header.svg");
  background-repeat: no-repeat;
  background-size: 100% 100%;
}

.page-sign {
  background-attachment: fixed;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.page-sign.sign-in {
  background:
    linear-gradient(160deg, rgba(60, 162, 224, .25) 50%, rgba(241, 244, 245, .9) 50%),
    url("/docs/assets/img/rocky-mountain.jpg");
}

.page-sign.sign-up {
  background:
    linear-gradient(-160deg, rgba(60, 162, 224, .25) 50%, rgba(241, 244, 245, .9) 50%),
    url("/docs/assets/img/rocky-mountain.jpg");
}
    </style>
</head>

<body>
    <div class="app">
        <div class="app-sidebar">
            <div class="sidebar-header">
                <svg class="avatar">
                    <use href="<?php print $theme_URL?>/src/docs/assets/img/faces.svg#john" />
                </svg>
                <div class="username"><span><?php print current_user('firstname').' '.current_user('lastname');?></span>
                 <small><?php
                    $school_data=sSelectTb($systemDb,'school_data','*','school_id='.sQ(current_user('school_id')));
                    $school_data=$school_data[0];
                    print $school_data['school_name'];
                 ?></small></div>
            </div>
            <div id="sidebar-nav" class="sidebar-nav">
            <?php
            $topMenu['Dashboard']=array(
            'class' => "header",
            'title' => 'Dashboard',
            'cond' => true,
            'bullet' => 'fa fa-dashboard',
            'url' => 'main/home/dashboard/view',
        );
            print gen_main_menu($menu_id='top-sidebar-nav',  $topMenu, $def=NULL,$class='sidebar-nav');
            print '<hr>';
            $menu['admin']= array(
                'class' => "header",
                'title' => 'ดูแลระบบ',
                'cond' => true,
                'bullet' => 'fa fa-gears',
                'item' => array(
                    'manage' => array('bullet' => '',
                        'title' => 'จัดการระบบ',
                        'url' => 'main/admin/manage/general',
                        'cond' => true,
                        ),
                    ),
                    
                );

                $menu['user']= array(
                    'class' => "header",
                    'title' => 'ผู้ใช้',
                    'cond' => true,
                    'bullet' => 'fa fa-users',
                    'item' => array(
                        'manage' => array('bullet' => '',
                            'title' => 'โปรไฟล์',
                            'url' => 'main/user/profile/general',
                            'cond' => true,
                            ),
                            
                        'picture' => array('bullet' => '',
                        'title' => 'รูป',
                        'url' => 'main/user/picture/general',
                        'cond' => true,
                        ),
                        ),
                        
                    );
                print gen_main_menu($menu_id='sidebar-nav', $menu, $def=NULL,$class='sidebar-nav','เมนู');
                print '<hr>';
                $footMenu['logout']=array(
                    'class' => "header",
                    'title' => 'Log OUT',
                    'cond' => true,
                    'bullet' => 'fa fa-power-off',
                    'url' => 'authen/logout/sign/out',
                );
                print gen_main_menu($menu_id='top-sidebar-nav',  $footMenu, $def=NULL,$class='sidebar-nav');
            ?>
            </div>
        </div>
        <div class="app-content">
            <div class="content-header">
                <nav class="navbar navbar-expand navbar-light bg-white">
                    <div class="navbar-brand">
                        <button type="button" class="btn btn-sidebar" data-toggle="sidebar"><i class="fa fa-bars"></i></button> <span class="pr-2"><?php print $systemTitle; ?></span> </div>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="badge badge-pill badge-primary">3</span> <i class="fa fa-bell-o"></i></a>
                            <div class="dropdown-menu dropdown-menu-right"><a href="/docs/pages/content/notification.html" class="dropdown-item"><small class="dropdown-item-title">Lorem ipsum (today)</small><br><div>Lorem ipsum dolor sit amet...</div></a>
                                <div class="dropdown-divider"></div><a href="/docs/pages/content/notification.html" class="dropdown-item"><small class="text-muted">Lorem ipsum (yesterday)</small><br><div>Lorem ipsum dolor sit amet...</div></a>
                                <div class="dropdown-divider"></div><a href="/docs/pages/content/notification.html" class="dropdown-item"><small class="text-muted">Lorem ipsum (12/25/2017)</small><br><div>Lorem ipsum dolor sit amet...</div></a>
                                <div class="dropdown-divider"></div><a href="/docs/pages/content/notifications.html" class="dropdown-item dropdown-link">See all notifications</a></div>
                        </li>
                    </ul>
                </nav>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><?php print ucfirst($app); ?></li>
                        <li class="breadcrumb-item"><?php print ucfirst($function); ?></li>
                    </ol>
                </nav>
            </div>
            <div class="content-body">
                <div class="container">
                    <?php
                        print $content;
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
print $systemFoot;
?>
</html>
<?php
    print_r($_COOKIES);