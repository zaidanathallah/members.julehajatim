<style>
</style>
<link rel='stylesheet' href='/css/members/membertemplate.css' />
<html>
    <?php foreach($ids as $obj){?>
    <table class='receipt'>
        <thead>
            <tr>
                <td class="col1"></td>
                <td class="col2"></td>
                <td class="col3"></td>
                <td class="col4"></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tdborderleft tdbordertop">Kepada yth</td>
                <td class="tdborderright tdbordertop">:<?php echo $obj['name'];?></td>
                <td class="tdbordertop"> Nama</td>
                <td class="tdborderright tdbordertop">:<?php echo $obj['name'];?></td>
            </tr>
            <tr>
                <td class="tdborderleft tdborderright" colspan=2><?php echo $obj['address'];?></td>
                <td>Alamat</td>
                <td class="tdborderright">:<?php echo $obj['address'];?></td>
            </tr>
            <tr>
                <td class="tdborderleft"></td>
                <td class="tdborderright"></td>
                <td>Jumlah</td>
                <td class="tdborderright">:</td>
            </tr>
            <tr>
                <td class="tdborderleft"></td>
                <td class="tdborderright"></td>
                <td>Jenis Donasi</td>
                <td class="tdborderright">:Donasi Reguler</td>
            </tr>
            <tr>
                <td class="tdborderleft tdborderbottom"></td>
                <td class="tdborderright tdborderbottom"></td>
                <td class=" tdborderbottom">Bulan</td>
                <td class="tdborderright tdborderbottom">:<?php echo $monthyear;?></td>
            </tr>
        </tbody>
    </table>
    <?php }?>
    <script>
        window.print();
    </script>
</html>