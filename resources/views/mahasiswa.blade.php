@extends('layouts.app')

@section('content')
  <h3>Data Mahasiswa</h3>
  <button class="btn btn-primary mb-3" id="btn-tambah">Tambah Mahasiswa</button>

  <table class="table table-bordered" id="table-mahasiswa">
    <thead>
      <tr>
        <th>NIM</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Tanggal Lahir</th>
        <th>Jurusan</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>
  </table>

  <div class="modal fade" id="modalMahasiswa" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalMahasiswaLabel">Tambah Mahasiswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="form-mahasiswa">
            <input type="hidden" id="hidden-nim">
            <div class="mb-3">
              <label for="nim" class="form-label">NIM</label>
              <input type="text" class="form-control" id="nim" name="nim">
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
              <label for="jk" class="form-label">Jenis Kelamin</label>
              <select class="form-control" id="jk" name="jk">
                <option value="">Pilih</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
              <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
            </div>
            <div class="mb-3">
              <label for="jurusan" class="form-label">Jurusan</label>
              <select class="form-control" id="jurusan" name="jurusan">
                <option value="">Pilih Jurusan</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
                <option value="Teknik Mesin">Teknik Mesin</option>
                <option value="Teknik Elektro">Teknik Elektro</option>
                <option value="Teknik Sipil">Teknik Sipil</option>
                <option value="Akutansi">Akutansi</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea class="form-control" id="alamat" name="alamat" rows="2"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button class="btn btn-primary" id="btn-simpan">Simpan</button>
          <button class="btn btn-warning" id="btn-update" style="display:none;">Update</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script>
  let table;

  $(document).ready(function () {
    table = $('#table-mahasiswa').DataTable({
      ajax: "/api/mahasiswa",
      columns: [
        { data: 'nim' },
        { data: 'nama' },
        { data: 'jk' },
        { data: 'tgl_lahir' },
        { data: 'jurusan' },
        { data: 'alamat' },
        {
          data: null,
          render: function (data) {
            return `
              <button class="btn btn-warning btn-sm btn-edit" data-id="${data.nim}">Edit</button>
              <button class="btn btn-danger btn-sm btn-delete" data-id="${data.nim}">Hapus</button>
            `;
          }
        }
      ]
    });

    $('#btn-tambah').click(function () {
      $('#form-mahasiswa')[0].reset();
      $('#modalMahasiswaLabel').text('Tambah Mahasiswa');
      $('#btn-simpan').show();
      $('#btn-update').hide();
      $('#modalMahasiswa').modal('show');
    });

    $('#btn-simpan').click(function () {
      const data = ambilDataForm();
      $.post('/api/mahasiswa', data, function () {
        $('#modalMahasiswa').modal('hide');
        table.ajax.reload();
      }).fail(function (xhr) {
        alert(xhr.responseText);
      });
    });

    $('#table-mahasiswa').on('click', '.btn-edit', function () {
      const nim = $(this).data('id');
      $.get('/api/mahasiswa/' + nim, function (data) {
        $('#nim').val(data.nim).prop('disabled', true);
        $('#hidden-nim').val(data.nim);
        $('#nama').val(data.nama);
        $('#jk').val(data.jk);
        $('#tgl_lahir').val(data.tgl_lahir);
        $('#jurusan').val(data.jurusan);
        $('#alamat').val(data.alamat);
        $('#modalMahasiswaLabel').text('Edit Mahasiswa');
        $('#btn-simpan').hide();
        $('#btn-update').show();
        $('#modalMahasiswa').modal('show');
      });
    });

    $('#btn-update').click(function () {
      const nim = $('#hidden-nim').val();
      const data = ambilDataForm();
      $.ajax({
        url: '/api/mahasiswa/' + nim,
        type: 'PUT',
        data: data,
        success: function () {
          $('#modalMahasiswa').modal('hide');
          table.ajax.reload();
        },
        error: function (xhr) {
          alert(xhr.responseText);
        }
      });
    });

    $('#table-mahasiswa').on('click', '.btn-delete', function () {
      if (!confirm('Yakin ingin menghapus?')) return;
      const nim = $(this).data('id');
      $.ajax({
        url: '/api/mahasiswa/' + nim,
        type: 'DELETE',
        success: function () {
          table.ajax.reload();
        },
        error: function (xhr) {
          alert(xhr.responseText);
        }
      });
    });

    function ambilDataForm() {
      return {
        nim: $('#nim').val(),
        nama: $('#nama').val(),
        jk: $('#jk').val(),
        tgl_lahir: $('#tgl_lahir').val(),
        jurusan: $('#jurusan').val(),
        alamat: $('#alamat').val()
      };
    }
  });
</script>
@endsection
