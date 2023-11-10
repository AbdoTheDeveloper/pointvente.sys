<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content ">
        <div class="sidebar sidebar-left sidebar-dark bg-dark o-hidden" data-perfect-scrollbar>
            <div class="sidebar-p-y">
                <!-- Account menu -->
                <div class="sidebar-heading">Gestion</div>
                <ul class="sidebar-menu">
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#etudient_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person_outline</i> Élèves
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="etudient_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('trav.etudiants') }} ">
                                    <span class="sidebar-menu-text">Tous les élèves</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('trav.ajouter-etudiants') }} ">
                                    <span class="sidebar-menu-text">Ajouter un élève</span>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#professeurs_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left fa fa-user-circle"></i> Professeurs
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="professeurs_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('trav.Professeur') }}">
                                    <span class="sidebar-menu-text">Tous les professeurs</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button"  href="{{ route('trav.AddProfesseur') }}">
                                    <span class="sidebar-menu-text">Ajouter un professeur</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#certificat_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left fa fa-book "></i> Certificats
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="certificat_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('trav.certificats') }}">
                                    <span class="sidebar-menu-text">Tous les certificats</span>
                                </a>
                            </li>
                          
                           {{--  <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="#">
                                    <span class="sidebar-menu-text">Ajouter certificat</span>
                                </a>
                            </li> --}}
                             
                        </ul>
                    </li> 
               
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="{{ route('trav.eleveDelegue') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_box</i> Ajouter un élève délégué
                        </a>
                    </li>
 

                     <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button sidebar-js-collapse" data-toggle="collapse" href="#statistique_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left fa fa-bars"></i> Statistiques 
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu sm-indent collapse" id="statistique_menu">
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('statitiqueParcours') }}">
                                    <span class="sidebar-menu-text">Organisation Parcours   </span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('statitiqueItemNiveauParcours') }}">
                                    <span class="sidebar-menu-text">items par niveau </span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('statitiqueItemNiveauParcoursPourcentage') }}">
                                    <span class="sidebar-menu-text">items par niveau (%)  </span>
                                </a>
                            </li>
                              <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{ route('actionparClasses') }}">
                                    <span class="sidebar-menu-text">Action par Classe  </span>
                                </a>
                            </li>
                            
                            

                        </ul>
                    </li>
                </ul>
                
            </div>
        </div>
    </div>
</div>