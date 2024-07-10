<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="bg-zinc-50 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-50">
        <nav class="bg-blue-500">
            <div class="container mx-auto flex justify-between items-center p-4">
                <a href="index.php" class="text-2xl font-bold">LIV Laundry</a>
                <ul class="flex space-x-4">
                    <li><a href="pricing.php" class="hover:underline">Paket Cucian</a></li>
                    <li><a href="cekresi.php" class="hover:underline">Cek Resi</a></li>
                    <li><a href="about.php" class="hover:underline">Tentang Kami</a></li>
                    <li><a href="/laundry/admin/index.php" class="hover:underline">Panel Admin</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <section class="py-16 text-center bg-zinc-100">
        <h2 class="text-3xl font-bold">CEK RESI PESANAN ANDA</h2>
        <form id="resiForm" class="mt-8">
            <input type="text" id="resiInput" placeholder="Masukkan Kode Resi" class="p-2 border border-gray-300 rounded">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Cek Resi</button>
        </form>
        <div id="resiResult" class="mt-4"></div>
    </section>

    <footer class="bg-zinc-800 text-white p-8">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <h3 class="text-xl font-semibold mb-2">LIV Laundry</h3>
                <p class="mb-4">LIV Laundry berlokasi di Jalan Jaksa Agung Suprapto No. 161.</p>
                <div class="flex space-x-2">
                    <a href="#"><img aria-hidden="true" alt="facebook" src="./assets/facebook.png" width="20" height="20" /></a>
                    <a href="#"><img aria-hidden="true" alt="twitter" src="./assets/twitter.png" width="20" height="20" /></a>
                    <a href="#"><img aria-hidden="true" alt="google-plus" src="./assets/google-plus.png" width="20" height="20" /></a>
                    <a href="#"><img aria-hidden="true" alt="linkedin" src="./assets/linkedin.png" width="20" height="20" /></a>
                </div>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-2">Recent Post</h3>
                <ul>
                    <li class="mb-2"><a href="#" class="hover:underline">How to laundry your suit office - tips and trick</a><br><span>May 29, 2015</span></li>
                    <li><a href="#" class="hover:underline">How to laundry your suit office - tips and trick</a><br><span>May 29, 2015</span></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-2">Newsletter</h3>
                <form>
                    <input type="text" placeholder="Name" class="w-full mb-2 p-2 rounded">
                    <input type="email" placeholder="Email" class="w-full mb-2 p-2 rounded">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Send</button>
                </form>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-2">Get in Touch</h3>
                <ul>
                    <li class="mb-2">Phone: +62 7144 3300</li>
                    <li class="mb-2">Email: livlaundry@gmail.com</li>
                    <li class="mb-2">Website: www.livlaundry.com</li>
                    <li>Address: Kab. Banyuwangi</li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-8">
            <p>Copyright &copy; 2024 <a href="https://github.com/ZeroTwo71">LIV Laundry</a></p>
        </div>
    </footer>

    <script>
        document.getElementById('resiForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var resi = document.getElementById('resiInput').value;

            // Memeriksa apakah textbox kode resi telah diisi
            if (resi.trim() === '') {
                alert('Silakan masukkan kode resi terlebih dahulu.');
                return; // Menghentikan proses selanjutnya jika textbox kosong
            }

            // Mengirim permintaan AJAX ke server untuk mengecek resi
            fetch('admin/data/cek_resi.php?resi=' + resi)
                .then(response => response.json())
                .then(data => {
                    var resultDiv = document.getElementById('resiResult');
                    if (data.success) {
                        resultDiv.innerHTML = `<p>Status Pesanan: ${data.laun_status_desc}</p>`;
                    } else {
                        resultDiv.innerHTML = '<p>Kode resi tidak ditemukan.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>