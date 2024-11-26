//sort by a filter
function sortBy(sort)
{
    //log what we are sorting by
    console.log(sort);

    //set the value of the input element used to pass the sort type to the next page 
    document.getElementById("txt_scores_sort").setAttribute("value",sort);

    //save the sort item in session storage
    sessionStorage.setItem("sort",sort);

    //submit the sort type by clicking the hidden submit button
    document.getElementById("btn_scores_sortBy").click();
}

//if we are sorting by user
function sortByUser(user)
{
    //for testing, log what user's scores are being grabbed
    console.log(user);

    //set the value of the sort type to the name of the user
    document.getElementById("txt_scores_sort").setAttribute("value",document.getElementById("btn_scores_user"+user).innerText);

    //save the username in storage
    sessionStorage.setItem("sort",document.getElementById("btn_scores_user"+user).innerText);

    //submit the username to the new page
    document.getElementById("btn_scores_sortBy").click();
}

//used to pass the page we want to go to
function setPage(page)
{
    //
    document.getElementById("txt_scores_sort").setAttribute("value",sessionStorage.getItem("sort"));

    document.getElementById("txt_scores_page").setAttribute("value",page);

    document.getElementById("btn_scores_sortBy").click();
}