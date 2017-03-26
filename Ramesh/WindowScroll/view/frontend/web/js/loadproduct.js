define(["jquery"],function($)
{
if($("body").hasClass("catalog-category-view") || $("body").hasClass("catalogsearch-result-index"))
	{
		$(".load-product-icon").insertBefore(".toolbar.toolbar-products:last");
		$(".toolbar.toolbar-products:last").hide();
		var page=1;
		var currentProductSize=$(".toolbar-amount:first > .toolbar-number:nth-child(2)").html();
		var totalProductSize=$(".toolbar-amount:first > .toolbar-number:nth-child(3)").html();
		if(currentProductSize*page<totalProductSize)
		{
			$(".load-product-icon").hide();
		}
		var requestInProcess=0;
		$(".load-product-icon").click(function(){
			loadProdcutItems();
		});	
		$( window ).scroll(function(event) {
			if($(".products.wrapper.grid.products-grid").is(':hover') && ($(".load-product-icon").position().top-$(this).scrollTop()<100))
			{
				loadProdcutItems();				
			}
		});
		function loadProdcutItems()
		{
			if(requestInProcess==0)
			{
				requestInProcess+=1
				if(currentProductSize*page<totalProductSize)
				{
					$(".load-product-icon").show();
					page+=1;
					$.ajax({
					url:$(location).attr('href'),
					data:{"p":page},			
					type:"GET",			
					success:function(responseHtml){ 
						var jtestresponseHtml=$(responseHtml);
						var product_item_grid=$(".products.wrapper.grid.products-grid > .products.list.items.product-items",jtestresponseHtml).html();
						$(".products.wrapper.grid.products-grid > .products.list.items.product-items").append(product_item_grid); 
						$(".toolbar-amount:first > .toolbar-number:nth-child(2)").html(parseInt($(".toolbar-amount:first > .toolbar-number:nth-child(2)").html())+$(product_item_grid).length);
						requestInProcess=0;						
						}  
					}); 
				}
				else
				{
					$(".load-product-icon").hide();
				}
			}			
		}
	}
});