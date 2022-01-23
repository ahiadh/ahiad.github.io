// mymfid is the id you've set to the hidden field you want to push the string to
myFields = document.querySelectorAll('[id=form-field-mymfid]');

// declare all characters
const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

function generateString(length) {
    var result = ' ';
    const charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }

    return result;
}
if (myFields) {
	myFields.forEach( function(element, index) {
    //  number of characters you want to add to the field
		randomValue = generateString(15);
		element.value = randomValue;
	});
}
