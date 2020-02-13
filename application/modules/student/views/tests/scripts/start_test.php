<script>
$(document).ready (function () {
	/*Hide All Questions on First Load and show only section 1*/
	$(".pages").hide ();
	$("#page1").show ();
	
	$(".next").click(function() {
		
		/*Hide/Show question blocks*/
		/*$(".pages:visible").hide().next(".pages").andSelf().last().show();*/
		var id = $('#num_question').val();
		var next = parseInt (id) + 1;
		var last = <?php echo $total_questions; ?>;
		var confirm_div = <?php echo $confirm_div; ?>;

		if (next > last) {
			$(".pages").hide();
			$("#page"+confirm_div).show();
		} 	
		$(".pages").hide();
		$("#page"+next).show();
		$('#num_question').val (next);	

		/*Change color of progress buttons and increment values for - Answered, Not-answered and For-review*/
		if (document.getElementById("leaveblank_"+id).checked == true ) {
			/*Change color*/
			document.getElementById("btn_"+id).className="btn btn-sm btn-warning";
		} else {
			/*Change color*/
			document.getElementById("btn_"+id).className="btn btn-sm btn-success";
		}

		if (document.getElementById("visitlater_"+id).checked == true ) {
			/*Change color*/
			document.getElementById("btn_"+id).className="btn btn-sm btn-danger";
		}
	
		if ($("#page"+next).height() > $('.test-page .st-content-inner').height()){
			$("#page"+next).find('.card-footer').addClass('sticky');
		}
        else{
            if(!$("#page"+next).hasClass('end'))
                $("#page"+next).find('.card-footer').css('width',$("#test_form").width()+'px');
        }
		

	});
	
	
	$('.visitlater').click (function() { 
		var id = $(this).attr ('data-id');
		if ($(this).is(':checked')) {
			$("#btn_"+id).addClass ("btn btn-sm btn-danger");		
		} else {
			$("#btn_"+id).removeClass ("btn-danger");		
		}
		
	});

	$('.answer_choices').click (function() {
		var id = $(this).attr ('data-id');
		if ($(this).is(':checked')) {
			$("#btn_"+id).addClass ("btn btn-sm btn-success");		
		} else {
			$("#btn_"+id).removeClass ("btn-success");		
		}
		
	});

	$('.leaveblank').click (function() {
		var id = $(this).attr ('data-id');
		if ($(this).is(':checked')) {
			$("#btn_"+id).removeClass ("btn-success");
			$("#btn_"+id).addClass ("btn-warning");
		} else {
			$("#btn_"+id).removeClass ("btn-warning");		
		}
		
	});

	/*Enable/Disable Timer*/
	$('#disable-timer-d, #disable-timer-m').on ('click', function (e) {		
		var x = confirm ('This will disable automatic test submission on time complete. Though the timer will keep running.');
		if (x) {
			/*$(this).checked = true;*/
		} else {
			e.preventDefault ();
		}
	});
});
/*Multi Select questions checkboxes toggle*/
function mcmc_deselect (blankid, qid) {
	if ( blankid.checked == true) {
		/*leave blank selected*/
		for ( var i=1; i <= 6; i++) {
			itemid = document.getElementById ('mc_'+qid+'_'+i);
			if ( itemid.checked == true ) {
				itemid.checked = false;
			}
		}
	}
}

/*Multi Select questions checkboxes toggle*/
function mcmc_select (qid, blankid) {
	itemid = document.getElementById (blankid);
	if ( itemid.checked == true) {
		/*leave blank selected*/
		itemid.checked = false;
	}
}
function match_deselect (blankid, qid) {
	if ( blankid.checked == true ) {
		for ( var i=1; i <=6; i++) {
			document.getElementById('ans_'+qid+'_'+i).value = "0";
		}
	}

}
function match_select (blankid) {
	item = document.getElementById(blankid);
	if ( item.checked == true ) {
		item.checked = false;
	}
}
function display_question(id) {	
	$('.pages').hide();
	$('#page'+id).show();
	$('#num_question').val(id);
    if($("#page"+id).height() > $('.test-page .st-content-inner').height()){
        $("#page"+id).find('.card-footer').addClass('sticky');
	}
    else{
        $("#page"+id).find('.card-footer').css('width',$("#test_form").width()+'px');
    }
}
function show_last () {	
	var last = <?php echo $total_questions; ?>;
	$('.pages').hide();
	$('#page'+last).show();
}
function show_first () {	
	var first = 1;
	$('.pages').hide();
	$('#page'+first).show();
	$('#num_question').val (first);	
}
$(document).ready(function() {
    $('input:radio').change(function(){
		var total_questions = <?php echo $total_questions; ?>;
        var num_answered = $('.answer:checked').length;
		var num_not_answered = total_questions - num_answered;
        $('#review-answered').text(num_answered);
        $('#review-not-answered').text(num_not_answered);
    });
	$('input:checkbox').change(function(){
        var num_visitlater = $('.visitlater:checked').length;
        $('#review-for-review').text(num_visitlater);
    });
});
</script>