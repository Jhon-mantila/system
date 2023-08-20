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
    document.getElementById('studentSearch').value = student.first_name;
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
