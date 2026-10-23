<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/css/members/member.css">
</head>
<body>

<h2>List Anggota Juleha Jawa Timur</h2>
<form action="/receipts/handler" method="POST">
<?php echo form_dropdown('month',$months,$month);?>
<?php echo form_dropdown('year',$years,$year);?>
<input type="submit" name="reload" value="Reload">
<input type="submit" name="print" value="Cetak">
<table>
    <?php foreach($objs as $obj){?>
  <tr>
    <th><input name="checme[]" value="<?php echo $obj->id?>" type="checkbox"></th>
    <th><?php echo $obj->nickname;?></th>
    <th><?php echo $obj->position?></th>
    <th><?php echo $obj->address?></th>
    <th><?php echo $obj->birthdate?></th>
  </tr>
  <?php }?>
</table>
    </form>
</body>
</html>
