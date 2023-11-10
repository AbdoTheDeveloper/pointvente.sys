
@extends('Admin.main')


@section('script')

 <!-- slimscroll, waves Scripts Plugin Js -->

<script src="{{url('assets/bundles/morrisscripts.bundle.js')}}"></script><!-- Morris Plugin Js -->
<script src="{{url('assets/bundles/jvectormap.bundle.js')}}"></script> <!-- JVectorMap Plugin Js -->
<script src="{{url('assets/plugins/jvectormap/jquery-jvectormap-us-aea-en.js')}}"></script><!-- USA Map Js -->
<script src="{{url('assets/bundles/knob.bundle.js')}}"></script> <!-- Jquery Knob, Count To, Sparkline Js -->

<script src="{{url('assets/js/pages/index.js')}}"></script>
@endsection
@section('content')
<section class="content home">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <h2>Tableau de bord
                <small>Bienvenue au Lycée Français International Jean Jaures</small>
                </h2>
            </div>            
          
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6">
                        <div class="card top_counter">
                            <div class="body">
                                <div class="icon xl-slategray"><i class="zmdi zmdi-account-o"></i> </div>
                                <div class="content">
                                    <div class="text">Étudiant</div>
                                    <h5 class="number count-to" data-from="0" data-to="2049" data-speed="2500" data-fresh-interval="700">2049</h5>
                                </div>
                            </div>                    
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card top_counter">
                            <div class="body">
                                <div class="icon xl-slategray"><i class="zmdi zmdi-account-circle"></i> </div>
                                <div class="content">
                                    <div class="text">Professeur</div>
                                    <h5 class="number count-to" data-from="0" data-to="39" data-speed="4000" data-fresh-interval="700">39</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card top_counter">
                            <div class="body">
                                <div class="icon xl-slategray"><i class="zmdi zmdi-label"></i> </div>
                                <div class="content">
                                    <div class="text">Item</div>
                                    <h5 class="number count-to" data-from="0" data-to="798" data-speed="3000" data-fresh-interval="700">798</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card top_counter">
                            <div class="body">
                                <div class="icon xl-slategray"><i class="zmdi zmdi-graduation-cap"></i> </div>
                                <div class="content">
                                    <div class="text">Activiter</div>
                                    <h5 class="number count-to" data-from="0" data-to="43" data-speed="2500" data-fresh-interval="700">43</h5>
                                </div>
                            </div>                    
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card top_counter">
                            <div class="body">
                                <div class="icon xl-slategray"><i class="zmdi zmdi-balance-wallet"></i> </div>
                                <div class="content">
                                    <div class="text">Parcours</div>
                                    <h5 class="m-b-0"><span class="number count-to" data-from="0" data-to="6" data-speed="2" data-fresh-interval="700">6</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card top_counter">
                            <div class="body">
                                <div class="icon xl-slategray"><i class="zmdi zmdi-balance"></i> </div>
                                <div class="content">
                                    <div class="text" style="font-size: 13px">Établissement</div>
                                    <h5 class="m-b-0"><span class="number count-to" data-from="0" data-to="6" data-speed="6" data-fresh-interval="700">6</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="card student-list">
                    <div class="header">
                        <h2><strong>Nouveau </strong> Liste d'admission<small>Description text here...</small></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp">
                                    <li><a href="javascript:void(0);">2017 Year</a></li>
                                    <li><a href="javascript:void(0);">2016 Year</a></li>
                                    <li><a href="javascript:void(0);">2015 Year</a></li>
                                </ul>
                            </li>
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover m-b-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Address</th>
                                        <th>Number</th>
                                        <th>Department</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="list-name">OU 00456</span></td>
                                        <td>Joseph</td>
                                        <td>25</td>
                                        <td>70 Bowman St. South Windsor, CT 06074</td>
                                        <td>404-447-6013</td>
                                        <td><span class="badge badge-primary">MCA</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="list-name">KU 00789</span></td>
                                        <td>Cameron</td>
                                        <td>27</td>
                                        <td>123 6th St. Melbourne, FL 32904</td>
                                        <td>404-447-4569</td>
                                        <td><span class="badge badge-warning">Medical</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="list-name">KU 00987</span></td>
                                        <td>Alex</td>
                                        <td>23</td>
                                        <td>123 6th St. Melbourne, FL 32904</td>
                                        <td>404-447-7412</td>
                                        <td><span class="badge badge-info">M.COM</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="list-name">OU 00951</span></td>
                                        <td>James</td>
                                        <td>23</td>
                                        <td>44 Shirley Ave. West Chicago, IL 60185</td>
                                        <td>404-447-2589</td>
                                        <td><span class="badge badge-default">MBA</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="list-name">OU 00456</span></td>
                                        <td>Joseph</td>
                                        <td>25</td>
                                        <td>70 Bowman St. South Windsor, CT 06074</td>
                                        <td>404-447-6013</td>
                                        <td><span class="badge badge-primary">MCA</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="list-name">OU 00953</span></td>
                                        <td>charlie</td>
                                        <td>21</td>
                                        <td>123 6th St. Melbourne, FL 32904</td>
                                        <td>404-447-9632</td>                                       
                                        <td><span class="badge badge-success">BBA</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
         
            </div>
           <div class="col-lg-4 col-md-12">
                <div class="card tasks_report">
                      <div class="card">
                    <div class="header">
                        <h2><strong>Louis </strong> Massignon <small></small></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                    <li><a href="javascript:void(0);">Edit</a></li>
                                    <li><a href="javascript:void(0);">Delete</a></li>
                                    <li><a href="javascript:void(0);">Report</a></li>
                                </ul>
                            </li>
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>                    
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs padding-0">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#chart-view">Chart View</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#table-view">Table View</a></li>
                        </ul>
                            
                        <!-- Tab panes -->
                        <div class="tab-content m-t-10">
                            <div class="tab-pane active" id="chart-view">
                                <div id="m_bar_chart" class="graph"></div>
                                                             
                            </div>
                            <div class="tab-pane" id="table-view">
                                <div class="table-responsive">
                                    <table class="table m-b-0 table-hover">
                                        <thead>
                                            <tr>                                                
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Earning</th>
                                                <th>Reviews</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>                                                
                                                <td>University Name</td>
                                                <td>Porterfield 508 Virginia Street Chicago, IL 60653</td>
                                                <td>$2,325</td>
                                                <td>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-neutral"><i class="zmdi zmdi-chart"></i></button>
                                                </td>
                                            </tr>
                                            <tr>                                                
                                                <td>University Name</td>
                                                <td>2595 Pearlman Avenue Sudbury, MA 01776 </td>
                                                <td>$3,325</td>
                                                <td>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-neutral"><i class="zmdi zmdi-chart"></i></button>
                                                </td>
                                            </tr>
                                            <tr>                                                
                                                <td>University Name</td>
                                                <td>Porterfield 508 Virginia Street Chicago, IL 60653</td>
                                                <td>$5,021</td>
                                                <td>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-neutral"><i class="zmdi zmdi-chart"></i></button>
                                                </td>
                                            </tr>
                                            <tr>                                                
                                                <td>University Name</td>
                                                <td>508 Virginia Street Chicago, IL 60653</td>
                                                <td>$1,325</td>
                                                <td>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star-outline"></i>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-neutral"><i class="zmdi zmdi-chart"></i></button>
                                                </td>
                                            </tr>
                                            <tr>                                                
                                                <td>University Name</td>
                                                <td>1516 Holt Street West Palm Beach, FL 33401</td>
                                                <td>$2,325</td>
                                                <td>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star-outline"></i>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-neutral"><i class="zmdi zmdi-chart"></i></button>
                                                </td>
                                            </tr>
                                            <tr>                                                
                                                <td>University Name</td>
                                                <td>508 Virginia Street Chicago, IL 60653</td>
                                                <td>$2,325</td>
                                                <td>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star col-amber"></i>
                                                    <i class="zmdi zmdi-star-outline"></i>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-neutral"><i class="zmdi zmdi-chart"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        </div>        
    </div>
</section>
@endsection
