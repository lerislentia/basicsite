		<!-- Products -->
    <section id="products" class="product-grid">
    <div class="container">
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div class="section-heading">
            <h2>{{ __('products.products') }}</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">

          <ul id="mygrid" class="mygrid">

          </ul>

        </div>
      </div>
    </div>
  </section>

	<script type="text/javascript">

$(document).ready(function () {

    var grid = $( "#mygrid" ).html("");
    var locale = '{{$locale}}';
		$.ajax({
          url: "/storage/products.json",
          type: "GET",
					dataType : "json",
          success: function (data) {
						
						$.each(data, function(i, item) {

							var filename = '';
							var thumb = '';
                var li = $("<li></li>");
                li.attr("id", "product"+item.id);
                var ahref = $("<a>");

                ahref.attr("class", "fancybox");
								if(item.images.length>0 && item.images[0].filename!=''){
									filename = item.images[0].filename;
								}
								ahref.attr("href", filename);
                ahref.attr("title", item.name_value.lang.{{$locale}}.text);
                ahref.attr("description", item.description_value.lang.{{$locale}}.text);
                var img = $("<img>");
								if(item.images.length>0 && item.images[0].thumb!=''){
									thumb = item.images[0].thumb;
								}
								img.attr("src", thumb);
                img.attr("alt", "");

                ahref.append(img);
                li.append(ahref);

                grid.append(li);
            });
            
            $(".fancybox").fancybox(
              {
                openEffect	: 'elastic',
    	          closeEffect	: 'elastic',
                helpers: {
                    title : {
                        type : 'inline'
                    }
                }
              }
            );

          },
          error: function () {
              console.log("[ERROR] Method: products.json");
          }
      });
});

</script>