<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pre Order</title>
    <?php include 'general/style-includes.php'; ?>
</head>
<body>
    <div class="container-background">
        <div class="container-fluid">
            <div class="preorder-container">
                <h1 class="text-center">PRE-ORDER YOUR FOODS NOW!</h1>
                <p class="text-center text-danger"><em>Late Orders are not accepted</em></p>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-row">
                                <?php 
                                    foreach($category as $c):
                                ?>
                                    <p class="text-center"><?php echo $c->category; ?></p>
                                        <select class="form-control listProduct" multiple>
                                            <?php 
                                                foreach($products as $p):
                                                    if($c->category_id == $p->category_id):
                                            ?>
                                                <option value="<?php echo $c->category_id; ?>" data-price="<?php echo $p->price; ?>" data-product-id="<?php echo $p->product_id; ?>" data-product-name="<?php echo $p->product_name; ?>"><?php echo $p->product_name; ?> - <?php echo $p->price; ?></option>
                                            <?php 
                                                    endif;
                                                endforeach;
                                            ?>      
                                        </select>
                                <?php 
                                    endforeach;
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel-heading" style="background:#29b2e1;">
                            <p class="text-white bg-dark text-center">Main Order</p>
                            <div class="white-bg">
                                <form>
                                    <ul class="main-order">
                                 
                                    </ul>
                                    <hr>
                                    <p class="totalPrice"></p>
                                </form>
                            </div>
                        </div>
                    </div> 
                                            <div class="col-md-4">
                        <form class="customerInfo" method="POST">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name:</label>
                                <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" id="name" placeholder="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" value="<?php echo date("Ymd") . uniqid(); ?>" style="display:none;" id="cart_id"/>
                            </div>
                            <div class="form-group row">
                                <div class="offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary orderFoodBtn">ORDER NOW</button>
                                </div>
                            </div>
                            </form>
                        </div>
            </div>
        </div>
    </div>

     <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Order Succesfully Placed</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeMsg" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('general/script-includes'); ?>
    <script>
        $(document).ready(function(){
            var productIDs;
            var totalPrice = 0;
            var products = '';

            $("input[type='text']").on("click", function () {
                $(this).select();
            });
           
        });

        $('.listProduct > option').on('click',function(){
            var total = 0;
            var value = $(this).text();
            var arr =  [];
            var prices = [];
            var pName = [];
            $('.main-order > li').remove();
            $(".totalPrice").html('');

                $('.listProduct :selected').each(function(i, selectedElement) {
                    var price = $(this).data('price');
                    var productID = $(this).data('product-id');
                    var productName = $(this).data('product-name');
                    arr.push(productID);
                    prices.push(price);
                    pName.push(productName);
                    total = total + parseFloat(price);
                    totalPrice = total;
                    $(".totalPrice").html("Total Price  : "  + total);
                    $(".main-order").append('<li>'+ $(selectedElement).text() + '</li>');
                });
                
                productIDs = arr;
                totalPrice = prices;
                products = pName;


        });

        $('option').mousedown(function(event) {
            event.preventDefault();
        
            var originalScrollTop = $(this).parent().scrollTop();
            $(this).prop('selected', $(this).prop('selected') ? false : true);
            var self = this;
            $(this).parent().focus();
            setTimeout(function() {
                $(self).parent().scrollTop(originalScrollTop);
            }, 0);
            
            return false;
        });

        $(".orderFoodBtn").on('click',function(event){
            event.preventDefault();
            var data = $(".customerInfo").serializeArray();
            var cartID = $("#cart_id").val();
            data.push({name: "product_id", value : productIDs });
            data.push({name: "cart_id" , value: cartID });
            data.push({name: "productName" , value: products });
            data.push({name: "totalPrice" , value: totalPrice });
                $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('order/add_order')?>",
                    data:data,
                    dataType:"json"
                }).done(function(response){
                    $("#success-dialog").text(response.msg);
                    $("#exampleModal").modal('show');
                });
        });

        $(".closeMsg").on('click',function(){
            window.location.reload();
        });


    </script>
</body>
</html>