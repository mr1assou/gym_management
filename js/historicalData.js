
function displayNumberOfNewClients(){
    const newClients=document.querySelectorAll('.new-clients');
    let len=newClients.length;
    const numberOfClients=document.querySelector('.number-clients');
    if(numberOfClients!=null)
        numberOfClients.textContent=len;
    else
        numberOfClients.textContent=0;
}
displayNumberOfNewClients();

function displayEarningOfThisMonth(){
    const amounts=document.querySelectorAll('.amount');
    if(amounts!=null){
        const earning=document.querySelector('.earning');
        let sum=0;
        amounts.forEach(amount=>{
            sum+=parseInt(amount.textContent);
        })
        earning.textContent=sum;
    }
}
displayEarningOfThisMonth();

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

function selectDates(){
    const selectElement=document.querySelector('.select');
    selectElement.addEventListener('change',e=>{
        const option=e.target.selectedOptions[0];
        const value=option.value;
        window.location.href =value;
    })
}
selectDates();


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
