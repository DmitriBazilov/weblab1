function sendForm() {
	var x = document.querySelectorAll('input[type="checkbox"]:checked');
	var y = document.getElementById('y_text');
	var r = document.querySelector('option:checked');
	var result = validate_values(x, y, r);
	var alrt = document.getElementById('alert');
	if (result != "") {
		alrt.innerHTML = "<strong>" + result + "</strong>";
	} else {
		console.log(x.item(0).value, y.value, r.value);
		$.ajax({
			url: 'php/index.php',
			type: 'POST',
			async: false,
			data: {
				'x': x.item(0).value,
				'y': y.value,
				'r': r.value,
				'clean': 'false'
			},
			success: function(data) {
				console.log(data);
				addInTable(data);
			},
			error: function(data) {
				alert(data);
			}
		});
	}
}
