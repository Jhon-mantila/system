import Chart from 'chart.js/auto';

const yearSelect = document.getElementById('year-id');
const chartCanvas = document.getElementById('myChart');
let chart = null;

function cargarGrafico(year){

  //console.log("año:"+year);
    fetch(window.location.origin+"/system/public/api/quantity-certificates?search=" + year)
    .then(response => response.json())
    .then (data =>{
      //console.log(data);
          // Actualiza el gráfico con los nuevos datos
          if (chart) {
              chart.destroy(); // Destruye el gráfico existente si hay uno
          }

          let cantidad = data["cantidad"];
          
          //console.log("cantidad"+cantidad);
          const info = {
              labels: data["mes"],
              datasets: [{
                  label: year,
                  data: cantidad,
                  backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                  ],
                  borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                  ],
                  borderWidth: 1   
              }]
          };

          const config = {
            type: 'bar',
            data: info,
            options: {}
          };

          chart = new Chart(
            chartCanvas,
            config
          );
    })
    .catch(error => {
          console.error('Error al cargar datos:', error);
    });

}
//console.log(yearSelect);
//control cuando cambia de pestaña y es null el objeto de yearSelct
if(yearSelect != null){

// Manejar cambios en la selección del año
  yearSelect.addEventListener('change', () => {
      const selectedYear = yearSelect.value;
      cargarGrafico(selectedYear);
  });

  // Inicialmente, carga el gráfico con el año seleccionado por defecto
  const initialYear = yearSelect.value;

  cargarGrafico(initialYear);

}
