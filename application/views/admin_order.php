<!DOCTYPE html>
<html>
<head>
	<title>Pre Ordering Admin</title>
	<?php include 'general/style-includes.php'; ?>
</head>
<body>
<div class="page-container page-navigation-top-fixed">
	<?php $this->load->view('general/sidebar'); ?>
	<?php $this->load->view('general/header'); ?>
            <!-- START BREADCRUMB -->
<br><br>
<div class="page-content-wrap" style="padding-bottom: 50px;">
    <div class="col-md-12">
        <div class="panel-group accordion accordion-dc">
        <div class="panel panel-default">
            <div class="panel-heading" style="background:#29b2e1;">                                
                <h3 class="panel-title" style="color:#fff;"><a href="#setting_products" data-toggle="tooltip" data-placement="right" title="Click to show/hide this panel">Order List</a></h3>                               
            </div>
            <div class="panel-body panel-body-open" id="setting_order">
                <div class="table-responsive">
                    <table id="order_table" class="table datatable">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Product List</th>
                                <th>Total</th>
                                <th>Cart ID</th>
                                <th>Name</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
    <?php $this->load->view('general/script-includes'); ?>
</body>
</html>
<script type="text/javascript">
    var order_table;
    $(document).ready(function(){

        order_table = $('#order_table').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "lengthMenu": [10, 25, 50],
            "order": [],

            "ajax":{
                "url": "<?php echo site_url('admin_order/order_list')?>",
                "type": "POST"
            },

                "columnDefs": [{
                "targets": [-1],
                "orderable": false,
            },],
        });
    });

</script>