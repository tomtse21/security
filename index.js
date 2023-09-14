$(function () {
    $(document).ready(function () {
        preloadFormData();
        
        $('#dob').datepicker({
            format: 'yyyy-mm-dd' // You can customize the date format
        });

        $('#vaccinationDate').datepicker({
            format: 'yyyy-mm-dd' // You can customize the date format
        });
        
        function preloadFormData() {
            // Simulate preloaded data (you can replace this with actual data retrieval)
            var preloadedData = {
                enName: "John Doe",
                cnName: "謝好",
                hkid: "A1234567",
                email: "123@gmail.com",
                phoneNo: 12345678,
                gender: "men",
                dob: "09/08/2001",
                vaccinationDate: "09/08/2001",
                boc: "bioNTech",
                location: "addr1"
                // Add more fields here
            };

            // Set the form field values using jQuery
            $("#enName").val(preloadedData.enName);
            $("#cnName").val(preloadedData.cnName);
            $("#hkid").val(preloadedData.hkid);
            $("#email").val(preloadedData.email);
            $("#phoneNo").val(preloadedData.phoneNo);
            $("#gender").val(preloadedData.gender);
            $("#dob").val(preloadedData.dob);
            $("#vaccinationDate").val(preloadedData.vaccinationDate);
            $("#boc").val(preloadedData.boc);
            $("#location").val(preloadedData.location);

            // Set values for other fields as needed
        }
        function isHKID(str) {
            var strValidChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            if (str.length < 8)
            { 
                return false;
            }
            str = str.toUpperCase();    
            var hkidPat = /^([A-Z]{1,2})([0-9]{6})([A0-9])$/;
            var matchArray = str.match(hkidPat);    
            if (matchArray == null)
            {
                return false;
            }
            var charPart = matchArray[1];
            var numPart = matchArray[2];
            var checkDigit = matchArray[3];    
            var checkSum = 0;
            if (charPart.length == 2) {
                checkSum += 9 * (10 + strValidChars.indexOf(charPart.charAt(0)));
                checkSum += 8 * (10 + strValidChars.indexOf(charPart.charAt(1)));
            } else {
                checkSum += 9 * 36;
                checkSum += 8 * (10 + strValidChars.indexOf(charPart));
            }

            for (var i = 0, j = 7; i < numPart.length; i++, j--)
            {
                checkSum += j * numPart.charAt(i);
            }
            var remaining = checkSum % 11;
            var verify = remaining == 0 ? 0 : 11 - remaining;
            return verify == checkDigit || (verify == 10 && checkDigit == 'A');
        }
        
        function isValidEmail(email) {
            // Regular expression for a valid email address
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            // Test the email against the pattern
            return emailPattern.test(email);
        }

    });

    
});