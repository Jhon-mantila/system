async function searchPrograms() {
    const searchInput = document.getElementById('programSearch').value;
    const resultsDiv = document.getElementById('programSearchResults');
    const idPrograms = document.getElementById('selectedProgramId').value;
    console.log(searchInput);
    try {
        const response = await fetch(`${window.location.origin}/system/public/api/search-programs?search=${searchInput}`);
        const searchResults = await response.json();
        console.log("Resultado");
        console.log(searchResults);
        resultsDiv.innerHTML = '';
        
        if(searchInput.trim().length != 0 && idPrograms.trim().length == 0){
            searchResults.forEach(result => {
                    selectProgram(result);
            });
        }

        searchResults.forEach(result => {
            const resultItem = document.createElement('div');
            resultItem.textContent = result.name;
            resultItem.classList.add('search-result');
            resultItem.addEventListener('click', () => selectProgram(result));
            resultsDiv.appendChild(resultItem);
        });
    } catch (error) {
        console.error(error);
    }
}

function selectProgram(program) {
    //console.log(program);
    document.getElementById('programSearch').value = program.name;
    document.getElementById('selectedProgramId').value = program.id;
    document.getElementById('programSearchResults').innerHTML = '';
}

async function searchCourse() {
    const searchInput = document.getElementById('courseSearch').value;
    const resultsDiv = document.getElementById('courseSearchResults');
    const idPrograms = document.getElementById('selectedCourseId').value;
    console.log(searchInput);
    try {
        const response = await fetch(`${window.location.origin}/system/public/api/search-courses?search=${searchInput}`);
        const searchResults = await response.json();
        console.log(searchResults);
        resultsDiv.innerHTML = '';
        
        if(searchInput.trim().length != 0 && idPrograms.trim().length == 0){
            searchResults.forEach(result => {
                selectCourse(result);
            });
        }

        searchResults.forEach(result => {
            const resultItem = document.createElement('div');
            resultItem.textContent = result.name;
            resultItem.classList.add('search-result');
            resultItem.addEventListener('click', () => selectCourse(result));
            resultsDiv.appendChild(resultItem);
        });
    } catch (error) {
        console.error(error);
    }
}

function selectCourse(course) {
    //console.log(course);
    document.getElementById('courseSearch').value = course.name;
    document.getElementById('selectedCourseId').value = course.id;
    document.getElementById('courseSearchResults').innerHTML = '';
}

async function searchStudents() {
    const searchInput = document.getElementById('studentSearch').value;
    const resultsDiv = document.getElementById('studentSearchResults');
    const idStudents = document.getElementById('selectedStudentId').value;
    console.log(searchInput);
    try {
        const response = await fetch(`${window.location.origin}/system/public/api/search-students?search=${searchInput}`);
        const searchResults = await response.json();
        console.log("Resultado");
        console.log(searchResults);
        resultsDiv.innerHTML = '';

        if(searchInput.trim().length != 0 && idStudents.trim().length == 0){
            searchResults.forEach(result => {
                    selectStudent(result);
            });
        }

        searchResults.forEach(result => {
            const resultItem = document.createElement('div');
            resultItem.textContent = result.first_name + " " + result.second_name + " " + result.last_name + " " + result.second_last_name;
            resultItem.classList.add('search-result');
            resultItem.addEventListener('click', () => selectStudent(result));
            resultsDiv.appendChild(resultItem);
        });
    } catch (error) {
        console.error(error);
    }
}

function selectStudent(student) {
    console.log(student);
    document.getElementById('studentSearch').value = student.first_name + " " + student.second_name + " " + student.last_name + " " + student.second_last_name;
    document.getElementById('selectedStudentId').value = student.id;
    document.getElementById('studentSearchResults').innerHTML = '';
}

async function searchEmployees() {
    const searchInput = document.getElementById('employeeSearch').value;
    const resultsDiv = document.getElementById('employeeSearchResults');
    const idEmployee = document.getElementById('selectedEmployeeId').value
    //console.log(searchInput);
    try {
        const response = await fetch(`${window.location.origin}/system/public/api/search-employees?search=${searchInput}`);
        const searchResults = await response.json();
        console.log("Resultado");
        console.log(searchResults);
        resultsDiv.innerHTML = '';

        if(searchInput.trim().length != 0 && idEmployee.trim().length == 0){
            searchResults.forEach(result => {
                    selectEmployee(result);
            });
        }

        searchResults.forEach(result => {
            const resultItem = document.createElement('div');
            resultItem.textContent = result.first_name + " " + result.second_name + " " + result.last_name + " " + result.second_last_name;
            resultItem.classList.add('search-result');
            resultItem.addEventListener('click', () => selectEmployee(result));
            resultsDiv.appendChild(resultItem);
        });
    } catch (error) {
        console.error(error);
    }
}

function selectEmployee(employee) {
    console.log(employee);
    document.getElementById('employeeSearch').value = employee.first_name + " " + employee.second_name + " " + employee.last_name + " " + employee.second_last_name;
    document.getElementById('selectedEmployeeId').value = employee.id;
    document.getElementById('employeeSearchResults').innerHTML = '';
}

//const searchInputId = document.getElementById('selectedProgramId').value;

const searchInputIdValue = document.getElementById('selectedProgramId');
let searchInputId;
if(searchInputIdValue !== null){
    searchInputId = searchInputIdValue.value;
    //console.log(searchInputId);
    searchProgramsId(searchInputId);
}else{
    console.log("----Programa id vacio no existe----");
}

async function searchProgramsId(searchInputId) {

    try {
        const response = await fetch(`${window.location.origin}/system/public/api/search-programs-id?search=${searchInputId}`);
        const searchResults = await response.json();
        //console.log("Resultado");
        //console.log(searchResults[0].name);

        if(searchInputId.trim().length != 0){
            document.getElementById('programSearch').value = searchResults[0].name;
        }

    } catch (error) {
        console.error(error);
    }
}

const searchInputCourseIdValue = document.getElementById('selectedCourseId');
let searchInputCourseId;
if(searchInputCourseIdValue !== null){
    searchInputCourseId = searchInputCourseIdValue.value;//'530f9fe2-aa5b-4f60-9e5f-63eba5ef8b6c';
    //console.log(searchInputCourseId);
    searchCoursesId(searchInputCourseId);
}else{
    console.log("----Curso id vacio no existe----");
}

async function searchCoursesId(searchInputCourseId) {

    try {
        const response = await fetch(`${window.location.origin}/system/public/api/search-courses-id?search=${searchInputCourseId}`);
        const searchResults = await response.json();
        //console.log("Resultado");
        //console.log(searchResults[0].name);

        if(searchInputCourseId.trim().length != 0){
            document.getElementById('courseSearch').value = searchResults[0].name;
        }

    } catch (error) {
        console.error(error);
    }
}

const searchInputStudentId = document.getElementById('selectedStudentId').value;
//console.log(searchInputStudentId);
searchStudentId(searchInputStudentId);
async function searchStudentId(searchInputStudentId) {

    try {
        const response = await fetch(`${window.location.origin}/system/public/api/search-students-id?search=${searchInputStudentId}`);
        const searchResults = await response.json();
        //console.log("Resultado");
        //console.log(searchResults[0].first_name);

        if(searchInputStudentId.trim().length != 0){
            document.getElementById('studentSearch').value = searchResults[0].first_name + " " +searchResults[0].second_name + " " + searchResults[0].last_name + " " + searchResults[0].second_last_name;
        }

    } catch (error) {
        console.error(error);
    }
}

const searchInputEmployeeId = document.getElementById('selectedEmployeeId').value;
//console.log(searchInputEmployeeId);
searchEmployeeId(searchInputEmployeeId);
async function searchEmployeeId(searchInputEmployeeId) {

    try {
        const response = await fetch(`${window.location.origin}/system/public/api/search-employees-id?search=${searchInputEmployeeId}`);
        const searchResults = await response.json();
        //console.log("Resultado");
        //console.log(searchResults);
        //console.log(searchResults[0].first_name);

        if(searchInputEmployeeId.trim().length != 0){
            document.getElementById('employeeSearch').value = searchResults[0].first_name + " " +searchResults[0].second_name + " " + searchResults[0].last_name + " " + searchResults[0].second_last_name;
        }

    } catch (error) {
        console.error(error);
    }
}
