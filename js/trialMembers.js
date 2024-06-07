import {} from './dashboard.js';

function hideSideBar(){
    const cross=document.querySelector('.cross');
    const sidebar=document.querySelector('.sidebar');
    console.log(cross);
    cross.addEventListener('click',()=>{
        sidebar.classList.remove('translate-x-[0%]');
        sidebar.classList.add('translate-x-[-100%]');
    })
}
hideSideBar();
function displaySideBar(){
    const toggleButton=document.querySelector('.toggleButton');
    const sidebar=document.querySelector('.sidebar');
    toggleButton.addEventListener('click',()=>{
        sidebar.classList.remove('translate-x-[-100%]');
        sidebar.classList.add('translate-x-[0%]');
    })
}
displaySideBar();
