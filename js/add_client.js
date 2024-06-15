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
const months=["january","February","March","April","May","June","July","August","September","October","November","December"];
let day="";
const renderCalendar=(currYear,currMonth,days,currentDate)=>{
    // get last date of months
    let lastDateofMonth=new Date(currYear,currMonth+1,0).getDate();
    for(let i=1;i<=lastDateofMonth;i++){
            day+=`<p class="px-4 py-2 font-black w-[12px] text-center bg-white  flex items-center justify-center rounded-full hover:bg-green hover:text-white cursor-pointer  text-green text-xs day">${i}</p>`
        }
    days.innerHTML=day;
    // appear the current date
    currentDate.textContent=`${months[currMonth]} ${currYear}`;
    day="";
}
renderCalendar(currYear,currMonth,days,currentDate);
clickDays(document.querySelectorAll('.day'),"",document.querySelector('.output-date'));
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
    const outputDate=document.querySelector('.output-date');
    clickDays(selectDays,"",outputDate);
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
    const outputDate=document.querySelector('.output-date');
    clickDays(selectDays,"",outputDate);
})

function clickDays(selectDays, inputDate, outputDate) {
    selectDays.forEach(day => {
      day.addEventListener('click', () => {
        //inputDate.value = `${currYear}-${currMonth + 1}-${day.textContent}`;
        outputDate.textContent = `${currYear}-${currMonth + 1}-${day.textContent}`;
        calendar.classList.remove('block');
        calendar.classList.add('hidden');
      });
    });
}
