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
                hkid: "A12345678",
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
    });


});