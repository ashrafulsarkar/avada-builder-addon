<script type="text/html" id="tmpl-custom_card-shortcode">
	<div class="custom_card">
		<div {{{ _.fusionGetAttributes( wrapperAttributes ) }}}>
			<div class="c_card_image">
				<img decoding="async" src="{{{ FusionPageBuilderApp.renderContent( image, cid, false ) }}}">
			</div>
			<div class="c_card_content">
				<h4>{{{ FusionPageBuilderApp.renderContent( title, cid, false ) }}}</h4>
				<a href="{{{ FusionPageBuilderApp.renderContent( button_link, cid, false ) }}}">{{{ FusionPageBuilderApp.renderContent( button_text, cid, false ) }}}</a>
			</div>
		</div>
		<div class="custom_card_bottom"></div>
	</div>
</script>