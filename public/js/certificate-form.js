async function searchPrograms() {
    const searchInput = document.getElementById('programSearch').value;
    const resultsDiv = document.getElementById('programSearchResults');
    //console.log(searchInput);
    try {
        const response = await fetch(`http://localhost/system/public/search-programs?search=${searchInput}`);
        const searchResults = await response.json();
        //console.log("Resultado");
        //console.log(searchResults);
        resultsDiv.innerHTML = '';

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
    console.log(program);
    document.getElementById('programSearch').value = program.name;
    document.getElementById('selectedProgramId').value = program.id;
    document.getElementById('programSearchResults').innerHTML = '';
}

async function searchStudents() {
    const searchInput = document.getElementById('studentSearch').value;
    const resultsDiv = document.getElementById('studentSearchResults');
    //console.log(searchInput);
    try {
        const response = await fetch(`http://localhost/system/public/search-students?search=${searchInput}`);
        const searchResults = await response.json();
        console.log("Resultado");
        console.log(searchResults);
        resultsDiv.innerHTML = '';

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

const searchInputId = document.getElementById('selectedProgramId').value;
//console.log(searchInputId);
searchProgramsId(searchInputId);
async function searchProgramsId(searchInputId) {

    try {
        const response = await fetch(`http://localhost/system/public/search-programs-id?search=${searchInputId}`);
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

const searchInputStudentId = document.getElementById('selectedStudentId').value;
//console.log(searchInputStudentId);
searchStudentId(searchInputStudentId);
async function searchStudentId(searchInputStudentId) {

    try {
        const response = await fetch(`http://localhost/system/public/search-students-id?search=${searchInputStudentId}`);
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
