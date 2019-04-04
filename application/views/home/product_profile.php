<br><br><br><br><br><br>
<style>
.veg-square {    
	height: 20px;
    width: 20px;
    display: -webkit-inline-box;
    border-color: green;
    border-style:solid;
}
.veg-circle
{
	height : 20%;
	background: green;
  	border-radius: 100%;
    width:40%;
    height:40%;
    margin : 30%
}

.nonveg-square {    
	height: 20px;
    width: 20px;
    display: -webkit-inline-box;
    border-color: #520000fa;
    border-style:solid;
}
.nonveg-circle
{
	background: #520000fa;
  	border-radius: 100%;
    width:45%;
    height:45%;
    margin : 30%
}

.chkbox
{
	zoom: 150% !important;
}

/*
 *  Include CSS is empty. Keep it that way
 */
.card-img-top 
{
	height: 155px;
}
 .include
 {

 }

</style> 
<section>
    <?php 
        foreach($get_product_details->result() as $product)
        {
            echo "<pre>";
            print_r($product);
            echo "</pre>";
        }
    ?>
</section>
<br><br><br>
<script>
	$(document).ready(function(){


		$('.checked').click(function(){
			var getRel = $(this).attr('rel');
			console.log(getRel);
    		var getVal = $('.'+$(this).attr('rel')).toggleClass('include');
    		 console.log(getVal);
		});		

		$(".add-cart").click(function(){
				var product_id = $(this).data("productid");
				var product_name = $(this).data("productname");
				var product_price = $(this).data("price");
				var quantity = $("#"+product_id).val();
				var custom_flag = $(this).data("customflag");

				// console.log(product_id+" "+product_name+" "+product_price+" "+quantity+" "+custom_flag);
				
				var checkBoxArray = undefined;
				var custom_amount = 0;

				if(custom_flag)
				{
				   var checkBoxArray = [];

				   	var i = 0
					$('input.include').each(function(){
						console.log(this.value);
        				checkBoxArray.push($('.checked:checked')[i].value+'/'+$('.'+$('.checked:checked').attr('rel')).val());
        				i++;
    				}); 
    				console.log(checkBoxArray);
    				
    				var split_array = undefined;

    				for(var x = 0; x < checkBoxArray.length; x++)
    				{
    					split_array = checkBoxArray[x].split('/');
							// console.log("split_array");
    					// console.log(split_array);

							// console.log(split_array[1]);
							// console.log(split_array[2]);

    					custom_amount = Number(custom_amount) + Number(split_array[1]*split_array[3]);
    					// console.log(custom_amount);
    				}

    				product_price = product_price + custom_amount;
				}
				else
				{
					product_price = product_price + custom_amount
					checkBoxArray = undefined;
				}
				
				 //console.log(checkBoxArray);

				if(quantity != '' && quantity > 0)
				{
					$.ajax({
						url: '<?php echo base_url()."cart/add"; ?>',
						method:"POST",
						data:{product_id:product_id,product_name:product_name,product_price:product_price,quantity:quantity,options:checkBoxArray},
						success: function(data){
							if(data != 'empty_error')
							{
								alert("Product Added To Cart");
								// location.reload(true);
							}
						},
  						error: (error) => {
                     	console.log(JSON.stringify(error));
   							}		
					});
				}
				else
				{
					alert('Quantity Cannot Be Empty or Zero');
				}

		});
	});
</script>
