<html>
<header>
    <?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=anggota-".$region.".xls");
?>
</header>
<body>
<table>
    <tbody>
        <?php $c = 1;?>
        <?php foreach($objs['res'] as $obj){?>
        <tr>
            <td><?php echo $c++;?></td>
            <td><?php echo $obj->juleha_id;?></td>
            <td><?php echo $obj->nickname;?></td>
            <td><?php echo $obj->firstname;?></td>
            <td><?php echo $obj->middlename;?></td>
            <td><?php echo $obj->lastname;?></td>
            <td><?php echo $obj->address;?></td>
            <td><?php echo $obj->phone;?></td>
        </tr>
        <?php }?>
    </tbody>
</table>    
</body>
</html>