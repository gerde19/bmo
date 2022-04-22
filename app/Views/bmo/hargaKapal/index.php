<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Harga Sewa Kapal | Bali Mode On</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Harga Sewa kapal</h1>
        <div class="section-header-button">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Harga Kapal</a>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <b>Success !</b>
                <?= session()->getFlashdata('success'); ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <b>Error !</b>
                <?= session()->getFlashdata('error'); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php $validation = session()->getFlashdata('validation'); ?>

    <!-- MODAL -->
    <?= form_open_multipart(base_url('Kapal/hargaKapalAdd')) ?>
    <div class="modal fade" id="exampleModal" data-backdrop="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Harga Kapal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="form-row">
                        <div class="form-group col-lg-5">
                            <label for="hk_kode" class="form-label">Kode Kapal</label>
                            <select name="hk_kode" id="hk_kode" class="form-control" required>
                                <option value="" hidden>- PILIH -</option>
                                <?php foreach ($kodeKapal as $d) : ?>
                                    <option value="<?= $d['kk_id']; ?>"><?= $d['kk_kode']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="hk_nama" class="form-label">Nama Kapal</label>
                        <input type="text" name="hk_nama" id="hk_nama" class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="hk_harga" class="form-label">Harga Sewa</label>
                        <input type="text" name="hk_harga" id="hk_harga" class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="hk_diskon" class="form-label">Harga Diskon</label>
                        <input type="text" name="hk_diskon" id="hk_diskon" class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="hk_status" class="form-label">Status Kapal</label>
                        <select name="hk_status" id="hk_status" class="form-control" required="required">
                            <option value="" hidden>- PILIH -</option>
                            <option value="Ready">READY</option>
                            <option value="Booked">BOOKED</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="hk_foto" class="form-label">Foto Kapal</label>
                        </br>
                        <input type="file" name="hk_foto" id="hk_foto" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <?= form_close() ?>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark">Data Harga Sewa Kapal</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th width="1%" class="text-center">NO</th>
                                    <th class="text-center">KODE KAPAL</th>
                                    <th class="text-center">NAMA KAPAL</th>
                                    <th class="text-center">HARGA KAPAL</th>
                                    <th class="text-center">DISKON KAPAL</th>
                                    <th class="text-center">STATUS KAPAL</th>
                                    <th class="text-center">GAMBAR</th>
                                    <th width="10%" class="text-center">OPSI</th>
                                </tr>
                                <?php $no = 1; ?>
                                <?php foreach ($hargaKapal as $key) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td class="text-center"><?= $key['kk_kode'] ?></td>
                                        <td><?= $key['hk_nama'] ?></td>
                                        <td class="text-right"><?= "Rp. " . number_format($key['hk_harga']) . " ,-" ?></td>
                                        <td class="text-right"><?= number_format($key['hk_diskon'], 2) . " %" ?></td>
                                        <td class="text-center"><?= $key['hk_status'] ?></td>
                                        <td class="text-center"><img src="<?= base_url('kapal/' . $key['hk_foto']) ?>" style="width:100px;height:100px;"></td>
                                        <td class="text-center">

                                            <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_<?= $key['hk_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="<?= site_url('kk/delete/' . $key['hk_id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Ingin Menghapus Data Ini ?')">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            </form>


                                            <?= form_open_multipart(base_url('Kapal/hargaKapalEdit')) ?>
                                            <div class="modal fade" data-backdrop="false" id="edit_<?= $key['hk_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Kode</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <?= csrf_field(); ?>
                                                            <div class="form-group">
                                                                <label>Kode Kapal</label>
                                                                <select name="hk_kode" class="form-control" required="required">
                                                                    <option value="">- Pilih Unit -</option>
                                                                    <?php foreach ($kodeKapal as $k) : ?>
                                                                        <option <?php if ($key['hk_kode'] == $k['kk_id']) {
                                                                                    echo "selected='selected'";
                                                                                } ?> value="<?= $k['kk_id'] ?>"><?= $k['kk_kode']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group" style="width:100%">
                                                                <label>Nama Kapal</label>
                                                                <input type="hidden" name="hk_id" value="<?= $key['hk_id'] ?>">
                                                                <input type="text" name="hk_nama" required="required" class="form-control" value="<?= $key['hk_nama'] ?>" style="width:100%">
                                                            </div>
                                                            <div class="form-group" style="width:100%">
                                                                <label>Harga Sewa</label>
                                                                <input type="text" name="hk_harga" required="required" class="form-control" value="<?= $key['hk_harga'] ?>" style="width:100%">
                                                            </div>
                                                            <div class="form-group" style="width:100%">
                                                                <label>Harga Diskon</label>
                                                                <input type="text" name="hk_diskon" required="required" class="form-control" value="<?= $key['hk_diskon'] ?>" style="width:100%">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Status Kapal</label>
                                                                <select name="hk_status" class="form-control" required="required">
                                                                    <option value="">- Pilih Kategori -</option>
                                                                    <option <?php if ($key['hk_status'] == "Ready") {
                                                                                echo "selected='selected'";
                                                                            } ?> value="Ready">READY</option>
                                                                    <option <?php if ($key['hk_status'] == "Booked") {
                                                                                echo "selected='selected'";
                                                                            } ?> value="Booked">BOOKED</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="hk_foto" class="form-label">Foto Kapal</label>
                                                                </br>
                                                                <input type="file" name="hk_foto" id="hk_foto" value="<?= base_url('kapal/' . $key['hk_foto']) ?>" class="form-control">
                                                                </br>
                                                                Kosongkan jika tidak ingin berubah!.
                                                                <div>
                                                                    <img src="<?= base_url('kapal/' . $key['hk_foto']) ?>" style="width:80%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Simpan</button>
                                                            <button type="reset" class="btn btn-secondary"> Reset</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?= form_close() ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>