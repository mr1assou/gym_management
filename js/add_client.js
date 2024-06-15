import countdown from './dashboard.js';
countdown();
clickLinksSideBar();
statusColor();


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
let grapYear=currYear;
let currMonth=date.getMonth();
let grapMonth=currMonth;
let currDay=date.getDate();
// months
const months=["january","February","March","April","May","June","July","August","September","October","November","December"];
let day="";
const renderCalendar=(currYear,currMonth,currDay,grapYear,days,customClass,currentDate)=>{
    // get last date of months
    let lastDateofMonth=new Date(currYear,currMonth+1,0).getDate();
    for(let i=1;i<=lastDateofMonth;i++){
            day+=`<p class=" font-black w-[3rem] text-center bg-white  flex items-center justify-center rounded-full hover:bg-orange hover:text-white cursor-pointer py-3 text-green text-sm">1</p>`
        }
    days.innerHTML=day;
    // appear the current date
    currentDate.textContent=`${months[currMonth]} ${currYear}`;
    day="";
}
renderCalendar(currYear,currMonth,currDay,grapYear,days,'day',currentDate);
