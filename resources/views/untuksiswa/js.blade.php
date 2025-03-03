        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('environs-1.0.0/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('environs-1.0.0/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('environs-1.0.0/lib/counterup/counterup.min.js') }}"></script>
        <script src="{{ asset('environs-1.0.0/lib/owlcarousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('environs-1.0.0/lib/lightbox/js/lightbox.min.js') }}"></script>


        <!-- Template Javascript -->
        <script src="{{ asset('environs-1.0.0/js/main.js') }}"></script>

        <!--Select2-->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            function scrollToSection() {
                document.getElementById('section2').scrollIntoView({
                    behavior: 'smooth'
                });
            }
        </script>

        <script>
            $(document).ready(function() {
                $('#peminjamantahunan_id').select2()

            })
        </script>
        <script>
            $(document).ready(function() {
                $('#siswa_id').select2()

            })
        </script>
        <script>
            $(document).ready(function() {
                $('#peminjaman_name').select2()

            })
        </script>
        <script>
            $(document).ready(function() {
                $('#peminjamantahunan_name').select2()

            })
        </script>
        <script>
            $(document).ready(function() {
                $('#bukucrud').select2()

            })
        </script>
        <script>
            $(document).ready(function() {
                $('#bukuharian').select2()

            })
        </script>
        <script>
            $(document).ready(function() {
                $('#kodebuku').select2()

            })
        </script>
