import {} from './add_client.js';
export function clickLinksSideBar(){
    const links=document.querySelectorAll('.link-page');
    links.forEach((link)=>{
    link.addEventListener('click',(e)=>{
            const sibling=e.currentTarget.children[1];
            sibling.click();
        })
    })
}
clickLinksSideBar();

export default function countdown(){
    const parents=document.querySelectorAll('.parent');
    parents.forEach(parent=>{
    const endDate=parent.querySelector('.end-date');
    const days=parent.querySelector('.days');
    const hours=parent.querySelector('.hrs');
    const minutes=parent.querySelector('.minutes');
    const secondes=parent.querySelector('.secondes');
        
    const oneDay=24*60*60*1000
    const oneHour=60*60*1000;
    const oneMinute=60*1000;
    const oneSecond=1000;
    let endPeriod=new Date(endDate.textContent.split("-").reverse().join("-")).getTime();
    let startPeriod=new Date().getTime()-oneDay+oneHour;
    let count=0;
    let intervalId=setInterval(()=>{
    let t=endPeriod-startPeriod;
    let restDays=Math.floor(t/oneDay);
    let restHours=Math.floor((t%oneDay)/oneHour);
    let restMinutes=Math.floor((t%oneHour)/oneMinute);
    let restSecondes=Math.floor((t%oneMinute)/oneSecond);
    days.textContent=restDays;
    hours.textContent=restHours;
    minutes.textContent=restMinutes;
    secondes.textContent=restSecondes;
    startPeriod+=1000;
        if(t<=0){
            days.textContent = 0;
            hours.textContent = 0;
            minutes.textContent = 0;
            secondes.textContent = 0;
            const bottom=parent.querySelector('.bottom');
            bottom.classList.remove('bg-green-dark');
            bottom.classList.add('bg-red-light');
            const timer=parent.querySelector('.timer');
            timer.classList.add('text-red');
            const confirm=parent.querySelector('.confirm');
            confirm.classList.remove('hidden');
            confirm.classList.add('block');
            clearInterval(intervalId);
        }
        },1000)
    })
}
countdown();

function confirm(){
    const confirms=document.querySelectorAll('.confirm');
    confirms.forEach(confirm=>{
        confirm.addEventListener('click',(e)=>{
            const parentElement=e.currentTarget.parentElement.parentElement.parentElement;
            console.log(parentElement);
            const fullName=parentElement.querySelector('.full-name');
            const name=document.querySelector('.name');
            name.textContent=fullName.textContent;
            const beginningDate=parentElement.querySelector('.beginning-date');
            const start=document.querySelector('.start');
            start.textContent=beginningDate.textContent;
            const endDate=parentElement.querySelector('.end-date');
            const end=document.querySelector('.end');
            end.textContent=endDate.textContent;
            let link=e.currentTarget.nextElementSibling.getAttribute('href');
            const clientId=link.split("?")[1].split("&")[0].split("=")[1];
            const clientIdField=document.querySelector('.client-id');
            clientIdField.value=clientId;
            const popUP=document.querySelector('.pop-up');
            popUP.classList.remove('hidden');
            popUP.classList.add('block');
        })
    })
}
confirm();
function deletePopUp(){
    const no=document.querySelector('.no');
    no.addEventListener('click',()=>{
        const popUP=document.querySelector('.pop-up');
        popUP.classList.remove('block');
        popUP.classList.add('hidden');              
    })
}
deletePopUp();

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
let dashboard=document.querySelector('.dashboard');
let titleText=title.textContent.replace(/\s/g, "");
let dashboardText=dashboard.textContent.replace(/\s/g, "");
if(dashboardText===titleText){
    dashboard.classList.add('bg-white');
    dashboard.style.color='#74f814';
    dashboard.classList.remove('hover:bg-white');
    dashboard.classList.remove('hover:text-green');
}




gsap.registerPlugin(ScrollTrigger);
gsap.to('.row',{
    opacity:1,
    duration:3,
    ScrollTrigger:".row"
})







