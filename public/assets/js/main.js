// SIDEBAR DROPDOWN
const allDropdown = document.querySelectorAll("#sidebar .side-dropdown");
const sidebar = document.getElementById("sidebar");
const toggleSidebar = document.querySelector("nav .toggle-sidebar");
const allSideDivider = document.querySelectorAll("#sidebar .divider");

// Handle dropdown functionality
allDropdown.forEach((item) => {
    const a = item.parentElement.querySelector("a:first-child");
    a.addEventListener("click", function (e) {
        e.preventDefault();

        // Close other dropdowns when one is clicked
        allDropdown.forEach((i) => {
            const aLink = i.parentElement.querySelector("a:first-child");
            if (aLink !== this) { // Close all except the clicked one
                aLink.classList.remove("active");
                i.classList.remove("show");
            }
        });

        // Toggle the clicked dropdown
        this.classList.toggle("active");
        item.classList.toggle("show");
    });
});

// SIDEBAR COLLAPSE AND TOGGLE
toggleSidebar.addEventListener("click", function () {
    sidebar.classList.toggle("hide");

    if (sidebar.classList.contains("hide")) {
        // Collapse the sidebar and ensure only active dropdown stays open
        allSideDivider.forEach((item) => {
            item.textContent = "-"; // Replace text with a short indicator
        });

        allDropdown.forEach((item) => {
            const a = item.parentElement.querySelector("a:first-child");

            // Keep the already active dropdown expanded
            if (a.classList.contains("active")) {
                item.classList.remove("show"); // Ensure the dropdown stays visible
            }
        });
    } else {
        // Expand the sidebar and restore texts and dropdown states
        allSideDivider.forEach((item) => {
            item.textContent = item.dataset.text; // Restore original text
        });

        allDropdown.forEach((item) => {
            const a = item.parentElement.querySelector("a:first-child");

            // Restore visibility for active dropdown
            if (a.classList.contains("active")) {
                item.classList.add("show");
            }
        });
    }
});


// Add a flag to track sidebar expansion via mouseenter
let isSidebarExpanded = false;

// Handle mouseenter to expand
sidebar.addEventListener('mouseenter', function () {
  if (this.classList.contains('hide')) {
    // Expand the sidebar
    this.classList.remove('hide'); // Remove the 'hide' class
    isSidebarExpanded = true; // Set the flag to true

    // Show full text for dividers
    allSideDivider.forEach(item => {
      item.textContent = item.dataset.text;
    });

    // Expand dropdowns but preserve the active state for <a>
    allDropdown.forEach(item => {
      const a = item.parentElement.querySelector('a:first-child');
      a.classList.add("active"); // Ensure <a> remains active
      item.classList.add("show"); // Show the dropdown menu
    });
  }
});

// Handle mouseleave to collapse
sidebar.addEventListener('mouseleave', function () {
  if (isSidebarExpanded) {
    // Collapse the sidebar
    this.classList.add('hide'); // Add the 'hide' class
    isSidebarExpanded = false; // Reset the flag

    // Collapse dropdowns but keep the active state for <a>
    allDropdown.forEach(item => {
      const a = item.parentElement.querySelector('a:first-child');
      a.classList.add("active"); // Keep <a> active
      item.classList.remove("show"); // Hide the dropdown menu
    });

    // Replace text with a short indicator (e.g., '-')
    allSideDivider.forEach(item => {
      item.textContent = '-';
    });
  }
});

// Handle toggle click (if you have a toggle button)
const toggleButton = document.querySelector('#toggleButton'); // Replace with your toggle button selector
toggleButton.addEventListener('click', function () {
  // Toggle the sidebar's 'hide' class
  sidebar.classList.toggle('hide');
  isSidebarExpanded = !sidebar.classList.contains('hide'); // Update the flag based on the new state

  // Ensure <a> remains active and manage dropdown visibility
  allDropdown.forEach(item => {
    const a = item.parentElement.querySelector('a:first-child');
    if (!sidebar.classList.contains('hide')) {
      a.classList.add("active"); // Ensure <a> is active when expanded
      item.classList.add("show"); // Show dropdowns
    } else {
      a.classList.add("active"); // Keep <a> active even when collapsed
      item.classList.remove("show"); // Hide dropdowns
    }
  });

  // Update side divider text based on the sidebar state
  allSideDivider.forEach(item => {
    item.textContent = sidebar.classList.contains('hide') ? '-' : item.dataset.text;
  });
});


// Handle mouseleave to collapse
sidebar.addEventListener("mouseleave", function () {
    if (isSidebarExpanded) {
        // Collapse the sidebar
        this.classList.add("hide"); // Add the 'hide' class
        isSidebarExpanded = false; // Reset the flag

        // Collapse dropdowns but keep the active state for <a>
        allDropdown.forEach((item) => {
            const a = item.parentElement.querySelector("a:first-child");
            a.classList.remove("active"); // Remove active state
            item.classList.remove("show"); // Hide dropdown menu
        });

        // Replace text with a short indicator (e.g., '-')
        allSideDivider.forEach((item) => {
            item.textContent = "-";
        });
    }
});

// Ensure the sidebar is properly displayed when loaded
if (sidebar.classList.contains("hide")) {
    allSideDivider.forEach((item) => {
        item.textContent = "-"; // Initially collapsed state
    });

    allDropdown.forEach((item) => {
        const a = item.parentElement.querySelector("a:first-child");
        a.classList.remove("active");
        item.classList.remove("show");
    });
} else {
    allSideDivider.forEach((item) => {
        item.textContent = item.dataset.text;
    });
}

// PROFILE DROPDOWN
const profile = document.querySelector("nav .profile");
const imgProfile = profile.querySelector("img");
const dropdownProfile = profile.querySelector(".profile-link");

imgProfile.addEventListener("click", function () {
    dropdownProfile.classList.toggle("show");
});

// MENU
const allMenu = document.querySelectorAll("main .content-data .head .menu");
allMenu.forEach((item) => {
    const icon = item.querySelector("i");
    const menuLink = item.querySelector(".menu-link");

    icon.addEventListener("click", function () {
        menuLink.classList.toggle("show");
    });
});

window.addEventListener("click", function (e) {
    if (e.target !== imgProfile) {
        if (e.target !== dropdownProfile) {
            if (dropdownProfile.classList.contains("show")) {
                dropdownProfile.classList.remove("show");
            }
        }
    }

    allMenu.forEach((item) => {
        const icon = item.querySelector("i");
        const menuLink = item.querySelector(".menu-link");

        if (e.target !== icon) {
            if (e.target !== menuLink) {
                if (menuLink.classList.contains("show")) {
                    menuLink.classList.remove("show");
                }
            }
        }
    });
});

// PROGRESSBAR
const allProgress = document.querySelectorAll("main .card .progress");

allProgress.forEach((item) => {
    const value = item.dataset.value; // Get the data-value
    item.style.setProperty("--value", `${value}%`); // Append '%' to the value
});

// APEXCHART
var options = {
    series: [44, 55, 13, 43, 22],
    chart: {
        width: 380,
        type: "pie",
    },
    labels: ["Team A", "Team B", "Team C", "Team D", "Team E"],
    responsive: [
        {
            breakpoint: 480,
            options: {
                chart: {
                    width: 200,
                },
                legend: {
                    position: "bottom",
                },
            },
        },
    ],
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();
