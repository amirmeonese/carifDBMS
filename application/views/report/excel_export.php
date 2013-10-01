<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Report</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
        <tr>
            <th style="background-color:Crimson;">Full Name</th>
            <th style="background-color:Crimson;">Sur Name</th>
            <th style="background-color:Crimson;">IC</th>
        </tr>
    </thead>
<?php foreach ($patient as $list): ?>
        <tr>
            <td><?php echo $list['fullname']; ?></td>
            <td><?php echo $list['surname']; ?></td>
            <td><?php echo $list['ic_no']; ?></td>
        </tr>
<?php endforeach; ?>

</table>