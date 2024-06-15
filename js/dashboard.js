
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

    let endPeriod=new Date(endDate.textContent).getTime();
    // to get the exact date timeNow-getHoursFromMidnight()-+oneHour
    let startPeriod=new Date().getTime()-oneDay;
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
            const bottom=parent.querySelector('.bottom');
            bottom.classList.remove('bg-green-dark');
            bottom.classList.add('bg-red-light');
            const timer=parent.querySelector('.timer');
            console.log(timer);
            timer.classList.add('text-red');
            // const confirm=parent.querySelector('.confirm');
            // confirm.classList.remove('hidden');
            // confirm.classList.add('block');
        }
        },1000)
    })
}
countdown();

function confirm(){
    const confirms=document.querySelectorAll('.confirm');
    confirms.forEach(confirm=>{
        confirm.addEventListener('click',(e)=>{
            let link=e.currentTarget.nextElementSibling.getAttribute('href');
            link=link.split("?");
            link[0]="./confirm.php?";
            const yes=document.querySelector('.yes');
            yes.setAttribute('href',link.join(""));
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
