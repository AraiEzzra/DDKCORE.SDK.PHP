<?php

namespace DDK\API;


use DDK\API\Schemas\CreateTransaction;
use DDK\API\Schemas\GetAccount;
use DDK\API\Schemas\GetAccountBalance;
use DDK\API\Schemas\GetBlock;
use DDK\API\Schemas\GetBlocks;
use DDK\API\Schemas\GetTransaction;
use DDK\API\Schemas\GetTransactions;
use DDK\API\Schemas\GetTransactionsByIdBlock;

class Schema
{

    const GET_ACCOUNT = GetAccount::schema;
    const GET_ACCOUNT_BALANCE = GetAccountBalance::schema;
    const GET_BLOCK = GetBlock::schema;
    const GET_BLOCKS = GetBlocks::schema;
    const GET_TRANSACTION = GetTransaction::schema;
    const CREATE_TRANSACTION = CreateTransaction::schema;
    const GET_TRANSACTIONS = GetTransactions::schema;
    const GET_TRANSACTIONS_BY_BLOCK_ID = GetTransactionsByIdBlock::schema;

}
