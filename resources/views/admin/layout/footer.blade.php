        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                    ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by
                    <a href="https://github.com/mirza-mam" target="_blank" class="footer-link fw-bolder">Muhammad Abdullah Mirza</a>
                </div>
            </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
        </div>
        </div>
        <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

        <!-- Core JS -->
        <!-- build:js dashboard/vendor/js/core.js -->
        <script src="{{ asset('dashboard/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('dashboard/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('dashboard/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

        <script src="{{ asset('dashboard/vendor/js/menu.js') }}"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ asset('dashboard/vendor/libs/apex-charts/apexcharts.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('dashboard/js/main.js') }}"></script>

        <!-- Page JS -->
        <script src="{{ asset('dashboard/js/dashboards-analytics.js') }}"></script>
        <script>
            window.addEventListener('close-modal', event => {
                $('#' + event.detail.id).modal('hide');
            });
        </script>
        @stack('footer')
        @stack('wire_script')
        @livewireScripts
        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        </body>

        </html>
