<div class="container" id="report_div">
    <div id="report_header" class="row">
        <p>Search Result</p>
    </div>
    <?php echo form_open('report/toExcel'); ?>
    <div class="container" id="report_form_section" >
        <div height="30px">&nbsp;</div>
        <table border="1" width="50%" style="margin-left:180px;">
            <thead>
                <tr>
                    <th style="background-color:Crimson;">Full Name</th>
                    <th style="background-color:Crimson;">Sur Name</th>
                    <th style="background-color:Crimson;">IC</th>
                </tr>
            </thead>
            <?php foreach ($searched_result as $list): ?>
                <tr>
                    <td><?php echo $list['fullname']; ?></td>
                    <td><?php echo $list['surname']; ?></td>
                    <td><?php echo $list['ic_no']; ?></td>
                </tr>
                    <input type="hidden" name="patient_name" value="<?php echo $a;?>">
            <?php endforeach; ?>
        </table>
        </br>
        <a style="margin-left:180px;" class="submitCancel" href="<?php echo site_url('report/index');?>">Done</a>
    </div>
</div>
    <a id="export_excel" value="export_excel" href="<?php echo site_url('report/process_report');?>">Export Data</a>
    
    <?php echo form_submit('export_excel', 'export'); ?>
    <?php echo form_close(); ?>