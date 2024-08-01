// This is for able to see chart. We are using Apex Chart. U can check the documentation of Apex Charts too..
var options = {
    series: [
        {
            name: "Net Profit",
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
        },
        {
            name: "Revenue",
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
        },
        {
            name: "Free Cash Flow",
            data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
        },
    ],
    chart: {
        type: "bar",
        height: 250, // make this 250
        sparkline: {
            enabled: true, // make this true
        },
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "55%",
            endingShape: "rounded",
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
    },
    xaxis: {
        categories: [
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
        ],
    },
    yaxis: {
        title: {
            text: "$ (thousands)",
        },
    },
    fill: {
        opacity: 1,
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return "$ " + val + " thousands";
            },
        },
    },
};

var chart = new ApexCharts(document.querySelector("#apex1"), options);
chart.render();

// Sidebar Toggle Codes;

var sidebarOpen = false;
var sidebar = document.getElementById("sidebar");
var sidebarCloseIcon = document.getElementById("sidebarIcon");

function toggleSidebar() {
    if (!sidebarOpen) {
        sidebar.classList.add("sidebar_responsive");
        sidebarOpen = true;
    }
}

function closeSidebar() {
    if (sidebarOpen) {
        sidebar.classList.remove("sidebar_responsive");
        sidebarOpen = false;
    }
}

// Récupérer le chemin d'accès de la page actuelle
const currentPath = window.location.pathname;

// Récupérer tous les liens de la barre de navigation latérale
const sidebarLinks = document.querySelectorAll(".sidebar__link a");

// Parcourir les liens et vérifier s'ils correspondent à la page actuelle
sidebarLinks.forEach((link) => {
    // Récupérer le chemin d'accès du lien
    const linkPath = link.getAttribute("href");

    // Vérifier si le chemin d'accès du lien correspond exactement à la page actuelle
    if (currentPath === linkPath) {
        // Ajouter la classe "active_menu_link" au lien correspondant à la page actuelle
        link.parentNode.classList.add("active_menu_link");
    } else {
        // Retirer la classe "active_menu_link" des liens qui ne correspondent pas à la page actuelle
        link.parentNode.classList.remove("active_menu_link");
    }
});
