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
                <h3 class="panel-title" style="color:#fff;"><a href="#setting_products" data-toggle="tooltip" data-placement="right" title="Click to show/hide this panel">Product List</a></h3>
                <ul class="panel-controls">
                    <li><a href="javascript:void(0)" onclick="add_product()" class="control-default" data-toggle="tooltip" data-placement="left" title="Click to add Product"><span class="fa fa-plus"></span></a></li>
                    <li><a href="javascript:void(0)" onclick="reload_product_table()" class="control-default" data-toggle="tooltip" data-placement="left" title="Click to refresh"><span class="fa fa-refresh"></span></a></li>
                </ul>                                
            </div>
            <div class="panel-body panel-body-open" id="setting_products">
                <div class="table-responsive">
                    <table id="product_table" class="table datatable">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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
<!-- PRODUCT MODAL -->        
<div class="modal fade" id="modal_product" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background:#29b2e1;">
            <div class="modal-header" style="background:#29b2e1;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="color:#fff;">Book</h4>
            </div>
            <div class="modal-body form" style="background:#fff;">
                <form action="#" id="productform" class="form-horizontal" role="form">
                    <input type="hidden" value="" name="product_id"/>
                    <label class="control-label">Product name</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="product_name" type="text" class="form-control" value="" placeholder="Enter Product name"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <label class="control-label">Category</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <select name="category" class="form-control" data-size="5">
                                <option value="">Choose Category</option>
                                <?php foreach ($category as $c): ?>
                                <option value="<?php echo $c->category_id; ?>"><?php echo $c->category_id. ' ' . $c->category; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <label class="control-label">Price</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="price" type="number" placeholder="1.00" step="0.01" min="0" class="form-control" value="" placeholder="Enter Product Price"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background:#29b2e1;">
                <button type="button" id="btnProductSave" onclick="save_product()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END PRODUCT MODAL -->
<!-- DELETE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to remove this row?</p>                    
                <p>Press Yes if you sure.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <button class="btn btn-success btn-lg mb-control-yes">Yes</button>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END DELETE BOX-->
    <?php $this->load->view('general/script-includes'); ?>
</body>
</html>
<script type="text/javascript">
    var product_table;
    $(document).ready(function(){

        product_table = $('#product_table').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "lengthMenu": [10, 25, 50],
            "order": [],

            "ajax":{
                "url": "<?php echo site_url('admin_dashboard/product_list')?>",
                "type": "POST"
            },

                "columnDefs": [{
                "targets": [-1],
                "orderable": false,
            },],
        });
    });

    function reload_product_table(){
        product_table.ajax.url("<?php echo site_url('admin_dashboard/product_list')?>").load();
    }

    function add_product(){
        save_method = 'add';
        $('#productform')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_product').modal('show');
        $('.modal-title').text('Add Product');
    }

    function save_product(){
        $('#btnProductSave').text('Saving...');
        $('#btnProductSave').attr('disabled', true);
        var url;

        if(save_method == 'add'){
            url = "<?php echo site_url('admin_dashboard/add_product')?>";
        } else {
            url = "<?php echo site_url('admin_dashboard/update_product')?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#productform').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    alert('Sucessfully Save!');
                    $('#modal_product').modal('hide');
                    reload_product_table();
                } else {
                    for(var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnProductSave').text('Save');
                $('#btnProductSave').attr('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error adding / update Products');
                $('#btnProductSave').text('Save');
                $('#btnProductSave').attr('disabled', false);
            }
        });
    }

    function edit_product(id){
        save_method = 'update';
        $('#productform')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('admin_dashboard/edit_product')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="product_id"]').val(data.product_id);
                $('[name="product_name"]').val(data.product_name);
                $('[name="category"]').val(data.category_id);
                $('[name="price"]').val(data.price);
                $('#modal_product').modal('show');
                $('.modal-title').text('Edit Product');
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error retrieving data from JSON');
            }
        });
    }

    function delete_product(id){
        var box = $("#mb-remove-row");
        box.addClass("open");
    
        box.find(".mb-control-yes").on("click",function(){
            $.ajax({
                url: "<?php echo site_url('admin_dashboard/delete_product')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    box.removeClass("open");
                    reload_product_table();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error deleting Product');
                }
            });
        });    
    }
</script>