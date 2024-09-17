let tasks = [];

$(function(){

    $("document").ready(function(){
       get_all_tasks();
       get_task_count();
    });

    $("#search").keyup(function(){
        let search = $("#search").val();
        if(search == ""){
            get_all_tasks();
        }else{            
            $.ajax({
                url: 'backend/task-search.php',
                type: 'POST',
                data: {search: search}, 
                success: function(response){
                    let template = '';
                    let task_list = tasks = JSON.parse(response).task;
                    if(task_list.length){
                        task_list.forEach(element => {
                            template += '<tr>'; 
                            template += '<td>'+element.id+'</td>';
                            template += '<td>'+element.name+'</td>';
                            template += '<td>'+element.description+'</td>';
                            template += '<td>'+get_options(element.id)+'</td>';
                            template += '</tr>';
                            $("#task-list-body").html(template);
                        });
                    }else{
                        template = "<tr><td colspan='4'>No se han encontrado tareas.</td></tr>";
                        $("#task-list-body").html(template);
                    }
                },
            });
        }
    });
    
});

function get_options(id){
    html = "<div class='btn-container'>";
    
    html += "<button class='btn btn-warning' onclick='edit_task("+id+")'><i class='fa-solid fa-pen'></i></button>";
    html += "<button class='btn btn-danger' onclick='delete_task("+id+")'><i class='fa-solid fa-trash'></i></button>";
    
    html += "</div>";
    
    return html;
}

function clean_fields(){
    $("#task-id").val("");
    $("#name").val("");
    $("#description").val("");
    $("#add-task").css("display", "block");
    $("#edit-task").css("display", "none");
}

function get_all_tasks(page = 1){
    $.ajax({
        url: 'backend/get-task.php',
        data: { page: page },
        type: 'POST',
        success: function(response){
            let template = '';
            let task_list = tasks = JSON.parse(response).task;
            if(task_list.length){
                task_list.forEach(element => {
                    template += '<tr>'; 
                    template += '<td>'+element.id+'</td>';
                    template += '<td>'+element.name+'</td>';
                    template += '<td>'+element.description+'</td>';
                    template += '<td>'+get_options(element.id)+'</td>';
                    template += '</tr>';
                    $("#task-list-body").html(template);
                });
            }else{
                template = "<tr><td colspan='4'>No se han registrado tareas.</td></tr>";
                $("#task-list-body").html(template);
            }
        },
    });
}

function get_task_count(){
    $.ajax({
        url: 'backend/get-task-count.php',
        type: 'POST',
        success: function(response){
            let template = '';
            let count = JSON.parse(response).count;
            let pages = parseInt(count/5);
            console.log(count);
            for(i=0; i<pages; i++){
                template += "<li class='page-item' onclick='get_all_tasks("+(i+1)+")'>";
                template += "<a class='page-link' href='#page="+(i+1)+"'>";
                template += i+1;
                template += "</a>";
                template += "</li>";
            }
            $("ul.pagination").html(template);
        },
    });
}

function edit_task(id){

    let selected_task = tasks.find(element => element.id == id);

    $("#name").val(selected_task.name);
    $("#description").val(selected_task.description);
    
    $("#add-task").css("display", "none");
    $("#edit-task").css("display", "block");

    $("#task-id").val(id);
}

function delete_task(id){
    Swal.fire({
        title: "Do you want to delete the task?",
        showDenyButton: true,
        confirmButtonText: "Cancel",
        denyButtonText: "Delete",
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isDenied) {
            $.ajax({
                url: 'backend/delete-task.php',
                type: 'POST',
                data: {id: id}, 
                success: function(response){
                    let message = JSON.parse(response).message;
                    Swal.fire(message, "", "info");
                    get_all_tasks();
                },
            }); 
        }
    });
}

$("#btn-cancel").click(function(){
    clean_fields();
});

$("#save-task-changes").click(function(e){
    e.preventDefault();
    let data = {
        id: $("#task-id").val(),
        name: $("#name").val(),
        description: $("#description").val(),
    }
    $.post("backend/task-update.php", data, function(response){
        let resp = JSON.parse(response);
        let icon = "success";
        let html = "";
        if(resp.status != "success"){
            icon = "error"
            html = "<ul>";
            resp.errors.forEach(element =>{
                html += "<li>"+element+"</li>"
            });                
            html += "</ul>";
        }
        get_all_tasks();
        clean_fields();
        Swal.fire({
            icon: icon,
            title: resp.message,
            html: html,
        });
    });
});

$("#add-task").click(function(e){
    e.preventDefault();
    let data = {
        name: $("#name").val(),
        description: $("#description").val(),
    }
    $.post("backend/task-add.php", data, function(response){
        let resp = JSON.parse(response);
        let icon = "success";
        let html = "";
        console.log(resp);
        if(resp.status != "success"){
            icon = "error"
            html = "<ul>";
            resp.errors.forEach(element =>{
                html += "<li>"+element+"</li>"
            });                
            html += "</ul>";
        }
        get_all_tasks();
        clean_fields();
        Swal.fire({
            icon: icon,
            title: resp.message,
            html: html,
        });
    });
});