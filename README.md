# <div align="center">Curacel SDK</div>
<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg)]()
[![GitHub Issues](https://img.shields.io/github/issues/JetstreamAfrica/The-Documentation-Compendium.svg)](https://github.com/JetstreamAfrica/jetcur-sdk/issues)
[![GitHub Pull Requests](https://img.shields.io/github/issues-pr/JetstreamAfrica/The-Documentation-Compendium.svg)](https://github.com/JetstreamAfrica/jetcur-sdk/pulls)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](/LICENSE)

</div>

---


[//]: # (<!-- TOC -->)
* [Curacel Grow API](#curacel-grow-api)
  * [Installation](#installation)
  * [Example](#example)
  * [Usage](#usage)
  * [Available DataObjects](#available-dataobjects)
  * [Available Service Classes](#available-services--implementations)

[//]: # (<!-- TOC -->)

# Curacel Grow API

This project is an integration of Curacel Grow Features, where each feature has its own dedicated service class. Each service class contains methods representing endpoints or actions related to that feature. This approach promotes modularity and separation of concerns, enhancing maintainability and testability. The structured organization of the code ensures seamless integration of Curacel Grow Features while maintaining a clean and manageable codebase.


## Installation

1. Update composer.json and add a repository:
    ```JSON
    {
        "require": {
            "jetstream/curacel": "dev-development"
        },
        
      "repositories": [
        {
          "type": "vcs",
          "url": "git@github.com:JetstreamAfrica/jetcur-sdk.git"
        }
      ]
    }
    ```

2. The above section points to  a private repository, hence you would need to provide composer with a personal access
   token from GitHub to successfully pull the contents of the repo.
   For local development, it is recommended that you create
   a gitignored `auth.json` file with the following content, in the root of your project:

    ```json
    {
      "github-oauth": {
          "github.com": "token"
      }
    }
    ```

3. Run composer
   Now just run ```composer update``` or ```composer install``` as usual.

## Example
Here's an example on how to call a method for customer creation using the service class in your controller


```php
<?php
use Jetstream\Curacel\Package\Interface\ICustomerService;

private mixed $service;

public function __construct(){
    $this->service = app(ICustomerService::class);
}


public function create(Request $request)
{
    $params = IndividualCustomerData::from($request->all());
    return $this->service->createCustomer($params);
}
```
it's important to wrap your payload in  data object. The package has predefined data object that expects some properties to be present while making a method call.


## Usage
- Defining your data DataObject.
  The package ``spatie/laravel-data`` by spatie enables the creation of rich data objects which can be used in various ways.Using this package you only need to describe your data once as shown below

```php
<?php

namespace Jetstream\Curacel\DataObjects;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class IndividualCustomerData extends  Data
{
    public function __construct(
        public string|Optional $ref,
        public string $first_name,
        public string $last_name,
        public string|Optional $middle_name,
        public string|Optional $sex,
        public string $birth_date,
        public string|Optional $email,
        public string|Optional $bvn,
        public string|Optional $occupation,
        public string|Optional $city,
        public string|Optional $residential_address,
        public string|Optional $state,
        public string|Optional $country,
        public string|Optional $next_of_kin_name,
        public string|Optional $next_of_kin_phone,
        public ProofOfAddressData|Optional  $proof_of_address,
    ) {
    }
}
```
- for more information on this library visit https://spatie.be/docs/laravel-data/v3/introduction

- Setup your controller e.g ``CustomerController``.
```php
<?php
class CustomerController extends Controller
{
    private mixed $service;

    public function __construct()
    {
        $this->service = app(ICustomerService::class);
    }
}
```

- The customer interface contains all the necessary methods for the basic features associated with a customer. Its concrete class CustomerService.php contains all the implementation of the methods defined.

- Convert your request data into a data object.

```php
<?php 

public  function create(Request $request)
    {
        $data = $request->all();

        $customer = IndividualCustomerData::from($data);

        return $this->service->createCustomer($customer);

    }
```

- Note that for endpoints that require body params, it is mandatory to set up the data object for it. Inside the service class the data is converted to an array before sending the payload to the provider as shown bellow.

```php
<?php  
public function createCustomer(IndividualCustomerData $customerData): array
  {
     return $this->post($this->path,$customerData->toArray();
  }
```

- There are methods do not require a data object to be provided as parameter. An example is given below.

``` php
<?php

public  function show($reference)
{
  return $this->service->getCustomer($reference);
}
```

## Available DataObjects

### AttachmentData
```php 
<?php
class AttachmentData extends  Data
{
    public function __construct(
        #[File]
        public UploadedFile $file,
        public string|Optional $description,
    ) {
    }
}
```

### ClaimData
```php 
<?php
class ClaimData extends  Data
{
    public function __construct(
        public string $policy_number,
        public string $amount,
        public array $attachments,
        public PaymentDetailsData $payment_details
    ) {
    }
}
```

### ConvertQuoteData
```php 
<?php
class ConvertQuoteData extends  Data
{
    public function __construct(
        public string $ref,
        public string|Optional $asset_ref,
        public string|Optional $customer_ref,
        public string|Optional $policy_start_date,
        public string|Optional $payment_type,
        public array|Optional  $attachments,
    ) {
    }
}
```

### CreditRequestData 
    
```php 
<?php
class CreditRequestData extends  Data
{
    public function __construct(
        public string $ref,
        public string|Optional $narration,
        public IndividualCustomerData|Optional  $customer,
        public float $total_amount_paid,
        public float $item_original_price,
    ) {
    }
}
```


## IndividualCustomerData
```php 
<?php
class IndividualCustomerData extends  Data
{
    public function __construct(
        public string|Optional $ref,
        public string $first_name,
        public string $last_name,
        public string|Optional $middle_name,
        public string|Optional $sex,
        public string $birth_date,
        public string|Optional $email,
        public string|Optional $bvn,
        public string|Optional $occupation,
        public string|Optional $city,
        public string|Optional $residential_address,
        public string|Optional $state,
        public string|Optional $country,
        public string|Optional $next_of_kin_name,
        public string|Optional $next_of_kin_phone,
        public ProofOfAddressData|Optional  $proof_of_address,
    ) {
    }
}
```


## PaymentDetailsData
```php
 <?php
class PaymentDetailsData extends  Data
{
    public function __construct(
        public string $bank_name,
        public string $account_number,
        public int    $sort_code,
    ) {
    }
}
```

## ProductData
```php 
<?php
class ProductData extends  Data
{
    public function __construct(
        public string $product_code,
        public string $customer_ref,
        public string $payment_type,
        public string $policy_start_date,
        public string|Optional $asset_ref,
        public float  $asset_value,
        public string $pickup_location,
        public string $dropoff_location,
        public array |Optional $attachments,
        public float|Optional $broker_premium_rate,
        public float|Optional $broker_taxes,
    ) {
    }
}
```

## ProofOfAddressData
```php 
<?php
class ProofOfAddressData extends  Data
{
    public function __construct(
        public string|Optional $type,
        public string|Optional $url,
    ) {
    }
}
```

## QuotationData
```php
 <?php
class QuotationData extends  Data
{
    public function __construct(
        public string $product_code,
        public string $customer_ref,
        public string $payment_type,
        public string $policy_start_date,
        public string|Optional $asset_ref,
        public float  $asset_value,
        public string $pickup_location,
        public string $dropoff_location,
        public array  $attachments,
        public float|Optional $broker_premium_rate,
        public float|Optional $broker_taxes,
    ) {
    }
}
```

## QuotationUpdateData
```php 
<?php
class QuotationUpdateData extends  Data
{
    public function __construct(
        public string $ref,
        public string|Optional $customer_ref,
        public string|Optional $asset_ref,
        public string|Optional $company_name,
        public string|Optional $description,
    ) {}
}
```

## VoucherData
```php 
<?php
class VoucherData extends  Data
{

    public function __construct(
        public int $claim_id,
        public int $discharge_voucher_id,
        public string $status,
        public string $comment){

    }
}
```


## WalletData
```php 
<?php
class WalletData extends  Data
{
    public function __construct(
        public float $amount,
        public string $currency,
    ) {
    }
}
```



## Available Services & Implementations

#### AttachmentService

```php 
<?php

createAttachment(AttachmentData $attachmentData);

downloadAttachment(int $id);
```

#### ClaimService
```php 
<?php

createClaim(ClaimData $claimData);

getAllClaims(array $params = []);

getClaim(int $claimId);

updateDischargeVoucher(VoucherData $voucherData);
```

#### CreditRequestService

    implementation of the credit request endpoints
    [Click Here](https://docs.curacel.co/reference/addcreditrequest)

```php 
<?php

requestCredit(CreditRequestData $creditRequest);

getCreditRequests(array $params = []);

getExtraAmount(array $params = []);
```

#### CustomerService

```php 
<?php

createCustomer(IndividualCustomerData $customerData);

updateCustomer(IndividualCustomerData $customerData);

getAllCustomers();

getCustomer($reference);

deleteCustomer($reference);
```

#### PolicyService

```php
<?php

getAllPolicies(array $params = []);

getPolicyDocument(int $id);

getPolicyResource(string $identifier,array $params = []);
```


#### ProductService
```php
<?php 
getInsuranceProduct(int $id,array $params = []);

getAllProductTypes();

getAllInsuranceProducts(array $params = []);

purchaseProduct(ProductData $productData);

getAllOrders(array $params = []);

getOrder(int $id);

authorizeOrder(array $payload);
```

#### QuotationService

```php
<?php
 
createQuotation(QuotationData $quotationData);

updateQuotation(QuotationUpdateData $quotationUpdateData);

getAllQuotations(array $params = []);

convertQuotation(ConvertQuoteData $convertQuoteData);

downloadQuotationInvoice(string $quote,array $params = []);

getQuotation(string $quote,array $params = []);

deleteQuotation(string $quote,array $params = []);
```

#### WalletService

```php
<?php
 
getBalance();

getTransactions(array $params = []);

initializeTopUp(WalletData $walletData);
```

## ⛏️ Built Using <a name = "built_using"></a>
- [PHP](https://www.php.net/) - Language
- [Orchestra Testbench](https://github.com/orchestral/testbench) - Library

## ✍️ Authors <a name = "authors"></a>
- [Melchizedek](https://github.com/listermatrix) - Initial work





