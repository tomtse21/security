
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>COVID-19 vaccination booking system </title>

    <!-- Include Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <!-- Include Bootstrap CSS from a CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Bootstrap Datepicker CSS and JavaScript files -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- ✅ load jQuery ✅ -->
    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Include jQuery UI from a CDN -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
    <div class="container" style="margin-top:50px">
        <h1>COVID-19 vaccination booking system </h1>
        <form method="post" action="create_form_process.php" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="enName">English Name:</label>
                <input type="text" class="form-control" id="enName" name="enName" required>
            </div>

            <div class="form-group">
                <label for="cnName">Chinese Name:</label>
                <input type="text" class="form-control" id="cnName" name="cnName" required>
            </div>

            <div class="form-group">
                <label for="hkid">HKID:</label>
                <input type="text" class="form-control" id="hkid" name="hkid"  required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phoneNo">Phone Number:</label>
                <input type="number" class="form-control" id="phoneNo" name="phoneNo" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="men">Men</option>
                    <option value="women">Women</option>
                </select>
            </div>

            <div class="form-group">
                <label for="dob">Date of birth:</label>
                <input type="text" class="form-control" id="dob" name="dob" required>
            </div>

            <div class="form-group">
                <label for="vaccinationDate">Vaccination date:</label>
                <input type="text" class="form-control" id="vaccinationDate" name="vaccinationDate" required>
            </div>

            <div class="form-group">
                <label for="boc">Brand of vaccine:</label>
                <select class="form-control" id="boc" name="boc">
                    <option value="bioNTech">BioNTech 復必泰</option>
                    <option value="coronaVac">CoronaVac 科興</option>
                </select>
            </div>


            <div class="form-group">
                <label for="location">Location:</label>
                <select class="form-control" id="location" name="location">
                    <option value="addr1">CENTRAL- Club Lusitano -16
                        Ice House Street (7/F) (Entrance
                        at Duddell Street) - by Marina
                        Medical </option>
                    <option value="addr2">CENTRAL - 9 Queen's Road
                        Central (Room 2101) - by
                        Humanity & Health (Sinovac) </option>
                    <option value="addr3">CAUSEWAY BAY - Sino Plaza,
                        255 Gloucester Road (11/F) - by
                        HKIPHCA </option>
                    <option value="addr4">CENTRAL - 9 Queen's Road
                        Central (Room 2101) - by
                        Humanity & Health (Sinovac) </option>
                    <option value="addr5">WONG CHUK HANG - 1 Nam
                        Fung Path (1/F, Tower A) -
                        Gleneagles Hospital Hong Kong
                        (BioNTech - Toddler/ Paediatric) </option>
                    <option value="addr6">HUNG HOM-1 Wu Kwong
                        Street (Shop 11) - by Dr. Leung
                        Shu Piu Clinic </option>
                    <option value="addr7">KOWLOON BAY - The
                        Quayside, 77 Hoi Bun Road
                        (Shop 7, 2/F) - by Quality
                        Healthcare </option>

                </select>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery from a CDN -->
    <!-- Include your custom CSS -->
    <script>
        function validateForm() {
            var chineseNameInput = document.getElementById("cnName");
            var chineseName = chineseNameInput.value.trim();

            // Regular expression to match Chinese characters
            var chineseRegex = /^[\u4e00-\u9fa5]+$/;

            if (!chineseRegex.test(chineseName)) {
                alert("Please enter a valid Chinese name.");
                chineseNameInput.focus();
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }

        function IsHKID(str) {
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
    </script>
    <script src="index.js"></script>


</body>

</html>