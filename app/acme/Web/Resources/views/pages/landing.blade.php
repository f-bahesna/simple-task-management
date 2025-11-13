<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <title>SimpleTask</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">
<div class="container text-center border-1 shadow-lg rounded-1">
    <div class="row">
        <div class="row dropdown col-2">
            <input type="hidden" class="project-id"/>
            <div class="border rounded-2 shadow-lg text-3xl dropdown-toggle p-2 m-2 dropdown-title" data-bs-toggle="dropdown"></div>
            <ul class="dropdown-menu dropdown-project-menu">
{{--                project task list--}}
            </ul>
        </div>
        <div class="row col-10 ">
            <div class="d-flex justify-content-end align-items-center">
                <button data-bs-toggle="modal" data-bs-target="#addProject" class="btn btn-primary">Add Project</button>
            </div>
        </div>
    </div>
    <div class="">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8">
                <table id="table-task" class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Created</th>
                        </tr>
                    </thead>
                    <tbody id="tasks-container">
                        {{--task lists--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Task Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Todo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control">
                    </div>
                    <button class="btn btn-primary btn-submit-create-todo">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Project Modal -->
    <div class="modal fade" id="addProject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Project Name</label>
                        <input type="text" id="project_name" class="form-control">
                    </div>
                    <button class="btn btn-primary btn-submit-add-project">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit and Delete modal -->
    <div class="modal fade" id="updateProject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Task Name</label>
                        <input type="text" id="task_name" class="form-control">
                        <input type="hidden" id="task_id" class="form-control">
                    </div>
                    <button class="btn btn-danger btn-delete-task">Delete</button>
                    <button class="btn btn-primary btn-submit-update-project">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div id="uncreated-task-alert"></div>

    <div class="flex justify-content-center align-items-center">
        <button type="button" class="btn btn-success button-create-todo my-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fa-solid fa-plus fa-2xl"></i>
        </button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(function (){
        const container = $('#tasks-container')
        const dropdownProjectMenu = $(".dropdown-project-menu")

        onLoad();

        $("tbody").on("click", "tr", function (){
            let task = $(this).attr('id')
            let taskName = $(this).children().first().text()

            $("#task_name").val(taskName)
            $("#task_id").val(task)
            $("#updateProject").modal('show')
        })

        $(".btn-submit-update-project").on("click", function (){
            let project = localStorage.getItem('projectId')
            let name = $("#task_name")
            let task = $("#task_id")

            let data = {
                project,
                task: task.val(),
                name: name.val()
            }

            updateTask(data)

            $("#updateProject").modal('hide')
            name.val('')
            task.val('')
        })

        $(".btn-delete-task").on("click", function (){
            let task = $("#task_id")
            let project = localStorage.getItem('projectId')

            let data = {
                project, task: task.val()
            }

            deleteTask(data)

            $("#updateProject").modal('hide')
            task.val('')
        })

        $(document).ready(function (){
            $('#table-task tbody').sortable({
                items: 'tr',
                axis: 'y',
                update: function(event, ui){
                    let newOrder = $(this).sortable('toArray');

                    let data = {
                        project: localStorage.getItem("projectId"),
                        tasks: newOrder
                    }

                    reorderTask(data)
                }
            })
        })

        $(document).on("click", ".dropdown-project-menu li a", function (){
            let project = $(this).data("id")
            let selectedText = $(this).text()

            $(".dropdown-title").text(selectedText)

            localStorage.setItem("projectId", project)
            getTaskByProjectAndLoadTable(project)
        })

        $(".btn-submit-create-todo").on("click", function (){
            let project = localStorage.getItem('projectId')

            let name = $("#name").val()

            let data = {
                project, name
            }

            createTask(data)
        })

        $(".btn-submit-add-project").on("click", function (){
            let projectName = $("#project_name").val()

            createProject(projectName)
        })

        function onLoad() {
            $.ajax({
                type: 'GET',
                url: 'http://127.0.0.1:8000/api/v1/projects',
                success: async function (response) {
                    let projects = response.data
                    let storedProjectId = localStorage.getItem('projectId')

                    // defining prev object from storage or just get the first project
                    let projectId = storedProjectId ? storedProjectId : projects[0].id
                    let fetchProjectTask = await getTaskByProjectJson(projectId)

                    let projectTask = fetchProjectTask.data.tasks
                    let projectName = fetchProjectTask.data.name
                    // load default tasks
                    $(".dropdown-title").text(projectName)
                    loadTasksTable(container, projectTask ?? 0)

                    // set projects
                    dropdownProjectMenu.html('')
                    projects.map((project) => {
                        const html =
                            `
                            <li>
                                <a class="dropdown-item" data-id="${project.id}" href="#">${project.name}</a>
                            </li>
                        `
                        dropdownProjectMenu.append(html)
                    })
                },
                error: function (err){
                    console.log("func getProjectTasksView: " + err.responseText)
                }
            })
        }

        function getTaskByProjectJson(project){
            return $.ajax({
                type: 'GET',
                url: 'http://127.0.0.1:8000/api/v1/projects/' + project
            })
        }

        function getTaskByProjectAndLoadTable(project) {
            $.ajax({
                type: 'GET',
                url: 'http://127.0.0.1:8000/api/v1/projects/' + project,
                success: function(response) {
                    let tasks = response.data.tasks
                    loadTasksTable(container, tasks)
                },
                error: function (err){
                    console.log("func getTaskByProject: " + err)
                }
            })
        }

        function appendProjectList(target, project){
            let html = ''

             html +=
                ` <li>
                    <a class="dropdown-item" data-id="${project.id}" href="#">${project.name}</a>
                  </li>`

            target.append(html)
        }

        function loadTasksTable(target, tasks){
            let html = ''
            target.html('')

            if(tasks.length > 0){
                tasks.map((task) => {
                    html +=
                        `<tr id="${task.id}">
                            <td>${task.name}</td>
                            <td>${task.priority}</td>
                            <td>${task.created_at}</td>
                        </tr>`
                })

                target.html(html)
                $("#uncreated-task-alert").html('')
            } else {
                $("#uncreated-task-alert")
                    .html(`
                <div class="d-flex justify-content-center align-items-center py-5">
                    You didn't have task here, create some tasks!
                </div>`)
            }
        }

        function createProject(projectName){
            $.ajax({
                type: 'POST',
                url: `http://127.0.0.1:8000/api/v1/projects`,
                data: JSON.stringify({
                    name: projectName,
                }),
                contentType: 'application/json',
                success: function(response) {
                    $('#addProject').modal('hide')

                    let project = response.data
                    appendProjectList(dropdownProjectMenu, project)
                },
                error: function (err){
                    console.log("func createProject: " + err)
                }
            })
        }

        function reorderTask(data){
            $.ajax({
                type: 'PATCH',
                url: `http://127.0.0.1:8000/api/v1/projects/${data.project}/task-reorder`,
                data: JSON.stringify({
                    tasks: data.tasks
                }),
                contentType: 'application/json',
                success: function() {
                    onLoad()
                },
                error: function (err){
                    console.log("func reorderTask: " + err)
                }
            })
        }

        function createTask(data){
            $.ajax({
                type: 'POST',
                url: `http://127.0.0.1:8000/api/v1/projects/${data.project}/task`,
                data: JSON.stringify({
                    name: data.name
                }),
                contentType: 'application/json',
                success: function() {
                    $('#staticBackdrop').modal('hide')
                   onLoad()
                },
                error: function (err){
                    console.log("func createTask: " + err)
                }
            })
        }

        function updateTask(data){
            $.ajax({
                type: 'PATCH',
                url: `http://127.0.0.1:8000/api/v1/projects/${data.project}/tasks/${data.task}`,
                data: JSON.stringify({
                    name: data.name
                }),
                contentType: 'application/json',
                success: function() {
                    onLoad()
                },
                error: function (err){
                    console.log("func updateTask: " + err)
                }
            })
        }

        function deleteTask(data){
            $.ajax({
                type: 'DELETE',
                url: `http://127.0.0.1:8000/api/v1/projects/${data.project}/tasks/${data.task}/delete`,
                contentType: 'application/json',
                success: function() {
                    restructureTaskPriority()
                },
                error: function (err){
                    console.log("func deleteTask: " + err)
                }
            })
        }

        async function restructureTaskPriority(){
            let project = localStorage.getItem('projectId')
            let fetchTaskByProject = await getTaskByProjectJson(project)

            let tasks = $.map(fetchTaskByProject.data.tasks, function (task){
                return task.id
            })

            let data = {
                tasks, project
            }

            reorderTask(data)
        }
    })
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</body>
</html>
