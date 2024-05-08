<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oop Bahan Bakar</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.container {
    background-color: #eee;
    padding: 20px;
    border-radius: 5px;
    margin-top: 20px;
}

.input-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input, select {
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 100%;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
    </style>
</head>
<body>

    <?php
    
    class Shell{
        // Properties atau Attribute
       public $harga_super =  15420.00;
       public $harga_power = 16130.00;
       public $harga_diesel = 18310.00;
       public $harga_nitro = 16510.00;
       public $tipe = [
            'super' => 'Shell Super',
            'power' => 'Shell V-Power',
            'diesel' => 'Shell V-Power Diesel',
            'nitro' => 'Shell V-Power Nitro',
        ];

        // Method atau Fungsi untuk mencari Nama Tipe berdasarkan kode tipe
        public function get_nama_tipe($kode_tipe)
        {
            return $this->tipe[$kode_tipe];   
        }

        // Method atau Fungsi untuk mencari harga berdasarkan kode tipe
        public function get_harga_berdasarkan_tipe($kode_tipe)
        {
            $temp_variable = "harga_" . $kode_tipe;
            return $this->{$temp_variable};
        }
    }
    
    class Beli extends shell{ 
        // Properties atau Attribute
        public $ppn = 10/100;

        // Method atau Fungsi untuk menghitung total yang harus dibayarkan berdasarkan jumlah liter dan harga bahan bakar
        public function hitung_total_bayar($jumlah_liter, $harga_bahan_bakar)
        {
            $total_harga = $jumlah_liter * $harga_bahan_bakar;
            $total_ppn = $total_harga * $this->ppn;
            $total_bayar = $total_harga - $total_ppn;

            return $total_bayar;
        }
    }

    $shell = new Shell();

    if (isset($_POST['beli'])) {
        $jumlah_liter = $_POST['jumlah_liter'];
        $kode_tipe = $_POST['tipe'];
        $nama_tipe = $shell->get_nama_tipe($kode_tipe);
        $harga_bahan_bakar = $shell->get_harga_berdasarkan_tipe($kode_tipe);
        
        $beli = new Beli();
        $total_bayar = $beli->hitung_total_bayar($jumlah_liter, $harga_bahan_bakar);

        
    ?>
        <div class="container">
            <p>
                Anda membeli bahan bakar minyak tipe 
                <strong><?= $nama_tipe?></strong>
            </p>
            <p>
                Dengan Jumlah : 
                <strong><?= $jumlah_liter?> Liter</strong>
            </p>
            <p>
                Total yang harus anda bayar Rp 
                <strong><?= number_format($total_bayar) ?></strong>
            </p>
        </div>
    <?php } ?>


    <form action="" method="post">

        <div class="input-group">      
            <label for="jumlah_liter">
                Masukan Jumlah Liter :
            </label>
            <input type="number" name="jumlah_liter" id="jumlah_liter" placeholder="0" required min="0">
        </div>
        <div class="input-group">      
            <label for="jumlah_liter">
                Pilih Tipe Bahan Bakar :
            </label>
            <select name="tipe" id="tipe" required > 
                <option value="" selected disabled >Pilih Bahan Bakar</option>
                <?php foreach($shell->tipe as $kode_tipe => $nama_tipe) {  ?>
                    <option value="<?= $kode_tipe ?>"><?= $nama_tipe ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="submit" value="Beli" name="beli">
    </form>

</body>
</html>