<template>
  <div class="register-container">
    <a-card class="card" title="注册">
      <a-list layout="vertical">
        <a-list-item label="用户名" :required="true">
          <a-input v-model="username" placeholder="请输入用户名" class="input-field" />
        </a-list-item>
        <a-list-item label="密码" :required="true">
          <a-input-password v-model="password" placeholder="请输入密码" class="input-field" />
        </a-list-item>
        <a-list-item label="确认密码" :required="true">
          <a-input-password v-model="confirmPassword" placeholder="请再次输入密码" class="input-field" />
        </a-list-item>
        <a-list-item>
          <a-button type="primary" @click="registerLuntan" class="register-button">注册</a-button>
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
  const confirmPassword = ref();
  //const modalVisible = ref(false);
  
  onMounted(() => {});

  const registerLuntan = async () => {
  const res = await axios.post(
    "http://localhost:3000/api/register",
    {
      username:username.value,
      password:password.value,
      confirmPassword:confirmPassword.value
    }
  );

  if (res.status === 200) {
    console.log(res.data);
    Message.success("注册成功");
    router.push("/login");
  } else {
    Message.error("注册失败，请重试！");
  }
};

  </script>

<style scoped>
.register-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f5f7fa;
}

.card {
  width: 400px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  background-color: #ffffff;
}

.input-field {
  width: 100%;
  margin-bottom: 16px;
}

.register-button {
  width: 100%;
  height: 48px;
  font-size: 16px;
  background-color: #1890ff;
  border-color: #1890ff;
  color: white;
  margin-top: 10px;
}

.register-button:hover {
  background-color: #40a9ff;
  border-color: #40a9ff;
}
</style>