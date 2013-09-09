<div class="container" id="report_div">
    <div id="report_header" class="row">
        <p>Report Manager</p>
    </div>
    <?php echo form_open('report/process_report'); ?>
    <div class="container" id="report_generation_section">
        <div height="30px">&nbsp;</div>
        <table>
            <tr>
                <td id="label1">
                    Full Name 
                </td>
                <td id="label1">
                    Date of Birth
                </td>
            </tr>
           <?php echo $result['fullname'] ?>
        </table>
    </div>

    <?php echo form_close(); ?>
</div>




