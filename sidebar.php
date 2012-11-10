				<section class="sidebar">
					<div class="container">
						<div class="categoria">
							<h4>Categorias</h4>
							<?php wp_nav_menu(array('theme_location' => 'MenuCategorias','container' => 'false')); ?>
						</div>
						<div class="links">
							<h4>Links de interes</h4>
							<?php wp_nav_menu(array('theme_location' => 'MenuLinks','container' => 'false')); ?>
						</div>
					</div>
					
				</section>