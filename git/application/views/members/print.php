<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Kwitansi Pelanggan</h2>
<form action="/receipts/printhandler" method="POST">
<?php echo form_dropdown('month',$months,$month);?>
<?php echo form_dropdown('year',$years,$year);?>

<input type="text" name='paymentdate' value='2021-07-01' style="display:none">
<input type='submit' name='saveandprint' value="Simpan dan Cetak">
<input type='submit' name='save' value="Simpan">
<input type="submit" name='home' value='Home'>
<table>
    <?php foreach($objs as $obj){?>      
      <tr>
        <th><input name="outletid[]" value="<?php echo $obj['id'];?>" type="checkbox" checked></th>
        <th><?php echo $obj['id'];?></th>
        <th><?php echo $obj['name'];?></th>
        <th><?php echo $obj['address'];?></th>
        <th><?php echo $obj['district'];?></th>
        <th><?php echo $obj['cp'];?></th>
    </tr>
  <?php }?>
</table>
</form>
</body>
</html>
