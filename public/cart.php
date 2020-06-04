<?php
    echo "<pre>";
    print_r($_SESSION['items']);
    echo "</pre>";
?>
	
	<!-- Varukorg -->
    <div class="d-flex justify-content-end">
        <div class="col">
            <a href="products.php" class="btn btn-info">Products</a>
        </div>

        <!-- Dropdown -->
        <div class="col">
            <button type="button" class="btn btn-info" data-toggle="dropdown ">
                Varukorg
            </button>

            <!-- Dropdown Menu -->
            <div class="d-flex justify-content-end">
                <div class="col-lg-6 col-sm-6 col-6">
                    <p>Total:
                        <span class="text-info">2000 kr</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
	
	<!-- Cart Detail -->
    <!-- <div class="d-flex flex-column">
    	<div class="col-lg-4 col-sm-4 cart-detail-img">
            
    	</div>

    	<div class="col-lg-4 col-sm-4 cart-detail-img">
            

    	</div>
		
		<div class="col-lg-4 col-sm-4 cart-detail-img">
            
    	</div>
    </div> -->




