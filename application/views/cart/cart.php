<br><br><br><br><br>
<section>
<div class="container-fluid">  
    <div class="row">
      <div class="col-md-6" align="left">
        <p class="h3"> Cart </p>
      </div>
      <div class="col-md-6" align="right">
        <a class="btn btn-sm btn-outline-danger" href="<?php echo base_url()."home"; ?>"> Back</a>
      </div>
    </div><br>

    <div class="container-fluid">
      <table id="table" class="table table-bordered cart_details">
        <thead>
          <th> S.No </th>
          <th> Product SKU </th>
          <th> Product Name </th>
          <th> Options </th>
          <th> Product Quantity </th>
          <th> Product Price </th>
          <th> Subtotal </th>
          <th> Update </th>
          <th> Remove</th>
        </thead>
        <tbody align="center">
            <?php
            if($this->cart->contents())
            {
              $count = 1;
              foreach($this->cart->contents() as $items)
              {
            ?>
            <tr>
              <td> <?php echo $count; ?> </td>
              <td> <?php echo $items["id"]; ?> </td>
              <td> <?php echo $items["name"]; ?> </td>
               <td> 
                <?php 
                  if ($this->cart->has_options($items['rowid']) == TRUE)
                  {
                    foreach ($this->cart->product_options($items['rowid']) as $option_name) 
                    {
                      print_r($option_name);
                    }
                  }
                  else
                  {
                    echo "No Options";
                  }
                ?> 
              </td>
              <td>  <input type="number" class="form-control quantity" id="<?php echo $items['rowid']; ?>" value="<?php echo $items["qty"]; ?>" min="1"/></td>
              <td> <?php echo $items["price"]; ?> </td>
              <td> <?php echo $items["qty"]*$items["price"]; ?> </td>
              <td> <button type="button" class="btn btn-sm btn-success update_product" id = "<?php echo $items['rowid']; ?>"> <b>Update</b> </button> </td>
              <td> <button type="button" class="btn btn-sm btn-danger remove_product" id="<?php echo $items['rowid']; ?>"> <b>Remove </b> </button> </td>
            </tr>    
            <?php  
              $count++;  
              }
            ?>
            <tr>
              <td colspan="6" align="right"> <b> Total </b>  </td>
              <td><?php echo $this->cart->total(); ?></td> 
              <td colspan="2"> <a href="<?php echo base_url()."cart/checkout";?>" class="btn btn-sm btn-info" > <b>Checkout </b> </a> </td>
            </tr>
            <?php 
              }
              else
              {
                echo "<tr> <td colspan='12'> <b> Your Cart Is Empty </b> </td> </tr>";
              }
            ?>
        </tbody>
      </table>
      <br><br><br>
    </div>
 </div> 
</section>

<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>
<script type="text/javascript">
  $(document).ready(function(){
  
    $(".remove_product").click(function(){
        var rowid = $(this).attr("id");
        
        $.ajax({
            url : '<?php echo base_url()."cart/remove"; ?>',
            method : 'POST',
            data : {rowid:rowid},
            success : function(data){
              alert('Removed Item From Cart');
              location.reload(true);
            },
            error : function (data) {
              alert('Unexpected Error : Cannot Remove Item From Cart');
            }
        });
    });
  });

  $(".update_product").click(function(){
      var rowid = $(this).attr("id");
      var qty = $("#"+rowid).val();

      $.ajax({
          url : '<?php echo base_url()."cart/update"; ?>',
          method : 'POST',
          data : {rowid:rowid,qty:qty},
          success : function(data){
            alert('Cart Updated');
            location.reload(true);
          },
          error : function(data){
            alert('Unexpected Error : Cannot Update Cart.');
          }
      });
  });
</script>
