var projectList = document.getElementById('listaProgetti');
var openProjectList = document.getElementById('openProjectList');
var opened = true;

function apriMenu() {
    if(opened){
        projectList.classList.remove('hidden');
        openProjectList.classList.add("fa-arrow-up");
        openProjectList.classList.remove("fa-arrow-down");
        opened = !opened;
    } else {
        projectList.classList.add('hidden');
        openProjectList.classList.add("fa-arrow-down");
        openProjectList.classList.remove("fa-arrow-up");
        opened = !opened;
    }
}