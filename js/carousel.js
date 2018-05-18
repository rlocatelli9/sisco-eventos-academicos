$('.carousel.captions ul').anoSlide(
{
	items: 1,
	speed: 50,
	prev: 'a.prev[data-prev-caption]',
	next: 'a.next[data-next-caption]',
	lazy: true,
	onStart: function(ui)
	{
		/* Remove existing caption in slide */
		ui.slide.element.find('.caption').remove();
	},
	onEnd: function(ui)
	{
		/* Get caption content */
		var content = ui.slide.element.data('caption');
		
		/* Create a caption wrap element */
		var caption = $('<div/>').addClass('caption').css(
		{
			position: 'absolute', 
			background: 'rgb(0,0,0)',
			color: 'rgb(255,255,255)',
			textShadow: 'rgb(0,0,0) -1px -1px',
			opacity: 0.5,
			top: -100,
			left: 50,
			padding: 20,
			webkitBorderRadius: 5,
			mozBorderRadius: 5,
			borderRadius: 5
		}).html(content);
		
		/* Append caption to slide and animate it. Animation is really up to you. */
		caption.appendTo(ui.slide.element).animate(
		{
			top:50
		});
	}
})