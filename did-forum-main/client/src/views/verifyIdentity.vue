<template>
    <div class="login-container">
      <a-card class="card" title="认证">
        <a-list layout="vertical">
          <a-list-item label="用户名" :required="true">
            <a-input v-model="username" placeholder="请输入用户名" class="input-field" />
          </a-list-item>
          <a-list-item>
            <a-button type="primary" @click="verifyIdentity" class="login-button">认证</a-button>
          </a-list-item>
        </a-list>
      </a-card>
    </div>
  </template>
  
  <script lang="ts" setup>
  import { Message } from "@arco-design/web-vue";
  import axios from "axios";
  import { onMounted, ref, reactive } from "vue";
  import { generateVP } from "../utils/vc/vc";
  import { useRouter } from "vue-router";
  
const loading = ref(false);
const router = useRouter();
const username = ref('');
//const modalVisible = ref(false);

onMounted(() => {});

const verifyIdentity = async () => {
    const didDocument = localStorage.getItem("did_document");
    if (!didDocument) {
        Message.error("请先到“个人信息”页面注册数字身份");
        return;
    }
    const did = JSON.parse(didDocument).id;
    let vp = undefined;
    const vcListStr = localStorage.getItem("vc_list") || "[]";
    const vcList = JSON.parse(vcListStr);
    if (vcList.length === 0) {
      Message.error("请先获取出生证明！");
      return;
    }
    const vc = vcList[vcList.length - 1];
    const adultYear = new Date().getFullYear() - 18;
    vp = await generateVP(vc, `${adultYear}:1`);
  
    loading.value = true;
    try {
    const res = await axios.post(
      "http://localhost:3000/api/verifyy",
      { username:username.value, did, vp }
    );
    console.log(res);
    if (res.status === 200) {
      Message.success(res.data.message);
      router.push("/luntan");
    } else {
      Message.error("验证失败！" + res.data.message);
    }
  } catch (error: any) {
    console.log(error);
    Message.error(error.response.data);
  } finally {
    loading.value = false;
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