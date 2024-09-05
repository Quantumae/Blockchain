<template>
    <div class="login-container">
      <a-card class="card" title="登录">
        <a-list layout="vertical">
          <a-list-item label="用户名" :required="true">
            <a-input v-model="username" placeholder="请输入用户名" class="input-field" />
          </a-list-item>
          <a-list-item label="密码" :required="true">
            <a-input-password v-model="password" placeholder="请输入密码" class="input-field" />
          </a-list-item>
          <a-list-item>
            <a-button type="primary" @click="loginLuntan" class="login-button">登录</a-button>
          </a-list-item>
        </a-list>
      </a-card>
    </div>
  </template>
  
<script setup lang="ts">
import { Message } from "@arco-design/web-vue";
import { onMounted, ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
// import router from "../router";


const router = useRouter();
const username = ref('');
const password = ref('');
//const modalVisible = ref(false);

onMounted(() => {});

const loginLuntan = async () => {
const res = await axios.post(
  "http://localhost:3000/api/login",
  {
    username:username.value,
    password:password.value
  }
);

if (res.status === 200) {
  console.log(res.data);
  Message.success("登录成功");
  router.push("/luntan");
  //把当前user post到后端，后端把这个user存起来，当调用buybucket时get过去。
} else {
  Message.error("登录失败，请重试！");
}
};

</script>

<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f5f7fa;
}

.card {
  width: 400px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  overflow: hidden;
}

.input-field {
  width: 100%;
  margin-bottom: 16px;
}

.login-button {
  width: 100%;
  height: 48px;
  font-size: 16px;
  background-color: #1890ff;
  border-color: #1890ff;
  color: white;
}

.login-button:hover {
  background-color: #40a9ff;
  border-color: #40a9ff;
}
</style>