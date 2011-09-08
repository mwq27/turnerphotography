<? $this->load->view("/partials/header.html"); ?>
	
			
	
	<div class="container2" style="">
		<div class="logo">
			<? $this->load->view("/partials/leftnav"); ?>
			
		</div>
		<div id="gallery" class="content">
			<?
				if($images == null){
			
			?>
			<div class="empty">
				<h2>New Photos Coming Soon</h2>
				We are always adding new photos to our different categories.  Please check back soon!
			</div>
		<? } ?>
					<div id="controls" class="controls"></div>
					<div class="slideshow-container">
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
					</div>
					<div id="caption" class="caption-container"></div>
		
		</div>
		<div class="clear"></div>
	</div>		
			<div id="thumbs" class="navigation">
					<ul class="thumbs noscript">
											
						<?	$x = 0;
							
							
							foreach($images as $row){
						?>
						
								
						<li>
							<a class="thumb" name = "<?=$row->filename?>" href="<? echo base_url().$row->filename;?>" title="Title #<?=$x?>">
								
								<img src = "<? echo base_url().$row->thumb;?>" alt="Title #<?=$x?>" />
								
								
								
							</a>
							<div class="caption">
				                
				            </div>
						</li>
						<?	
						
									$x++;
							}
						
						?>
					</ul>
		</div>

	
<script>
$(document).ready(function(){
	$('div.navigation').css({});
				$('div.content').css('display', 'block');

				// Initially set opacity on thumbs and add
				// additional styling for hover effect on thumbs
				var onMouseOutOpacity = 0.67;
				$('#thumbs ul.thumbs li').opacityrollover({
					mouseOutOpacity:   onMouseOutOpacity,
					mouseOverOpacity:  1.0,
					fadeSpeed:         'fast',
					exemptionSelector: '.selected'
				});
				
				// Initialize Advanced Galleriffic Gallery
				var gallery = $('#thumbs').galleriffic({
					delay:                     2500,
					numThumbs:                 17,
					preloadAhead:              10,
					enableTopPager:            true,
					enableBottomPager:         false,
					maxPagesToShow:            7,
					imageContainerSel:         '#slideshow',
					controlsContainerSel:      '#controls',
					captionContainerSel:       '#caption',
					loadingContainerSel:       '#loading',
					renderSSControls:          true,
					renderNavControls:         true,
					playLinkText:              'Play Slideshow',
					pauseLinkText:             'Pause Slideshow',
					prevLinkText:              '&lsaquo; Previous Photo',
					nextLinkText:              'Next Photo &rsaquo;',
					nextPageLinkText:          'Next &rsaquo;',
					prevPageLinkText:          '&lsaquo; Prev',
					enableHistory:             false,
					autoStart:                 false,
					syncTransitions:           true,
					defaultTransitionDuration: 900,
					enableKeyboardNavigation:	false,
					onSlideChange:             function(prevIndex, nextIndex) {
						// 'this' refers to the gallery, which is an extension of $('#thumbs')
						this.find('ul.thumbs').children()
							.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
							.eq(nextIndex).fadeTo('fast', 1.0);
					},
					onPageTransitionOut:       function(callback) {
						this.fadeTo('fast', 0.0, callback);
					},
					onPageTransitionIn:        function() {
						this.fadeTo('fast', 1.0);
					}
				});
				
				
				var triggers = $("#contactlink").overlay({
					mask: {
								color: '#ebecff',
								loadSpeed: 200,
								opacity: 0.9
						},
					closeOnClick: true
				});
				
				
			
			});
</script>
<? $this->load->view("/partials/footer"); ?>