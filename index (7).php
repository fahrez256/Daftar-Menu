<!-- <img src="placeholder.jpg" alt="Gambar" style="width: 10vw; height: 10vw; margin-right: 2vw; border-radius: 5px;"> -->
<?php
include "conn.php";

function render_items($result, $title)
{
	echo '<h4 id="' . strtolower($title) . '" class="mt-5 mb-3 ml-3 menu-title" style="color: black; font-size: 6vw;">' . $title . '</h4>';

	while ($row = $result->fetch_assoc()) {
		echo '
		<div class="item-box px-4 py-3 mb-2" style="background-color: orange; color: white; font-size: 4vw; border: 2px solid white; border-radius: 2vw;">
			<div class="d-flex justify-content-between align-items-center">
				<div class="d-flex align-items-center">
					<div>
						<span class="item-name" style="font-size: 5vw; font-weight: bold;">' . $row["nama"] . '</span><br>
						<span class="item-price" data-price="' . $row["harga"] . '" style="font-size: 4vw;">Rp ' . number_format($row["harga"], 0, ',', '.') . '</span>
					</div>
				</div>
				<div class="d-flex align-items-center">
					<button class="btn btn-outline-light btn-sm mr-2 px-3" style="font-size: 4vw; background-color: whitesmoke; font-weight: bold; color: grey; border-radius: 2vw;" onclick="decreaseQuantity(this, ' . $row["harga"] . ')">-</button>
					<input type="text" value="0" class="form-control form-control-sm text-center quantity-input" style="width: 12vw; font-size: 4vw; border-radius: 2vw;" oninput="updateTotal(this, ' . $row["harga"] . ')">
					<button class="btn btn-outline-light btn-sm ml-2 px-3" style="font-size: 4vw; background-color: whitesmoke; font-weight: bold; color: grey; border-radius: 2vw;" onclick="increaseQuantity(this, ' . $row["harga"] . ')">+</button>
				</div>
			</div>
		</div>
		';
	}
}

$tables = [
	'makanan' => 'Makanan',
	'minuman' => 'Minuman',
	'cemilan' => 'Cemilan',
	'kopi' => 'Kopi',
	'tenant' => 'Food Court'
];
?>

<!-- font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<title>Menu - Kedai Mi Kireen</title>
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<!-- CSS untuk Tampilan Mobile -->
<style>
	* {
		font-family: "Poppins";
	}

	body {
		padding: 5vw;
		padding-top: 15vw;
	}

	.sidebar {
		position: fixed;
		top: 0;
		left: 0;
		height: 100%;
		width: 100%;
		opacity: 0.9;
		transform: translateX(-100%);
		transition: transform 0.3s ease-in-out;
		z-index: 999;
		/* Menyesuaikan margin-top */
	}
	
	.sidebar .sidebar-content {
		position: fixed;
		padding: 5vw;
		margin-top: 16vw;
		height: 100%;
		width: 58vw;
		background-color: whitesmoke;
		opacity: 0.9;
		/* Menyesuaikan margin-top */
	}

	.sidebar.active {
		transform: translateX(0);
	}

	.sidebar a {
		color: black;
		display: block;
		margin-top: 5vw;
		margin-bottom: 1vw;
		font-size: 5vw;
	}

	.title-container {
		display: flex;
		align-items: center;
		justify-content: space-between;
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		background-color: white;
		z-index: 1000;
		padding: 3vw 4vw;
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
	}

	.title-container h2 {
		margin: 0;
		font-size: 6vw;
	}

	.search-container {
		flex-grow: 1;
		margin-left: 2vw;
	}

	.search-container input {
		font-size: 4vw;
	}

	#orderButton {
		font-size: 5vw;
	}

	.form-group-notes {
		margin-top: 4vw;
		margin-bottom: 3vw;
	}

	.form-group-wa {
		margin-bottom: 20vw;
	}

	.modal-body .form-group {
		margin-bottom: 0.5rem;
	}

	.modal-body textarea,
	.modal-body input {
		margin-bottom: 0.5rem;
	}

	/* Modal Bottom Dialog Custom Styling */
	.modal-dialog-bottom {
		position: fixed;
		bottom: 0;
		margin: 0;
		width: 100%;
		max-width: none;
	}

	.modal-content-bottom {
		border-radius: 0;
		border: none;
		height: 75vh;
		/* Set modal height to 50% of the viewport height */
		display: flex;
		flex-direction: column;
	}

	.modal-body {
		overflow-y: auto;
		/* Allow scrolling if content exceeds height */
		padding: 2vw;
		/* Add padding for better spacing */
	}

	.modal-footer {
		margin-top: auto;
		/* Push footer to the bottom */
	}

	/* Styling for larger text in modal */
	.modal-title {
		font-size: 6vw;
		/* Title font size */
	}

	.modal-body label {
		font-size: 5vw;
		/* Label font size */
	}

	.modal-body textarea,
	.modal-body input {
		font-size: 4.5vw;
		/* Input and textarea font size */
	}

	.modal-footer .btn {
		font-size: 5vw;
		/* Button font size */
	}

	#orderItemsList {
		font-size: 4vw;
		/* Ukuran font untuk daftar item pesanan */
		line-height: 1.4;
		/* Jarak antar baris */
	}
	.overlay {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, 0.8); /* Warna overlay semi-transparan */
		color: white;
		display: flex;
		justify-content: center;
		align-items: center;
		z-index: 9999; /* Pastikan overlay berada di atas konten lain */
		font-size: 5vw;
		padding: 10vw;
		text-align: center;
		pointer-events: auto;
	}
	
	body.blocked {
		overflow: hidden;
		pointer-events: none;
	}
</style>

<!-- Overlay yang disembunyikan secara default -->
<div id="overlay" class="overlay">
	Mohon gunakan Daftar Menu hanya di Kedai Mie Kireen
</div>

<!-- Title, Sidebar Toggle Button dan Search Bar -->
<div class="title-container">
	<button class="btn sidebar-toggle" style="font-size: 6vw; background-color: orange; color: white; border-radius:2vw" onclick="toggleSidebar()">☰</button>
	<div class="mb-0" style="margin-left: 4vw; font-size: 4.2vw; font-weight: 600">Daftar Menu</div>
	<div class="search-container position-relative">
		<input type="text" style="border: 4px solid lightgray; border-radius: 2vw; padding-right: 4rem;" class="form-control py-5 px-4" placeholder="Cari menu..." id="searchInput" onkeypress="searchOnEnter(event)">
		<i class="fas fa-search position-absolute" style="right: 1.5rem; top: 50%; transform: translateY(-50%); font-size: 2rem; color: lightgray;"></i>
	</div>
</div>

<!-- Sidebar -->
<div id="sidebar" class="sidebar" onclick="toggleSidebar()">
	<div class="sidebar-content">
	<!-- <h5 style="font-size: 7vw;">Menu</h5> -->
		<?php
		foreach ($tables as $table => $title) {
			echo '<a href="#' . strtolower($title) . '">' . $title . '</a>';
		}
		?>
	</div>
</div>

<?php
foreach ($tables as $table => $title) {
	$sql = "SELECT nama, harga FROM $table";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		render_items($result, $title);
	} else {
		echo '<div class="item-box p-3 mb-2" style="background-color: orange; color: white; font-size: 4vw; border: 2px solid white; border-radius: 10px;">0 results for ' . $title . '</div>';
	}
}

// Menutup koneksi
$conn->close();
?>

<!-- Form untuk Catatan dan Nomor Telepon -->
<div class="form-group-notes">
	<label for="notes" style="font-size: 5vw; margin-left: 1vw;">Catatan:</label>
	<textarea placeholder="Gak pake bawang...?" id="notes" class="form-control py-3 px-4" rows="3" style="font-size: 4vw; border-width: 4px; border-radius: 2vw;"></textarea>
</div>

<div class="form-group">
	<div class="row">
		<div class="col-md-6">
			<label for="floor" style="font-size: 5vw;">Lantai:</label>
			<input type="number" value="0" id="floor" class="form-control" style="font-size: 5vw; border-width: 4px; border-radius: 2vw;" placeholder="1-2">
		</div>
		<div class="col-md-6">
			<label for="table" style="font-size: 5vw;">Meja:</label>
			<input type="number" value="0" id="table" class="form-control" style="font-size: 5vw; border-width: 4px; border-radius: 2vw;" placeholder="1-30">
		</div>
	</div>
</div>

<div class="form-group-wa">
	<label for="phone" style="font-size: 5vw; margin-left: 1vw;">Nomor Wa:</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text" style="font-size: 5vw; border-radius: 2vw 0 0 2vw; background-color: lightgray;">+62</span>
		</div>
		<input placeholder="81234567890" type="number" id="phone" class="form-control py-5" style="font-size: 5vw; border-width: 4px; border-radius: 0 2vw 2vw 0;">
	</div>
</div>

<!-- Tombol Pesan -->
<button id="orderButton" class="btn btn-primary btn-lg px-5 py-3" style="font-family:'Poppins'; border: 0.5vw solid white; border-radius: 2vw; position: fixed; bottom: 5vw; right: 5vw;" onclick="checkScrollState()">
	Pesan - Total: <span id="totalPrice">0</span>
</button>

<!-- Bootstrap Modal untuk Konfirmasi Pesanan -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-bottom" role="document">
		<div class="modal-content modal-content-bottom" style="border-top-left-radius: 5vw; border-top-right-radius: 5vw;">
			<div class="modal-header py-4 px-5" style="background-color: orange; color: white; border-top-left-radius: 5vw; border-top-right-radius: 5vw;">
				<h5 class="modal-title" id="orderModalLabel">Konfirmasi Pesanan</h5>
			</div>
			<div class="modal-body px-5">
				<div class="form-group py-4" id="orderItemsList"></div>
				<div class="form-group">
					<label for="modalNotes" class="ml-2">Catatan:</label>
					<textarea id="modalNotes" style="border-radius: 2vw;" class="form-control" rows="4" readonly></textarea>
				</div>
				<div class="form-group mt-4">
					<div class="row">
						<div class="col-md-6">
							<label for="modalFloor" style="font-size: 5vw;">Lantai:</label>
							<input type="number" value="0" id="modalFloor" class="form-control" style="border-radius: 2vw;" placeholder="Lantai" readonly>
						</div>
						<div class="col-md-6">
							<label for="modalTable" style="font-size: 5vw;">Meja:</label>
							<input type="number" value="0" id="modalTable" class="form-control" style="border-radius: 2vw;" placeholder="Meja" readonly>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="modalPhone" class="ml-2 mt-4">Nomor Wa:</label>
					<input type="text" id="modalPhone" class="form-control" style="border-radius: 2vw;" readonly>
				</div>
			</div>
			<div class="modal-footer mr-4 mb-4">
				<button type="button" class="btn btn-primary mr-4 px-5" style="border-radius: 2vw;" onclick="sendOrder()">Pesan</button>
				<button type="button" class="btn px-5" style="border-radius: 2vw; background-color: lightgray" data-dismiss="modal" onclick="$('#customBottomDialog').modal('hide')" >Tutup</button>
			</div>
		</div>
	</div>
</div>

<!-- Custom Bottom Dialog Modal -->
<div class="modal fade" id="customBottomDialog" tabindex="-1" role="dialog" aria-labelledby="customBottomDialogLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-bottom" role="document">
		<div class="modal-content" style="border-top-left-radius: 5vw; border-top-right-radius: 5vw;">
			<div class="modal-header py-4 px-5" style="background-color: orange; color: white; border-top-left-radius: 5vw; border-top-right-radius: 5vw;">
				<h5 class="modal-title" id="customBottomDialogTitle"></h5>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> -->
			</div>
			<div class="modal-body px-5 py-5" style="font-size: 4vw;" id="customBottomDialogMessage">
				<!-- Message goes here -->
			</div>
			<div class="modal-footer mr-4 mb-4">
				<button type="button" class="btn px-5" style="border-radius: 2vw; background-color: lightgray" data-dismiss="modal" onclick="location.reload()" >Tutup</button>
			</div>
		</div>
	</div>
</div>


<!-- JavaScript untuk Sidebar, Pencarian, dan Modal -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
	function showCustomDialog(title, message) {
		document.getElementById('customBottomDialogTitle').innerText = title;
		document.getElementById('customBottomDialogMessage').innerHTML = message;

		$('#customBottomDialog').modal('show');
	}

	function formatCurrency(value) {
		return new Intl.NumberFormat('id-ID', {
			style: 'currency',
			currency: 'IDR',
			minimumFractionDigits: 0,
			maximumFractionDigits: 0
		}).format(value);
	}

	function toggleSidebar() {
		document.getElementById('sidebar').classList.toggle('active');
	}

	function updateTotal(input, price) {
		let total = 0;
		let items = document.querySelectorAll('.item-box');

		items.forEach(item => {
			let quantity = item.querySelector('.quantity-input').value;
			let itemPrice = item.querySelector('.item-price').dataset.price;

			if (parseInt(quantity) > 0) {
				total += parseInt(quantity) * parseInt(itemPrice);
			}
		});

		document.getElementById('totalPrice').innerText = formatCurrency(total);
	}

	function increaseQuantity(button, price) {
		let input = button.previousElementSibling;
		input.value = parseInt(input.value) + 1;
		updateTotal(input, price);
	}

	function decreaseQuantity(button, price) {
		let input = button.nextElementSibling;
		if (parseInt(input.value) > 0) {
			input.value = parseInt(input.value) - 1;
			updateTotal(input, price);
		}
	}

	function filterItems() {
		let input = document.getElementById('searchInput');
		let filter = input.value.toLowerCase();
		let items = document.querySelectorAll('.item-box');
		let titles = document.querySelectorAll('.menu-title');
		let firstMatch = null;

		titles.forEach(title => {
			let section = title.nextElementSibling;
			let hasVisibleItems = false;

			while (section && section.classList.contains('item-box')) {
				let name = section.querySelector('.item-name').innerText.toLowerCase();
				if (name.includes(filter)) {
					section.style.display = "";
					hasVisibleItems = true;
					if (!firstMatch) {
						firstMatch = section;
					}
				} else {
					section.style.display = "none";
				}
				section = section.nextElementSibling;
			}

			title.style.display = hasVisibleItems ? "" : "none";
		});

		if (firstMatch) {
			firstMatch.scrollIntoView({
				behavior: 'smooth'
			});
		}
	}

	function searchOnEnter(event) {
		if (event.key === 'Enter') {
			filterItems();
		}
	}
	
	let scrolledToBottom = false;

	function checkScrollState() {
		const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		const windowHeight = window.innerHeight;
		const documentHeight = document.documentElement.scrollHeight;
	
		if (scrollTop + windowHeight >= documentHeight - 200) {
			if (!scrolledToBottom) {
				scrolledToBottom = true;
				showOrderConfirmation();
			}
		} else {
			scrolledToBottom = false;
			window.scrollTo({ top: documentHeight, behavior: 'smooth' });
		}
	}

	function showOrderConfirmation() {
		let items = document.querySelectorAll('.item-box');
		let orderItemsList = document.getElementById('orderItemsList');
		let total = 0;
		let message = 'Pesanan:\n\n';

		orderItemsList.innerHTML = '';
		items.forEach(item => {
			let quantity = item.querySelector('.quantity-input').value;
			let name = item.querySelector('.item-name').innerText;
			let price = item.querySelector('.item-price').dataset.price;

			if (parseInt(quantity) > 0) {
				let itemTotal = parseInt(quantity) * parseInt(price);
				total += itemTotal;

				orderItemsList.innerHTML += `<div>${name} - ${quantity} x ${formatCurrency(price)} = ${formatCurrency(itemTotal)}</div>`;
				message += `${name} - ${quantity} x ${formatCurrency(price)} = ${formatCurrency(itemTotal)}\n`;
			}
		});

		let notes = document.getElementById('notes').value;
		let phone = document.getElementById('phone').value;
		let floor = document.getElementById('floor').value;
		let table = document.getElementById('table').value;

		message += `\nTotal: ${formatCurrency(total)}\n`;
		message += `Catatan: ${notes}\n`;
		message += `Nomor Telepon: https://wa.me/+62${phone}`;

		document.getElementById('modalNotes').value = notes || `Serius gak ada catatan nih?`;
		document.getElementById('modalFloor').value = floor;
		document.getElementById('modalTable').value = table;
		document.getElementById('modalPhone').value = '+62' + (phone || ` Kosong? kalau kangen gimana?`);

		$('#orderModal').modal('show');
	}

	function getQueryParams() {
		let params = new URLSearchParams(window.location.search);
		return {
			floor: params.get('lantai') || '',
			tableNumber: params.get('meja') || ''
		};
	}

	document.addEventListener('DOMContentLoaded', function() {
		const sidebarLinks = document.querySelectorAll('#sidebar a');
		const floorInput = document.getElementById('floor');
		const tableInput = document.getElementById('table');
		const {
			floor,
			tableNumber
		} = getQueryParams();
		document.body.classList.add('blocked');
		
		if (floor && tableNumber) {
			const overlay = document.getElementById('overlay');
			overlay.style.display = 'none'; // Menyembunyikan overlay
			document.body.classList.remove('blocked'); // Membolehkan interaksi
		}

		if (floorInput && tableInput) {
			floorInput.value = floor || 1;
			tableInput.value = tableNumber || 1;
		}

		sidebarLinks.forEach(link => {
			link.addEventListener('click', function(event) {
				event.preventDefault(); // Mencegah perilaku klik default
				const targetId = this.getAttribute('href').substring(1); // Ambil ID target tanpa '#'
				const targetElement = document.getElementById(targetId);

				if (targetElement) {
					const offset = 200; // Offset Y yang diinginkan
					const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - offset;
					
					toggleSidebar()
					window.scrollTo({
						top: targetPosition,
						behavior: 'smooth' // Animasi scroll yang mulus
					});
				}
			});
		});
	});

	function sendOrder() {
		let items = document.querySelectorAll('.item-box');
		let total = 0;
		let message = 'Pesanan:\n\n';
		let messageWa = 'Min, ini pesanan saya:\n\n';

		items.forEach(item => {
			let quantity = item.querySelector('.quantity-input').value;
			let name = item.querySelector('.item-name').innerText;
			let price = item.querySelector('.item-price').dataset.price;

			if (parseInt(quantity) > 0) {
				let itemTotal = parseInt(quantity) * parseInt(price);
				total += itemTotal;

				message += `${name} - ${quantity} x ${formatCurrency(price)} = ${formatCurrency(itemTotal)}\n`;
				messageWa += `${name} - ${quantity} x ${formatCurrency(price)} = ${formatCurrency(itemTotal)}\n`;
			}
		});

		let notes = document.getElementById('notes').value;
		let phone = document.getElementById('phone').value;
		let floor = document.getElementById('floor').value;
		let table = document.getElementById('table').value;

		message += `\nTotal: ${formatCurrency(total)}\n`;
		messageWa += `\nTotal: ${formatCurrency(total)}\n`;
		message += `Catatan: ${notes}\n`;
		messageWa += `Catatan: ${notes}\n`;
		message += `Nomor Telepon: https://wa.me/+62${phone}\n`;
		message += `Lantai: ${floor}\n`;
		message += `No Meja: ${table}`;
		messageWa += `Lantai: ${floor}\n`;
		messageWa += `No Meja: ${table}`;

		// Encode the message for URL
		let encodedMessage = encodeURIComponent(message);
		let encodedMessageWa = encodeURIComponent(messageWa);

		// Send message to Telegram bot
		let url = `https://api.telegram.org/bot7402146766:AAFe2pz-S4Edqko40eZvrLcvg3TCDTFts-Y/sendMessage?chat_id=7289796062&text=${encodedMessage}`;
		let urlwa = `https://wa.me/+6285936596613?text=${encodedMessageWa}`;

		fetch(url)
			.then(response => response.json())
			.then(data => {
				if (data.ok) {
					showCustomDialog('Pesanan Berhasil', 'Mohon ditunggu yah, kalau ada yang kurang bakalan dikasih tau lewat wa (kalau gak kosong)!');
				} else {
					showCustomDialog('Pesanan Gagal', `Yah gagal nih :(<br><br>Atau kamu bisa lanjutkan pesanan lewat chat admin <a href="${urlwa}">disini</a>`);
				}
			})
			.catch(error => {
				console.error('Error:', error);
				showCustomDialog('Kesalahan', `Web ini lagi error nih kayaknya :(<br><br>Atau kamu bisa lanjutkan pesanan lewat chat admin <a href="${urlwa}">disini</a>`);
			});

		$('#orderModal').modal('hide');
	}
</script>