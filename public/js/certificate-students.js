

  const contentSection = document.getElementById('content-section');
  const previousButton = document.getElementById('previous-button');
  const nextButton = document.getElementById('next-button');
  const id_studiante = document.getElementById('id_studiante').value;
  console.log(id_studiante);
  let currentPage = 1;
  let totalPageCount = 0;

async function loadContent(pageNumber, searchById) {
    try {
      const response = await fetch(`http://localhost/system/public/api/students-api?page=${pageNumber}&searchById=${searchById}`);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const data = await response.json();
      
      // Limpia el contenido anterior
      contentSection.innerHTML = '';

      // Llena contentSection con los datos de los estudiantes y certificados
      data.data.forEach(student => {
        const studentDiv = document.createElement('div');
        studentDiv.textContent = `${student.program.name} - ${student.student.first_name}`;
        contentSection.appendChild(studentDiv);
      });

      console.log(data);
      const paginationDiv = document.getElementById('pagination');
      paginationDiv.innerHTML = `Página: ${data.current_page} de ${data.last_page}`;

      // Actualiza la paginación
      currentPage = data.current_page;
      totalPageCount = data.last_page; // Actualiza totalPageCount
      previousButton.disabled = currentPage === 1;
      nextButton.disabled = currentPage === totalPageCount;
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }

previousButton.addEventListener('click', (event) => {
  if (currentPage > 1) {
    event.preventDefault();
    currentPage--;
    console.log("anterior:" + currentPage);
    loadContent(currentPage, id_studiante);
  }
});

nextButton.addEventListener('click', (event) => {
    event.preventDefault();
    if (currentPage < totalPageCount) {
    currentPage++;
    console.log("siguiente:" + currentPage);
    loadContent(currentPage, id_studiante);
  }
});

loadContent(currentPage, id_studiante); // Carga la primera página al cargar la página inicialmente

  