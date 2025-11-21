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
    <div class="card w-75 mx-auto mt-5 text-center">
        <h1>Public Transportation Inquiry System - Passenger Feedback Form</h1>
    </div>
    <form class="w-50 mx-auto mt-3 p-2" @submit.prevent="submit()">
        <div class="d-flex mb-3 align-items-center">
            <label style="margin-right: 20px" for="route">Route</label>
            <select class="form-control" required v-model="form.route" id="route">
                <option v-for="option in options" :value="option.name">{{option.name}}
                </option>
            </select>
        </div>
        <div class="d-flex mb-3">
            <label style="margin-right: 20px" for="">Name</label>
            <input required type="text" class="form-control flex-fill" id="name" v-model="form.name">
        </div>
        <div class="d-flex mb-3">
            <label style="margin-right: 20px" for="mail">Email</label>
            <input required type="email" class="form-control flex-fill" id="mail" v-model="form.mail">
        </div>
        <div class="d-flex mb-3">
            <label style="margin-right: 20px" for="">Rating</label>
            <label>
                <input required type="radio" name="rate" value="Very Dissatisfied" v-model="form.rate">
                Very Dissatisfied
            </label>
            <label>
                <input required type="radio" name="rate" value="Dissatisfied" v-model="form.rate">
                Dissatisfied
            </label>
            <label>
                <input required type="radio" name="rate" value="Neutral" v-model="form.rate">
                Neutral
            </label>
            <label>
                <input required type="radio" name="rate" value="Satisfied" v-model="form.rate">
                Satisfied
            </label>
            <label>
                <input required type="radio" name="rate" value="Very Satisfied" v-model="form.rate">
                Very Satisfied
            </label>
        </div>
        <div class="d-flex mb-3">
            <label style="margin-right: 20px" for="feedback">Your Feedback</label>
            <textarea type="text" class="form-control flex-fill" id="feedback" v-model="form.feedback"></textarea>
        </div>
        <button class="btn btn-outline-primary w-100">Submit</button>
    </form>
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
                form: {},
                options: []
            }
        },
        methods: {
            getOptions() {
                $.post("controllers/get.php", {action: "route"}, (res) => {
                    this.options = JSON.parse(res)
                })
            },
            submit(){
                console.log(this.form)
                $.post("controllers/add.php", {form: this.form,action: "response"},(res)=>{
                    alert(res)
                })
            }
        },
        mounted() {
            this.getOptions()
        }
    }).mount("#app")
</script>