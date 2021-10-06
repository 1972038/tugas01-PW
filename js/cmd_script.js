function deleteGenre(id){
    let confirmation = window.confirm("Are you sure you want to delete?");
    if (confirmation){
        window.location = "?mn=genre&tok=del&did=" + id;
    }  
}
function editGenre(id){
    window.location =  "?mn=genre_update&uid=" +id;
}