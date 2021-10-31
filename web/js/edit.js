
function addField (data) {
    let telnum = parseInt($("#dep_container").find("div.row:last").find("#each_dep:last").attr("name").slice(3))
    telnum++;
    $("#dep_container").append('<div class="row"><div class = "col-5 ml-3 mt-4" id="dep_select"><div class="form-group field-each_dep">' +
        '<select class="form-control" id="each_dep" name="dep'+telnum+'">' +
        '</select></div></div><div class="col-2 mt-4"><button onclick="delete_row(this)" type="button" id="subtract" class="btn btn-danger">-</button></div></div>')
    // $("div#add_field_area").append('<div id="add" telnum "" class="add"><select type="text" width="120" name="val[]" id="val"  value=""/></div>');
    $.each(data,function (index,value){$("select[name=dep"+telnum+"]").append('<option value='+index+'>'+value+'</option>')})

}
function delete_row(elem){
    if($(elem).parent().parent().parent().children().length !== 1)
    {
        $(elem).parent().parent().remove()
    }

}
$("#new").on("click",function(){
    $.ajax({
        url: "/admin-emp/get-deps",
        type: "get",
        success: function(data){
            data = JSON.parse(data);
                addField(data)
            },
        error: function () {
            console.log("no")
        }
    });
})

$("#w0").submit(function(){
    let children=$('#dep_container select');
    let Deps = '';
    children.each(function(){
        Deps += $(this).val() + '|';
    });
    $("#dep_name").val(Deps)
})