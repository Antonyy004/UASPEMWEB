let barangList = [];

document.getElementById('btnTambah').addEventListener('click', function() {
  showModal();
});

document.getElementById('closeModal').addEventListener('click', function() {
  closeModal();
});

document.getElementById('barangForm').addEventListener('submit', function(event) {
  event.preventDefault();
  saveBarang();
});

function showModal(barang = null) {
  document.getElementById('modal').style.display = 'block';
  
  if (barang) {
    document.getElementById('barangId').value = barang.id;
    document.getElementById('barangNama').value = barang.nama;
    document.getElementById('barangHarga').value = barang.harga;
  } else {
    document.getElementById('barangId').value = '';
    document.getElementById('barangNama').value = '';
    document.getElementById('barangHarga').value = '';
  }
}

function closeModal() {
  document.getElementById('modal').style.display = 'none';
}

function saveBarang() {
  const id = document.getElementById('barangId').value;
  const nama = document.getElementById('barangNama').value;
  const harga = document.getElementById('barangHarga').value;

  if (id) {
    // Edit barang
    const index = barangList.findIndex(b => b.id === id);
    barangList[index] = { id, nama, harga };
  } else {
    // Tambah barang
    const newId = Date.now().toString();
    barangList.push({ id: newId, nama, harga });
  }

  renderTable();
  closeModal();
}

function renderTable() {
  const tbody = document.querySelector('#barangTable tbody');
  tbody.innerHTML = '';

  barangList.forEach(barang => {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${barang.id}</td>
      <td>${barang.nama}</td>
      <td>${barang.harga}</td>
      <td>
        <button onclick="editBarang('${barang.id}')">Edit</button>
        <button onclick="deleteBarang('${barang.id}')">Hapus</button>
      </td>
    `;
    tbody.appendChild(row);
  });
}

function editBarang(id) {
  const barang = barangList.find(b => b.id === id);
  showModal(barang);
}

function deleteBarang(id) {
  barangList = barangList.filter(b => b.id !== id);
  renderTable();
}

// Initial render
renderTable();
