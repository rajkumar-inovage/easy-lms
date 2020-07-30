<script>
$(document).ready(() => {
	$('iframe').on("load", (event) => {
		console.log(event.currentTarget.width);
		$(event.currentTarget).height(Math.floor($(event.currentTarget).parent().width() * 9 / 16));
	});
	$('iframe').each((index, frame)=>{
		$(frame).height(0);
	});
});
</script>