// JavaScript to toggle the rotation and dropdown
document.addEventListener("DOMContentLoaded", function () {
    const plusButton = document.getElementById("plusButton");
    const dropdown = document.getElementById("userdropdown");

    // Toggle the rotation and dropdown visibility
    plusButton.addEventListener("click", function (event) {
        // Toggle the "active" class to rotate the vertical line
        plusButton.classList.toggle("active");

        // Toggle dropdown visibility
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";

        // Prevent click from propagating
        event.stopPropagation();
    });

    // Close dropdown when clicking anywhere else
    document.addEventListener("click", function (event) {
        if (!plusButton.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = "none";
            plusButton.classList.remove("active"); // Reset the plus sign
        }
    });
});