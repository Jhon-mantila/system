  const contentSection = document.getElementById('content-section');
  const previousButton = document.getElementById('previous-button');
  const nextButton = document.getElementById('next-button');
  const id_studiante = document.getElementById('id_studiante').value;
  //console.log(id_studiante);
  let currentPage = 1;
  let totalPageCount = 0;
  console.log("URLR");
  let url = window.location.origin;
  //console.log(window.location.origin);
async function loadContent(pageNumber, searchById) {
    try {
      const response = await fetch(`${url}/system/public/api/students-api?page=${pageNumber}&searchById=${searchById}`);

      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const data = await response.json();
      //console.log("------------PROGRAMAS------------");
      //console.log(data);
      // Limpia el contenido anterior
      contentSection.innerHTML = '';
      
      // Llena contentSection con los datos de los estudiantes y certificados
      data.data.forEach(student => {
        const studentDiv = document.createElement('tr');
        let tipo_certificado;
        if(student.type_certificate == "c"){
          tipo_certificado = "Certificado";
        }else{
          tipo_certificado = "Certificado Matricula";
        }
        //studentDiv.innerHTML = `${student.program.name} - ${student.student.first_name}`;

        studentDiv.innerHTML = `<td><p class='p-1'>${student.program.name}</p></td>
                                <td><p class='p-1'>${tipo_certificado}</p></td>
                                `;
        contentSection.appendChild(studentDiv);
      });

      //console.log(data);
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
    //console.log("anterior:" + currentPage);
    loadContent(currentPage, id_studiante);
  }
});

nextButton.addEventListener('click', (event) => {
    event.preventDefault();
    if (currentPage < totalPageCount) {
    currentPage++;
    //console.log("siguiente:" + currentPage);
    loadContent(currentPage, id_studiante);
  }
});

loadContent(currentPage, id_studiante); // Carga la primera página al cargar la página inicialmente

// ---------------------------- Certificados cursos ----------------------------------------

const contentSectionCourse = document.getElementById('content-section-course');
const previousButtonCourse = document.getElementById('previous-button-course');
const nextButtonCourse = document.getElementById('next-button-course');


let currentPageCourse = 1;
let totalPageCountCourse = 0;

async function loadContentCourse(pageNumber, searchById) {
  try {
    const response = await fetch(`${url}/system/public/api/students-api-courses?page=${pageNumber}&searchById=${searchById}`);

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    //console.log("------------CURSOS-----------");
    //console.log(data);
    // Limpia el contenido anterior
    contentSectionCourse.innerHTML = '';
    
    // Llena contentSection con los datos de los estudiantes y certificados
    data.data.forEach(student => {
      const studentDiv = document.createElement('tr');
      let tipo_certificado;
      if(student.type_certificate == "c"){
        tipo_certificado = "Certificado";
      }else{
        tipo_certificado = "Certificado Matricula";
      }
      //studentDiv.innerHTML = `${student.program.name} - ${student.student.first_name}`;

      studentDiv.innerHTML = `<td><p class='p-1'>${student.course.name}</p></td>
                              <td><p class='p-1'>${tipo_certificado}</p></td>
                              `;
      contentSectionCourse.appendChild(studentDiv);
    });

    //console.log(data);
    const paginationDiv = document.getElementById('pagination-course');
    paginationDiv.innerHTML = `Página: ${data.current_page} de ${data.last_page}`;

    // Actualiza la paginación
    currentPageCourse = data.current_page;
    totalPageCountCourse = data.last_page; // Actualiza totalPageCount
    previousButtonCourse.disabled = currentPageCourse === 1;
    nextButtonCourse.disabled = currentPageCourse === totalPageCountCourse;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
}

previousButtonCourse.addEventListener('click', (event) => {
  if (currentPageCourse > 1) {
    event.preventDefault();
    currentPageCourse--;
    console.log("anterior Curso:" + currentPageCourse);
    loadContentCourse(currentPageCourse, id_studiante);
  }
});

nextButtonCourse.addEventListener('click', (event) => {
  event.preventDefault();
  if (currentPageCourse < totalPageCountCourse) {
  currentPageCourse++;
  console.log("siguiente curso:" + currentPageCourse);
  loadContentCourse(currentPageCourse, id_studiante);
}
});

loadContentCourse(currentPageCourse, id_studiante); // Carga la primera página al cargar la página inicialmente