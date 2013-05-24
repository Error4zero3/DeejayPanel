/*
	* eakroko.js - Copyright 2013 by Ernst-Andreas Krokowski
	* Framework for themeforest themes

	* Date: 2013-01-01
	*/
	$(document).ready(function() {
		var mobile = false,
		tooltipOnlyForDesktop = true,
		notifyActivatedSelector = 'button-active';

		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
			mobile = true;
		}

	// Round charts (easypie)
	if($(".chart").length > 0)
	{
		$(".chart").each(function(){
			var color = "#881302",
			el = $(this);
			if(el.attr('data-color'))
			{
				color = el.attr('data-color');
			}
			else
			{
				if(parseInt(el.attr("data-percent")) <= 25)
				{
					color = "#046114";
				}
				else if(parseInt(el.attr("data-percent")) > 25 && parseInt(el.attr("data-percent")) < 75)
				{
					color = "#dfc864";
				}
			}
			el.easyPieChart({
				animate: 1000,
				barColor: color,
				lineWidth: 3
			});
		});
	}

	// Calendar (fullcalendar)
	if($('.calendar').length > 0)
	{
		$('.calendar').fullCalendar({
			header: {
				left: 'today,prev,next',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			buttonText:{
				today:'Today'
			},
			editable: true
		});
		$(".fc-button-effect").remove();
		$(".fc-button-next .fc-button-content").html("<i class='icon-chevron-right'></i>");
		$(".fc-button-prev .fc-button-content").html("<i class='icon-chevron-left'></i>");
		$(".fc-button-today").addClass('fc-corner-right');
		$(".fc-button-prev").addClass('fc-corner-left');
	}

	// Tooltips (only for desktop) (bootstrap tooltips)
	if(tooltipOnlyForDesktop)
	{
		if(!mobile)
		{
			$('[rel=tooltip]').tooltip();
		}
	}
	

	// Notifications
	$(".notify").click(function(){
		var el = $(this);
		var title = el.attr('data-notify-title'),
		message = el.attr('data-notify-message'),
		image = el.attr('data-notify-image'),
		time = el.attr('data-notify-time'),
		sticky = el.attr('data-notify-sticky');

		if($('.notify-toggle').hasClass(notifyActivatedSelector))
		{

				// Regex
				
				if(!el.hasClass("notify-inverse")){
					message = message.replace('{{state}}',(el.hasClass('button-active')) ? 'off' : 'on');
				} else {
					message = message.replace('{{state}}',(el.hasClass('button-active')) ? 'on' : 'off');
				}

				$.gritter.add({
					title: 	(typeof title !== 'undefined') ? title : 'Message - Head',
					text: 	(typeof message !== 'undefined') ? message : 'Body',
					image: 	(typeof image !== 'undefined') ? image : null,
					sticky: (typeof sticky !== 'undefined') ? sticky : false,
					time: 	(typeof time !== 'undefined') ? time : 5000
				});
			}
		});

	// masked input
	if($('.mask_date').length > 0){
		$(".mask_date").mask("9999/99/99");	
	}
	if($('.mask_phone').length > 0){
		$(".mask_phone").mask("(999) 999-9999");
	}
	if($('.mask_serialNumber').length > 0){
		$(".mask_serialNumber").mask("9999-9999-99");	
	}
	if($('.mask_productNumber').length > 0){
		$(".mask_productNumber").mask("aaa-9999-a");	
	}
	// tag-input
	if($(".tagsinput").length > 0){
		$('.tagsinput').tagsInput({width:'auto', height:'auto'});
	}

	// datepicker
	if($('.datepick').length > 0){
		$('.datepick').datepicker();
	}
	// timepicker
	if($('.timepick').length > 0){
		$('.timepick').timepicker({
			defaultTime: 'current',
			minuteStep: 1,
			disableFocus: true,
			template: 'dropdown'
		});
	}
	// colorpicker
	if($('.colorpick').length > 0){
		$('.colorpick').colorpicker();	
	}
	// uniform
	if($('.uniform-me').length > 0){
		$('.uniform-me').uniform({
			radioClass : 'uni-radio',
			buttonClass : 'uni-button'
		});
	}
	// Chosen (chosen)
	if($('.chosen-select').length > 0)
	{
		$('.chosen-select').chosen(); 
	}

	// multi-select
	if($('.multiselect').length > 0)
	{
		$(".multiselect").each(function(){
			var el = $(this);
			var selectableHeader = el.attr('data-selectableheader'),
			selectionHeader  = el.attr('data-selectionheader');
			if(selectableHeader != undefined)
			{
				selectableHeader = "<div class='multi-custom-header'>"+selectableHeader+"</div>";
			}
			if(selectionHeader != undefined)
			{
				selectionHeader = "<div class='multi-custom-header'>"+selectionHeader+"</div>";	
			}
			el.multiSelect({
				selectionHeader : selectionHeader,
				selectableHeader : selectableHeader
			});
		});
	}

	// spinner
	if($('.spinner').length > 0){
		$('.spinner').spinner();
	}

	// WYSIWYG
	if($('.cleditor').length > 0){
		$(".cleditor").cleditor({width:'auto'});
	}
	// PlUpload
	if($('.plupload').length > 0){
		$('.plupload').pluploadQueue({
			runtimes : 'html5,gears,flash,silverlight,browserplus',
			url : 'js/plupload/upload.php',
			max_file_size : '10mb',
			chunk_size : '1mb',
			unique_names : true,
			resize : {width : 320, height : 240, quality : 90},
			filters : [
			{title : "Image files", extensions : "jpg,gif,png"},
			{title : "Zip files", extensions : "zip"}
			],
			flash_swf_url : 'js/plupload/plupload.flash.swf',
			silverlight_xap_url : 'js/plupload/plupload.silverlight.xap'
		});
		$(".plupload_header").remove();
		$(".plupload_progress_container").addClass("progress").addClass('progress-striped');
		$(".plupload_progress_bar").addClass("bar");
		$(".plupload_button").each(function(){
			if($(this).hasClass("plupload_add")){
				$(this).attr("class", 'button button-basic pl_add');
			} else {
				$(this).attr("class", 'button button-basic pl_start');
			}
		});
	}

	// Wizard
	if($(".form-wizard").length > 0){
		$(".form-wizard").formwizard({ 
			formPluginEnabled: true,
			validationEnabled: true,
			focusFirstInput : false,
			validationOptions: {
				errorElement:'span',
				errorClass: 'help-block error',
				errorPlacement:function(error, element){
					element.parents('.controls').append(error);
				},
				highlight: function(label) {
					$(label).closest('.control-group').removeClass('error success').addClass('error');
				},
				success: function(label) {
					label.addClass('valid').closest('.control-group').removeClass('error success').addClass('success');
				}
			},
			formOptions :{
				success: function(){
				},
				beforeSubmit: function(){
				},
				dataType: 'json',
				resetForm: true
			}	
		});
	}

	// Validation
	if($('.form-validate').length > 0)
	{
		$('.form-validate').each(function(){
			var id = $(this).attr('id');
			$("#"+id).validate({
				errorElement:'span',
				errorClass: 'help-block error',
				errorPlacement:function(error, element){
					element.parents('.controls').append(error);
				},
				highlight: function(label) {
					$(label).closest('.control-group').removeClass('error success').addClass('error');
				},
				success: function(label) {
					label.addClass('valid').closest('.control-group').removeClass('error success').addClass('success');
				}
			});
		});
	}

	// dataTables
	if($('.dataTable').length > 0){
		$('.dataTable').each(function(){
			var opt = {
				"sPaginationType": "full_numbers",
				"oLanguage":{
					"sSearch": "<span>Search:</span> ",
					"sInfo": "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
					"sLengthMenu": "<span>Show entries:</span> _MENU_"
				}
			};
			if($(this).hasClass("dataTable-noheader")){
				opt.bFilter = false;
				opt.bLengthChange = false;
			}
			if($(this).hasClass("dataTable-nofooter")){
				opt.bInfo = false;
				opt.bPaginate = false;
			}
			if($(this).hasClass("dataTable-nosort")){
				var column = $(this).data('nosort');
				column = column.split(',');
				for (var i = 0; i < column.length; i++) {
					column[i] = parseInt(column[i]);
				};
				opt.aoColumnDefs =  [
				{ 'bSortable': false, 'aTargets': column }
				];
			}
			if($(this).hasClass('dataTable-tools')){
				opt.sDom= 'T<"clear">lfrtip';
				opt.oTableTools = {
					"sSwfPath": "js/swf/copy_csv_xls_pdf.swf"
				};
			}
			$(this).dataTable(opt);
			$('.dataTables_filter input').attr("placeholder", "Search here...");
		});
}

	// force correct width for chosen
	resize_chosen();

	// file_management
	if($('.file-manager').length > 0)
	{
		$('.file-manager').elfinder({
			url:'js/elfinder/php/connector.php'
		});
	}

	// slider
	if($('.slider').length > 0)
	{
		$(".slider").each(function(){
			var el = $(this);
			var min = parseInt(el.attr('data-min')),
			max = parseInt(el.attr('data-max')),
			step = parseInt(el.attr('data-step')),
			range = el.attr('data-range'),
			rangestart = parseInt(el.attr('data-rangestart')),
			rangestop = parseInt(el.attr('data-rangestop'));

			var opt = {
				min: min,
				max: max,
				step: step,
				slide: function( event, ui ) {
					el.find('.amount').html( ui.value );
				}
			};

			if(range !== undefined)
			{
				opt.range = true;
				opt.values = [rangestart, rangestop];
				opt.slide = function( event, ui ) {
					el.find('.amount').html( ui.values[0]+" - "+ui.values[1] );
				};
			}

			el.slider(opt);
			if(range !== undefined){
				var val = el.slider('values');
				el.find('.amount').html(val[0] + ' - ' + val[1]);
			} else {
				el.find('.amount').html(el.slider('value'));
			}
		});
	}
});

$(window).resize(function() {
	// chosen resize bug
	resize_chosen();
});

function resize_chosen(){
	$('.chzn-container').each(function() {
		var el = $(this);
		el.css('width', el.parent().width()+'px');
		el.find(".chzn-drop").css('width', (el.parent().width()-2)+'px');
		el.find(".chzn-search input").css('width', (el.parent().width()-37)+'px');
	});
}