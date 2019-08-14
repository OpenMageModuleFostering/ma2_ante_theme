function desc_showfull()
{
    document.getElementById("full_desc").style.display = "block";
    document.getElementById("box-view-btn-less").style.display = "block";
    document.getElementById("box-view-btn-show").style.display = "none";
    document.getElementById("short_desc").style.display = "none";
        
}
function desc_hidefull()
{
    document.getElementById("full_desc").style.display = "none";
    document.getElementById("box-view-btn-show").style.display = "block";
    document.getElementById("box-view-btn-less").style.display = "none";
    document.getElementById("short_desc").style.display = "block";
}

	