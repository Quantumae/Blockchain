<template>
  <div class="container">
    <div style="margin-bottom: 20px">
      <a-button type="primary" @click="queryVCIssuerDIDDocument">
        查询公安局的数字身份文档
      </a-button>
    </div>
    <a-space direction="vertical">
      <a-card title="申请“出生年份”的可验证声明">
        <a-space>
          <a-input v-model="name" placeholder="请输入姓名" style="width: 200px" />
        <a-input
          v-model="idNumber"
          placeholder="请输入身份证号"
          style="width: 200px"
          @input="extractBirthYear"
        />
        <div>
          <p>提取的出生年份: {{ birthyear }}</p>
        </div>
          <a-button type="primary" @click="applyVCByBirthyear">提交</a-button>
        </a-space>
        <p>新申请的声明将会覆盖已有声明</p>
        <p>有效年份范围为[1900, 2020]</p>
      </a-card>
    </a-space>
  </div>

  <a-modal v-model:visible="modalVisible" width="auto">
    <template #title>
      <span>公安局的数字身份文档</span>
    </template>
    <div v-if="didDocument">
      <DIDDocumentCards :did-document="didDocument"></DIDDocumentCards>
    </div>
  </a-modal>
</template>

<script setup lang="ts">
import { Message } from "@arco-design/web-vue";
import { onMounted, ref } from "vue";
import axios from "axios";
import DIDDocumentCards from "../components/DIDDocumentCards.vue";
import { useRouter } from "vue-router";
// import router from "../router";


const router = useRouter();
const name = ref('');
const idNumber = ref('');
const birthyear = ref('');
const didDocument = ref();
const modalVisible = ref(false);

onMounted(() => {});

const extractBirthYear = () => {
  if (idNumber.value.length >= 10) {
    // 从身份证号中提取出生年份（第七位开始的8个字符）
    const year = idNumber.value.substr(6, 4);
    birthyear.value = year;
  } else {
    birthyear.value = ''; // 如果身份证号不完整，则清除出生年份
  }
};

const queryVCIssuerDIDDocument = async () => {
  const res = await axios.get(
    "http://localhost:3000/api/did/did:example:vcissuer"
  );
  if (res.status === 200) {
    didDocument.value = res.data;
    modalVisible.value = true;
  } else {
    Message.error("查询VC Issuer的DID文档失败");
  }
};

const storeVC = (vc: any) => {
  let vcListStr = localStorage.getItem("vc_list");
  if (!vcListStr) {
    vcListStr = "[]";
  }
  let vcList = JSON.parse(vcListStr);
  vcList.push(vc);
  localStorage.setItem("vc_list", JSON.stringify(vcList));
};

const applyVCByBirthyear = async () => {
  try {
    const didDocument = localStorage.getItem("did_document");
    if (!didDocument) {
      Message.error("请先到“个人信息”页面注册数字身份");
      return;
    }

    const did = JSON.parse(didDocument).id;

    const res = await axios.post(
      "http://localhost:3000/api/vc/birthday_merkle/apply",
      {
        name: name.value,
        idnumber: idNumber.value,
        birthyear: birthyear.value,
        did,
      }
    );

    if (res.status === 200) {
      console.log(res.data);
      Message.success("申请成功");
      storeVC(res.data);
      router.push("/profile");
    } else {
      Message.error("姓名或身份证号不正确");
    }
  } catch (error:any) {
    if (error.response && error.response.status === 400) {
      Message.error("姓名或身份证号不正确");
    } else {
      Message.error("请求失败，请稍后再试");
    }
  }
};

</script>

<style scoped>
.container {
  height: 100%;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
</style>
