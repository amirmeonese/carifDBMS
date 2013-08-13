<div class="container" id="add_record_div">
    <div id="add_record_header" class="row">
        <p>Add Personal Details</p>
    </div>
    <?php echo form_open("record/patient_record_insertion"); ?>
    <div class="container" id="add_record_form_section_one">
        <div height="30px">&nbsp;</div>
        <table>
            <tr><td>
                    <?php echo $fullname; ?>: 
                    <?php echo form_input('fullname'); ?>
                </td>
                <td>
                    <?php echo $surname; ?>: 
                    <?php echo form_input('surname'); ?>
                </td><td>
                    <?php echo $maiden_name; ?>: 
                    <?php echo form_input('maiden_name'); ?>
                </td></tr>
            <tr><td>
                    <?php echo $IC_no; ?>: 
                    <?php echo form_input('IC_no'); ?>

                </td><td>
                    <?php echo $nationality; ?>: 
                    <?php echo form_dropdown('nationality', $nationalities); ?>
                    <?php //echo form_checkbox('available','yes',TRUE); ?>
                </td><td>
                    <?php echo $DOB; ?>: 
                    <?php //echo form_textarea
                    echo form_input('d_o_b');
                    ?>
                </td></tr>


            <tr><td>
                    <?php echo $pedigree_label; ?>: 
<?php echo form_input('padigree_labelling'); ?>
                </td>
                <td>
                    <?php echo $gender; ?>: 
                    <?php echo form_input('gender'); ?>
                </td><td>
                    <?php echo $ethinicity; ?>: 
<?php echo form_input('ethnicity'); ?>
                </td></tr>
            <tr><td>
                    <?php echo $blood_group; ?>: 
<?php echo form_input('blood_group'); ?>

                </td><td>
                    <?php echo $comment; ?>: 
                    <?php 
                    $data = array(
                        'name'        => 'comment',
                        'id'          => 'comment',
                        'rows'        => '10',
                        'cols'        => '10'
                      );
                    echo form_textarea($data); ?>
                </td><td>
                    <?php echo $hospital_no; ?>: 
                    <?php //echo form_textarea
                    echo form_input('hospital_no');
                    ?>
                </td></tr>
        </table>
    </div>
<?php echo form_submit('mysubmit', 'Save'); ?>
<?php echo form_close(); ?>
    <div>




