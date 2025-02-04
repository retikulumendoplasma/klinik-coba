<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomor Antrian</title>
</head>
<body>
    <h1>Nomor Antrian</h1>
    <p>Nomor Antrian: <span id="nomorAntrian">{{ $nomorAntrian }}</span></p>
    <button onclick="playAntrian()">Panggil Nomor Antrian</button>

    <!-- Menggunakan asset helper untuk akses file audio -->
    <audio id="dingSound" src="{{ asset('audio/ding-sound.mp3') }}" preload="auto"></audio>

    <script>
        function playAntrian() {
            var nomorAntrian = document.getElementById("nomorAntrian").innerText;
            var dingSound = document.getElementById("dingSound");

            // Mainkan suara "ding ding ding"
            dingSound.play();
            
            // Tunggu suara "ding ding ding" selesai sebelum memainkan suara pengumuman nomor antrian
            dingSound.onended = function() {
                var utterance = new SpeechSynthesisUtterance("Nomor antrian " + nomorAntrian);
                
                // Set bahasa pengucapan ke bahasa Indonesia
                utterance.lang = "id-ID"; // Bahasa Indonesia
                
                // Set suara perempuan Indonesia jika tersedia
                var voices = window.speechSynthesis.getVoices();
                utterance.voice = voices.find(function(voice) {
                    return voice.lang === "id-ID" && voice.name.includes("Female"); // Menemukan suara perempuan bahasa Indonesia
                });

                // Jika tidak ada suara perempuan, gunakan suara default bahasa Indonesia
                if (!utterance.voice) {
                    utterance.voice = voices.find(function(voice) {
                        return voice.lang === "id-ID"; // Gunakan suara bahasa Indonesia default
                    });
                }

                // Atur kecepatan pengucapan
                utterance.rate = 0.1; // Kecepatan pengucapan lebih lambat

                window.speechSynthesis.speak(utterance); // Menggunakan TTS untuk mengumumkan nomor antrian
            };
        }
    </script>
</body>
</html>
