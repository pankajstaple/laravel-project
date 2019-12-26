jQuery(document).ready(function($){
	
	function output(lose, month, price, span1, span2)
	{
		if ( month == 1 ){
			var mul = month * 5;
			
			if ( price <= 20 ){
				$("#span1").text("133");
				$("#span2").text("150");
				$('#min_range').val("133");
				$('#max_range').val("150");
			} 
			else 
			{
				var u = 1;
				remainder = price % 5;
				x = (price - remainder) / 5;
				multi = x - 4;
				addition = mul * multi;
				
				if( lose == 1 ){
					if ( u == 1)
					{
						var finalspan1 = span1 + addition + 3;
					} 
					else
					{
						var finalspan1 = span1 + addition;
					}
					var finalspan2 = span2 + addition;
				}
				else if( lose > 1 && lose <= 9)
				{
					sublose = lose - 1;
					totallose = sublose * 30;
					if ( u == 1)
					{
						var finalspan1 = span1 + addition + 3 + 1;
					} 
					else
					{
						var finalspan1 = span1 + addition + 1;
					}
					var finalspan2 = span2 + addition + totallose;
				} 
				else if( lose > 9 && lose <= 30)
				{
					sublose = 8;
					totallose = sublose * 30;
					if ( u == 1)
					{
						var finalspan1 = span1 + addition + 3 + 1;
					} 
					else
					{
						var finalspan1 = span1 + addition + 1;
					}
					var finalspan2 = span2 + addition + totallose + 21;
				}
				else if( lose > 30 && lose <= 200)
				{
					sublose = 8;
					totallose = sublose * 30;
					subsix = lose - 30;
					totalsix = subsix * 6;
					
					if ( lose == 64 )
					{
						if ( u == 1)
						{
							var finalspan1 = span1 + addition + 3 + 1 + 2;
						} 
						else
						{
							var finalspan1 = span1 + addition + 1 + 2;
						}
					}	
					else if ( lose == 65 )
					{
							var finalspan1 = span1 + addition + 2 + 20;
					}
					else if ( lose == 66 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19;
					}
					else if ( lose == 67 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23;
					}
					else if ( lose == 68 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28;
					}
					else if ( lose == 69 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37;
					}
					else if ( lose == 70 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50;
					}
					else if ( lose == 71 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69;
					}
					else if ( lose == 72 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218;
					}
					else if ( lose == 73 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218 + 4;
					}
					else if ( lose > 73 && lose <=77 )
					{
						subthree = lose - 73;
						totalthree = subthree * 3;
						//alert(subthree);
						var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218 + 4 + totalthree;
					}
					
					else if ( lose == 78 )
					{
						subthree = lose - 73;
						totalthree = subthree * 3;
						//alert(subthree);
						var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218 + 4 + totalthree + 1;
					}
					
					else
					{
						subthree = lose - 73;
						totalthree = subthree * 3;
						//alert(subthree);
						var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218 + 4 + totalthree + 1;
					} 
					var finalspan2 = span2 + addition + totallose + 21 + totalsix;
				}
				$("#span1").text(finalspan1);
				$("#span2").text(finalspan2);	
				$('#min_range').val(finalspan1);
				$('#max_range').val(finalspan2);			
			}
			
		}
		else if ( month == 2 )
		{
			
			var span1 = 117;  
			var span2 = 135;

			$("#span1").text(span1);
			$("#span2").text(span2);
			$('#min_range').val(span1);
			$('#max_range').val(span2);
			
			var mul = month * 5;
	
			
			if ( price <= 15 ){
				$("#span1").text(span1);
				$("#span2").text(span2);
				$('#min_range').val(span1);
				$('#max_range').val(span2);
			} 
			
			else 
			{
				var u = 1;
				remainder = price % 5;
				x = (price - remainder) / 5;
				multi = x - 3;
				addition = mul * multi;
				
				if( lose == 1 ){
					if ( u == 1)
					{
						var finalspan1 = span1 + addition + 3;
					} 
					else
					{
						var finalspan1 = span1 + addition;
					}
					var finalspan2 = span2 + addition;
				}
				else if( lose > 1 && lose <= 9)
				{
					sublose = lose - 1;
					totallose = sublose * 30;
					if ( u == 1)
					{
						var finalspan1 = span1 + addition + 3 + 1;
					} 
					else
					{
						var finalspan1 = span1 + addition + 1;
					}
					var finalspan2 = span2 + addition + totallose;
				} 
				else if( lose > 9 && lose <= 30)
				{
					sublose = 8;
					totallose = sublose * 30;
					if ( u == 1)
					{
						var finalspan1 = span1 + addition + 3 + 1;
					} 
					else
					{
						var finalspan1 = span1 + addition + 1;
					}
					var finalspan2 = span2 + addition + totallose + 21;
				}
				else if( lose > 30 && lose <= 200)
				{
					sublose = 8;
					totallose = sublose * 30;
					subsix = lose - 30;
					totalsix = subsix * 6;
					
					if ( lose == 64 )
					{
						if ( u == 1)
						{
							var finalspan1 = span1 + addition + 3 + 1 + 2;
						} 
						else
						{
							var finalspan1 = span1 + addition + 1 + 2;
						}
					}	
					else if ( lose == 65 )
					{
							var finalspan1 = span1 + addition + 2 + 20;
					}
					else if ( lose == 66 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19;
					}
					else if ( lose == 67 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23;
					}
					else if ( lose == 68 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28;
					}
					else if ( lose == 69 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37;
					}
					else if ( lose == 70 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50;
					}
					else if ( lose == 71 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69;
					}
					else if ( lose == 72 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218;
					}
					else if ( lose == 73 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218 + 4;
					}
					else if ( lose > 73 && lose <=77 )
					{
						subthree = lose - 73;
						totalthree = subthree * 3;
						//alert(subthree);
						var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218 + 4 + totalthree;
					}
					
					else if ( lose == 78 )
					{
						subthree = lose - 73;
						totalthree = subthree * 3;
						//alert(subthree);
						var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218 + 4 + totalthree + 1;
					}
					
					else
					{
						subthree = lose - 73;
						totalthree = subthree * 3;
						//alert(subthree);
						var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218 + 4 + totalthree + 1;
					} 
					var finalspan2 = span2 + addition + totallose + 21 + totalsix;
				}
				$("#span1").text(finalspan1);
				$("#span2").text(finalspan2);	
				$('#min_range').val(finalspan1);
				$('#max_range').val(finalspan2);			
			}
			
		}
		
		else if ( month == 3 )
		{
			
			var span1 = 133;  
			var span2 = 150;

			$("#span1").text(span1);
			$("#span2").text(span2);
			$('#min_range').val(span1);
			$('#max_range').val(span2);
			
			var mul = month * 5;
	
			
			if ( price <= 15 ){
				$("#span1").text(span1);
				$("#span2").text(span2);
				$('#min_range').val(span1);
				$('#max_range').val(span2);
			} 
			
			else 
			{
				var u = 1;
				remainder = price % 5;
				x = (price - remainder) / 5;
				multi = x - 3;
				addition = mul * multi;
				
				if( lose == 1 ){
					if ( u == 1)
					{
						var finalspan1 = span1 + addition + 3;
					} 
					else
					{
						var finalspan1 = span1 + addition;
					}
					var finalspan2 = span2 + addition;
				}
				else if( lose > 1 && lose <= 9)
				{
					sublose = lose - 1;
					totallose = sublose * 30;
					if ( u == 1)
					{
						var finalspan1 = span1 + addition + 3 + 1;
					} 
					else
					{
						var finalspan1 = span1 + addition + 1;
					}
					var finalspan2 = span2 + addition + totallose;
				} 
				else if( lose > 9 && lose <= 30)
				{
					sublose = 8;
					totallose = sublose * 30;
					if ( u == 1)
					{
						var finalspan1 = span1 + addition + 3 + 1;
					} 
					else
					{
						var finalspan1 = span1 + addition + 1;
					}
					var finalspan2 = span2 + addition + totallose + 21;
				}
				else if( lose > 30 && lose <= 200)
				{
					sublose = 8;
					totallose = sublose * 30;
					subsix = lose - 30;
					totalsix = subsix * 6;
					
					if ( lose == 64 )
					{
						if ( u == 1)
						{
							var finalspan1 = span1 + addition + 3 + 1 + 2;
						} 
						else
						{
							var finalspan1 = span1 + addition + 1 + 2;
						}
					}	
					else if ( lose == 65 )
					{
							var finalspan1 = span1 + addition + 2 + 20;
					}
					else if ( lose == 66 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19;
					}
					else if ( lose == 67 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23;
					}
					else if ( lose == 68 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28;
					}
					else if ( lose == 69 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37;
					}
					else if ( lose == 70 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50;
					}
					else if ( lose == 71 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69;
					}
					else if ( lose == 72 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218;
					}
					else if ( lose == 73 )
					{
							var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218 + 4;
					}
					else if ( lose > 73 && lose <=77 )
					{
						subthree = lose - 73;
						totalthree = subthree * 3;
						//alert(subthree);
						var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218 + 4 + totalthree;
					}
					
					else if ( lose == 78 )
					{
						subthree = lose - 73;
						totalthree = subthree * 3;
						//alert(subthree);
						var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218 + 4 + totalthree + 1;
					}
					
					else
					{
						subthree = lose - 73;
						totalthree = subthree * 3;
						//alert(subthree);
						var finalspan1 = span1 + addition + 2 + 20 + 19 + 23 + 28 + 37 + 50 + 69 + 218 + 4 + totalthree + 1;
					} 
					var finalspan2 = span2 + addition + totallose + 21 + totalsix;
				}
				$("#span1").text(finalspan1);
				$("#span2").text(finalspan2);
				$('#min_range').val(finalspan1);
				$('#max_range').val(finalspan2);				
			}
			
		}
		
		
		
		
		u++;
	}
	
	
	
	
	var span1 = 133;  
	var span2 = 150;  
	
	$("#span1").text("133");
	$("#span2").text("150");
	$('#min_range').val("133");
	$('#max_range').val("150");
	
	
	$("select.price").change(function(){
        var price = $(this).children("option:selected").val();
        var month = $("select.month").children("option:selected").val();
		var lose = $("select.lose").children("option:selected").val();
		output(lose, month, price, span1, span2);
    }); 
	
	$("select.month").change(function(){
        var month = $(this).children("option:selected").val();
        var price = $("select.price").children("option:selected").val();
		var lose = $("select.lose").children("option:selected").val();
		output(lose, month, price, span1, span2);
    }); 
	
	$("select.lose").change(function(){
		var price = $("select.price").children("option:selected").val();
		var month = $("select.month").children("option:selected").val();
        var lose = $(this).children("option:selected").val();

		output(lose, month, price, span1, span2);
		
    }); 
	
	
});