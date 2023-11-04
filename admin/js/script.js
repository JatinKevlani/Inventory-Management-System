const charts = document.querySelectorAll(".chart");

charts.forEach(function (chart) {
  var ctx = chart.getContext("2d");
  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
      datasets: [
        {
          label: "# of Votes",
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});

$(document).ready(function () {
  $(".data-table").each(function (_, table) {
    $(table).DataTable();
  });
});

document.addEventListener("DOMContentLoaded", function () {


  const navLinks = document.querySelectorAll(".product-nav,.card-redirect");
  const pages = document.querySelectorAll(".page");

  const card = document.querySelectorAll(".card-link")
  const cardContent = document.querySelectorAll(".card-content")
  
  
  
  function toggleCard(targetCard) {
    cardContent.forEach(function (cardd) {
      cardd.style.display = "none";
    });
    console.log("fsfsf")
    card.forEach(function (cardLink) {
      cardLink.classList.remove("active");
    });
    
    const activeCard = document.querySelector(`[href="#${targetCard}"]`);
    if (activeCard) {
      activeCard.classList.add("active");
    }
    
    document.getElementById(targetCard).style.display = "block";
  }
  
  // Show the home page by default
  // toggleActiveLink("pehlu card ");
  
  card.forEach(function (cardLink) {
    cardLink.addEventListener("click", function (event) {
      event.preventDefault();
      const targetCard = this.getAttribute("href").substring(1);
      console.log("fddddddsfsf")
      toggleCard(targetCard);
    });
  });
  
  // Function to toggle active class
  function toggleActiveLink(targetId) {
    pages.forEach(function (page) {
      page.style.display = "none";
    });
    
    navLinks.forEach(function (link) {
      link.classList.remove("active");
    });
    
    const activeLink = document.querySelector(`[href="#${targetId}"]`);
    if (activeLink) {
      activeLink.classList.add("active");
    }
    
    document.getElementById(targetId).style.display = "block";
  }
  
  // Show the home page by default
  toggleActiveLink("dashboard");
  
  navLinks.forEach(function (link) {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      const targetId = this.getAttribute("href").substring(1);
      toggleActiveLink(targetId);
    });
  });
  
});

const selectColumn = document.getElementById('select-column');
const dataTable = document.getElementById('data-table');

selectColumn.addEventListener('change', function () {
  const selectedValue = selectColumn.value;
  const columnIndex = Array.from(dataTable.querySelector('thead').children[0].children).findIndex(th => th.textContent === selectedValue);

  if (columnIndex !== -1) {
    const rows = dataTable.querySelectorAll('tbody tr');

    rows.forEach(row => {
      const cells = row.querySelectorAll('td');
      cells.forEach((cell, index) => {
        cell.style.display = index === columnIndex ? 'table-cell' : 'none';
      });
    });
  }
});