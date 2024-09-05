package main

import (
	"fmt"
  	"github.com/hyperledger/fabric-contract-api-go/contractapi"
)

// SmartContract 包含多个合约
type SmartContract struct {
    contractapi.Contract
    DIDContract
    NFTicketContract
}

// main函数是Fabric智能合约的入口点
func main() {
    smartContract := new(SmartContract)
    // 使用contractapi.NewChaincode来创建一个新的Chaincode
    chaincode, err := contractapi.NewChaincode(smartContract)
    if err != nil {
        fmt.Printf("Error create chaincode: %s", err.Error())
	return
    }

    // 启动链码
    if err := chaincode.Start(); err != nil {
        fmt.Printf("Error starting chaincode: %s", err.Error())
    }
}

