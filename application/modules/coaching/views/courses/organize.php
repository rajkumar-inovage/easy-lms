<style type="text/css">
	body.dragging, body.dragging * {
	  cursor: move !important;
	}

	.dragged {
	  position: absolute;
	  opacity: 0.5;
	  z-index: 2000;
	}

	ul.content li.placeholder {
	  position: relative;
	  /** More li styles **/
	}
	ul.content li.placeholder:before {
	  position: absolute;
	  /** Define arrowhead **/
	}
</style>

<ul class="list-group list-group-minimum content serialization">
  <li class="list-group-item" data-id="1" data-name="First">First</li>
  <li class="list-group-item" data-id="2" data-name="Second">Second</li>
  <li class="list-group-item" data-id="3" data-name="Third">Third</li>
	<ul>
	  <li class="list-group-item" data-id="4" data-name="Fourth">Forth</li>
		
	</ul>
</ul>

<div id="serialize_output2"></div>