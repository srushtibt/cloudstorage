function download_btn_press(id) {
    //    alert("pressed");
    var item_name = id;
    var content_name = "file_td" + id;
    var name = document.getElementById(content_name).innerHTML;
    localStorage.setItem("supply_data", name);
    window.location = "middle_man.php?uid=" + name;
}

function dlt_btn_press(id) {
    var item_name = id;
    var content_name = "file_td" + id;
    var name = document.getElementById(content_name).innerHTML;
    localStorage.setItem("dlt_data", name);
    window.location = "delete_confirmation.php";
}

function cpy_btn_press(id) {
    var item_name = id;
    var content_name = "file_td" + id;
    var name = document.getElementById(content_name).innerHTML;
    localStorage.setItem("cpy_data", name);
    window.location.href = "copy_link.php?uid=" + name;
}

function go_page() {
    window.location = "folder_access.php";
}

function go_login_page() {
    window.location = "index.php";
}

function on_user_folder_click(id) {
    var admin_folder_id_name = "folder" + id;
    var get_folder_name = document.getElementById(admin_folder_id_name).innerHTML;
    localStorage.setItem("folder_name", get_folder_name);
    window.location = "admin_user.php?uid=" + get_folder_name;
}

function admin_file_delete() {
    window.location="admin_dlt_no_confirmation.php";
}
