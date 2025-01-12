<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Desa Jatirejo | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- all css card slide here -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="../style.css" rel="stylesheet" type="text/css" />

    <script src="../jquery-3.4.1.min.js"></script>
  </head>
  <body>
    @include('layouts.navigation')
    

    <div class="main mb-5">
        @yield('main')
    </div>

    
    <footer class="mt-5">
    @include('layouts.footer')
  </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    
    <!-- all js card  slide here -->
    {{-- <script src="jquery-3.4.1.min.js"></script> --}}
    <script src="../bootstrap.min.js"></script>
    <script src="../owl.carousel.min.js"></script>
    <script>
        
        function slider_carouselInit() {
            $('.owl-carousel.slider_carousel').owlCarousel({
                dots: false,
                loop: true,
                margin: 30,
                stagePadding: 2,
                autoplay: false,
                nav: true,
                navText: ["<i class='far fa-arrow-alt-circle-left'></i>","<i class='far fa-arrow-alt-circle-right'></i>"],
                autoplayTimeout: 1500,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2,
                    },
                    992: {
                        items: 5
                    }
                }
            });
        }
        slider_carouselInit();

    </script>

    {{-- script untuk bagian saran dan masukan --}}
    <script>
        // Dummy chat data
        var chatData = [
            { type: 'user', message: 'Assalamualakum Wr Wb' },
            { type: 'admin', message: 'Ayo Sampaikan Saran dan Masukan yang membangun Desa KITA..., Mohon Gunakan Bahasa Yang Sopan' }
        ];

        // Function to display chat messages
        function displayChatMessages() {
            var chatBox = document.getElementById('chat-box');
            chatBox.innerHTML = '';

            chatData.forEach(function (chat) {
                var messageClass = chat.type === 'admin' ? 'text-success' : 'text-primary';
                chatBox.innerHTML += '<p class="' + messageClass + '">' + chat.message + '</p>';
            });
        }

        // Function to send a user message
        function sendMessage() {
            var userInput = document.getElementById('message-input').value;
            chatData.push({ type: 'user', message: userInput });
            displayChatMessages();
            // Clear the input field after sending the message
            document.getElementById('message-input').value = '';
        }

        // Display initial chat messages
        displayChatMessages();
    </script>

    {{-- script untuk bagian penampil PDF Keuangan desa --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil semua elemen list-group-item
            var listItems = document.querySelectorAll('.list-group-item');
        
            // Simpan tahun-tahun dalam array
            var years = [];
    
            listItems.forEach(function(item) {
                var currentYear = parseInt(item.textContent.trim());
                years.push(currentYear);
            });
    
            // Urutkan tahun-tahun dari terendah ke tertinggi
            years.sort(function(a, b) {
                return a - b;
            });
    
            // Tambahkan kelas "active" ke elemen dengan tahun tertinggi
            var highestYear = years[years.length - 1];
            var highestYearElement = Array.from(listItems).find(function(item) {
                return parseInt(item.textContent.trim()) === highestYear;
            });
    
            if (highestYearElement) {
                highestYearElement.classList.add('active');
        
                // Ambil data PDF URL dari atribut data-pdf-url
                var pdfUrl = highestYearElement.dataset.pdfUrl;
        
                // Dapatkan elemen iframe
                var pdfViewer = document.getElementById('pdf-viewer');
        
                // Ganti atribut src dengan URL PDF
                pdfViewer.src = pdfUrl;
            }
        
            // Tambahkan event listener untuk setiap item
            listItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    // Hapus kelas "active" dari semua elemen
                    listItems.forEach(function(item) {
                        item.classList.remove('active');
                    });
        
                    // Tambahkan kelas "active" ke elemen yang diklik
                    this.classList.add('active');
        
                    // Ambil data PDF URL dari atribut data-pdf-url
                    var pdfUrl = this.dataset.pdfUrl;
        
                    // Dapatkan elemen iframe
                    var pdfViewer = document.getElementById('pdf-viewer');
        
                    // Ganti atribut src dengan URL PDF
                    pdfViewer.src = pdfUrl;
                });
            });
        });
    </script>
    
        
  </body>
  
</html>