   





        <!-- jQuery -->
    <script src="{{url('assets/vendor/jquery.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{url('assets/vendor/popper.min.js')}}"></script>
    <script src="{{url('assets/vendor/bootstrap.min.js')}}"></script>

    <!-- Perfect Scrollbar -->
    <script src="{{url('assets/vendor/perfect-scrollbar.min.js')}}"></script>

    <!-- MDK -->
    <script src="{{url('assets/vendor/dom-factory.js')}}"></script>
    <script src="{{url('assets/vendor/material-design-kit.js')}}"></script>

    <!-- App JS -->
    <script src="{{url('assets/js/app.js')}}"></script>

    <!-- Highlight.js -->
    <script src="{{url('assets/js/hljs.js')}}"></script>

    <!-- App Settings (safe to remove) -->
    <script src="{{url('assets/js/app-settings.js')}}"></script>

    <!-- Global Settings -->
    <script src="{{url('assets/js/settings.js')}}"></script>

    <!-- Moment.js -->
    <script src="{{url('assets/vendor/moment.min.js')}}"></script>
    <script src="{{url('assets/vendor/moment-range.min.js')}}"></script>

    <!-- Chart.js -->
    <script src="{{url('assets/vendor/Chart.min.js')}}"></script>

    <!-- UI Charts Page JS -->
    <script src="{{url('assets/js/chartjs-rounded-bar.js')}}"></script>
    <script src="{{url('assets/js/chartjs.js')}}"></script>

    <script src="{{url('assets/js/select2.full.js')}}"></script>

    <!-- Chart.js Samples -->
    <script src="{{url('assets/js/page.student-dashboard.js')}}"></script>



    <script type="text/javascript">
    
        $( document ).ready(function() {
    
$(".select2-single").select2({
            theme: "bootstrap",
            placeholder: "",
            maximumSelectionSize: 6,
            containerCssClass: ":all:"
        });

    });


</script>

			@yield('script')