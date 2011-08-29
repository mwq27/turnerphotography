<? $this->load->view("/partials/header.html"); ?>
	
		<h1>Marcus Turner Photography</h1>
	

	<div class="container2" style="width: 900px; margin:0px auto;">
		
		<div id="gallery" class="content">
					<div id="controls" class="controls"></div>
					<div class="slideshow-container">
						<div id="loading" class="loader"></div>
						<div id="slideshow" class="slideshow"></div>
					</div>
					<div id="caption" class="caption-container"></div>
		
		</div>
		
		<div id="thumbs" class="navigation">
					<ul class="thumbs noscript">
											
						<?	$x = 0;
							echo count($images); 
							foreach($images as $row){
						?>
						
								
						<li>
							<a class="thumb" name = "<?=$row->filename?>" href="<? echo base_url().'images/'.$row->filename;?>" title="Title #<?=$x?>">
								
								<img src = "http://farm4.static.flickr.com/3261/2538183196_8baf9a8015_s.jpg" alt="Title #<?=$x?>" />
								
								
								
							</a>
							<div class="caption">
				                (Any html can go here)
				            </div>
						</li>
						<?	
						
									$x++;
							}
						
						?>
					</ul>
		</div>
		
		
		
	</div>
	
	
<script>
$(document).ready(function(){
	$('div.navigation').css({'width' : '300px', 'float' : 'left'});
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
					numThumbs:                 15,
					preloadAhead:              10,
					enableTopPager:            true,
					enableBottomPager:         true,
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
					enableHistory:             true,
					autoStart:                 false,
					syncTransitions:           true,
					defaultTransitionDuration: 900,
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
				
			});
</script>

<? $this->load->view("/partials/footer"); ?>