jQuery(document).ready(function($) {

    "use strict";
	
	$(".mosaicholder").jPages({
      containerID: "mosaicContainer",
      previous : "←",
      next : "→",
      perPage:8,
      midRange: 3,
      direction: "random",
      animation: "flipInY"
    });
	
	$('.mosaic-gallery-link').viewbox();
	
});