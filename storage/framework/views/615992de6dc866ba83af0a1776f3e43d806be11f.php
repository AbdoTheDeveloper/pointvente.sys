<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content ">
        <div class="sidebar sidebar-left sidebar-dark bg-dark o-hidden" data-perfect-scrollbar>
            <div class="sidebar-p-y">
                <!-- Account menu -->
                <div class="sidebar-heading">Gestion</div>
                <ul class="sidebar-menu">

                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="<?php echo e(route('admin.index')); ?>">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left fa fa-desktop"></i> Tableau de bord
                        </a>
                    </li>

                    <?php if(Auth::user()->p_recette): ?>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="<?php echo e(route('admin.index_recette')); ?>">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left fa fa-list"></i> Recette
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->p_trav): ?>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#direction_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person_outline</i> Travailleurs
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="direction_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('admin.index_travailleur')); ?> ">
                                    <span class="sidebar-menu-text">Tous les Travailleurs </span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('admin.create_travailleur')); ?> ">
                                    <span class="sidebar-menu-text">Ajouter un Travailleur</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->p_users && false): ?>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#user_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person_outline</i> Utilisateurs
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="user_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('users')); ?> ">
                                    <span class="sidebar-menu-text">Tous les Utilisateurs </span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('admin.ajouter-user')); ?> ">
                                    <span class="sidebar-menu-text">Ajouter un Utilisateur</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>


                    <?php if(Auth::user()->p_frns): ?>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#Fournisseurs_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person</i> Fournisseurs
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="Fournisseurs_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('admin.index_fournisseur')); ?> ">
                                    <span class="sidebar-menu-text">Tous les Fournisseurs </span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('admin.create_fournisseur')); ?> ">
                                    <span class="sidebar-menu-text">Ajouter un Fournisseur</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(Auth::user()->p_eleve): ?>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#etudient_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person_outline</i> Clients
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="etudient_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('etudiants')); ?> ">
                                    <span class="sidebar-menu-text">Tous les clients</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('ajouter-etudiants')); ?> ">
                                    <span class="sidebar-menu-text">Ajouter des clients</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('admin.etat.recharge')); ?> ">
                                    <span class="sidebar-menu-text">état recharge</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>






                    <?php if(Auth::user()->p_niv && false): ?>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#niveau_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">menu</i> Niveaux
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="niveau_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('niveau')); ?>">
                                    <span class="sidebar-menu-text">Tous les niveaux</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('AddNiveau')); ?>">
                                    <span class="sidebar-menu-text">Ajouter un niveau</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>


                    <?php if(Auth::user()->p_class && false): ?>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#class_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left fa fa-building"></i> Classe
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="class_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('classes')); ?>">
                                    <span class="sidebar-menu-text">Toutes les classes</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('AddClasse')); ?>">
                                    <span class="sidebar-menu-text">Ajouter une classe</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>




                    <?php if(Auth::user()->p_cat): ?>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#cat_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">menu</i> Categorie
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="cat_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('admin.index_cat')); ?>">
                                    <span class="sidebar-menu-text">Tous les Categories</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('admin.create_cat')); ?>">
                                    <span class="sidebar-menu-text">Ajouter une Categorie</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>


                    <?php if(Auth::user()->p_art): ?>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#article_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">menu</i> Articles
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="article_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('admin.index_article')); ?>">
                                    <span class="sidebar-menu-text">Tous les Articles</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('admin.create_article')); ?>">
                                    <span class="sidebar-menu-text">Ajouter un Article</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('admin.inventaire_prods')); ?>">
                                    <span class="sidebar-menu-text">Inventaire de stock</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>



                    <?php if(Auth::user()->p_stock): ?>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#Stock_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">menu</i> Stocks
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="Stock_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('admin.index_prodStock')); ?>">
                                    <span class="sidebar-menu-text">Tous le Stock</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('admin.create_prodStock')); ?>">
                                    <span class="sidebar-menu-text">Ajouter un Stock</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>





                    <?php if(Auth::user()->p_save): ?>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#backup_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left fa fa-save"></i> Sauvegarde
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="backup_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('backup')); ?>">
                                    <span class="sidebar-menu-text">Journal de sauvegarde </span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>




                    <?php if(Auth::user()->p_para): ?>
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#bas">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left fa fa-cog"></i> Paramétrage
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="bas">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('etablissements')); ?>">
                                    <span class="sidebar-menu-text">Profil </span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('bascule')); ?>">
                                    <span class="sidebar-menu-text">Importation </span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('pv')); ?>">
                                    <span class="sidebar-menu-text">Point de vente </span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="<?php echo e(route('params')); ?>">
                                    <span class="sidebar-menu-text">Configuration </span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <?php endif; ?>




                </ul>

            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\hp\Desktop\pointvente.sys\resources\views/Admin/inc/side.blade.php ENDPATH**/ ?>