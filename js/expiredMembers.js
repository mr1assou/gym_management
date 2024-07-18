import countdown from './dashboard.js';
countdown();



function hideSideBar(){
    const cross=document.querySelector('.cross');
    const sidebar=document.querySelector('.sidebar');
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

let title=document.querySelector('.title');
let expired_members=document.querySelector('.expired_members');
let titleText=title.textContent.replace(/\s/g, "");
let historicalDataText=expired_members.textContent.replace(/\s/g, "");
if(historicalDataText===titleText){
    expired_members.classList.add('bg-white');
    expired_members.style.color='#74f814';
    expired_members.classList.remove('hover:bg-white');
    expired_members.classList.remove('hover:text-green');
}

















