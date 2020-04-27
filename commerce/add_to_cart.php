<?php
 class add_to_list{
	function productAdd($p_id, $p_qty)
	{
		$_SESSION['cart'][$p_id]['p_qty']=$p_qty;
	}
	
	function productUpdate($p_id, $p_qty)
	{
		if(isset($_SESSION['cart'][$p_id]))
		{
			$_SESSION['cart'][$p_id]['p_qty']=$p_qty;
		}
	}
	function productEmpty()
	{
		unset($_SESSION['cart']);
	}
	function productTotal()
	{
		if(isset($_SESSION['cart']))
		{
			return count($_SESSION['cart']);
		}else
			{
				return 0;
			}
	}
 }
?>