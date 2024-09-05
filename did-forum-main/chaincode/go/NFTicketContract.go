package main

import (
    "encoding/json"
    "fmt"
    "github.com/hyperledger/fabric-contract-api-go/contractapi"
)

// 定义 NFTicket 结构体
type NFTicket struct {
    TicketId string  `json:"ticketId"`
    Owner    string  `json:"owner"`
    Event    string  `json:"event"`
    Date     string  `json:"date"`
    Price    float64 `json:"price"`
}

// 构造函数，用于创建新的 NFTicket 实例
func NewNFTicket(ticketId, owner, event, date string, price float64) *NFTicket {
    return &NFTicket{
        TicketId: ticketId,
        Owner:    owner,
        Event:    event,
        Date:     date,
        Price:    price,
    }
}

// 定义 NFTicketContract 合约
type NFTicketContract struct {
    contractapi.Contract
}

// 创建 NFTicket
func (t *NFTicketContract) CreateTicket(ctx contractapi.TransactionContextInterface, ticketId string, owner string, event string, date string, price float64) error {
    ticket := NewNFTicket(ticketId, owner, event, date, price)

    ticketJSON, err := json.Marshal(ticket)
    if err != nil {
        return fmt.Errorf("failed to marshal ticket: %v", err)
    }

    return ctx.GetStub().PutState(ticketId, ticketJSON)
}

// 查询 NFTicket
func (t *NFTicketContract) QueryTicket(ctx contractapi.TransactionContextInterface, ticketId string) (*NFTicket, error) {
    ticketJSON, err := ctx.GetStub().GetState(ticketId)
    if err != nil {
        return nil, fmt.Errorf("failed to read ticket: %v", err)
    }
    if ticketJSON == nil {
        return nil, fmt.Errorf("ticket with ID %s does not exist", ticketId)
    }

    var ticket NFTicket
    err = json.Unmarshal(ticketJSON, &ticket)
    if err != nil {
        return nil, fmt.Errorf("failed to unmarshal ticket: %v", err)
    }

    return &ticket, nil
}

// 转移 NFTicket
func (t *NFTicketContract) TransferTicket(ctx contractapi.TransactionContextInterface, ticketId string, newOwner string) error {
    ticket, err := t.QueryTicket(ctx, ticketId)
    if err != nil {
        return err
    }

    ticket.Owner = newOwner

    ticketJSON, err := json.Marshal(ticket)
    if err != nil {
        return fmt.Errorf("failed to marshal ticket: %v", err)
    }

    return ctx.GetStub().PutState(ticketId, ticketJSON)
}

