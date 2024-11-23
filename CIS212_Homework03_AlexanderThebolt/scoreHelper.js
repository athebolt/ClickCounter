function sortBy(sort)
{
    console.log(sort);

    document.getElementById("txt_scores_sort").setAttribute("value",sort);

    document.getElementById("btn_scores_sortBy").click();
}

function sortByUser(user)
{
    console.log(user);

    document.getElementById("txt_scores_sort").setAttribute("value",document.getElementById("btn_scores_user"+user).innerText);

    document.getElementById("btn_scores_sortBy").click();
}