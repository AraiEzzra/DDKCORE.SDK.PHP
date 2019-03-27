<?php

namespace DDK\API;


class TransactionStatus {

    const CREATED = 0;
    const QUEUED = 1;
    const PROCESSED = 2;
    const QUEUED_AS_CONFLICTED = 3;
    const VERIFIED = 4;
    const UNCONFIRM_APPLIED = 5;
    const PUT_IN_POOL = 6;
    const BROADCASTED = 7;
    const APPLIED = 8;
    const DECLINED = 9;

}
