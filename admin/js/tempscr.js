const selectColumn = document.getElementById('select-column');
const dataTable = document.getElementById('data-table');

selectColumn.addEventListener('change', function() {
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
