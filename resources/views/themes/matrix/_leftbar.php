<?php //@$_SESSION["menu"] = true; ?>
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=BASE_URL?>/main" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <?php if (@$_SESSION["menu"] == true) { ?>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-folder-account"></i><span class="hide-menu">Socios de Negocio</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="<?=BASE_URL?>/person/listclients" class="sidebar-link"><i class="mdi mdi-account-circle"></i><span class="hide-menu"> Clientes </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?=BASE_URL?>/person/listshippers" class="sidebar-link"><i class="mdi mdi-airplane"></i><span class="hide-menu"> Shipper's </span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=BASE_URL?>/notify" aria-expanded="false"><i class="mdi mdi-table-large"></i><span class="hide-menu">Informes</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=BASE_URL?>/notify/addnew" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Crear Notificación</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?=BASE_URL?>/notify/desconsol" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Cerrados</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-search-web"></i><span class="hide-menu">Consultas</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?=BASE_URL?>/consult/consolidate"><i class="mdi mdi-package-variant-closed"></i><span class="hide-menu">Consolidados</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?=BASE_URL?>/consult/deconsolidateds"><i class="mdi mdi-package-variant"></i><span class="hide-menu">Desconsolidados</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="<?=BASE_URL?>/consult/deconsolidated"><i class="mdi mdi-dropbox"></i><span class="hide-menu">Desconsolidado</span></a>
                        </li>
                    </ul>
                </li>
                <?php }
                    if (@$_SESSION["type"] == 1) { ?>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Sistema </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="<?=BASE_URL?>/system/listusers" class="sidebar-link"><i class="mdi mdi-account-multiple"></i><span class="hide-menu"> Usuarios </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?=BASE_URL?>/system/listroles" class="sidebar-link"><i class="mdi mdi-checkbox-multiple-marked"></i><span class="hide-menu"> Roles </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?=BASE_URL?>/system/setting" class="sidebar-link"><i class="mdi mdi-settings-box"></i><span class="hide-menu"> Configuración </span></a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </nav>
        <!--- DO NOT EDIT - GlobalSign SSL Site Seal Code - DO NOT EDIT ---><table width=125 border=0 cellspacing=0 cellpadding=0 title="CLICK TO VERIFY: This site uses a GlobalSign SSL Certificate to secure your personal information." ><tr><td><span id="ss_img_wrapper_gmogs_image_110-45_en_black"><a href="https://www.globalsign.com/" target=_blank title="GlobalSign Site Seal" rel="nofollow"><img alt="SSL" border=0 id="ss_img" src="//seal.globalsign.com/SiteSeal/images/gs_noscript_110-45_en.gif"></a></span><script type="text/javascript" src="//seal.globalsign.com/SiteSeal/gmogs_image_110-45_en_black.js"></script></td></tr></table><!--- DO NOT EDIT - GlobalSign SSL Site Seal Code - DO NOT EDIT --->
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
