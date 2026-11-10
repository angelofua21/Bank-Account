<?php

trait Logger
{
    public function logTransaction($message)
    {
        echo "Transaction logged: " . $message . "\n";
    }
}

class BankAccount
{
    use Logger;

    private $balance;

    public function __construct($initialBalance = 0)
    {
        $this->balance = $initialBalance;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function setBalance($amount)
    {
        $this->balance = $amount;
        $this->logTransaction("Balance set to $amount");
    }

    public function deposit($amount)
    {
        $this->balance += $amount;
        $this->logTransaction("Deposited $amount. New balance: " . $this->balance);
    }

    public function withdraw($amount)
    {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            $this->logTransaction("Withdrew $amount. New balance: " . $this->balance);
        } else {
            $this->logTransaction("Insufficient funds for withdrawal of $amount");
        }
    }
}

$account = new BankAccount(100);
echo "Initial balance: " . $account->getBalance() . "\n";

$account->deposit(200);
$account->withdraw(90);
$account->withdraw(40);

$account->setBalance(500);
echo "Final balance: " . $account->getBalance() . "\n";
