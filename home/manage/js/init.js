$('#clear').click(function(event) {
	ue.setContent('');
});
$('#confirm').click(function(event) {
	event.preventDefault();
	if($('#ismd')[0].checked){
		$('#mdtext')[0].value=ue.getPlainTxt();
	}
	document.forms[1].submit();
});