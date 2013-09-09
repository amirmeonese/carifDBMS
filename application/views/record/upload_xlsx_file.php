<div class="container" id="add_xlsx_div">
    <div id="add_record_header" class="row">
        <p>Add xlsx file</p>
        <?php echo $error; ?>
    </div>
    <?php echo form_open_multipart("record/do_upload_xlsx"); ?>
 
    <div class="container" id="add_xlsx">
        <div height="30px">&nbsp;</div>
        <?php
        echo form_fieldset('Attach xlsx file');
        ?>
        <table id="xlsx_section">
            <tr>
                <td>
                    <input type="file" name="userfile" size="100" />
                    <br/><br/>
                </td>
            </tr>			
        </table>    
        <?php echo form_fieldset_close(); ?>
    </div>

    <?php echo form_submit('mysubmit', 'Upload'); ?>
    <?php echo form_close(); ?>
</div>




