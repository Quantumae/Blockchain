// DIDContract.go
package main

import (
    "encoding/json"
    "errors"
    "fmt"
    "github.com/hyperledger/fabric-contract-api-go/contractapi"
    "github.com/minio/sha256-simd"
)

// 结构体定义部分
type VerificationMethod struct {
    ID                string      `json:"id"`
    Type              string      `json:"type"`
    Controller        string      `json:"controller"`
    PublicKeyJwk      interface{} `json:"publicKeyJwk,omitempty"`
    PublicKeyMultibase string     `json:"publicKeyMultibase,omitempty"`
}

type ServiceEndpoint struct {
    ID              string        `json:"id"`
    Type            interface{}   `json:"type"` // Can be string or string array
    ServiceEndpoint interface{}   `json:"serviceEndpoint"` // Can be a variety of types
}

type DIDDocument struct {
    Context              interface{}           `json:"@context"` // Can be string or string array
    ID                   string                `json:"id"`
    AlsoKnownAs          []string              `json:"alsoKnownAs,omitempty"`
    Controller           interface{}           `json:"controller,omitempty"` // Can be string or string array
    VerificationMethod   []VerificationMethod  `json:"verificationMethod,omitempty"`
    Authentication       interface{}         `json:"authentication,omitempty"` // Can be string or VerificationMethod
    AssertionMethod      []interface{}         `json:"assertionMethod,omitempty"` // Can be string or VerificationMethod
    KeyAgreement         []interface{}         `json:"keyAgreement,omitempty"` // Can be string or VerificationMethod
    CapabilityInvocation []interface{}         `json:"capabilityInvocation,omitempty"` // Can be string or VerificationMethod
    CapabilityDelegation []interface{}         `json:"capabilityDelegation,omitempty"` // Can be string or VerificationMethod
    Service              []ServiceEndpoint     `json:"service,omitempty"`
    Created              string                `json:"created"`
    Updated              string                `json:"updated"`
    VersionID            string                `json:"versionId"`
}

// 智能合约定义部分
type DIDContract struct {
    contractapi.Contract
}

// 创建DID文档
func (dc *DIDContract) CreateDID(ctx contractapi.TransactionContextInterface, did string, didDocumentString string) error {
    exists, err := dc.ReallydidExists(ctx, did)
    if err != nil {
        return err
    }
    if exists {
        return fmt.Errorf("DID %s already exists", did)
    }

    var didDocument DIDDocument
    if err := json.Unmarshal([]byte(didDocumentString), &didDocument); err != nil {
        return fmt.Errorf("failed to parse DID Document: %v", err)
    }

    // 验证DID文档是否符合规范
    if didDocument.ID != did {
        return fmt.Errorf("DID Document ID does not match provided DID %s", did)
    }
    if didDocument.Context == nil {
        return errors.New("DID Document must contain @context")
    }

    didDocumentBytes, err := json.Marshal(didDocument)
    if err != nil {
        return fmt.Errorf("failed to marshal DID Document: %v", err)
    }

    return ctx.GetStub().PutState(did, didDocumentBytes)
}

// 更新DID文档
func (dc *DIDContract) UpdateDID(ctx contractapi.TransactionContextInterface, did string, didDocumentString string) error {
    exists, err := dc.ReallydidExists(ctx, did)
    if err != nil {
        return err
    }
    if !exists {
        return fmt.Errorf("DID %s does not exist", did)
    }

    var didDocument DIDDocument
    if err := json.Unmarshal([]byte(didDocumentString), &didDocument); err != nil {
        return fmt.Errorf("failed to parse DID Document: %v", err)
    }

    // 验证DID文档是否符合规范
    if didDocument.ID != did {
        return fmt.Errorf("DID Document ID does not match provided DID %s", did)
    }
    if didDocument.Context == nil {
        return errors.New("DID Document must contain @context")
    }

    didDocumentBytes, err := json.Marshal(didDocument)
    if err != nil {
        return fmt.Errorf("failed to marshal DID Document: %v", err)
    }

    return ctx.GetStub().PutState(did, didDocumentBytes)
}

// 获取DID文档
func (dc *DIDContract) GetDIDDocument(ctx contractapi.TransactionContextInterface, did string) (string, error) {
    didDocumentBytes, err := ctx.GetStub().GetState(did)
    if err != nil {
        return "", fmt.Errorf("failed to get DID Document: %v", err)
    }
    if didDocumentBytes == nil {
        return "", fmt.Errorf("DID Document %s does not exist", did)
    }
    return string(didDocumentBytes), nil
}

// 检查DID是否存在
func (dc *DIDContract) ReallydidExists(ctx contractapi.TransactionContextInterface, did string) (bool, error) {
    didDocumentBytes, err := ctx.GetStub().GetState(did)
    if err != nil {
        return false, fmt.Errorf("failed to get DID Document: %v", err)
    }
    return didDocumentBytes != nil, nil
}

// 注册凭证
func (dc *DIDContract) RegisterCredential(ctx contractapi.TransactionContextInterface, issuerDid string, credential string) error {
    if issuerDid != "did:example:vcissuer" {
        return fmt.Errorf("Issuer DID %s is not allowed to issue credentials", issuerDid)
    }

    credentialHash := fmt.Sprintf("%x", sha256.Sum256([]byte(credential)))

    return ctx.GetStub().PutState(credentialHash, []byte(issuerDid))
}

// 验证凭证
func (dc *DIDContract) CheckCredential(ctx contractapi.TransactionContextInterface, issuerDid string, credential string) (bool, error) {
    credentialHash := fmt.Sprintf("%x", sha256.Sum256([]byte(credential)))
    issuerDidBytes, err := ctx.GetStub().GetState(credentialHash)
    if err != nil {
        return false, fmt.Errorf("failed to get credential: %v", err)
    }
    return issuerDidBytes != nil && string(issuerDidBytes) == issuerDid, nil
}

