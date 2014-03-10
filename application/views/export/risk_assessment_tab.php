<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_riskassessment_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Risk Assessment</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
        <tr>
                    <th colspan="2" rowspan="2" style="background-color:Crimson;"></th>
                    <th colspan="9" style="background-color:Crimson;">Manchester Score</th>
                    <th colspan="9" style="background-color:Crimson;">BOADICEA</th>
                    <th colspan="4" style="background-color:Crimson;">Gail Model</th>
                </tr>
                <tr>
                    <th colspan="3" style="background-color:Crimson;">At consent</th>
                    <th colspan="3" style="background-color:Crimson;">Adjusted</th>
                    <th colspan="3" style="background-color:Crimson;">After GC</th>
                    <th colspan="3" style="background-color:Crimson;">At consent</th>
                    <th colspan="3" style="background-color:Crimson;">Adjusted</th>
                    <th colspan="3" style="background-color:Crimson;">After GC</th>
                    <th colspan="2" style="background-color:Crimson;">At consent</th>
                    <th colspan="2" style="background-color:Crimson;">First Mammogram</th>
                </tr>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">IC No</th>
                    <th style="background-color:Crimson;">BRCA1</th>
                    <th style="background-color:Crimson;">BRCA2</th>
                    <th style="background-color:Crimson;">Total</th>
                    <th style="background-color:Crimson;">BRCA1</th>
                    <th style="background-color:Crimson;">BRCA2</th>
                    <th style="background-color:Crimson;">Total</th>
                    <th style="background-color:Crimson;">BRCA1</th>
                    <th style="background-color:Crimson;">BRCA2</th>
                    <th style="background-color:Crimson;">Total</th>
                    <th style="background-color:Crimson;">BRCA1</th>
                    <th style="background-color:Crimson;">BRCA2</th>
                    <th style="background-color:Crimson;">No Mutation</th>
                    <th style="background-color:Crimson;">BRCA1</th>
                    <th style="background-color:Crimson;">BRCA2</th>
                    <th style="background-color:Crimson;">No Mutation</th>
                    <th style="background-color:Crimson;">BRCA1</th>
                    <th style="background-color:Crimson;">BRCA2</th>
                    <th style="background-color:Crimson;">No Mutation</th>
                    <th style="background-color:Crimson;">5 years:</th>
                    <th style="background-color:Crimson;">10 years:</th>
                    <th style="background-color:Crimson;">5 years:</th>
                    <th style="background-color:Crimson;">10 years:</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_risk_assessment as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list['patient_ic_no']; ?></td>
                    <td><?php echo $list['at_consent_mach_brca1']; ?></td>
                    <td><?php echo $list['at_consent_mach_brca2']; ?></td>
                    <td><?php echo $list['at_consent_mach_total']; ?></td>
                    <td><?php echo $list['adjusted_mach_brca1']; ?></td>
                    <td><?php echo $list['adjusted_mach_brca2']; ?></td>
                    <td><?php echo $list['adjusted_mach_total']; ?></td>
                    <td><?php echo $list['after_gc_brca1']; ?></td>
                    <td><?php echo $list['after_gc_brca2']; ?></td>
                    <td><?php echo $list['after_gc_total']; ?></td>
                    <td><?php echo $list['at_consent_boadicea_brca1']; ?></td>
                    <td><?php echo $list['at_consent_boadicea_brca2']; ?></td>
                    <td><?php echo $list['at_consent_boadicea_no_mutation']; ?></td>
                    <td><?php echo $list['adjusted_boadicea_brca1']; ?></td>
                    <td><?php echo $list['adjusted_boadicea_brca2']; ?></td>
                    <td><?php echo $list['adjusted_boadicea_no_mutation']; ?></td>
                    <td><?php echo $list['after_gc_boadicea_brca1']; ?></td>
                    <td><?php echo $list['after_gc_boadicea_brca2']; ?></td>
                    <td><?php echo $list['after_gc_boadicea_no_mutation']; ?></td>
                    <td><?php echo $list['at_consent_gail_model_5years']; ?></td>
                    <td><?php echo $list['at_consent_gail_model_10years']; ?></td>
                    <td><?php echo $list['first_mammo_gail_model_5years']; ?></td>
                    <td><?php echo $list['first_mammo_gail_model_10years']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </table>
