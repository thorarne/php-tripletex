<?php
/**
 * CustomerTripletexAccount
 *
 * PHP version 5
 *
 * @category Class
 * @package  Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Tripletex API
 *
 * The Tripletex API is a **RESTful API**, which does not implement PATCH, but uses a PUT with optional fields.  **Actions** or commands are represented in our RESTful path with a prefixed `:`. Example: `/v2/hours/123/:approve`.  **Summaries** or aggregated results are represented in our RESTful path with a prefixed <code>&gt;</code>. Example: <code>/v2/hours/&gt;thisWeeksBillables</code>.  **\"requestID\"** is a key found in all responses in the header with the name `x-tlx-request-id`. For validation and error responses it is also in the response body. If additional log information is absolutely necessary, our support division can locate the key value.  **Download** the [swagger.json](/v2/swagger.json) file [OpenAPI Specification](https://github.com/OAI/OpenAPI-Specification) to [generate code](https://github.com/swagger-api/swagger-codegen). This document was generated from the Swagger JSON file.  **version:** This is a versioning number found on all DB records. If included, it will prevent your PUT/POST from overriding any updates to the record since your GET.  **Date & DateTime** follows the **ISO 8601** standard. Date: `YYYY-MM-DD`. DateTime: `YYYY-MM-DDThh:mm:ssZ`  **Sorting** is done by specifying a comma separated list, where a `-` prefix denotes descending. You can sort by sub object with the following format: `project.name, -date`.  **Searching:** is done by entering values in the optional fields for each API call. The values fall into the following categories: range, in, exact and like.  **Missing fields or even no response data** can occur because result objects and fields are filtered on authorization.  **See [FAQ](https://tripletex.no/execute/docViewer?articleId=906&language=0) for more additional information.**   ## Authentication: - **Tokens:** The Tripletex API uses 3 different tokens - **consumerToken**, **employeeToken** and **sessionToken**.  - **consumerToken** is a token provided to the consumer by Tripletex after the API 2.0 registration is completed.  - **employeeToken** is a token created by an administrator in your Tripletex account via the user settings and the tab \"API access\". Each employee token must be given a set of entitlements. [Read more here.](https://tripletex.no/execute/docViewer?articleId=853&language=0)  - **sessionToken** is the token from `/token/session/:create` which requires a consumerToken and an employeeToken created with the same consumer token, but not an authentication header. See how to create a sessionToken [here](https://tripletex.no/execute/docViewer?articleId=855&language=0). - The session token is used as the password in \"Basic Authentication Header\" for API calls.  - Use blank or `0` as username for accessing the account with regular employee token, or if a company owned employee token accesses <code>/company/&gt;withLoginAccess</code> or <code>/token/session/&gt;whoAmI</code>.  - For company owned employee tokens (accounting offices) the ID from <code>/company/&gt;withLoginAccess</code> can be used as username for accessing client accounts.  - If you need to create the header yourself use <code>Authorization: Basic &lt;base64encode('0:sessionToken')&gt;</code>.   ## Tags: - **[BETA]** This is a beta endpoint and can be subject to change. - **[DEPRECATED]** Deprecated means that we intend to remove/change this feature or capability in a future \"major\" API release. We therefore discourage all use of this feature/capability.  ## Fields: Use the `fields` parameter to specify which fields should be returned. This also supports fields from sub elements. Example values: - `project,activity,hours`  returns `{project:..., activity:...., hours:...}`. - just `project` returns `\"project\" : { \"id\": 12345, \"url\": \"tripletex.no/v2/projects/12345\"  }`. - `project(*)` returns `\"project\" : { \"id\": 12345 \"name\":\"ProjectName\" \"number.....startDate\": \"2013-01-07\" }`. - `project(name)` returns `\"project\" : { \"name\":\"ProjectName\" }`. - All elements and some subElements :  `*,activity(name),employee(*)`.  ## Changes: To get the changes for a resource, `changes` have to be explicitly specified as part of the `fields` parameter, e.g. `*,changes`. There are currently two types of change available:  - `CREATE` for when the resource was created - `UPDATE` for when the resource was updated  NOTE: For objects created prior to October 24th 2018 the list may be incomplete, but will always contain the CREATE and the last change (if the object has been changed after creation).  ## Rate limiting in each response header: Rate limiting is performed on the API calls for an employee for each API consumer. Status regarding the rate limit is returned as headers: - `X-Rate-Limit-Limit` - The number of allowed requests in the current period. - `X-Rate-Limit-Remaining` - The number of remaining requests. - `X-Rate-Limit-Reset` - The number of seconds left in the current period.  Once the rate limit is hit, all requests will return HTTP status code `429` for the remainder of the current period.   ## Response envelope: ```json {   \"fullResultSize\": ###,   \"from\": ###, // Paging starting from   \"count\": ###, // Paging count   \"versionDigest\": \"Hash of full result\",   \"values\": [...list of objects...] } {   \"value\": {...single object...} } ```   ## WebHook envelope: ```json {   \"subscriptionId\": ###,   \"event\": \"object.verb\", // As listed from /v2/event/   \"id\": ###, // Object id   \"value\": {... single object, null if object.deleted ...} } ```    ## Error/warning envelope: ```json {   \"status\": ###, // HTTP status code   \"code\": #####, // internal status code of event   \"message\": \"Basic feedback message in your language\",   \"link\": \"Link to doc\",   \"developerMessage\": \"More technical message\",   \"validationMessages\": [ // Will be null if Error     {       \"field\": \"Name of field\",       \"message\": \"Validation failure information\"     }   ],   \"requestId\": \"UUID used in any logs\" } ```   ## Status codes / Error codes: - **200 OK** - **201 Created** - From POSTs that create something new. - **204 No Content** - When there is no answer, ex: \"/:anAction\" or DELETE. - **400 Bad request** -   - **4000** Bad Request Exception   - **11000** Illegal Filter Exception   - **12000** Path Param Exception   - **24000**   Cryptography Exception - **401 Unauthorized** - When authentication is required and has failed or has not yet been provided   -  **3000** Authentication Exception - **403 Forbidden** - When AuthorisationManager says no.   -  **9000** Security Exception - **404 Not Found** - For content/IDs that does not exist.   -  **6000** Not Found Exception - **409 Conflict** - Such as an edit conflict between multiple simultaneous updates   -  **7000** Object Exists Exception   -  **8000** Revision Exception   - **10000** Locked Exception   - **14000** Duplicate entry - **422 Bad Request** - For Required fields or things like malformed payload.   - **15000** Value Validation Exception   - **16000** Mapping Exception   - **17000** Sorting Exception   - **18000** Validation Exception   - **21000** Param Exception   - **22000** Invalid JSON Exception   - **23000**   Result Set Too Large Exception - **429 Too Many Requests** - Request rate limit hit - **500 Internal Error** -  Unexpected condition was encountered and no more specific message is suitable   -  **1000** Exception
 *
 * OpenAPI spec version: 2.38.5
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.16
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Tripletex\Model;

use \ArrayAccess;
use \Tripletex\ObjectSerializer;

/**
 * CustomerTripletexAccount Class Doc Comment
 *
 * @category Class
 * @package  Tripletex
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class CustomerTripletexAccount implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'CustomerTripletexAccount';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'administrator' => '\Tripletex\Model\Employee',
'customer_id' => 'int',
'account_type' => 'string',
'modules' => '\Tripletex\Model\Modules',
'type' => 'string',
'send_emails' => 'bool',
'auto_validate_user_login' => 'bool',
'create_api_token' => 'bool',
'send_invoice_to_customer' => 'bool',
'customer_invoice_email' => 'string',
'number_of_employees' => 'int',
'number_of_vouchers' => 'string',
'administrator_password' => 'string',
'chart_of_accounts_type' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'administrator' => null,
'customer_id' => 'int32',
'account_type' => null,
'modules' => null,
'type' => null,
'send_emails' => null,
'auto_validate_user_login' => null,
'create_api_token' => null,
'send_invoice_to_customer' => null,
'customer_invoice_email' => null,
'number_of_employees' => 'int32',
'number_of_vouchers' => null,
'administrator_password' => null,
'chart_of_accounts_type' => null    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'administrator' => 'administrator',
'customer_id' => 'customerId',
'account_type' => 'accountType',
'modules' => 'modules',
'type' => 'type',
'send_emails' => 'sendEmails',
'auto_validate_user_login' => 'autoValidateUserLogin',
'create_api_token' => 'createApiToken',
'send_invoice_to_customer' => 'sendInvoiceToCustomer',
'customer_invoice_email' => 'customerInvoiceEmail',
'number_of_employees' => 'numberOfEmployees',
'number_of_vouchers' => 'numberOfVouchers',
'administrator_password' => 'administratorPassword',
'chart_of_accounts_type' => 'chartOfAccountsType'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'administrator' => 'setAdministrator',
'customer_id' => 'setCustomerId',
'account_type' => 'setAccountType',
'modules' => 'setModules',
'type' => 'setType',
'send_emails' => 'setSendEmails',
'auto_validate_user_login' => 'setAutoValidateUserLogin',
'create_api_token' => 'setCreateApiToken',
'send_invoice_to_customer' => 'setSendInvoiceToCustomer',
'customer_invoice_email' => 'setCustomerInvoiceEmail',
'number_of_employees' => 'setNumberOfEmployees',
'number_of_vouchers' => 'setNumberOfVouchers',
'administrator_password' => 'setAdministratorPassword',
'chart_of_accounts_type' => 'setChartOfAccountsType'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'administrator' => 'getAdministrator',
'customer_id' => 'getCustomerId',
'account_type' => 'getAccountType',
'modules' => 'getModules',
'type' => 'getType',
'send_emails' => 'getSendEmails',
'auto_validate_user_login' => 'getAutoValidateUserLogin',
'create_api_token' => 'getCreateApiToken',
'send_invoice_to_customer' => 'getSendInvoiceToCustomer',
'customer_invoice_email' => 'getCustomerInvoiceEmail',
'number_of_employees' => 'getNumberOfEmployees',
'number_of_vouchers' => 'getNumberOfVouchers',
'administrator_password' => 'getAdministratorPassword',
'chart_of_accounts_type' => 'getChartOfAccountsType'    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    const ACCOUNT_TYPE_TEST = 'TEST';
const ACCOUNT_TYPE_PAYING = 'PAYING';
const TYPE_NONE = 'NONE';
const TYPE_ENK = 'ENK';
const TYPE__AS = 'AS';
const TYPE_NUF = 'NUF';
const TYPE_ANS = 'ANS';
const TYPE_DA = 'DA';
const TYPE_PRE = 'PRE';
const TYPE_KS = 'KS';
const TYPE_ASA = 'ASA';
const TYPE_BBL = 'BBL';
const TYPE_BRL = 'BRL';
const TYPE_GFS = 'GFS';
const TYPE_SPA = 'SPA';
const TYPE_SF = 'SF';
const TYPE_IKS = 'IKS';
const TYPE_KF_FKF = 'KF_FKF';
const TYPE_FCD = 'FCD';
const TYPE_EOFG = 'EOFG';
const TYPE_BA = 'BA';
const TYPE_STI = 'STI';
const TYPE_ORG = 'ORG';
const TYPE_ESEK = 'ESEK';
const TYPE_SA = 'SA';
const TYPE_SAM = 'SAM';
const TYPE_BO = 'BO';
const TYPE_VPFO = 'VPFO';
const TYPE_OS = 'OS';
const TYPE_OTHER = 'Other';
const NUMBER_OF_VOUCHERS__0_100 = 'INTERVAL_0_100';
const NUMBER_OF_VOUCHERS__101_500 = 'INTERVAL_101_500';
const NUMBER_OF_VOUCHERS__0_500 = 'INTERVAL_0_500';
const NUMBER_OF_VOUCHERS__501_1000 = 'INTERVAL_501_1000';
const NUMBER_OF_VOUCHERS__1001_2000 = 'INTERVAL_1001_2000';
const NUMBER_OF_VOUCHERS__2001_3500 = 'INTERVAL_2001_3500';
const NUMBER_OF_VOUCHERS__3501_5000 = 'INTERVAL_3501_5000';
const NUMBER_OF_VOUCHERS__5001_10000 = 'INTERVAL_5001_10000';
const NUMBER_OF_VOUCHERS_UNLIMITED = 'INTERVAL_UNLIMITED';
const CHART_OF_ACCOUNTS_TYPE__DEFAULT = 'DEFAULT';
const CHART_OF_ACCOUNTS_TYPE_MAMUT_STD_PAYROLL = 'MAMUT_STD_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_MAMUT_NARF_PAYROLL = 'MAMUT_NARF_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_AGRO_FORRETNING_PAYROLL = 'AGRO_FORRETNING_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_AGRO_LANDBRUK_PAYROLL = 'AGRO_LANDBRUK_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_AGRO_FISKE_PAYROLL = 'AGRO_FISKE_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_AGRO_FORSOKSRING_PAYROLL = 'AGRO_FORSOKSRING_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_AGRO_IDRETTSLAG_PAYROLL = 'AGRO_IDRETTSLAG_PAYROLL';
const CHART_OF_ACCOUNTS_TYPE_AGRO_FORENING_PAYROLL = 'AGRO_FORENING_PAYROLL';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAccountTypeAllowableValues()
    {
        return [
            self::ACCOUNT_TYPE_TEST,
self::ACCOUNT_TYPE_PAYING,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_NONE,
self::TYPE_ENK,
self::TYPE__AS,
self::TYPE_NUF,
self::TYPE_ANS,
self::TYPE_DA,
self::TYPE_PRE,
self::TYPE_KS,
self::TYPE_ASA,
self::TYPE_BBL,
self::TYPE_BRL,
self::TYPE_GFS,
self::TYPE_SPA,
self::TYPE_SF,
self::TYPE_IKS,
self::TYPE_KF_FKF,
self::TYPE_FCD,
self::TYPE_EOFG,
self::TYPE_BA,
self::TYPE_STI,
self::TYPE_ORG,
self::TYPE_ESEK,
self::TYPE_SA,
self::TYPE_SAM,
self::TYPE_BO,
self::TYPE_VPFO,
self::TYPE_OS,
self::TYPE_OTHER,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getNumberOfVouchersAllowableValues()
    {
        return [
            self::NUMBER_OF_VOUCHERS__0_100,
self::NUMBER_OF_VOUCHERS__101_500,
self::NUMBER_OF_VOUCHERS__0_500,
self::NUMBER_OF_VOUCHERS__501_1000,
self::NUMBER_OF_VOUCHERS__1001_2000,
self::NUMBER_OF_VOUCHERS__2001_3500,
self::NUMBER_OF_VOUCHERS__3501_5000,
self::NUMBER_OF_VOUCHERS__5001_10000,
self::NUMBER_OF_VOUCHERS_UNLIMITED,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getChartOfAccountsTypeAllowableValues()
    {
        return [
            self::CHART_OF_ACCOUNTS_TYPE__DEFAULT,
self::CHART_OF_ACCOUNTS_TYPE_MAMUT_STD_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_MAMUT_NARF_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_AGRO_FORRETNING_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_AGRO_LANDBRUK_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_AGRO_FISKE_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_AGRO_FORSOKSRING_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_AGRO_IDRETTSLAG_PAYROLL,
self::CHART_OF_ACCOUNTS_TYPE_AGRO_FORENING_PAYROLL,        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['administrator'] = isset($data['administrator']) ? $data['administrator'] : null;
        $this->container['customer_id'] = isset($data['customer_id']) ? $data['customer_id'] : null;
        $this->container['account_type'] = isset($data['account_type']) ? $data['account_type'] : null;
        $this->container['modules'] = isset($data['modules']) ? $data['modules'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['send_emails'] = isset($data['send_emails']) ? $data['send_emails'] : false;
        $this->container['auto_validate_user_login'] = isset($data['auto_validate_user_login']) ? $data['auto_validate_user_login'] : false;
        $this->container['create_api_token'] = isset($data['create_api_token']) ? $data['create_api_token'] : false;
        $this->container['send_invoice_to_customer'] = isset($data['send_invoice_to_customer']) ? $data['send_invoice_to_customer'] : false;
        $this->container['customer_invoice_email'] = isset($data['customer_invoice_email']) ? $data['customer_invoice_email'] : null;
        $this->container['number_of_employees'] = isset($data['number_of_employees']) ? $data['number_of_employees'] : null;
        $this->container['number_of_vouchers'] = isset($data['number_of_vouchers']) ? $data['number_of_vouchers'] : null;
        $this->container['administrator_password'] = isset($data['administrator_password']) ? $data['administrator_password'] : null;
        $this->container['chart_of_accounts_type'] = isset($data['chart_of_accounts_type']) ? $data['chart_of_accounts_type'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['account_type'] === null) {
            $invalidProperties[] = "'account_type' can't be null";
        }
        $allowedValues = $this->getAccountTypeAllowableValues();
        if (!is_null($this->container['account_type']) && !in_array($this->container['account_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'account_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['modules'] === null) {
            $invalidProperties[] = "'modules' can't be null";
        }
        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['number_of_vouchers'] === null) {
            $invalidProperties[] = "'number_of_vouchers' can't be null";
        }
        $allowedValues = $this->getNumberOfVouchersAllowableValues();
        if (!is_null($this->container['number_of_vouchers']) && !in_array($this->container['number_of_vouchers'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'number_of_vouchers', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getChartOfAccountsTypeAllowableValues();
        if (!is_null($this->container['chart_of_accounts_type']) && !in_array($this->container['chart_of_accounts_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'chart_of_accounts_type', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets administrator
     *
     * @return \Tripletex\Model\Employee
     */
    public function getAdministrator()
    {
        return $this->container['administrator'];
    }

    /**
     * Sets administrator
     *
     * @param \Tripletex\Model\Employee $administrator administrator
     *
     * @return $this
     */
    public function setAdministrator($administrator)
    {
        $this->container['administrator'] = $administrator;

        return $this;
    }

    /**
     * Gets customer_id
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->container['customer_id'];
    }

    /**
     * Sets customer_id
     *
     * @param int $customer_id The customer id to an already created customer to create a Tripletex account for.
     *
     * @return $this
     */
    public function setCustomerId($customer_id)
    {
        $this->container['customer_id'] = $customer_id;

        return $this;
    }

    /**
     * Gets account_type
     *
     * @return string
     */
    public function getAccountType()
    {
        return $this->container['account_type'];
    }

    /**
     * Sets account_type
     *
     * @param string $account_type account_type
     *
     * @return $this
     */
    public function setAccountType($account_type)
    {
        $allowedValues = $this->getAccountTypeAllowableValues();
        if (!in_array($account_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'account_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['account_type'] = $account_type;

        return $this;
    }

    /**
     * Gets modules
     *
     * @return \Tripletex\Model\Modules
     */
    public function getModules()
    {
        return $this->container['modules'];
    }

    /**
     * Sets modules
     *
     * @param \Tripletex\Model\Modules $modules modules
     *
     * @return $this
     */
    public function setModules($modules)
    {
        $this->container['modules'] = $modules;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type type
     *
     * @return $this
     */
    public function setType($type)
    {
        $allowedValues = $this->getTypeAllowableValues();
        if (!in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets send_emails
     *
     * @return bool
     */
    public function getSendEmails()
    {
        return $this->container['send_emails'];
    }

    /**
     * Sets send_emails
     *
     * @param bool $send_emails Should the emails normally sent during creation be sent in this case?
     *
     * @return $this
     */
    public function setSendEmails($send_emails)
    {
        $this->container['send_emails'] = $send_emails;

        return $this;
    }

    /**
     * Gets auto_validate_user_login
     *
     * @return bool
     */
    public function getAutoValidateUserLogin()
    {
        return $this->container['auto_validate_user_login'];
    }

    /**
     * Sets auto_validate_user_login
     *
     * @param bool $auto_validate_user_login Should the user be automatically validated?
     *
     * @return $this
     */
    public function setAutoValidateUserLogin($auto_validate_user_login)
    {
        $this->container['auto_validate_user_login'] = $auto_validate_user_login;

        return $this;
    }

    /**
     * Gets create_api_token
     *
     * @return bool
     */
    public function getCreateApiToken()
    {
        return $this->container['create_api_token'];
    }

    /**
     * Sets create_api_token
     *
     * @param bool $create_api_token Creates a token for the admin user. The accounting office could also use their tokens so you might not need this.
     *
     * @return $this
     */
    public function setCreateApiToken($create_api_token)
    {
        $this->container['create_api_token'] = $create_api_token;

        return $this;
    }

    /**
     * Gets send_invoice_to_customer
     *
     * @return bool
     */
    public function getSendInvoiceToCustomer()
    {
        return $this->container['send_invoice_to_customer'];
    }

    /**
     * Sets send_invoice_to_customer
     *
     * @param bool $send_invoice_to_customer Should the invoices for this account be sent to the customer?
     *
     * @return $this
     */
    public function setSendInvoiceToCustomer($send_invoice_to_customer)
    {
        $this->container['send_invoice_to_customer'] = $send_invoice_to_customer;

        return $this;
    }

    /**
     * Gets customer_invoice_email
     *
     * @return string
     */
    public function getCustomerInvoiceEmail()
    {
        return $this->container['customer_invoice_email'];
    }

    /**
     * Sets customer_invoice_email
     *
     * @param string $customer_invoice_email The address to send the invoice to at the customer.
     *
     * @return $this
     */
    public function setCustomerInvoiceEmail($customer_invoice_email)
    {
        $this->container['customer_invoice_email'] = $customer_invoice_email;

        return $this;
    }

    /**
     * Gets number_of_employees
     *
     * @return int
     */
    public function getNumberOfEmployees()
    {
        return $this->container['number_of_employees'];
    }

    /**
     * Sets number_of_employees
     *
     * @param int $number_of_employees The number of employees in the customer company. Is used for calculating prices and setting some default settings, i.e. approval settings for timesheet.
     *
     * @return $this
     */
    public function setNumberOfEmployees($number_of_employees)
    {
        $this->container['number_of_employees'] = $number_of_employees;

        return $this;
    }

    /**
     * Gets number_of_vouchers
     *
     * @return string
     */
    public function getNumberOfVouchers()
    {
        return $this->container['number_of_vouchers'];
    }

    /**
     * Sets number_of_vouchers
     *
     * @param string $number_of_vouchers Number of vouchers each year. Used to calculate prices.
     *
     * @return $this
     */
    public function setNumberOfVouchers($number_of_vouchers)
    {
        $allowedValues = $this->getNumberOfVouchersAllowableValues();
        if (!in_array($number_of_vouchers, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'number_of_vouchers', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['number_of_vouchers'] = $number_of_vouchers;

        return $this;
    }

    /**
     * Gets administrator_password
     *
     * @return string
     */
    public function getAdministratorPassword()
    {
        return $this->container['administrator_password'];
    }

    /**
     * Sets administrator_password
     *
     * @param string $administrator_password The password of the administrator user.
     *
     * @return $this
     */
    public function setAdministratorPassword($administrator_password)
    {
        $this->container['administrator_password'] = $administrator_password;

        return $this;
    }

    /**
     * Gets chart_of_accounts_type
     *
     * @return string
     */
    public function getChartOfAccountsType()
    {
        return $this->container['chart_of_accounts_type'];
    }

    /**
     * Sets chart_of_accounts_type
     *
     * @param string $chart_of_accounts_type The chart of accounts to use for the new company
     *
     * @return $this
     */
    public function setChartOfAccountsType($chart_of_accounts_type)
    {
        $allowedValues = $this->getChartOfAccountsTypeAllowableValues();
        if (!is_null($chart_of_accounts_type) && !in_array($chart_of_accounts_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'chart_of_accounts_type', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['chart_of_accounts_type'] = $chart_of_accounts_type;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
