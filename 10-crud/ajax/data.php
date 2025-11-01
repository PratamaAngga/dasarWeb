<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Jenis Kelamin</td>
            <td>Alamat</td>
            <td>No Telp</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'koneksi.php';
        $no = 1;
        $query = "SELECT * FROM anggota ORDER BY ID DESC";
        $sql = $db1->prepare($query);
        $sql->execute();
        $res1 = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (count($res1) > 0) {
            foreach($res1 as $row) {
                $id = $row['id'];
                $nama = $row['nama'];
                $jenis_kelamin = ($row['jenis_kelamin'] == 'L') ? 'Laki-Laki' : 'Perempuan';
                $alamat = $row['alamat'];
                $no_telp = $row['no_telp'];
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $nama; ?></td>
                    <td><?php echo $jenis_kelamin; ?></td>
                    <td><?php echo $alamat; ?></td>
                    <td><?php echo $no_telp; ?></td>
                    <td>
                        <button id="<?php echo $id; ?>" class="btn btn-success btn-sm edit_data" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> Edit</button>
                        <button id="<?php echo $id; ?>" class="btn btn-danger btn-sm hapus_data"><i class="fa fa-trash"></i> Hapus</button>
                    </td>
                </tr>
                <?php
            }
        } else {
        ?>
        <tr>
            <td colspan="7">Tidak ada data ditemukan</td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>