


const status=document.querySelectorAll('.status');
status.forEach(element=> {
    if(element.textContent=="access" || element.textContent=="trial" || element.textContent=="inactive")
        element.classList.add('text-green-dark');
    else
        element.classList.add('text-red');
});