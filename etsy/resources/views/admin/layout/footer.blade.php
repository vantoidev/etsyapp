        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    @yield('footer-scripts')

    <!-- Custom Theme Scripts -->
    <script src="template/build/js/custom.min.js"></script>

    <script type="text/javascript" charset="utf-8">
      function confirmDelete(msg) {
        if(window.confirm(msg)) {
          return true;
        }
        return false;
      }

    </script>
  
  </body>
</html>