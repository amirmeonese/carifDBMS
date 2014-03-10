<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export_personal_data(mutation).xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<p>Counseling</p>
<div height="30px">&nbsp;</div>

<table border="1">
    <thead>
                <tr>
                    <th style="background-color:Crimson;">No</th>
                    <th style="background-color:Crimson;">Patient Studies Id</th>
                    <th style="background-color:Crimson;">Date test ordered</th>
                    <th style="background-color:Crimson;">Ordered by</th>
                    <th style="background-color:Crimson;">Request for result notification</th>
                    <th style="background-color:Crimson;">Service provider</th>
                    <th style="background-color:Crimson;">Testing batch</th>
                    <th style="background-color:Crimson;">Testing date</th>
                    <th style="background-color:Crimson;">Gene tested</th>
                    <th style="background-color:Crimson;">Types of testing</th>
                    <th style="background-color:Crimson;">Sample type</th>
                    <th style="background-color:Crimson;">Test reason</th>
                    <th style="background-color:Crimson;">Is new mutation</th>
                    <th style="background-color:Crimson;">Test results</th>
                    <th style="background-color:Crimson;">Other details for tests results</th>
                    <th style="background-color:Crimson;">Mutation pathogenicity</th>
                    <th style="background-color:Crimson;">Mutation nomenclature</th>
                    <th style="background-color:Crimson;">Mutation name</th>
                    <th style="background-color:Crimson;">Mutation type</th>
                    <th style="background-color:Crimson;">Exon</th>
                    <th style="background-color:Crimson;">Carrier status</th>
                    <th style="background-color:Crimson;">Report date</th>
                    <th style="background-color:Crimson;">Date client notified</th>
                    <th style="background-color:Crimson;">Counseling</th>
                    <th style="background-color:Crimson;">Comments</th>
                    <th style="background-color:Crimson;">Attach conformation</th>
                </tr>
            </thead>
            <?php $no = 1; foreach ($patient_mutation_analysis as $list): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list['patient_studies_id']; ?></td>
                    <td><?php echo $list['date_test_ordered']; ?></td>
                    <td><?php echo $list['ordered_by']; ?></td>
                    <td><?php echo $list['testing_result_notification_flag']; ?></td>
                    <td><?php echo $list['service_provider']; ?></td>
                    <td><?php echo $list['testing_batch']; ?></td>
                     <td><?php echo $list['testing_date']; ?></td>
                    <td><?php echo $list['gene_tested']; ?></td>
                    <td><?php echo $list['types_of_testing']; ?></td>
                    <td><?php echo $list['type_of_sample']; ?></td>
                     <td><?php echo $list['reasons']; ?></td>
                    <td><?php echo $list['new_mutation_flag']; ?></td>
                    <td><?php echo $list['test_result']; ?></td>
                    <td><?php echo $list['investigation_test_results_other_details']; ?></td>
                    <td><?php echo $list['mutation_pathogenicity']; ?></td>
                     <td><?php echo $list['mutation_nomenclature']; ?></td>
                    <td><?php echo $list['mutation_name']; ?></td>
                    <td><?php echo $list['mutation_type']; ?></td>
                    <td><?php echo $list['exon']; ?></td>
                    <td><?php echo $list['carrier_status']; ?></td>
                     <td><?php echo $list['report_date']; ?></td>
                    <td><?php echo $list['date_client_notified']; ?></td>
                    <td><?php echo $list['is_counselling_flag']; ?></td>
                    <td><?php echo $list['conformation_attachment']; ?></td>
                </tr>
            <?php $no++; endforeach; ?>
        </table>
