<br><br><br><br><br>
<section>
<form method="post" action="<?= base_url() ?>paypal/create_payment_with_paypal">
	<div class="container-fluid">
<?php 

$option_price = 0;
$option_product_append = "";
$sub_product_array = array();
if($show_optional_product->num_rows() != 0)
{	$x = 0;
	foreach($show_optional_product->result() as $options)
	{
		if($options->optional_name == "" && $options->optional_price == "" && $options->optional_quantity="")
		{
			$option_product_append = "No options";
		}
		else
		{
			$option_product_append = "product : ".$options->optional_name."&nbsp;&nbsp;&nbsp;" ;
			$option_product_append .= "price : ".$options->optional_price."&nbsp;&nbsp;&nbsp;";
			$option_product_append .= "quantity : ".rtrim($options->optional_quantity,"<br>")."&nbsp;&nbsp;&nbsp;";

			$sub_product_array[$option_product_append] =  $options->optional_rowid;
			$quant_rtrim = "";
		
			if($options->optional_quantity != "")
			{
				$quant_rtrim = rtrim($options->optional_quantity,"<br>");
			}
			else
			{
				$quant_rtrim = 0;
			}
			
			$option_price = $option_price + ($quant_rtrim * $options->optional_price); 
			$x++;
		}	
	}
}


// echo"<pre> Sub product";
// print_r($sub_product_array); 
// echo "</pre>";

$Final_array = array();               
foreach($sub_product_array as $key => $value)
{
	if(array_key_exists($value, $Final_array))
	{
  		$Final_array[$value] = $Final_array[$value]. ", ".$key;
	}
	else
	{
  		$Final_array[$value] = $key;
 	}
}

// echo "<pre>";
// print_r($Final_array);
// echo "</pre>";

$product_price = 0;
$total = 0;

if($show_product_cart->num_rows() > 0)
{
	$x = 1;
?>
<div class="table" id="mydiv">
	<table>
		<thead>
			<td> S.NO </td>
			<td> PRODUCTS </td>
			<td> PRICE </td>
		<?php 
			if($this->session->userdata('type') == 'individual')
			{
		?>
			<td> ADDRESS </td>
		<?php		
			}
			else
			{
		?>
			<td> Corporate Address </td>
			<td> Branch Address </td>
		<?php		
			}
		?>	
			
			<td> SUBSCRIPTION DATES </td>
			<td> Remove </td>
		</thead>
		<tbody id="reloader">

<?php
	foreach ($show_product_cart->result() as $product)
	{
?>
		<tr>
			<td> <?php echo $x; ?> </td>
			<td> 
				<?php 
					echo "Name : ".$product->name." SKU : ".$product->sku."<br>";
					
						if(array_key_exists($product->rowid,$Final_array))
						{

							echo $Final_array[$product->rowid];	
						}
						else
						{
							echo "No options";
						}
				?>
				<input type="hidden" class="form-control" value="<?php echo "Name : ".$product->name ?>" name="product_array[]" readonly/> 
				<input type="hidden" class="form-control" value="<?php echo $product->sku ?>" name="product_sku_array[]" readonly/> 
						
			</td>
			<td> 
				<input type="text" class="form-control" name="price_array[]" value="<?php echo $product->price; ?>" readonly> <br>
				<input type="hidden" class="form-control" name = "order_id[]" value="<?php echo $product->order_id; ?>" readonly><br>
			    <input type="hidden" class = "form-control" name="row_id_array[]" value="<?php echo $product->rowid; ?>" readonly/>
			</td>

			<td>
					<select class="form-control" name ="address_array[]"> 
				<?php
					foreach($get_address->result() as $address)
					{
				?>
						<option value="<?php echo $address->address."%".$address->state."%".$address->city;?>"> <?php echo $address->address." ".$address->state." ".$address->city;?> </option>
				<?php		
					}
				?>		
					</select>
			</td>
			<?php 
				if($this->session->userdata('type') != 'individual')
				{
			?>
			<td>
					<select class="form-control" name="branch_address_array[]">
						<option value="no_branch"> No Branch </option>
			<?php
				if($get_branch_data->num_rows() > 0)
				{
					foreach($get_branch_data->result() as $branch_address)
					{
			?>
						<option value="<?php echo $branch_address->branch_address1.",".$branch_address->branch_address2.",".$branch_address->branch_address3."%".$branch_address->branch_city."%".$branch_address->branch_state; ?>"> <?php echo $branch_address->branch_address1.",".$branch_address->branch_address2.",".$branch_address->branch_address3." ".$branch_address->branch_city." ".$branch_address->branch_state; ?> </option>
			<?php			
					}
				}
				else
				{
			?>
						<option value="no_branch"> No Branch </option>
			<?php		
				}	
			?>
					<select>
			</td>		
			<?php		
				}
			?>
			<td> <input type="text" name="daterange[]" class="form-control" value="" /></td>
			<td> <input type="button" class="btn btn-sm btn-danger delete_confirm_cart" data-prodid='<?php echo $product->rowid; ?>' value="Remove"> </td>
		</tr>
<?php		
	$total+=$product->price;
	$x++;
	}
}
//echo $Final_array['4705c36f1d1651a1e4ad04d462ab9051'];        
?>
		<tr>
			<td colspan="2" align="right"> Total </td>
			<td> <input type="text" class="form-control" name="details_subtotal" value = "<?php echo $total; ?>" readonly> </td>
			<td colspan="2" align="right">Pay To Checkout </td>
			<td>  
				<!-- <input type="submit" class="btn btn-sm btn-primary" name="submit_cart" value="Pay">  -->
				<button  type="submit"  class="btn btn-sm btn-success">Pay Now</button></td>
			</td>
		</tr>
	</tbody>
	</table>
	</div>
</div>
</form>
</section>




<script>
$(function() {
$('input[name="daterange[]"]').daterangepicker({
opens: 'left'
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
});
});
</script>
<!-- calender -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />




<script>
	$(document).ready(function(){
		$('.delete_confirm_cart').click(function(){
			var rowid = $(this).data('prodid');
			$.ajax({
				url : '<?php echo base_url()."cart/ajaxCallDeleteProduct"; ?>',
				method : 'post',
				data : {id_setter:rowid},
				success : function(recv){
					if(data=recv)
					{
						alert('Product Removed');
						$("#reloader").load(location.href + " #reloader");
					}
				}
			});
		});
	});
</script>