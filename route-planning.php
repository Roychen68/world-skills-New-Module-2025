<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Public Transport Query System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<header class="d-flex">
    <nav class="col-8 d-flex" id="logo">
        <span class="logo">LOGO</span>
        <h2>Public Transport Query System</h2>
    </nav>
    <nav class="col-4 align-content-end">
        <button class="btn btn-outline-dark align-content-end" onclick="admin()">Site Management</button>
        <button class="btn btn-outline-dark align-content-end" id="logout" onclick="logout()">Logout</button>
    </nav>
</header>
<div id="app">
    <div class="card w-75 mx-auto mt-5"></div>
    <div class="modal fade">
        <div class="modal-dialog">
            <form @submit.prevent="login()" class="modal-content">
                <div class="modal-header">
                    <h3>Site Management - Login</h3>
                </div>
                <div class="modal-body">
                    <div class="d-flex mb-3 align-items-center">
                        <label for="username" class="w-25">Username :</label>
                        <input type="text" id="username" class="w-75 form-control" v-model="form.username" required>
                    </div>
                    <div class="d-flex mb-3 align-items-center">
                        <label for="password" class="w-25">Passowrd :</label>
                        <input type="text" id="password" class="w-75 form-control" v-model="form.password" required>
                    </div>
                    <div class="d-flex mb-3 align-items-center">
                        <label for="captcha" class="w-25">Captcha : {{ captcha }}</label>
                        <input type="text" id="captcha" class="w-75 form-control" v-model="form.captcha" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary">Login</button>
                    <button type="button" class="btn btn-outline-info" @click="veri()">Regenerate captcha</button>
                    <button class="btn btn-outline-secondary" type="button" onclick="back()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<script src="js/jquery-3.7.1.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/vue.3.5.24.js"></script>
<script src="js/app.js"></script>
<script>
    const {createApp} = Vue
    createApp({
        data() {
            return {
                form: {
                    username:"",
                    password: "",
                    captcha: ""
                },
                captcha: "",
            }
        },
        methods: {
            veri(){
                $.post("controllers/veri.php",(res)=>{
                    this.captcha = res
                })
            },
            login(){
                if (this.form.captcha == this.captcha) {
                    $.post("controllers/login.php",{form: this.form},(res)=>{
                        if (res == true) {
                            alert("Login Success")
                            location.href = "route.html"
                        } else {
                            alert("Username or Password error")
                        }
                    })
                } else {
                    alert("Captcha error!")
                }
            }
        },
        mounted() {
            this.veri()
        }
    }).mount("#app")
</script>