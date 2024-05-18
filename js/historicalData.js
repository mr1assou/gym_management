
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