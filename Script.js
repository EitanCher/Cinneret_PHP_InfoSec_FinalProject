// SQL Injection on Client: prevent using apostrophe

function checkFormInjection() {
	// Arrange all the inputs of class "input_to_check" into a list:
	const inputs = document.getElementsByClassName('input_to_check');

	// Loop through the list of the inputs:
	for (let input of inputs) {
		var inputValue = input.value;
			if (inputValue.includes("'")) {
				alert("Using of apostrophe is not allowed")
				return false;	// Input's value contains "'"
			}
	}
	return true;
}