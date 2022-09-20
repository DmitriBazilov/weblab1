function initialize_table() {
	$.ajax({
		type: "GET",
		url: "php/index.php",
		async: false,
		success: function(response) {
			addInTable(response);
		},
		error: function(response) {
			alert(response);
		}
	});
}

function clean_table() {
	$.ajax({
		type: "POST",
		url: "php/index.php",
		async: false,
		data: {"clean" : 'true'},
		success: function(response) {
			let tBody = document.querySelector('#table_body');
			tBody.innerHTML = ''; 
		},
		error: function(response) {
			alert(response);
		}
	});
}

function addInTable(data) {
	$('#table_body').append(data);
}
