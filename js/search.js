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


gsap.registerPlugin(ScrollTrigger);
gsap.to('.row',{
    opacity:1,
    duration:3,
    ScrollTrigger:".row"
})



function checkSearchField(){
    const parent=document.querySelector('.parent');
    if(parent===null){
        const content=document.querySelector('.content');
        content.innerHTML=`<div class="text-1xl text-center text-grey font-bold">There is no client with this name</div>`;
    }
}
checkSearchField();

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




const roles=document.querySelectorAll('.role');
const priceField=document.querySelector('.price-field');
roles.forEach(role=>{
    role.addEventListener('click',()=>{
        if(role.value==="monthly" && language.textContent==="ar")
            priceField.innerHTML=`<div class="relative h-11 w-full min-w-[200px] mt-5"><input   name="price" type="number" min="0"  required value="<?php ?>"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" value="<?php echo $price?>"/>
                    <label
                        class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                :الواجب الشهري للمتدرب
                </label></div>`;
            else if(role.value==="monthly" && language.textContent==="en")
            priceField.innerHTML=`<div class="relative h-11 w-full min-w-[200px] mt-5"><input   name="price" type="number" min="0"  required value="<?php ?>"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" value="<?php echo $price?>"/><label
                        class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Price client per month:
                </label></div>`
        if(role.value==="yearly" && language.textContent==="ar")
            priceField.innerHTML=`<div class="relative h-11 w-full min-w-[200px] mt-5"><input   name="price" type="number" min="0"  required value="<?php ?>"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" value="<?php echo $price?>"/>
                    <label
                        class="justify-end pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                :الواجب السنوي للمتدرب
                </label></div>`;
            else if(role.value==="yearly" && language.textContent==="en")
            priceField.innerHTML=`<div class="relative h-11 w-full min-w-[200px] mt-5"><input   name="price" type="number" min="0"  required value="<?php ?>"
                    class="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50" value="<?php echo $price?>"/><label
                        class=" pointer-events-none absolute left-0  -top-2.5 flex h-full w-full select-none !overflow-visible truncate text-sm font-normal leading-tight text-gray-500 transition-all after:absolute after:-bottom-2.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-gray-500 after:transition-transform after:duration-300 peer-placeholder-shown:leading-tight peer-placeholder-shown:text-blue-gray-500 peer-focus:text-sm peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:after:scale-x-100 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                Price client per year:
                </label></div>`
    })
})





