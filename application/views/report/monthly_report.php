<div class="container" id="report_div">
    <div id="report_header" class="row">
    </div>
    <div class="container" id="report_form_section" >
        <div height="30px">&nbsp;</div>
        <table width="50%" style="margin-left:180px;">
            <thead>
                <tr>
                    <th style="background-color:Crimson;">Studies</th>
                    <th style="background-color:Crimson;">SD MyBrca</th>
                    <th style="background-color:Crimson;">UM MyBrca</th>
                    <th style="background-color:Crimson;">MyOvca</th>
                    <th style="background-color:Crimson;">MyEpiBrca Baseline</th>
                    <th style="background-color:Crimson;">MyEpiBrca Follow up</th>
                    <th style="background-color:Crimson;">My1000Mammo</th>
                    <th style="background-color:Crimson;">Total</th>
                </tr>
            </thead>
            
            <?php $total = $SD_MyBrca + $UM_MyBrca + $MyOvca + $MyEpiBrca_b + $MyEpiBrca_f + $My1000mammo; ?>
            
                <tr>
                    <td><?php echo 'Total' ?></td>
                    <td><?php echo $SD_MyBrca; ?></td>
                    <td><?php echo $UM_MyBrca; ?></td>
                    <td><?php echo $MyOvca; ?></td>
                    <td><?php echo $MyEpiBrca_b; ?></td>
                    <td><?php echo $MyEpiBrca_f; ?></td>
                    <td><?php echo $My1000mammo; ?></td>
                    <td><?php echo $total; ?></td>
                </tr>
        </table>
        </br>
    </div>
</div>