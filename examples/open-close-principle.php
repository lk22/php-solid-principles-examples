<?php 

// Open closed principle
// Software entities should be open for extension, but closed for modification
// Classes should be open for extension, but closed for modification
// Methods should be open for extension, but closed for modification

// OCP Open Close Principle a violation example 
class LoginService {
    public function login($user){
        if( $user instanceof User ){
            $this->authenticate($user);
        } else if ($user instanceOf ThirdPartyUser) {
            $this->authenticateThirdParty($user);
        }
    }
}

// OCP Open Close Principle a solution example
interface LoginInterface {
    public function authenticate($user);
}

class UserAuthentication implements LoginInterface {
    public function authenticate($user) {
       // authenticate user
    }
}

class ThirdPartyAuthentication implements LoginInterface {
    public function authenticate($user) {
       // authenticate third party user
    }
}

class LoginService {
    public function login(LoginInterface $loginService, UserInterface $user){
        $loginService->authenticate($user);
    }
}

// OCP Open Close Principle a violation example
public function pay(Request $request) {
    $payment = new Payment();

    switch($request->type) {
        case "creditcard":
            $payment->creditcard($request->amount);
            break;
        case "paypal":
            $payment->paypal($request->amount);
            break;
        case "bitcoin":
            $payment->bitcoin($request->amount);
            break;
    }
}

class PaymentRequest {
    public function payWithCreditCard($amount) {
        $payment = new Payment();
        $payment->creditcard($amount);
    }

    public function payWithPaypal($amount) {
        $payment = new Payment();
        $payment->paypal($amount);
    }
}

/**
 * All the methods that process the different types of payments are found in a single class, the Payment class. Therefore, when we add a new payment type or remove one, we should edit the Payment class, and as the Open / Closed principle says, this is not ideal. Like it is also violating the principle of Single Responsibility.
 */

 // OCP Open Close Principle a solution example
 interface PayableInterface {
    public function pay();
 }

 class CreditCardPayment implements PayableInterface{
    public function pay() {
        // pay with credit card
    }
 }

 class PaypalPayment implements PayableInterface {
    public function pay() {
        // pay with paypal
    }
 }

 public function pay(Request $request)
 {
    $paymentFactory = new PaymentFactory();
    $payment = $paymentFactory->initialize($request->type);

    return $payment->pay();
 }

 class PaymentFactory {
    public function initialize(string $type): PayableInterface {
        switch($type) {
            case "creditcard":
                return new CreditCardPayment();
            case "paypal":
                return new PaypalPayment();
            default:
                throw new Exception("Payment type not supported");
                break;
        }
    }
 }

?>