import countdown from './dashboard.js';
countdown();
clickLinksSideBar();



// display calendar
const calendar=document.querySelector('.calendar');
const toggleCalendar=document.querySelector('.toggle-calendar');
toggleCalendar.addEventListener('click',()=>{
    if(calendar.classList.contains('hidden')){
        calendar.classList.remove('hidden');
        calendar.classList.add('block');
    }
    else{
        calendar.classList.remove('block');
        calendar.classList.add('hidden');
    }
})

// logic of calendar
const currentDate=document.querySelector('.current-date');
const days=document.querySelector('.days');
const prev=document.querySelector('.prev');
const next=document.querySelector('.next');
// getting new date,current year and month
let date=new Date();
let currYear=date.getFullYear();
let currMonth=date.getMonth();
let currDay=date.getDate();
// months
const language=document.querySelector('.language');
let months="";
if(language.textContent=="en")
    months=["january","February","March","April","May","June","July","August","September","October","November","December"];
else
    months=["يناير","فبراير","مارس","أبريل","ماي","يونيو","يوليوز","غشت","شتنبر","اكتوبر","نونبر","دجنبر"];
let day="";
const renderCalendar=(currYear,currMonth,days,currentDate)=>{
    // get last date of months
    let lastDateofMonth=new Date(currYear,currMonth+1,0).getDate();
    for(let i=1;i<=lastDateofMonth;i++){
         if((currMonth>date.getMonth() &&  currYear==date.getFullYear()) || currYear>date.getFullYear()){
            day+=`<p class="px-4 py-2 font-black w-[12px] text-center bg-white  flex items-center justify-center rounded-full hover:bg-green hover:text-white cursor-pointer line-through text-xs day text-grey">${i}</p>`;
         }
         else if((currMonth<date.getMonth() && currYear==date.getFullYear()) || (currYear<date.getFullYear())){
            console.log('bbbbb');
            day+=`<p class="px-4 py-2 font-black w-[12px] text-center bg-white  flex items-center justify-center rounded-full hover:bg-green hover:text-white cursor-pointer  text-green text-xs day">${i}</p>`;
         }
         else if(currMonth===date.getMonth() && currYear===date.getFullYear()){
            if(i<=date.getDate())
                day+=`<p class="px-4 py-2 font-black w-[12px] text-center bg-white  flex items-center justify-center rounded-full hover:bg-green hover:text-white cursor-pointer  text-green text-xs day">${i}</p>`;
            else
                day+=`<p class="px-4 py-2 font-black w-[12px] text-center bg-white  flex items-center justify-center rounded-full hover:bg-green hover:text-white cursor-pointer line-through text-xs day text-grey">${i}</p>`;
        }
    }
    days.innerHTML=day;
    // appear the current date
    currentDate.textContent=`${months[currMonth]} ${currYear}`;
    day="";
}
renderCalendar(currYear,currMonth,days,currentDate);
clickDays(document.querySelectorAll('.day'));

prev.addEventListener('click',(e)=>{
    e.preventDefault();
    day="";
    currMonth=currMonth-1;
    if(currMonth===-1){
        currYear-=1;
        currMonth=11;
    }
    renderCalendar(currYear,currMonth,days,currentDate);
    const selectDays=document.querySelectorAll('.day');
    clickDays(selectDays);
})
// next Btn
next.addEventListener('click',(e)=>{
    e.preventDefault()
    day="";
    currMonth=currMonth+1;
    if(currMonth===12){
        currYear+=1;
        currMonth=0;
    }
    renderCalendar(currYear,currMonth,days,currentDate);
    const selectDays=document.querySelectorAll('.day');
    clickDays(selectDays);
})

function clickDays(selectDays) {
    selectDays.forEach(day => {
      day.addEventListener('click', () => {
        if(!day.classList.contains('text-grey')){
            const inputDate=document.querySelector('.input-date');
            if(language.textContent=="en")
                inputDate.value = `${currYear}-${currMonth + 1}-${day.textContent}`;
            else
                inputDate.value = `${day.textContent}-${currMonth + 1}-${currYear}`;
            calendar.classList.remove('block');
            calendar.classList.add('hidden');
        }
        else{
            const message=document.querySelector('.message');
            if(language.textContent=='en')
                message.textContent=`you can't choose this day`;
            else
            message.textContent=`لا يمكنك إختيار هذا التاريخ`;
            setTimeout(()=>{
                message.textContent="";
            },3000)
        }
      });
    });
}
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

let title=document.querySelector('.title');
let add_client=document.querySelector('.add-client');
let titleText=title.textContent.replace(/\s/g, "");
let add_clientText=add_client.textContent.replace(/\s/g, "");
if(add_clientText===titleText){
    add_client.classList.add('bg-white');
    add_client.style.color='#74f814';
    add_client.classList.remove('hover:bg-white');
    add_client.classList.remove('hover:text-green');
}





 