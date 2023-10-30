import Chart from 'chart.js/auto';
console.log("PRUEBAAAAA")
async function fetchData() {
    
    const apiUrl = "http://localhost/system/public/api/certificates-actives";

    try {
        const response = await fetch(apiUrl);  // Realizar la solicitud a la API
        if (!response.ok) {
          throw new Error('Error al obtener los datos de la API');
        }
    
        const data = await response.json();  // Convertir la respuesta a JSON
        return data;
      } catch (error) {
        console.error('Ocurrió un error:', error);
        return null;
      }
}

// Llamar a la función y manejar los datos obtenidos
(async () => {
    const info = await fetchData();
    if (info) {
      console.log('datos: ', info);
      // Aquí puedes hacer lo que necesites con los datos de la API
       
        const data = {
            labels: ['Activos', 'Inactivos'],
            datasets: [
            {
                label: 'Dataset 1',
                data: info,
                backgroundColor: [
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)'
                  ],
            }
            ]
        };
        
        const config = {
            type: 'doughnut',
            data: data,
            options: {
              responsive: true,
              plugins: {
                legend: {
                  position: 'top',
                },
                title: {
                  display: true,
                  text: 'Certificados Activos - Inactivos'
                }
              }
            },
          };
        
        new Chart(
            document.getElementById('myChartPie'),
            config
        );
    }
  })();