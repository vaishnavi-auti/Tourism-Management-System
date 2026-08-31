function validateBookingForm() {

    const phone = document.getElementById("phone").value.trim();

    const persons = document.getElementById("persons").value;

    // Phone validation
    const phonePattern = /^[0-9]{10}$/;

    if (!phonePattern.test(phone)) {

        alert("Please enter a valid 10 digit phone number.");

        return false;
    }


    // Persons validation
    if (persons < 1 || persons > 20) {

        alert("Number of persons must be between 1 and 20.");

        return false;
    }


    return true;
}