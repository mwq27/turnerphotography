<? $this->load->view("/partials/header"); ?>
	
		
	<section >
		<div id="leftside" >
			<nav class="side-ul">
				<ul>
					<li><a href="c/Beauty">Beauty</a></li>
					<li>Fashion</li>
					<li>Editorial</li>
					<li>Sports &amp; Fitness</li>
					<li>Personal</li>
				</ul>
			</nav>
			
		</div>
		
		<div id="rightside" >
			<nav class="side-ul">
				<ul>
					<li>About Me</li>
					<li>Contact</li>
					
				</ul>
			</nav>
		</div>
	</section>
	<div class="container">
		<h1>Marcus Turner Photography</h1>
		<div id="featured"> 
			
			<!--<img src="dummy-images/captions.jpg" data-caption="#htmlCaption" />-->
			<?
				foreach($images as $row){
					echo "<img src='/images/".$row->filename."'/>";
				}
			
			?>
			
		</div>
		<!-- Captions for Orbit -->
		
		
		
		</div>			


<? $this->load->view("/partials/footer"); ?>