<!-- Home 100vh-->
<div class="home">
	<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/searchbg.jpg" data-speed="0.1"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content text-center">
						   <br>
							<div class="home_title"><?echo _search_company_product?></div>
						    	<div class="search">
								<form action="search.php" method="get" class="search_form" id="search_form">
									<img class="search_icon search_icon_turn" src="images/search.png" alt="Search icon" title="Search">
									<input type="search" autocomplete="off" old-data="" name="searchingText" id="searching-text" class="search_input"  placeholder="<?php echo _search_placeholder;?>" onkeyup="Search_GetText()" required="required">
									<div class="SearchBox-searching-items" id="searching-items">
										<!-- Searching items -->
									</div>
									<input type="submit" class="search_button" value="Search">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>