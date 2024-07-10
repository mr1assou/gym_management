function countdown(){
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
            timer.classList.add('text-red');
            const confirm=parent.querySelector('.confirm');
            confirm.classList.remove('hidden');
            confirm.classList.add('block');
        }
        },1000)
    })
}
countdown();



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



let titleActive=document.querySelector('.active');
let active_member=document.querySelector('.active_member');
let titleActiveText=titleActive.textContent.replace(/\s/g, "");
let active_memberText=active_member.textContent.replace(/\s/g, "");
if(active_memberText===titleActiveText){
    active_member.classList.add('bg-white');
    active_member.style.color='#74f814';
    active_member.classList.remove('hover:bg-white');
    active_member.classList.remove('hover:text-green');
}
