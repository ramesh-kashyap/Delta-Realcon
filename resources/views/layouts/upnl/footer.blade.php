  <!--**********************************
            Footer start
        ***********************************-->
  <div class="footer">
      <div class="copyright">
          <p>Copyright © Designed &amp; Developed by <a href="https://mega-bot.co/" target="_blank">{{siteName()}}</a> 2025</p>
      </div>
  </div>
  <!--**********************************
            Footer end
        ***********************************-->
  @include('partials.notify')
  <!--**********************************
           Support ticket button start
        ***********************************-->

  <!--**********************************
           Support ticket button end
        ***********************************-->



  <!--**********************************
        Main wrapper end
    ***********************************-->

  <!--**********************************
        Scripts
    ***********************************-->
  <!-- Required vendors -->

  <script type="text/javascript">
      function googleTranslateElementInit() {
          new google.translate.TranslateElement({
              pageLanguage: 'en'
          }, 'google_translate_element');
      }
  </script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


  <script src="{{asset('')}}user/vendor/global/global.min.js"></script>
  <script src="{{asset('')}}user/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
  <script src="{{asset('')}}user/vendor/chart.js/Chart.bundle.min.js"></script>
  <script src="{{asset('')}}user/vendor/owl-carousel/owl.carousel.js"></script>
  <script src="{{asset('')}}user/vendor/datatables/js/jquery.dataTables.min.js"></script>
  <!-- Apex Chart -->
  <script src="{{asset('')}}user/vendor/apexchart/apexchart.js"></script>
  <!-- Dashboard 1 -->
  <script src="{{asset('')}}user/js/deznav-init.js"></script>
  <script src="{{asset('')}}user/js/custom.min.js"></script>
  <script src="{{asset('')}}user/js/dashboard/dashboard-1.js"></script>
  <script src="{{asset('')}}user/js/plugins-init/datatables.init.js"></script>
  <script src="{{asset('')}}user/js/demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
      $(document).ready(function() {
          $("#search-input").on("keyup", function() { // Jab user type karega
              var value = $(this).val().toLowerCase(); // User ka input lowercase me convert hoga
              $("#table-body tr").filter(function() { // Table ke sabhi rows par loop chalega
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1); // Agar text match kare to row dikhayega
              });
          });
      });
  </script>

  </body>

  </html>