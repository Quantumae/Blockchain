package main

import (
    "regexp"
    "time"
    "fmt"
)

// 验证DID格式
func isValidDID(did string) bool {
    // 使用正则表达式验证DID的格式
    didRegex := `^did:[a-z0-9]+:[a-zA-Z0-9.\-_]+$`
    re := regexp.MustCompile(didRegex)
    return re.MatchString(did)
}

// 生成DID文档ID
func generateDIDDocumentId(did string) string {
    return fmt.Sprintf("DIDDocument:%s", did)
}

// 获取当前时间戳
func getCurrentTimestamp() string {
    // 获取当前时间并格式化为ISO 8601字符串
    return time.Now().UTC().Format(time.RFC3339)
}


