
function clickLinksSideBar(){
    const links=document.querySelectorAll('.link-page');
    links.forEach((link)=>{
    link.addEventListener('click',(e)=>{
            const sibling=e.currentTarget.children[1];
            sibling.click();
        })
    })
}
clickLinksSideBar();
function statusColor(){
    const status=document.querySelectorAll('.status');
    status.forEach(item=>{
        if(item.textContent=='trial') item.classList.add('text-blue');
        else if(item.textContent=='access') item.classList.add('text-green-dark');
        else if(item.textContent=='reject') item.classList.add('text-red');
    })
}
statusColor();
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
            parent.classList.add('text-red');
        }
        },1000)
    })
}
countdown();


