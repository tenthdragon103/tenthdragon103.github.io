// JavaScript to toggle the rotation and dropdown
document.addEventListener("DOMContentLoaded", function () {
    const plusButton = document.getElementById("plusButton");
    const dropdown = document.getElementById("userdropdown");

    const toggleButton = document.getElementById("darkModeToggle");
    const body = document.body;


    // Check localStorage for saved mode
    if (localStorage.getItem("darkMode") === "enabled") {
        body.classList.add("dark");
    }

    // Toggle dark mode on button click
    toggleButton.addEventListener("click", function () {
        body.classList.toggle("dark");

        // Save user preference in localStorage
        if (body.classList.contains("dark")) {
            localStorage.setItem("darkMode", "enabled");
        } else {
            localStorage.setItem("darkMode", "disabled");
        }
    });

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