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

<h2>Pelanggan yang sudah membayar</h2>
<form action="/receipts/paidhandler" method="POST">
<?php echo form_dropdown('month',$months,$month);?>
<?php echo form_dropdown('year',$years,$year);?>
<input type="submit" name="reload" value="Reload">
<input type="submit" name="print" value="Cetak">
<table>
    <?php foreach($objs as $obj){?>
  <tr>
    <th><input name="checme[]" value="<?php echo $obj->id?>" type="checkbox"></th>
    <th><?php echo $obj->cp;?></th>
    <th><?php echo $obj->name?></th>
    <th><?php echo $obj->address?></th>
    <th><?php echo $obj->cp?></th>
  </tr>
  <?php }?>
</table>
    </form>
</body>
</html>
